<?php

include "init.php";

$id = $_GET['id'];

delCustomer($conn,$id);

function delCustomer($conn,$id) {
    global $handle;
    $sql = "DELETE FROM `customers` WHERE id = :id";
    $handle= $conn->prepare($sql);
    $handle->bindParam('id',$id,PDO::PARAM_STR);
    $handle->execute();

    $sql = "DELETE FROM `g2c` WHERE customer_id = :id";
    $handle= $conn->prepare($sql);
    $handle->bindParam('id',$id,PDO::PARAM_STR);
    $handle->execute();

    echo "Customer Deleted!";

    $handle->closeCursor();	
}

?>