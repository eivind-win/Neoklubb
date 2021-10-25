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
        background-color: #ddd;
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

$sql = "SELECT * FROM Medlem";
$sp = $pdo->prepare($sql);
try {
    $sp->execute();
} catch (PDOException $e) {
    echo $e->getMessage() . "<br>";
    //denne meldingen bør vi logge isstedenfor å skrive ut på skjermen
}
//Lager en tabell og som inneholder alle radene 
$Medlem = $sp->fetchAll(PDO::FETCH_OBJ);
if ($sp->rowCount() > 0) {
    echo "<table>";
    echo "<tr>";
    echo "<th> MedlemID </th>";
    echo "<th> Fornavn </th>";
    echo "<th> Etternavn </th>";
    echo "<th> Telefon </th>";
    echo "<th> Epost </th>";
    echo "<th> Fodselsdato </th>";
    echo "<th> Kjønn </th>";
    echo "<th> RegistreringsDato </th>";
    echo "</tr>";

    //foreach som itererer gjennom alle feltene i tabell

    //foreach som itererer gjennom alle feltene og printer ut i en tabell
    foreach ($Medlem as $Medlem) {
        echo "<tr>";
        echo "<td>" . $Medlem->MedlemID . "</td>";
        echo "<td>" . $Medlem->Fornavn . "</td>";
        echo "<td>" . $Medlem->Etternavn . "</td>";
        echo "<td>" . $Medlem->Telefon . "</td>";
        echo "<td>" . $Medlem->Epost . "</td>";
        echo "<td>" . $Medlem->Fodselsdato . "</td>";
        echo "<td>" . $Medlem->Kjonn . "</td>";
        echo "<td>" . $Medlem->RegistreringsDato . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Det er ingen medlemmer som matcher denne beskrivelsen";
}
