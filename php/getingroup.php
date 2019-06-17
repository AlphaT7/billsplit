<?php

include "init.php";

$id = $_GET["id"];

getInGroup($conn,$id);

function getInGroup($conn,$id) {
    global $handle;
    //$sql = "SELECT c.id, c.l_name, c.f_name, c.nickname, email, 'true' AS ingroup FROM customers c, g2c WHERE c.id = g2c.customer_id and g2c.group_id=:id UNION ";
    //$sql .= "SELECT c.id, c.l_name, c.f_name, c.nickname, email, 'false' AS ingroup FROM customers c WHERE c.id NOT IN (SELECT c.id FROM customers c, g2c WHERE c.id = g2c.customer_id and g2c.group_id=:id)";
    $sql = "SELECT DISTINCT c.id, c.l_name, c.f_name, c.nickname, c.email, IF(ISNULL(g2c.customer_id)=0 ,'true','false') AS ingroup FROM customers c LEFT JOIN g2c ON c.id = g2c.customer_id AND g2c.group_id=:id";
    $handle= $conn->prepare($sql);
    $handle->bindParam('id',$id,PDO::PARAM_STR);
    $handle->execute();
    $query_results = $handle->fetchAll(PDO::FETCH_BOTH);
    echo json_encode($query_results); 

    $handle->closeCursor();	
}

?>