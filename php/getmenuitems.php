<?php

include "init.php";

$restaurant_id = $_GET["restaurant_id"];

getMenuItems($conn,$restaurant_id);

function getMenuItems($conn,$restaurant_id) {
    global $handle;
    $sql = "SELECT * FROM `menus` WHERE restaurant_id = :restaurant_id";
    $handle= $conn->prepare($sql);
    $handle->bindParam('restaurant_id',$restaurant_id,PDO::PARAM_STR);
    $handle->execute();
    $query_results = $handle->fetchAll(PDO::FETCH_BOTH);
    echo json_encode($query_results); 

    $handle->closeCursor();	
}

?>