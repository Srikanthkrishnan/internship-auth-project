<!-- <?php

include 'config.php';

$name = $_POST['name'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$stmt = $mysql->prepare(
    "INSERT INTO users(name, email, password) VALUES (?, ?, ?)"
);

$stmt->bind_param("sss", $name, $email, $password);

if ($stmt->execute()) {
    echo json_encode([
        "status" => true,
        "message" => "Registration successful"
    ]);
} else {
    echo json_encode([
        "status" => false,
        "message" => "Email already exists"
    ]);
}

?> -->


<?php

header("Content-Type: application/json");

include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = trim($_POST['name']);

    $email = trim($_POST['email']);

    $password = password_hash(
        $_POST['password'],
        PASSWORD_DEFAULT
    );

    $check = $conn->prepare(
        "SELECT id FROM users WHERE email=?"
    );

    $check->bind_param("s", $email);

    $check->execute();

    $result = $check->get_result();

    if ($result->num_rows > 0) {

        echo json_encode([

            "status" => "error",

            "message" => "Email already exists"

        ]);

        exit();

    }

    $stmt = $conn->prepare(

        "INSERT INTO users(name,email,password)
         VALUES(?,?,?)"

    );

    $stmt->bind_param(

        "sss",

        $name,

        $email,

        $password

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

} else {

    echo json_encode([

        "status" => "error",

        "message" => "Invalid Request"

    ]);

}

?>