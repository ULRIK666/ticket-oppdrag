<?php
$saksnummer = $_POST['saksnummer'];
$solution = $_POST['solution'];
$status = $_POST['status'];



require_once "includes/db_connection.php";

$query = "update henvendelser set solution = ?, status = ? where saksnummer = ?";
$stmt = $conn->prepare($query);

$stmt->bind_param("sii", $solution, $status, $saksnummer);

$stmt->execute();

header("location: vis_saker.php");

?>