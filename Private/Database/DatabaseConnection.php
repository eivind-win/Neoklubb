<?php
define("DB_VERT", "localhost");
define("DB_BRUKER", "root");
define("DB_PASS", "");
define("DB_NAVN", "NeoKlubb");

try {

    $pdo = new PDO("mysql:host=" . DB_VERT . ";dbname=" . DB_NAVN, DB_BRUKER, DB_PASS);
    echo "Tilkobling til database er OK";
    echo "<br>";
} catch (PDOException $e) {
    echo "Tilkobling til database feilet: " . $e->getMessage();
    echo "<br>";
}
