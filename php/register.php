<?php

header("Content-Type: application/json");

require "config.php";

$username = trim($_POST["username"] ?? "");
$email = trim($_POST["email"] ?? "");
$password = trim($_POST["password"] ?? "");

if (empty($username) || empty($email) || empty($password)) {

    echo json_encode([
        "status" => "error",
        "message" => "All fields are required"
    ]);

    exit;
}

$check = $conn->prepare(
    "SELECT id FROM users WHERE email = ?"
);

$check->bind_param("s", $email);

$check->execute();

$result = $check->get_result();

if ($result->num_rows > 0) {

    echo json_encode([
        "status" => "error",
        "message" => "Email already exists"
    ]);

    exit;
}

$hashedPassword = password_hash(
    $password,
    PASSWORD_DEFAULT
);

$sql = "INSERT INTO users
(username, email, password)
VALUES (?, ?, ?)";

$stmt = $conn->prepare($sql);

$stmt->bind_param(
    "sss",
    $username,
    $email,
    $hashedPassword
);

if ($stmt->execute()) {

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