<?php 

include("connection_db.php");

$sql_query = "select * from products";
$result = $link -> query($sql_query);
$response = [];

while ($row = $result -> fetch_array(MYSQLI_NUM)){
    $arr = [];
    $arr ['product_id'] = $row[0];
    $arr ['product_name'] = $row[1];
    $arr ['product_brand'] = $row[2];
    $arr ['product_price'] = $row[3];
    $arr ['product_img'] = $row[4];
    $arr ['product_category'] = $row[5];
    $arr ['product_description'] = $row[6];
    $arr ['product_model_number'] = $row[7];
    $arr ['product_quantity'] = $row[8];

    array_push($response,$arr);
}
echo json_encode($response);

?>