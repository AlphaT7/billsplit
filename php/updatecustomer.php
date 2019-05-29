<?php

include "init.php";

$id = $_GET["id"];
$f_name = $_GET["f_name"];
$l_name = $_GET["l_name"];
$nickname = $_GET["nickname"];
$email = $_GET["email"];

updateCustomer($conn,$id,$f_name,$l_name,$nickname,$email);

function updateCustomer($conn,$id,$f_name,$l_name,$nickname,$email) {
    global $handle;
    $str = "";
    $sql = "UPDATE `customers` SET f_name = :f_name, l_name = :l_name, nickname = :nickname, email = :email WHERE id = :id"; 
    $handle= $conn->prepare($sql);
    $handle->bindParam('id',$id,PDO::PARAM_STR);
    $handle->bindParam('f_name',$f_name,PDO::PARAM_STR);
    $handle->bindParam('l_name',$l_name,PDO::PARAM_STR);
    $handle->bindParam('nickname',$nickname,PDO::PARAM_STR);
    $handle->bindParam('email',$email,PDO::PARAM_STR);
    $handle->execute();
    //$query_results = $handle->fetchAll(PDO::FETCH_BOTH);
    //echo json_encode($query_results); 

    echo "Customer Updated!";

    $handle->closeCursor();	
}

?>