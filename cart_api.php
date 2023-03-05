<?php 

include("connection_db.php");

// $query = $link->prepare();
// $query->execute();
// $query->store_result();
// $num_rows = $query->num_rows();

$result = $link->query('select  p.product_name, p.product_img, p.product_description, p.product_price, c.quantity from products p,
    carts c where p.product_id = c.product_id
');
$response = [];
while($row = $result -> fetch_array(MYSQLI_NUM)){
    $arr = [];
    $arr['name'] = $row[0];
    $arr['img'] = $row[1];
    $arr['desc'] = $row[2];
    $arr['price'] = $row[3];
    array_push($response,$arr);
}

echo json_encode($response);