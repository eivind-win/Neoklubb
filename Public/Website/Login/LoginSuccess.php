<?php
//login_success.php  
session_start();
if (isset($_SESSION["Epost"])) {
    echo "Du er nå logget inn!";
    echo "<br>";
    echo  $_SESSION["Epost"];
    echo "<br>";
    echo  $_SESSION["Fornavn"];



    echo '<br /><br /><a href="logout.php">Logout</a>';
} else {
    header("location:../index/Forside.php");
}
