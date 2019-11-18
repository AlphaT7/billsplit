<?php

include "conn.php";

$conn = connectDB($user,$pass);

function connectDB($user,$pass) {
    
	try {
    $conn = new PDO("mysql:host=localhost;dbname=pizzaapp", $user, $pass);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch(exception $e) {
		$conn=false;
        print $e;
        exit();
   }
   return $conn;
}

?>