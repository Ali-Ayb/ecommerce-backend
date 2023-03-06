<?php

include('connection_db.php');
$photo_path = '';
if (isset($_POST["product_img"])) {
    $code64 = explode(',', $_POST["product_img"]);
    $img = base64_decode($code64[1]);
    $extension = explode(";", explode('/', $code64[0])[1])[0];
    $photo_path = "images/" . uniqid() . "." . $extension;
    file_put_contents($photo_path, $img);
}

$product_name = $_POST['product_name'];
$product_brand = $_POST['product_brand'];
$product_price = $_POST['product_price'];
$product_img = $photo_path;

$product_category = $_POST['product_category'];
$product_description = $_POST['product_description'];
$product_model_number = $_POST['product_model_number'];
$product_quantity = $_POST['product_quantity'];

$sql = "INSERT INTO products (product_name, product_brand, product_price, product_img, product_category, product_description, product_model_number, product_quantity) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($link, $sql);
mysqli_stmt_bind_param($stmt, "ssissssi", $product_name, $product_brand, $product_price, $product_img, $product_category, $product_description, $product_model_number, $product_quantity);
$result = mysqli_stmt_execute($stmt);

$response = [
    'response' => $result
];
echo json_encode($response);
