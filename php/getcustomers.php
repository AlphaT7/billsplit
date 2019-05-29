<?php

include "init.php";

getCustomers($conn);

function getCustomers($conn) {
    global $handle;
    $str = "";      
    $sql = "SELECT id,f_name,l_name,nickname FROM `customers`";
    $handle= $conn->prepare($sql);
    /*$handle->bindParam('pid',$pid,PDO::PARAM_STR);*/
    $handle->execute();
    $query_results = $handle->fetchAll(PDO::FETCH_BOTH);
    echo json_encode($query_results); 
/*
    while ($row = $handle->fetch()){
      $str .= '<div class="btn_wrapper">';
      $str .= '<div data-id="' . $row['id'] . '" class="btn_edit edit_customer">' . $row['f_name'] . '&nbsp;' . $row['l_name'] . '</div>';
      $str .= '<div data-id="' . $row['id'] . '"class="btn_del del_customer"><i class="fas fa-trash-alt del_customer"></i></div>';
      $str .= '</div>';
    }
*/
    //echo $str;

    $handle->closeCursor();	
}

?>