<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fremside</title>
</head>

<body>
    <?php
    include_once "/Applications/XAMPP/xamppfiles/htdocs/Neoklubb/Private/Include/LoginHeader.php";

    session_start();
    if (isset($_SESSION["Epost"])) {
        echo "Du er nå logget inn!";
        echo "<br>";
        echo  $_SESSION["Epost"];
        echo "<br>";
        echo  $_SESSION["Fornavn"];
        //echo print_r($_SESSION);
    }


    ?>
    <h1> Velkommen til Neo Ungdomsklubb! </h1>

    <a href="../ListMembers/ListMembers.php">List opp medlemmer
        <br>
        <br>
        <a href="../EditMember/Editor.php">Endre medlemsinformasjon



</body>

</html>