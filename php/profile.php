<?php

include 'config.php';

/*
|--------------------------------------------------------------------------
| Check Session
|--------------------------------------------------------------------------
*/

$token = $_POST['token'];

if (!$redis->get($token)) {

    echo json_encode([

        "status" => "error",

        "message" => "Unauthorized"

    ]);

    exit;
}

/*
|--------------------------------------------------------------------------
| Get Data
|--------------------------------------------------------------------------
*/

$user_id = $_POST['user_id'];

$age = $_POST['age'];

$dob = $_POST['dob'];

$contact = $_POST['contact'];

/*
|--------------------------------------------------------------------------
| MongoDB Collection
|--------------------------------------------------------------------------
*/

$collection =
    $mongoDB->profiles;

/*
|--------------------------------------------------------------------------
| Save Profile
|--------------------------------------------------------------------------
*/

$collection->updateOne(

    [ "user_id" => $user_id ],

    [

        '$set' => [

            "age" => $age,

            "dob" => $dob,

            "contact" => $contact
        ]

    ],

    [ "upsert" => true ]
);

echo json_encode([

    "status" => "success",

    "message" => "Profile Saved"

]);

?>