<?php

include "init.php";

$id = $_GET['id'];

delCustomerGroup($conn,$id);

function delCustomerGroup($conn,$id) {
    global $handle;
    $sql = "DELETE FROM `groups` WHERE id = :id";
    $handle= $conn->prepare($sql);
    $handle->bindParam('id',$id,PDO::PARAM_STR);
    $handle->execute();

    $sql = "DELETE FROM `g2c` WHERE group_id = :id";
    $handle= $conn->prepare($sql);
    $handle->bindParam('id',$id,PDO::PARAM_STR);
    $handle->execute();

    echo "Group Deleted!";

    $handle->closeCursor();	
}

?>