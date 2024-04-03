<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>endre sak</title>
</head>

<body>
    <div class="container">

        <?php

        session_start();

        //hente brukernavn og passord
        $bruker_id = $_SESSION["bruker_id"];

        if (!isset ($bruker_id)) {
            echo "du må være logget inn for å kunne vise saker  <a href='index.php'>tilbake til forsiden</a>";
            exit();
        }
        ?>

        <h1>her kan du endre den valgte saken</h1>
        legg til en sak til <a href="leggtilhenvendelse.php">legg til</a> <br>
        eller gå tilbake til <a href="index.php">forsiden</a> <br>

        <?php


        $saksnummer = $_GET['saksnummer'];

        try {
            require_once "includes/db_connection.php";

            $query = "SELECT bruker_id, tittel, beskrivelse, solution, status FROM henvendelser WHERE saksnummer = ?";
            $stmt = $conn->prepare($query);

            $stmt->bind_param("i", $saksnummer);


            $stmt->execute();
            $stmt->bind_result($bruker_id, $tittel, $beskrivelse, $solution, $status);
            $stmt->fetch();

            echo "
    <form action='endre_sak_handler.php' method='POST'>
    
    <h2>$tittel</h2>
    <input type='hidden' name='saksnummer' value='$saksnummer'>
    sendt in av $bruker_id <br>
    beskrivelse: <br>
    $beskrivelse <br>
    løsning: <br>
    <textarea name='solution' cols='80' rows='8'>$solution</textarea> <br>
    status: 
    <select name='status'>
    <option value='1'>Åpen</option>
    <option value='2'>Løst</option>
    </select> <br>
    <input type='submit' value='lagre'>
    </form>
";

            echo "  <form action='slett_sak_handler.php' method='POST'>
            <input type='hidden' name='saksnummer' value='$saksnummer'>
            <input type='submit' value='slett'>
            </form>";

        } catch (PDOException $e) {
            $_SESSION['error_message'] = "Query failed: " . $e->getMessage();
            //  header("location: ../log_inn.php");
            echo "feil";
            exit();
        }

        ?>
    </div>

</body>

</html>