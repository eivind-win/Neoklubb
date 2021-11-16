<?php
//Diverse include filer
include_once "/Applications/XAMPP/xamppfiles/htdocs/Neoklubb/Private/Database/DatabaseConnection.php";
include_once "/Applications/XAMPP/xamppfiles/htdocs/Neoklubb/Private/Include/LoginHeader.php";
include_once "/Applications/XAMPP/xamppfiles/htdocs/NeoKlubb/Private/Include/LoginChecker.php";
include_once "/Applications/XAMPP/xamppfiles/htdocs/NeoKlubb/Public/Resources/Style/Table.html";

$medlemid = $_SESSION['MedlemID'];


$sql = "SELECT * FROM Aktivitet WHERE StartDato >= curdate()";
$sp = $pdo->prepare($sql);
try {
    $sp->execute();
} catch (PDOException $e) {
    echo $e->getMessage() . "<br>";
    //denne meldingen bør vi logge isstedenfor å skrive ut på skjermen
}
//Lager en tabell og som inneholder alle radene om rowcount er over 0
$Aktivitet = $sp->fetchAll(PDO::FETCH_OBJ);
if ($sp->rowCount() > 0) {
    echo "<table>";
    echo "<tr>";
    echo "<th> AktivitetID </th>";
    echo "<th> Aktivitet </th>";
    echo "<th> Beskrivelse </th>";
    echo "<th> Starter </th>";
    echo "<th> Slutter </th>";
    echo "<th> Bli med </th>";

    echo "</tr>";

    //foreach som itererer gjennom alle feltene og printer ut i en tabell
    foreach ($Aktivitet as $Aktivitet) {
        echo "<tr>";
        echo "<td>" . $Aktivitet->AktivitetID . "</td>";
        echo "<td>" . $Aktivitet->Aktivitet . "</td>";
        echo "<td>" . $Aktivitet->Beskrivelse . "</td>";
        echo "<td>" . $Aktivitet->StartDato . "</td>";
        echo "<td>" . $Aktivitet->SluttDato . "</td>";
        echo "<td>"
?>
        <input type="checkbox" /> <? $Aktivitet['AktivitetID'] ?>
<?php
        "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
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