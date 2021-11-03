<?php
session_start();

if (!isset($_SESSION['Epost'])) {

    header("location: ../Login/Login.php");
}
