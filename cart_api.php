<?php 

include("connection_db.php");


$results = [];
$result = $link->query('select c.cart_id, p.product_name, p.product_img, p.product_description, p.product_price, c.quantity  from products p,
    carts c  where p.product_id = c.product_id
');
$response = [];
while($row = $result -> fetch_array(MYSQLI_NUM)){
    $arr = [];
    $arr['cart_id'] = $row[0];
    $arr['name'] = $row[1];
    $arr['img'] = $row[2];
    $arr['desc'] = $row[3];
    $arr['price'] = $row[4];
    $arr['quantity'] = $row[5];
    array_push($response,$arr);
}
    $results["response"] = $response;
    $query = $link->prepare('select sum(c.quantity * p.product_price) as total from carts c, products p 
    where c.product_id = p.product_id
    ');
    $query->execute();
    $query->store_result();
    $num_rows = $query->num_rows();
    if ($num_rows === 0) {
        $results["total"] = 0;
    }
    else{
        $query->bind_result($total);
        print($total);
        $query->fetch();
        $results["total"] = $total;

    }
echo json_encode($results);