<?php

header('Content-Type: application/json');

include("connection_db.php");

$sql = 'select * from products';

$result = mysqli_query($link,$sql);
$products = mysqli_fetch_all($result,MYSQLI_ASSOC);
echo json_encode($products)
?>