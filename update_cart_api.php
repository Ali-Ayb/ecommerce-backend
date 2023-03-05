

<?php

include("connection_db.php");

$response = [];

if(isset($_POST["quantity"]) && isset($_POST["cart_id"])){
    $quantity = $_POST["quantity"];
    $cart_id = $_POST["cart_id"];
    $sql = " update carts set quantity = $quantity where cart_id = ?";

    $query = $link->prepare($sql);
    $query->bind_param('s', $cart_id);
    $result = $query->execute();

if($result){
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
