<?php
include_once 'includes/db_connection.php';

session_start();


// Sjekk om skjemaet er sendt
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Hent data fra skjemaet
    $bruker_id = $_SESSION['bruker_id'];
    $tittel = $_POST['navn'];
    $beskrivelse = $_POST['beskrivelse'];

    // Forbered SQL-spørringen for å sette inn data
    $sql = "INSERT INTO henvendelser (bruker_id, tittel, beskrivelse) VALUES (?, ?, ?)";

    // Forbered en forberedt uttalelse
    $stmt = $conn->prepare($sql);

    // Bind parametere og sett verdier
    $stmt->bind_param("iss", $bruker_id, $tittel, $beskrivelse);

    // Utfør spørringen og sjekk om det lykkes
    if ($stmt->execute()) {
        $saksnummer = $conn->insert_id;
        echo "Henvendelsen ble lagt til. saksnummeret er: $saksnummer <br>";
        echo "gå til bake til forside <a href='index.php'>forside</a> <br>
        eller legg til en sak til <a href='leggtilhenvendelse.php'>registrer ny sak</a> <br>";
    } else {
        echo "Feil: " . $sql . "<br>" . $conn->error;
    }


    // Lukk forberedt uttalelse
    $stmt->close();
}

// Lukk tilkoblingen
$conn->close();
?>