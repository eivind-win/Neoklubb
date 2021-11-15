<!DOCTYPE html>
<html lang="en">

<?php
include_once "/Applications/XAMPP/xamppfiles/htdocs/Neoklubb/Private/Include/LoginHeader.php";
session_start();
// dersom det IKKE er startet noe session blir med redirectet til loginsiden igjen.
if (!isset($_SESSION['Epost'])) {

    header("location: ../Login/Login.php");
}
<<<<<<< HEAD
// dersom session blir startet printer ut session variabler. 
if (isset($_SESSION["Epost"])) {
    echo "Du er nå logget inn!";
    echo "<br>";
    echo  $_SESSION["Epost"];
    echo "<br>";
    echo  $_SESSION["Fornavn"];
    echo "<br>";
    echo  $_SESSION["Etternavn"];
    echo "<br>";
    echo  $_SESSION["Telefon"];
    echo "<br>";
    echo  $_SESSION["MedlemID"];
}

=======
>>>>>>> e0c12aca3fa881bbdd83a16d866b51b8dddb34f4

?>
<h1> Velkommen til Neo Ungdomsklubb! </h1>

<a href="../Listing/ListMembers.php">List opp medlemmer
    <br>
    <br>
    <a href="../Editing/Editor.php">Endre medlemsinformasjon



        </body>

</html>