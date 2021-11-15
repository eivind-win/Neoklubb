<!DOCTYPE html>
<html lang="en">

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