<?php

include("connection_db.php");

$response = [];

if(isset($_POST["cart_id"])){
    $cart_id = $_POST["cart_id"];
    $sql = "delete from carts where cart_id = ?";

    $query = $link->prepare($sql);
    $query->bind_param('s', $cart_id);
    $result = $query->execute();

if($result){
    $response["result"] = "removes succefully !";
}

else {
    $response["result"] = "can't remove";
}
}
else {
    print($_POST["cart_id"]);
    $response["result"] = "error";
}

echo json_encode($response);
