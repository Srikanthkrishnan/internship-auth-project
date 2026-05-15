<?php

header("Content-Type: application/json");

include "config.php";

$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

if (!$name || !$email || !$password) {

    echo json_encode([
        "status" => "error",
        "message" => "All fields required"
    ]);

    exit;
}

$hashed = password_hash($password, PASSWORD_DEFAULT);

$stmt = $conn->prepare(
    "INSERT INTO users(name,email,password) VALUES(?,?,?)"
);

$stmt->bind_param("sss", $name, $email, $hashed);

if ($stmt->execute()) {

    echo json_encode([
        "status" => "success",
        "message" => "Registered Successfully"
    ]);

} else {

    echo json_encode([
        "status" => "error",
        "message" => "Registration Failed"
    ]);
}