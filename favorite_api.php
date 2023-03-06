<?php

include("connection_db.php");
$sql_query = "select * from favorites";
$result = $link -> query($sql_query);
$response = [];

while($row = $result -> fetch_array(MYSQLI_NUM)) {
    $arr = [];
    $arr['user_id'] = $row[0];
    $arr['product_id'] = $row[1];

    array_push($response, $arr);
}

echo json_encode($response);

?>