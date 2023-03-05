<?php

include("connection_db.php");


$response = [];
    if(isset($_POST["user_id"]) && isset($_POST["cart_id"])){
        $user_id = $_POST["user_id"];
        $cart_id = $_POST["cart_id"];
        $date = "date";
        $query = "insert into orders (user_id, cart_id,date) values(1,1,'date')";
    
        if (mysqli_query($link,$query)){
            $response["result"] = "New record created successfully";
        }
        else {
            $response["result"] = "error while posting order";
        }
    
    }
    else {
        print($_POST["cart_id"]);
        $response["result"] = "error";
    }



echo json_encode($response);