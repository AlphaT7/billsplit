<?php

include "init.php";

$group = $_GET['group'];

addGroup($conn,$group);

function addGroup($conn,$group) {
    global $handle;
    $sql = "INSERT INTO `groups` (name) VALUES (:group)";
    $handle= $conn->prepare($sql);
    $handle->bindParam('group',$group,PDO::PARAM_STR);
    $handle->execute();

    echo "Customer Added!";

    $handle->closeCursor();	
}

?>