<?php
//login_success.php  
session_start();
if (isset($_SESSION["Epost"])) {
    echo  $_SESSION["Epost"];

    echo '<br /><br /><a href="logout.php">Logout</a>';
} else {
    header("location:Login.php");
}
