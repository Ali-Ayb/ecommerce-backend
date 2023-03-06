<?php
include 'connection_db.php';

$product_id = $_POST['product_id'];

$stmt = mysqli_prepare($link, "UPDATE products SET deleted = 1 where product_id = ?");
mysqli_stmt_bind_param($stmt, "i", $product_id);

echo json_encode(mysqli_stmt_execute($stmt));
