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
    include_once "/Applications/XAMPP/xamppfiles/htdocs/Neoklubb/Private/Include/LoginHeader.php";
    session_start();
    // dersom det IKKE er startet noe session blir med redirectet til loginsiden igjen.
    if (!isset($_SESSION['Epost'])) {

        header("location: ../Login/Login.php");
    }



    ?>
    <h1> Velkommen til Neo Ungdomsklubb! </h1>



</body>

</html>