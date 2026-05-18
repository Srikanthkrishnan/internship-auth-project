<?php

header("Content-Type: application/json");

require "config.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {

    echo json_encode([
        "status" => "error",
        "message" => "Invalid Request"
    ]);

    exit;
}

$email = trim($_POST["email"] ?? "");
$password = trim($_POST["password"] ?? "");

if (empty($email) || empty($password)) {

    echo json_encode([
        "status" => "error",
        "message" => "All fields are required"
    ]);

    exit;
}

$sql = "SELECT * FROM users WHERE email = ?";

$stmt = $conn->prepare($sql);

$stmt->bind_param("s", $email);

$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows === 0) {

    echo json_encode([
        "status" => "error",
        "message" => "User Not Found"
    ]);

    exit;
}

$user = $result->fetch_assoc();

if (!password_verify($password, $user["password"])) {

    echo json_encode([
        "status" => "error",
        "message" => "Invalid Password"
    ]);

    exit;
}

$token = bin2hex(random_bytes(16));

echo json_encode([
    "status" => "success",
    "message" => "Login Successful",
    "token" => $token,
    "username" => $user["username"]
]);

?>