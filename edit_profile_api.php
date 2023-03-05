

<?php

include("connection_db.php");

$response = [];

if(isset($_POST["fname"])
 && isset($_POST["lname"])
 && isset($_POST["user_id"])
 && isset($_POST["email"])
 && isset($_POST["password"])
 && isset($_POST["address"])
 && isset($_POST["contact_number"])
 && isset($_POST["city"])
 && isset($_POST["state"])
 ){
    $user_id = $_POST["user_id"];
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $address = $_POST["address"];
    $contact_number = $_POST["contact_number"];
    $city = $_POST["city"];
    $state = $_POST["state"];
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    $sql1 = "update users
     set email = ?,
    first_name = ?,
    last_name = ?,
    password = ?
    where user_id = ?;";

    $query1 = $link->prepare($sql1);
    $query1->bind_param('ssssi',$email,$fname,$lname,$password,$user_id);
    $result1 = $query1->execute();

    $query = $link->prepare('select * from locations where user_id=?');
    $query->bind_param('i', $user_id);
    $query->execute();

    $query->store_result();
    $num_rows = $query->num_rows();


    if($num_rows == 0){
            $sql2 = "insert into locations (address,city, state, contact_number,user_id) values (?, ?, ?, ?,?)";
            $query2 = $link->prepare($sql2);
            $query2->bind_param("ssssi",$address,$city,$state,$contact_number,$user_id);
            $result2 = $query2->execute();
        }   
    else {
        $sql2 = " update locations set 
        address = ?,
        city = ?,
        state = ?,
        contact_number =?
        where user_id = ?";

        $query2 = $link->prepare($sql2);
        $query2->bind_param("ssssi",$address,$city,$state,$contact_number,$user_id);
        $result2 = $query2->execute();
    }
    

if($result1 && $result2){
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
