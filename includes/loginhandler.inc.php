<?php

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //hente brukernavn og passord
    $brukernavn = $_POST["brukernavn"];
    $oppgitt_passord = $_POST["passord"];

    try {
        require_once "db_connection.php";


        # 1 - finner bruker

        $query = "SELECT id, passord FROM brukere WHERE brukernavn = ?";


        $stmt = $conn->prepare($query);

        $stmt->bind_param("s", $brukernavn);


        $stmt->execute();
        $stmt->bind_result($id, $registrert_passord);
        $row = $stmt->fetch();



        if ($row != 1) {
            $_SESSION['error_message'] = "Ukjent brukernavn!";
            header("location: ../log_inn.php");
            exit();
        } 

        if ($oppgitt_passord == $registrert_passord) {
            $_SESSION['bruker_id'] = $id;
            header("location: ../vis_saker.php");
            exit();
        } else {
            $_SESSION['error_message'] = "Feil passord";
            header("location: ../log_inn.php");
            exit();
        }
    } catch (PDOException $e) {
        $_SESSION['error_message'] = "Query failed: " . $e->getMessage();
        header("location: ../log_inn.php");
        exit();
    }
} else {
    $_SESSION['error_message'] = "ingen data mottat fra formen";

   header("location: ../log_inn.php");
    exit();
}
?>
