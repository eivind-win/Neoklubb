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
<!-- Includer config fil til databasen og velger hvilke entiteter som skal henters ut fra hvilket tabel i databasen.  -->
<?php
<<<<<<< Updated upstream

include_once "/Applications/XAMPP/xamppfiles/htdocs/NeoKlubb/Neoklubb/Private/Database/DatabaseConnection.php";

=======
include_once "/Applications/XAMPP/xamppfiles/htdocs/NeoKlubb/Private/Database/DatabaseConnection.php";
>>>>>>> Stashed changes
$sql = "SELECT * FROM Medlem";
$sp = $pdo->prepare($sql);
try {
    $sp->execute();
} catch (PDOException $e) {
    echo $e->getMessage() . "<br>";
    //denne meldingen bør vi logge isstedenfor å skrive ut på skjermen
}
//Lager en tabell og som inneholder alle radene som skal være i view
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
    //foreach som itererer gjennom alle feltene i tabel
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
        //echo $Medlem->Passord . " // ";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "spørringen returnerte ingen oppføringer";
}
