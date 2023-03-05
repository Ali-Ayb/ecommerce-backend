<?php

include("connection_db.php");

$response = [];

if(isset($_POST["cart_id"])){
    $cart_id = $_POST["cart_id"];
    $query = "delete from carts where cart_id = $cart_id";

if(mysqli_query($link, $query)){
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
