<?php
include('connection_db.php');


$response = [];

if(isset($_POST["user_id"])){
    $user_id = $_POST["user_id"];
    $query = $link->prepare('select * from locations where user_id=?');
$query->bind_param('s', $user_id);
$query->execute();

$query->store_result();
$num_rows = $query->num_rows();
$query->bind_result($location_id, $address, $city, $state, $contact_number,$_user_id);
$query->fetch();
if ($num_rows == 0) {
    $response['response'] = "user not found";
} else {

        $response["result"] = "succecfully";
        $response["location_id"] = $location_id;
        $response['address'] = $address;
        $response['city'] = $city;
        $response['state'] = $state;
        $response['contact_number'] = $contact_number;
        $response['user_id'] = $user_id;
      
}
}

else {
    print( $_POST["user_id"]);
    $response["result"] = "error";

}

echo json_encode($response);