<?php
// Jamison-PC.earthlink.net
// ^^^ needed for HeidiSQL host
$conn = connectDB();

function connectDB() {
    
    $user = 'pizzauser';
	$pass = 'PizzaUser123!';

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