<?php
$servername = "localhost";
$username = "root";
$password = "test-passord";
$dbname = "ticket_oppdrag_uke12";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
