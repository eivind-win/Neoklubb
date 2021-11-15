<!-- inkluderer config fil til databasen og velger hvilke entiteter som skal henters ut fra hvilket tabel i databasen.  -->
<?php

include_once "/Applications/XAMPP/xamppfiles/htdocs/Neoklubb/Private/Database/DatabaseConnection.php";
include_once "/Applications/XAMPP/xamppfiles/htdocs/Neoklubb/Private/Include/LoginHeader.php";

$sql = "SELECT Medlem.MedlemID, Medlem.Fornavn, Medlem.Etternavn, Interesser.Interesser FROM Medlem INNER JOIN MineInteresser ON Medlem.MedlemID = MineInteresser.MedlemID INNER JOIN Interesser ON MineInteresser.InteresseID = Interesser.InteresseID";
$sp = $pdo->prepare($sql);
try {
    $sp->execute();
} catch (PDOException $e) {
    echo $e->getMessage() . "<br>";
}
//Lager en tabell og som inneholder alle radene 
$Medlem = $sp->fetchAll(PDO::FETCH_OBJ);
if ($sp->rowCount() > 0) {
    echo "<table>";
    echo "<tr>";
    echo "<th> Fornavn </th>";
    echo "<th> Etternavn </th>";
    echo "<th> Interesser </th>";

    echo "</tr>";


    //foreach som itererer gjennom alle feltene og printer ut i en tabell
    foreach ($Medlem as $Medlem) {
        echo "<tr>";
        echo "<td>" . $Medlem->Fornavn . "</td>";
        echo "<td>" . $Medlem->Etternavn . "</td>";
        echo "<td>" . $Medlem->Interesser . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Det er ingen medlemmer som matcher denne beskrivelsen";
}
?>

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