<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Legg til henvendelse</title>
</head>

<body>
    <?php
    session_start();
    if (!isset ($_SESSION['bruker_id'])) {
        echo "du er ikke logget inn, klikk her for å gå til <a href='index.php'>forsiden</a>";
        exit();
    }

    $bruker_id = $_SESSION['bruker_id'];

    require_once "includes/db_connection.php";


    # 1 - finner bruker
    
    $query = "SELECT brukernavn FROM brukere WHERE id = ?";


    $stmt = $conn->prepare($query);

    $stmt->bind_param("i", $bruker_id);


    $stmt->execute();
    $stmt->bind_result($brukernavn);
    $row = $stmt->fetch();
    ?>

    <div class="container">

        <h2>Legg til henvendelse</h2>
        <?php
        echo "<p>du er logget inn som $brukernavn</p> <br>";
        echo "nå kan du registrere tickets";
        ?>
        <form action="handlehenvendelse.php" method="post">
            <div class="form-group">
                <label for="navn">Tittel:</label>
                <input type="text" id="navn" name="navn" required>
            </div>
            <div class="form-group">
                <label for="beskrivelse">Beskrivelse:</label>
                <textarea id="beskrivelse" name="beskrivelse" required></textarea>
            </div>
            <div class="form-group">
                <input type="submit" value="Send henvendelse">
            </div>
        </form>
        <!-- Skjema for å sjekke status på henvendelse -->
        <form action="sjekk_status.php" method="post">
            Saksnummer: <input type="text" name="saksnummer"><br>
            <input type="submit" value="Sjekk status">
        </form>

    </div>

</body>

</html>