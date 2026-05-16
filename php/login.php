<?php

header("Content-Type: application/json");

require_once "config.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {

    echo json_encode([
        "status" => "error",
        "message" => "Invalid Request"
    ]);

    exit;
}

/* =========================
   GET FORM DATA
========================= */

$email = trim($_POST["email"] ?? "");
$password = trim($_POST["password"] ?? "");

/* =========================
   VALIDATION
========================= */

if (empty($email) || empty($password)) {

    echo json_encode([
        "status" => "error",
        "message" => "Email and Password required"
    ]);

    exit;
}

/* =========================
   MYSQL LOGIN CHECK
========================= */

$sql = "SELECT * FROM users WHERE email = ?";

$stmt = $conn->prepare($sql);

if (!$stmt) {

    echo json_encode([
        "status" => "error",
        "message" => "SQL Prepare Failed"
    ]);

    exit;
}

$stmt->bind_param("s", $email);

$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows > 0) {

    $user = $result->fetch_assoc();

    /* =========================
       VERIFY PASSWORD
    ========================= */

    if (password_verify($password, $user["password"])) {

        /* =========================
           STORE LOGIN IN REDIS
        ========================= */

        try {

            $redis->set(
                "user_login_" . $user["id"],
                json_encode([
                    "id" => $user["id"],
                    "username" => $user["username"],
                    "email" => $user["email"],
                    "login_time" => date("Y-m-d H:i:s")
                ])
            );

        } catch (Exception $e) {
            // Redis optional
        }

        /* =========================
           STORE LOGIN LOG IN MONGODB
        ========================= */

        try {

            $mongoDB->profiles->insertOne([
                "user_id" => $user["id"],
                "username" => $user["username"],
                "email" => $user["email"],
                "login_time" => date("Y-m-d H:i:s"),
                "ip_address" => $_SERVER["REMOTE_ADDR"] ?? "unknown"
            ]);

        } catch (Exception $e) {
            // MongoDB optional
        }

        echo json_encode([
            "status" => "success",
            "message" => "Login Successful",
            "user" => [
                "id" => $user["id"],
                "username" => $user["username"],
                "email" => $user["email"]
            ]
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

$stmt->close();

$conn->close();

?>