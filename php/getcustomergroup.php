<?php

include "init.php";

$id = $_GET["id"];

getCustomerGroup($conn,$id);

function getCustomerGroup($conn,$id) {
    global $handle;
    $str = "";      
    $sql = "SELECT * FROM `groups` WHERE id = :id";
    $handle= $conn->prepare($sql);
    $handle->bindParam('id',$id,PDO::PARAM_STR);
    $handle->execute();
    //$query_results = $handle->fetchAll(PDO::FETCH_BOTH);
    //echo json_encode($query_results); 

    while ($row = $handle->fetch()){
      $str .= '<div class="section_update_customergroup">';
      $str .= '<div class="title"><div id="btn_return_to_customergroups">Customer Groups - Edit</div><div id="customergroup_update_status">- Updating...</div><i class="fal fa-users"></i></div>';
      $str .= '<input class="section_update_customergroup_input" type="text" value="' . $row["name"] . '" id="groupname"><br/>';
      $str .= '<div id="btn_update_customergroup"  data-id="' . $id . '" class="btn btn-green">Submit</div>';
      $str .= '<div id="btn_delete_customergroup"  data-id="' . $id . '"  data-name="' . $row["name"] . '" class="btn btn-red">Delete</div>';
      $str .= '<div id="customergroup_statustable"></div>';
      $str .= '</div>';
    }

    echo $str;

    $handle->closeCursor();	
}

?>