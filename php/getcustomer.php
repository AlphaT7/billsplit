<?php

include "init.php";

$id = $_GET["id"];

getCustomer($conn,$id);

function getCustomer($conn,$id) {
    global $handle;
    $str = "";      
    $sql = "SELECT * FROM `customers` WHERE id = :id";
    $handle= $conn->prepare($sql);
    $handle->bindParam('id',$id,PDO::PARAM_STR);
    $handle->execute();
    //$query_results = $handle->fetchAll(PDO::FETCH_BOTH);
    //echo json_encode($query_results); 

    while ($row = $handle->fetch()){
      $str .= '<div class="section_update_customer">';
      $str .= '<div class="title"><div id="btn_return_to_customers">Customers - Edit</div><div id="customer_update_status">- Updating...</div><i class="fal fa-users"></i></div>';
      $str .= '<input class="section_update_customer_input" type="text" value="' . $row["f_name"] . '" id="f_name"><br/>';
      $str .= '<input class="section_update_customer_input" type="text" value="' . $row["l_name"] . '" id="l_name"><br />';
      $str .= '<input class="section_update_customer_input" type="text" value="' . $row["nickname"] . '" id="nickname"><br />';
      $str .= '<input class="section_update_customer_input" type="text" value="' . $row["email"] . '" id="email"><br />';
      $str .= '<div id="btn_update_customer"  data-id="' . $id . '" class="btn btn-green">Submit</div>';
      $str .= '<div id="btn_delete_customer"  data-id="' . $id . '"  data-name="' . $row["f_name"] . '&nbsp;' . $row["l_name"] . '" class="btn btn-red">Delete</div>';
      $str .= '</div>';
    }

    echo $str;

    $handle->closeCursor();	
}

?>