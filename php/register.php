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

include 'config.php';

$name = $_POST['name'];
$email = $_POST['email'];

$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$stmt = $conn->prepare(
"INSERT INTO users(name,email,password) VALUES(?,?,?)"
);

$stmt->bind_param("sss",$name,$email,$password);

if($stmt->execute()){

    echo json_encode([
        "status"=>"success",
        "message"=>"Registration Successful"
    ]);

}else{

    echo json_encode([
        "status"=>"error",
        "message"=>"Registration Failed"
    ]);

}

?>