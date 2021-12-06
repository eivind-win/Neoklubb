<?php
//Diverse include filer
include_once "/Applications/XAMPP/xamppfiles/htdocs/Neoklubb/Private/Database/DatabaseConnection.php";
include_once "/Applications/XAMPP/xamppfiles/htdocs/Neoklubb/Private/Include/LoginHeader.php";
include_once "/Applications/XAMPP/xamppfiles/htdocs/NeoKlubb/Private/Include/LoginChecker.php";
//include_once "/Applications/XAMPP/xamppfiles/htdocs/NeoKlubb/Public/Resources/Style/Table.html";


$sql = "SELECT * FROM interesser";
$sp = $pdo->prepare($sql);
try {
    $sp->execute();
} catch (PDOException $e) {
    echo $e->getMessage() . "<br>";
    //denne meldingen bør vi logge isstedenfor å skrive ut på skjermen
}
//Lager en tabell og som inneholder alle radene 
$Interesser = $sp->fetchAll(PDO::FETCH_OBJ);
if ($sp->rowCount() > 0) {
    echo "<table>";
    echo "<tr>";
    echo "<th> InteresseID </th>";
    echo "<th> Interesser </th>";
    echo "<th> Bli med </th>";
    echo "</tr>";

    //foreach som itererer gjennom alle feltene og printer ut i en tabell
    foreach ($Interesser as $Interesser) {
        echo "<tr>";
        echo "<td>" . $Interesser->InteresseID . "</td>";
        echo "<td>" . $Interesser->Interesser . "</td>";
        echo "<td>"
?>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?> ">
            <fieldset>
                <input type="checkbox" name="interesseID" id="ID" value="<?php echo $Interesser->InteresseID; ?>">
                <br>
                </p>
                <button type="Submit" name="LeggTilInteresse">Legg til interesse</button>
            </fieldset>
        </form>
        </p>
<?php
        "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Det er ingen aktiviteter som matcher denne beskrivelsen";
}

if (isset($_POST["LeggTilInteresse"])) {
    $interesseID = $_POST['interesseID'];
    $medlemid = $_SESSION['MedlemID'];
    // sett inn spørring her
    $sql = "INSERT INTO MineInteresser (MedlemID, InteresseID) VALUES (:MedlemID, :InteresseID)";
    $sp = $pdo->prepare($sql);
    $sp->bindParam(":InteresseID", $interesseID, PDO::PARAM_INT);
    $sp->bindParam(":MedlemID", $medlemid, PDO::PARAM_INT);
    try {
        $sp->execute();
    } catch (PDOException $e) {
        echo $e->getMessage() . "<br>";
    }
} else {
    echo "Klarer ikke hente data";
}
?>