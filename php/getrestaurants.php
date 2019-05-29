<?php

include "init.php";

getRestaurants($conn);

function getRestaurants($conn) {
    global $handle;
    $str = "";      
    $sql = "SELECT * FROM `restaurants`";
    $handle= $conn->prepare($sql);
    /*$handle->bindParam('pid',PDO::PARAM_STR);*/
    $handle->execute();
    //$query_results = $handle->fetchAll(PDO::FETCH_BOTH);
    //echo json_encode($query_results); 

    while ($row = $handle->fetch()){
      $str .= '<div class="btn_wrapper">';
      $str .= '<div data-id="' . $row['id'] . '" class="btn_edit">' . $row['name'] .'</div>';
      $str .= '<div data-id="' . $row['id'] . '"class="btn_del"><i class="fas fa-minus"></i></div>';
      $str .= '</div>';
    }

    echo $str;

    $handle->closeCursor();	
}

?>