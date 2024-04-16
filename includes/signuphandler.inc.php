<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // henter infylt brukernavn og passord
    $brukernavn = $_POST["brukernavn"];
    $passord = $_POST["passord"];


    try {
        require_once "db_connection.php";

        // skriver in brukernavn og passord in i databasen 
        $query = "INSERT INTO brukere (brukernavn, passord, rolle) 
                  VALUES (?, ?, 2);";

        $stmt = $conn->prepare($query);


        $stmt->bind_param("ss", $brukernavn, $passord);


        $stmt->execute();

        //$pdo = null;
        $stmt = null;

        // sender deg tilbake osv
        header("location: ../index.php");

        die();
    } catch (PDOException $e) {
        die ("Query failed:" . $e->getMessage());
    }
} else {
    header("location: ../leggtilhenvendelse.php");
}