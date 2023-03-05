<?php
include('connection_db.php');


$response = [];

if(isset($_POST["user_id"])){
    $user_id = $_POST["user_id"];
    $query = $link->prepare('select user_id,email,password,first_name,last_name,age,gender,date_created,deleted from users where user_id=?');
$query->bind_param('s', $user_id);
$query->execute();

$query->store_result();
$num_rows = $query->num_rows();
$query->bind_result($user_id, $email, $hashed_password, $first_name, $last_name,$age, $gender,$date_created,$deleted);
$query->fetch();
if ($num_rows == 0) {
    $response['response'] = "user not found";
} else {
    
        $response['user_id'] = $user_id;
        $response['email'] = $email;
        $response['first_name'] = $first_name;
        $response['last_name'] = $last_name;
        $response['hashed_password'] = $hashed_password;
        $response['age'] = $age;
        $response['gender'] = $gender;
        $response['date_created'] = $date_created;
        $response['deleted'] = $deleted;
  
}
}

else {
    $response["result"] = "error";
}

echo json_encode($response);
