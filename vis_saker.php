<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
</head>
<body>
    <div class="container">

    <?php

session_start();

//hente brukernavn og passord
$bruker_id = $_SESSION["bruker_id"];

if (!isset($bruker_id)) {
    echo "du må være logget inn for å kunne vise saker  <a href='index.php'>tilbake til forsiden</a>";
    exit();
}
    ?>
    <h1>viser saker du har tilgang til</h1>
    legg til en sak til <a href="leggtilhenvendelse.php">legg til</a> <br>
    eller gå tilbake til <a href="index.php">forsiden</a> <br>



<?php


//hente brukernavn og passord
$bruker_id = $_SESSION["bruker_id"];

try {
    require_once "includes/db_connection.php";

    $query = "SELECT brukernavn, rolle FROM brukere WHERE id = ?";

    $stmt = $conn->prepare($query);

    $stmt->bind_param("i", $bruker_id);


    $stmt->execute();
    $stmt->bind_result($brukernavn, $rolle);
    $row = $stmt->fetch();
    $stmt->close(); // Close the previous statement

    if ($row != 1) {
        echo "brukeren finnes ikke, prøv igjen";
    }
    echo "du er logget in som $brukernavn og du har rollen $rolle <br>";

    if ($rolle == 'Administrator') {
        $query = "SELECT saksnummer, bruker_id, tittel, status FROM henvendelser";
        $stmt = $conn->prepare($query);
echo "her vises saker for alle brukere <br>";
    } else {
        $query = "SELECT saksnummer, bruker_id, tittel, status FROM henvendelser WHERE bruker_id = ?";
        $stmt = $conn->prepare($query);

        echo "viser dine saker <br>";
        $stmt->bind_param("i", $bruker_id);
    }

    $stmt->execute();
    $stmt->bind_result($saksnummer, $bruker_id, $tittel, $status);
    
    echo "<table border=1>";
    echo "<tr>";
    echo "<th>saksnummer</th><th>bruker id</th><th>tittel</th><th>status</th>";
    if ($rolle == 'Administrator') {
        echo "<th></th>";
    }
    echo "</tr>\n";

    while ($stmt->fetch()) {
        if ($status == "") {
        $status = "registrert";
        }
        echo "<tr>\n";
        echo "<td>$saksnummer</td><td>$bruker_id</td><td>$tittel</td><td>$status</td>";
        if ($rolle == 'Administrator') {
            echo "<td><a href='endre_sak.php?saksnummer=$saksnummer'>endre</a></td>";
        }
        echo "</tr>\n";
    }
    echo "</table>";

} catch (PDOException $e) {
    $_SESSION['error_message'] = "Query failed: " . $e->getMessage();
  //  header("location: ../log_inn.php");
  echo"feil";
    exit();
}

?>
    </div>

</body>
</html>