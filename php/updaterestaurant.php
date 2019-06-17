<?php

include "init.php";

$id = $_GET["id"];
$name = $_GET["name"];
$phone = $_GET["phone"];
$website = $_GET["website"];

updateRestaurant($conn,$id,$name,$phone,$website);

function updateRestaurant($conn,$id,$name,$phone,$website) {
    global $handle;
    $sql = "UPDATE `restaurants` SET name = :name, phone = :phone, website = :website WHERE id = :id"; 
    $handle= $conn->prepare($sql);
    $handle->bindParam('id',$id,PDO::PARAM_STR);
    $handle->bindParam('name',$name,PDO::PARAM_STR);
    $handle->bindParam('phone',$phone,PDO::PARAM_STR);
    $handle->bindParam('website',$website,PDO::PARAM_STR);
    $handle->execute();
    //$query_results = $handle->fetchAll(PDO::FETCH_BOTH);
    //echo json_encode($query_results); 

    echo "Restaurant Updated!";

    $handle->closeCursor();	
}

?>