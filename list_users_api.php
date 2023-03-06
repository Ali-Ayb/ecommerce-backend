<?php
header('Content-Type: application/json');
include('connection_db.php');

$sql = "select user_id, first_name, last_name,age,gender,email from users";

$result = mysqli_query($link,$sql);
$users = mysqli_fetch_all($result,MYSQLI_ASSOC);
echo json_encode($users);
?>