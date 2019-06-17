<?php

include "init.php";

$restaurant = $_GET['restaurant'];

addRestaurant($conn,$restaurant);

function addRestaurant($conn,$restaurant) {
    global $handle;
    $sql = "INSERT INTO `restaurants` (name) VALUES (:restaurant)";
    $handle= $conn->prepare($sql);
    $handle->bindParam('restaurant',$restaurant,PDO::PARAM_STR);
    $handle->execute();

    echo "Restaurant Added!";

    $handle->closeCursor();	
}

?>