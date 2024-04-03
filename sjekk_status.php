<?php
// Inkluderer db_connection.php for å koble til databasen
include_once 'includes/db_connection.php';

// Sjekker om skjemaet er sendt
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Hent saksnummeret fra skjemaet
    $saksnummer = $_POST['saksnummer'];

    // Søk etter henvendelsen basert på saksnummeret i databasen
    $sql = "SELECT * FROM henvendelser WHERE saksnummer = ?";

    // Forbered en forberedt uttalelse
    $stmt = $conn->prepare($sql);

    // Binder parametere og setter verdier
    $stmt->bind_param("i", $saksnummer); // Antar at saksnummer er en integer

    // Utfører spørringen
    $stmt->execute();

    // Hent resultatet
    $result = $stmt->get_result();

    // Sjekk om det finnes en henvendelse med det gitte saksnummeret
    if ($result->num_rows > 0) {
        // Vis statusen på henvendelsen
        $row = $result->fetch_assoc();
        echo "<div class='container'>";
        echo "Status for henvendelse med saksnummer $saksnummer er: " . $row['status'];
        echo "</div>";
    } else {
        // Vis feilmelding hvis henvendelsen ikke ble funnet
        echo "<div class='container'>";
        echo "Ingen henvendelse funnet med saksnummer $saksnummer.";
        echo "</div>";

    }

    // Lukk forberedt uttalelse
    $stmt->close();
}
?>