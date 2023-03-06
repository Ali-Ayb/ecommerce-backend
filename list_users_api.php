<?php
include('connection_db.php');

$sql = "select * from users";

$result = mysqli_query($link,$sql);
$users = mysqli_fetch_all($result,MYSQLI_ASSOC);
echo json_encode($users);
?>