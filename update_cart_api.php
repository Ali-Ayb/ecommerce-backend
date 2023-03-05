

<?php

include("connection_db.php");

$response = [];

if(isset($_POST["quantity"]) && isset($_POST["cart_id"])){
    $quantity = $_POST["quantity"];
    $cart_id = $_POST["cart_id"];
    $query = " update carts set quantity = $quantity where cart_id = $cart_id";

if(mysqli_query($link, $query)){
    $response["result"] = "updated succefully !";
}

else {
    $response["result"] = "can't update";
}
}
else {
    print($_POST["cart_id"]);
    $response["result"] = "error";
}

echo json_encode($response);
