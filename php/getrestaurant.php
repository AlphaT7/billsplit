<?php

include "init.php";

$id = $_GET["id"];

getRestaurant($conn,$id);

function getRestaurant($conn,$id) {
    global $handle;
    $str = "";      
    $sql = "SELECT * FROM `restaurants` WHERE id = :id";
    $handle= $conn->prepare($sql);
    $handle->bindParam('id',$id,PDO::PARAM_STR);
    $handle->execute();
    //$query_results = $handle->fetchAll(PDO::FETCH_BOTH);
    //echo json_encode($query_results); 

    while ($row = $handle->fetch()){
      $str .= '<div class="section_update_restaurant">';
      $str .= '<div class="title"><div id="btn_return_to_restaurants">Restaurants - Edit</div><div id="restaurant_update_status">- Updating...</div><i class="fal fa-users"></i></div>';
      $str .= '<input class="section_update_restaurant_input" type="text" value="' . $row["name"] . '" id="r_name"><br/>';
      $str .= '<input class="section_update_restaurant_input" type="text" value="' . $row["phone"] . '" id="r_phone"><br/>';
      $str .= '<input class="section_update_restaurant_input" type="text" value="' . $row["website"] . '" id="r_website"><br/>';
      $str .= '<div id="btn_update_restaurant"  data-id="' . $id . '" class="btn btn-green">Submit</div>';
      $str .= '<div id="btn_delete_restaurant"  data-id="' . $id . '"  data-name="' . $row["name"] . '" class="btn btn-red">Delete</div>';
      $str .= '</div>';
      $str .= '<div id="restaurant_table"></div>';
    }

    echo $str;

    $handle->closeCursor();	
}

?>