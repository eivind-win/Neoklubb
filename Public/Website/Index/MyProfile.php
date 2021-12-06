<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Min profil</title>
</head>

<body>
    <?php
    include_once "/Applications/XAMPP/xamppfiles/htdocs/Neoklubb/Private/Include/LogInChecker.php";
    include_once "/Applications/XAMPP/xamppfiles/htdocs/Neoklubb/Private/Include/LoginHeader.php";
    include_once "/Applications/XAMPP/xamppfiles/htdocs/NeoKlubb/Public/Resources/Style/Css/Profil.html";
    $medlemid = $_SESSION['MedlemID'];

    ?>
    <h2 style="text-align:center">Min profil</h2>
    <!-- Printer ut variabler i profile card basert på session -->
    <div class="card">
        <img class="avatar" width="200" height="200" src="../../Resources/Image/<?php echo $medlemid ?>.jpeg" alt="Not Found" onerror="this.onerror=null; this.src='../../Resources/Image/avatar.jpeg'">

        <br>
        <u><a href="../Index/ProfilePicture.php">Bytt profilbilde</a></u>
        <h1> <?php echo $_SESSION["Fornavn"] ?></h1>
        <h1> <?php echo $_SESSION["Etternavn"] ?></h1>
        <h3> <?php echo $_SESSION["Epost"] ?></h3>
        <h3> <?php echo "tlf" . " " .  $_SESSION["Telefon"] ?></h3>
        <h3> <?php echo "Medlem siden " . "<br>" ?></h3>
        <h3> <?php echo $_SESSION["RegistreringsDato"] ?></h3>
        <p><button>Profil</button></p>
    </div>

</body>

</html>