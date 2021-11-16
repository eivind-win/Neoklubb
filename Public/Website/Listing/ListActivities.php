<style>
    table {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    td,
    th {
        border: 1px solid #ddd;
        padding: 8px;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    tr:hover {
        background-color: #ddd;
    }

    table th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #04AA6D;
        color: white;
    }
</style>
<!-- inkluderer config fil til databasen og velger hvilke entiteter som skal henters ut fra hvilket tabel i databasen.  -->
<?php

include_once "/Applications/XAMPP/xamppfiles/htdocs/Neoklubb/Private/Database/DatabaseConnection.php";
include_once "/Applications/XAMPP/xamppfiles/htdocs/Neoklubb/Private/Include/LoginHeader.php";

$sql = "SELECT * FROM Aktivitet";
$sp = $pdo->prepare($sql);
try {
    $sp->execute();
} catch (PDOException $e) {
    echo $e->getMessage() . "<br>";
    //denne meldingen bør vi logge isstedenfor å skrive ut på skjermen
}
//Lager en tabell og som inneholder alle radene 
$Aktivitet = $sp->fetchAll(PDO::FETCH_OBJ);
if ($sp->rowCount() > 0) {
    echo "<table>";
    echo "<tr>";
    echo "<th> AktivitetID </th>";
    echo "<th> Aktivitet </th>";
    echo "<th> Beskrivelse </th>";
    echo "<th> Starter </th>";
    echo "<th> Slutter </th>";
    echo "</tr>";

    //foreach som itererer gjennom alle feltene i tabell

    //foreach som itererer gjennom alle feltene og printer ut i en tabell
    foreach ($Aktivitet as $Aktivitet) {
        echo "<tr>";
        echo "<td>" . $Aktivitet->AktivitetID . "</td>";
        echo "<td>" . $Aktivitet->Aktiviteter . "</td>";
        echo "<td>" . $Aktivitet->Beskrivelse . "</td>";
        echo "<td>" . $Aktivitet->StartDato . "</td>";
        echo "<td>" . $Aktivitet->SluttDato . "</td>";


        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Det er ingen medlemmer som matcher denne beskrivelsen";
}
