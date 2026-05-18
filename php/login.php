<?php

header("Content-Type: application/json");

require 'config.php';

// Get JSON data
$data = json_decode(file_get_contents("php://input"), true);

// Validate input
if (
    !isset($data['email']) ||
    !isset($data['password'])
) {
    echo json_encode([
        "status" => "error",
        "message" => "All fields are required"
    ]);
    exit;
}

$email = trim($data['email']);
$password = trim($data['password']);

// Check empty fields
if (empty($email) || empty($password)) {

    echo json_encode([
        "status" => "error",
        "message" => "Please fill all fields"
    ]);

    exit;
}

// Find user
$query = "SELECT * FROM users WHERE email = ?";

$stmt = $conn->prepare($query);

$stmt->bind_param("s", $email);

$stmt->execute();

$result = $stmt->get_result();

// User not found
if ($result->num_rows === 0) {

    echo json_encode([
        "status" => "error",
        "message" => "User Not Found"
    ]);

    exit;
}

$user = $result->fetch_assoc();

// Verify password
if (!password_verify($password, $user['password'])) {

    echo json_encode([
        "status" => "error",
        "message" => "Invalid Password"
    ]);

    exit;
}

// Create session token
$sessionToken = bin2hex(random_bytes(16));

// Store session in Redis
$redis->set(
    $sessionToken,
    json_encode([
        "id" => $user['id'],
        "username" => $user['username'],
        "email" => $user['email']
    ])
);

// Store token for 1 hour
$redis->expire($sessionToken, 3600);

// Success response
echo json_encode([
    "status" => "success",
    "message" => "Login Successful",
    "token" => $sessionToken,
    "user" => [
        "id" => $user['id'],
        "username" => $user['username'],
        "email" => $user['email']
    ]
]);

?>