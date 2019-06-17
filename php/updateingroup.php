<?php
//set headers to NOT cache a page
header("Cache-Control: no-cache, must-revalidate"); //HTTP 1.1
header("Pragma: no-cache"); //HTTP 1.0
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past

include "init.php";

$customer_id = $_GET["customer_id"];
$group_id = $_GET["group_id"];
$changetype = $_GET["changetype"];

if ( $changetype == "add") {
    addInGroup($conn,$customer_id,$group_id);
} else {
    delInGroup($conn,$customer_id,$group_id);
}

function addInGroup($conn,$customer_id,$group_id) {
    global $handle;
    $sql = "INSERT INTO g2c (group_id, customer_id) VALUES (:group_id, :customer_id)"; 
    $handle= $conn->prepare($sql);
    $handle->bindParam('group_id',$group_id,PDO::PARAM_STR);
    $handle->bindParam('customer_id',$customer_id,PDO::PARAM_STR);
    $handle->execute();

    $sql = "SELECT DISTINCT c.id, c.l_name, c.f_name, c.nickname, c.email, IF(ISNULL(g2c.customer_id)=0 ,'true','false') AS ingroup "; 
    $sql .= "FROM customers c ";
    $sql .= "LEFT JOIN g2c ON c.id = g2c.customer_id AND g2c.group_id=:group_id";
    $handle= $conn->prepare($sql);
    $handle->bindParam('group_id',$group_id,PDO::PARAM_STR);
    $handle->execute();
    $query_results = $handle->fetchAll(PDO::FETCH_BOTH);
    echo json_encode($query_results); 

    $handle->closeCursor();	
}

function delInGroup($conn,$customer_id,$group_id) {
    global $handle;
    $sql = "DELETE FROM g2c WHERE group_id = :group_id AND customer_id = :customer_id"; 
    $handle= $conn->prepare($sql);
    $handle->bindParam('group_id',$group_id,PDO::PARAM_STR);
    $handle->bindParam('customer_id',$customer_id,PDO::PARAM_STR);
    $handle->execute();

    $sql = "SELECT DISTINCT c.id, c.l_name, c.f_name, c.nickname, c.email, IF(ISNULL(g2c.customer_id)=0 ,'true','false') AS ingroup "; 
    $sql .= "FROM customers c ";
    $sql .= "LEFT JOIN g2c ON c.id = g2c.customer_id AND g2c.group_id=:group_id";
    $handle= $conn->prepare($sql);
    $handle->bindParam('group_id',$group_id,PDO::PARAM_STR);
    $handle->execute();
    $query_results = $handle->fetchAll(PDO::FETCH_BOTH);
    echo json_encode($query_results); 

    $handle->closeCursor();	
}

?>