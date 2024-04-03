<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.8.1/css/foundation.min.css"
        integrity="sha512-QuI0HElOtzmj6o/bXQ52phfzjVFRAhtxy2jTqsp85mdl1yvbSQW0Hf7TVCfvzFjDgTrZostqgM5+Wmb/NmqOLQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/style.css">
    <title>Loginn</title>
</head>

<body>

    <div class="container">
        <a href="index.php">forside</a>

        <h3>Signup</h3>

        <form action="includes/signuphandler.inc.php" method="post">
            <input class="input_width" type="text" name="brukernavn" placeholder="Username" required>
            <input class="input_width" type="password" name="passord" placeholder="Password" requierd>
            <button type="submit" class="button">Signup</button>
        </form>
    </div>

</body>

</html>