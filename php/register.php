<!-- <?php

include 'config.php';

$username = $_POST['username'];
$email = $_POST['email'];

$password = password_hash(
    $_POST['password'],
    PASSWORD_DEFAULT
);

$stmt = $mysql->prepare(
    "INSERT INTO users(username,email,password)
     VALUES(?,?,?)"
);

$stmt->bind_param(
    "sss",
    $username,
    $email,
    $password
);

if ($stmt->execute()) {

    echo "Registration Successful";

} else {

    echo "Registration Failed";
}

?> -->






<?php

include 'config.php';

/*
|--------------------------------------------------------------------------
| Get Form Data
|--------------------------------------------------------------------------
*/

$username = $_POST['username'];
$email = $_POST['email'];

$password = password_hash(
    $_POST['password'],
    PASSWORD_DEFAULT
);

/*
|--------------------------------------------------------------------------
| Insert User
|--------------------------------------------------------------------------
*/

$stmt = $mysql->prepare(
    "INSERT INTO users(username,email,password)
     VALUES(?,?,?)"
);

$stmt->bind_param(
    "sss",
    $username,
    $email,
    $password
);

/*
|--------------------------------------------------------------------------
| Execute Query
|--------------------------------------------------------------------------
*/

if ($stmt->execute()) {

    echo "Registration Successful";

} else {

    echo "Registration Failed";
}

?>