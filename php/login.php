<?php

$conn = new mysqli("127.0.0.1", "root", "", "internship_auth", 3307);

if ($conn->connect_error) {
    die(json_encode([
        "status" => "error",
        "message" => "Database Connection Failed"
    ]));
}

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE email='$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    $user = $result->fetch_assoc();

    // Verify hashed password
    if (password_verify($password, $user['password'])) {

        echo json_encode([
            "status" => "success",
            "message" => "Login Successful"
        ]);

    } else {

        echo json_encode([
            "status" => "error",
            "message" => "Invalid Password"
        ]);
    }

} else {

    echo json_encode([
        "status" => "error",
        "message" => "User Not Found"
    ]);
}

?>