<?php

include "init.php";

$f_name = $_GET['f_name'];
$l_name = $_GET['l_name'];
$nickname = $_GET['nickname'];
$email = $_GET['email'];

addCustomer($conn,$f_name,$l_name,$nickname,$email);

function addCustomer($conn,$f_name,$l_name,$nickname,$email) {
    global $handle;

    $sql = "INSERT INTO `customers` (f_name, l_name, nickname, email) VALUES (:f_name,:l_name,:nickname,:email)";
    $handle= $conn->prepare($sql);
    $handle->bindParam('f_name',$f_name,PDO::PARAM_STR);
    $handle->bindParam('l_name',$l_name,PDO::PARAM_STR);
    $handle->bindParam('nickname',$nickname,PDO::PARAM_STR);
    $handle->bindParam('email',$email,PDO::PARAM_STR);
    $handle->execute();

    $sql = "INSERT INTO `g2c` (group_id, user_id) VALUES (0,(SELECT id FROM `customers` WHERE f_name = :f_name AND l_name = :l_name AND nickname = :nickname AND email = :email))";
    $handle= $conn->prepare($sql);
    $handle->bindParam('f_name',$f_name,PDO::PARAM_STR);
    $handle->bindParam('l_name',$l_name,PDO::PARAM_STR);
    $handle->bindParam('nickname',$nickname,PDO::PARAM_STR);
    $handle->bindParam('email',$email,PDO::PARAM_STR);
    $handle->execute();

    echo "Customer Added!";

    $handle->closeCursor();	
}

?>