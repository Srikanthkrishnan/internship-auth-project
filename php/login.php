<?php

include 'config.php';

$email = $_POST['email'];
$password = $_POST['password'];

$stmt = $mysql->prepare(
    "SELECT id, password FROM users WHERE email = ?"
);

$stmt->bind_param("s", $email);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows > 0) {

    $user = $result->fetch_assoc();

    if (password_verify($password, $user['password'])) {

        $token = bin2hex(random_bytes(16));

        // STORE SESSION IN REDIS
        $redis->set($token, $user['id']);

        echo json_encode([
            "status" => true,
            "token" => $token,
            "user_id" => $user['id']
        ]);

    } else {

        echo json_encode([
            "status" => false,
            "message" => "Invalid password"
        ]);
    }

} else {

    echo json_encode([
        "status" => false,
        "message" => "User not found"
    ]);
}

?>