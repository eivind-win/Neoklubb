<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hjemmeside</title>
</head>

<body>
    <?php
    include_once "/Applications/XAMPP/xamppfiles/htdocs/Neoklubb/Private/Include/LogInChecker.php";
    include_once "/Applications/XAMPP/xamppfiles/htdocs/Neoklubb/Private/Include/LoginHeader.php";
    include_once "/Applications/XAMPP/xamppfiles/htdocs/NeoKlubb/Private/Database/DatabaseConnection.php";
    ?>
    <h1> Velkommen til Neo Ungdomsklubb! </h1>
    <h2> Hei, nye og gamle medlemmer! Det blir en spennende uke med mye gøy å melde seg på!</h2>
    <h3> Trykk på linken under for å få med deg kommende kurs og andre spennende aktiviteter vi tilbyr!</h3>
    <br>

    <a href=../Listing/ListActivities.php>Kommende aktiviteter!</a>
    <h3> Hilsen oss i Neo Ungdomsklubb!</h3>


</body>

</html>
<style>
    body {
        background-image: url('../../Resources/Image/Forside.jpg');
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: 100% 100%;
    }
</style>
</head>

<body>