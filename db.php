<?php 
// Establish a database connection
$con = mysqli_connect("localhost", "root", "", "register");

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
