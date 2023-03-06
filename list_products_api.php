<?php

include("connection_db.php");

$sql = 'select product_name, product_brand,product_price,product_img,product_quantity from products where deleted != 1';

$result = mysqli_query($link, $sql);
$products = mysqli_fetch_all($result);
echo json_encode($products);
