<<<<<<< HEAD
<?php
//Diverse include filer
include_once "/Applications/XAMPP/xamppfiles/htdocs/Neoklubb/Private/Database/DatabaseConnection.php";
include_once "/Applications/XAMPP/xamppfiles/htdocs/Neoklubb/Private/Include/LoginHeader.php";
include_once "/Applications/XAMPP/xamppfiles/htdocs/NeoKlubb/Private/Include/LoginChecker.php";
include_once "/Applications/XAMPP/xamppfiles/htdocs/NeoKlubb/Public/Resources/Style/Table.html";

$medlemid = $_SESSION['MedlemID'];


$sql = "SELECT * FROM Aktivitet WHERE StartDato >= curdate()";
=======
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
>>>>>>> 7f48a4a92c91b11ad9c8e12c4e28f3a25034079b
$sp = $pdo->prepare($sql);
try {
    $sp->execute();
} catch (PDOException $e) {
    echo $e->getMessage() . "<br>";
    //denne meldingen bør vi logge isstedenfor å skrive ut på skjermen
}
<<<<<<< HEAD
//Lager en tabell og som inneholder alle radene om rowcount er over 0
=======
//Lager en tabell og som inneholder alle radene 
>>>>>>> 7f48a4a92c91b11ad9c8e12c4e28f3a25034079b
$Aktivitet = $sp->fetchAll(PDO::FETCH_OBJ);
if ($sp->rowCount() > 0) {
    echo "<table>";
    echo "<tr>";
    echo "<th> AktivitetID </th>";
    echo "<th> Aktivitet </th>";
    echo "<th> Beskrivelse </th>";
    echo "<th> Starter </th>";
    echo "<th> Slutter </th>";
<<<<<<< HEAD
    echo "<th> Bli med </th>";

    echo "</tr>";

=======
    echo "</tr>";

    //foreach som itererer gjennom alle feltene i tabell

>>>>>>> 7f48a4a92c91b11ad9c8e12c4e28f3a25034079b
    //foreach som itererer gjennom alle feltene og printer ut i en tabell
    foreach ($Aktivitet as $Aktivitet) {
        echo "<tr>";
        echo "<td>" . $Aktivitet->AktivitetID . "</td>";
<<<<<<< HEAD
        echo "<td>" . $Aktivitet->Aktivitet . "</td>";
        echo "<td>" . $Aktivitet->Beskrivelse . "</td>";
        echo "<td>" . $Aktivitet->StartDato . "</td>";
        echo "<td>" . $Aktivitet->SluttDato . "</td>";
        echo "<td>"
?>
        <input type="checkbox" /> <? $Aktivitet['AktivitetID'] ?>
<?php
        "</td>";
=======
        echo "<td>" . $Aktivitet->Aktiviteter . "</td>";
        echo "<td>" . $Aktivitet->Beskrivelse . "</td>";
        echo "<td>" . $Aktivitet->StartDato . "</td>";
        echo "<td>" . $Aktivitet->SluttDato . "</td>";


>>>>>>> 7f48a4a92c91b11ad9c8e12c4e28f3a25034079b
        echo "</tr>";
    }
    echo "</table>";
} else {
<<<<<<< HEAD
    echo "Det er ingen aktiviteter som matcher denne beskrivelsen";
}

if (isset($_POST["BliMed"])) {

    try {
        $bm->execute();
    } catch (PDOException $e) {
        echo $e->getMessage() . "<br>";
    }
    //$sp->debugDumpParams();

    if ($pdo->lastInsertId() > 0) {
        echo "Dataene er satt inn i tabellen";
    } else {
        echo "Dataene er ikke satt inn i tabellen";
    }
}
?>

<p>
    <button type="Submit" name="BliMed">Bli med</button>
</p>
=======
    echo "Det er ingen medlemmer som matcher denne beskrivelsen";
}
>>>>>>> 7f48a4a92c91b11ad9c8e12c4e28f3a25034079b
