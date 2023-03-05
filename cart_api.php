<?php 

include("connection_db.php");

// $query = $link->prepare();
// $query->execute();
// $query->store_result();
// $num_rows = $query->num_rows();

$result = $link->query('select c.cart_id, p.product_name, p.product_img, p.product_description, p.product_price, c.quantity from products p,
    carts c where p.product_id = c.product_id
');
$response = [];
while($row = $result -> fetch_array(MYSQLI_NUM)){
    $arr = [];
    $arr['cart_id'] = $row[0];
    $arr['name'] = $row[1];
    $arr['img'] = $row[2];
    $arr['desc'] = $row[3];
    $arr['price'] = $row[4];
    array_push($response,$arr);
}

echo json_encode($response);