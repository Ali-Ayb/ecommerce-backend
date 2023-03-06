<?php

include("connection_db.php");


$response = [];
    if(isset($_POST["user_id"]) && isset($_POST["cart_id"])){
        $user_id = $_POST["user_id"];
        $cart_id = $_POST["cart_id"];
        $date = "date";
        $sql = "insert into orders (user_id, cart_id,date) values(?,?,?)";
        $query = $link->prepare($sql);
        $query->bind_param('iis',$user_id ,$cart_id,$date);
        $result = $query->execute();
        
        if($result){
            $response["result"] = "order succefully posted !";
        }
        
        else {
            $response["result"] = "can't order";
        }
    
        }
    else {
        $response["result"] = "error";
    }

 

echo json_encode($response);