<?php

include "init.php";

$group = $_GET['group'];

updateCustomerGroup($conn,$group);

function updateCustomerGroup($conn,$group) {
    global $handle;
    $str = "";      
    $sql = "INSERT INTO `groups` (name) VALUES (:group)";
    $handle= $conn->prepare($sql);
    $handle->bindParam('group',$group,PDO::PARAM_STR);
    $handle->execute();

    echo "Customer Added!";

    $handle->closeCursor();	
}

?>