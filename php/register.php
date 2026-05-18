<?php

header("Content-Type: application/json");

require 'config.php';

// Get JSON data
$data = json_decode(file_get_contents("php://input"), true);

// Validate input
if (
    !isset($data['username']) ||
    !isset($data['email']) ||
    !isset($data['password'])
) {
    echo json_encode([
        "status" => "error",
        "message" => "All fields are required"
    ]);
    exit;
}

$username = trim($data['username']);
$email = trim($data['email']);
$password = trim($data['password']);

// Check empty fields
if (empty($username) || empty($email) || empty($password)) {

    echo json_encode([
        "status" => "error",
        "message" => "Please fill all fields"
    ]);

    exit;
}

// Check existing email
$checkQuery = "SELECT id FROM users WHERE email = ?";

$checkStmt = $conn->prepare($checkQuery);

$checkStmt->bind_param("s", $email);

$checkStmt->execute();

$checkResult = $checkStmt->get_result();

if ($checkResult->num_rows > 0) {

    echo json_encode([
        "status" => "error",
        "message" => "Email already exists"
    ]);

    exit;
}

// Hash password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Insert user
$insertQuery = "INSERT INTO users(username, email, password)
VALUES (?, ?, ?)";

$insertStmt = $conn->prepare($insertQuery);

$insertStmt->bind_param(
    "sss",
    $username,
    $email,
    $hashedPassword
);

if ($insertStmt->execute()) {

    echo json_encode([
        "status" => "success",
        "message" => "Registration Successful"
    ]);

} else {

    echo json_encode([
        "status" => "error",
        "message" => "Registration Failed"
    ]);
}

?>