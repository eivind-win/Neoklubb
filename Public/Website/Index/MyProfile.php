<?php
session_start();
include_once "/Applications/XAMPP/xamppfiles/htdocs/Neoklubb/Private/Include/LoginHeader.php";
?>

<!DOCTYPE html>
<html>
<!-- Stylsheet for profile card -->

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .card {
            box-shadow: 0 10px 20px 0 rgba(0, 0, 0, 0.5);
            max-width: 300px;
            margin: auto;
            text-align: center;
            font-family: arial;
        }

        .title {
            color: grey;
            font-size: 18px;
        }

        button {
            border: none;
            outline: 0;
            display: inline-block;
            padding: 8px;
            color: white;
            background-color: #6268F1;
            text-align: center;
            cursor: pointer;
            width: 100%;
            font-size: 18px;
        }

        a {
            text-decoration: none;
            font-size: 22px;
            color: black;
        }

        button:hover,
        a:hover {
            opacity: 0.7;
        }
    </style>
</head>

<body>

    <h2 style="text-align:center">Min profil</h2>
    <!-- Printer ut variabler i profile card basert på session -->
    <div class="card">
        <img src="avatar.jpeg" alt="John" style="width:100%">
        <h1> <?php echo $_SESSION["Fornavn"] ?></h1>
        <h1> <?php echo $_SESSION["Etternavn"] ?></h1>
        <h2> <?php echo $_SESSION["Epost"] ?></h2>
        <h2> <?php echo "tlf" . " " .  $_SESSION["Telefon"] ?></h2>
        <h3> <?php echo "Medlem siden " . "<br>" ?></h3>
        <h3> <?php echo $_SESSION["RegistreringsDato"] ?></h3>
        <p class="title">IT-Student</p>
        <p>Universitetet i Agder</p>
        <div style="margin: 24px 0;">
            <a href="#"><i class="fa fa-instagram"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-linkedin"></i></a>
            <a href="#"><i class="fa fa-facebook"></i></a>
        </div>
        <p><button>Profil kort</button></p>
    </div>

</body>

</html>