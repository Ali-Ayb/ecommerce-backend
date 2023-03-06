<?php

include("connection_db.php");
$sql_query = "select * from favorites";
$result = $link -> query($sql_query);
$response = [];

$row = $result -> fetch_array(MYSQLI_NUM);

echo json_encode($row);

?>