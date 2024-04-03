<?php
$saksnummer = $_POST['saksnummer'];


require_once "includes/db_connection.php";

$query = "delete from henvendelser where saksnummer = ?";
$stmt = $conn->prepare($query);

$stmt->bind_param("i", $saksnummer);

$stmt->execute();

header("location: vis_saker.php");

?>