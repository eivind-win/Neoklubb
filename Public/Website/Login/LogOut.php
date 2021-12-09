<?php

// Starter en session for å unsette session variabler forså å ødelegge session og redirecte til login siden
session_start();
unset($_SESSION['Fornavn']);
unset($_SESSION["Epost"]);
unset($_SESSION["Fornavn"]);
unset($_SESSION["Etternavn"]);
unset($_SESSION["Telefon"]);
unset($_SESSION["MedlemID"]);
session_destroy();
header("location:Login.php");
