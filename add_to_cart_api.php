<?php 
include("connection_db.php");
$response = [];
$quantity = 1;
if(isset($_POST["product_id"]))
{
    $product_id = $_POST["product_id"];
    $sql = "insert into carts (product_id, quantity) values (?, ?)";
    $query = $link->prepare($sql);
    $query->bind_param("ii",$product_id,$quantity);
    $result = $query->execute();
    if ($result) {
        $response["result"] = "added succefuly";
    }
    else {
        $response["result"] = "can't add to cart";
    }
        }

        else {
            print($_POST["product_id"]);
            $response["result"] = "error";
        }

echo json_encode($response);