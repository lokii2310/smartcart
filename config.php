<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
// Replace with your database credentials
$host = "localhost";
$username = "root";
$password = "";
$dbname = "shop_products";

// Create a new connection
$link = new mysqli($host, $username, $password, $dbname);

 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>