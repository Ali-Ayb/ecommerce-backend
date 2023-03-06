<?php
include('connection_db.php');

$sql = "select email, first_name, last_name, gender,age from users where deleted = 0";

$result = mysqli_query($link, $sql);
$users = mysqli_fetch_all($result);
echo json_encode($users);
