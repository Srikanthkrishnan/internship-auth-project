<?php

include 'config.php';

$user_id = $_POST['user_id'];
$age = $_POST['age'];
$dob = $_POST['dob'];
$contact = $_POST['contact'];

$collection = $mongoDB->profiles;

$data = [
    'user_id' => $user_id,
    'age' => $age,
    'dob' => $dob,
    'contact' => $contact
];

$collection->updateOne(
    ['user_id' => $user_id],
    ['$set' => $data],
    ['upsert' => true]
);


echo json_encode([
    "status" => true,
    "message" => "Profile updated"
]);

?>