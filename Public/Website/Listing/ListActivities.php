<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kommende aktiviteter</title>
</head>

<body>
    <?php
    //Diverse include filer
    include_once "/Applications/XAMPP/xamppfiles/htdocs/Neoklubb/Private/Database/DatabaseConnection.php";
    include_once "/Applications/XAMPP/xamppfiles/htdocs/Neoklubb/Private/Include/LoginHeader.php";
    include_once "/Applications/XAMPP/xamppfiles/htdocs/NeoKlubb/Private/Include/LoginChecker.php";
    include_once "/Applications/XAMPP/xamppfiles/htdocs/NeoKlubb/Public/Resources/Style/Table.html";

    //Spørring som henter ut aktiviteter fra nå eller i fremtiden. 
    $sql = "SELECT * FROM Aktivitet WHERE StartDato >= curdate()";
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
        echo "<th> Bli med </th>";
        echo "</tr>";

        //foreach som itererer gjennom alle feltene og printer ut i en tabell
        foreach ($Aktivitet as $Aktivitet) {
            echo "<tr>";
            echo "<td>" . $Aktivitet->AktivitetID . "</td>";
            echo "<td>" . $Aktivitet->Aktivitet . "</td>";
            echo "<td>" . $Aktivitet->Beskrivelse . "</td>";
            echo "<td>" . date("d-m-Y k\l. H:i", strtotime($Aktivitet->StartDato)) . "</td>";
            echo "<td>" . date("d-m-Y k\l. H:i", strtotime($Aktivitet->SluttDato)) . "</td>";
            echo "<td>"
    ?>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?> ">
                <fieldset>
                    <input type="checkbox" name="AktivitetID" id="ID" value="<?php echo $Aktivitet->AktivitetID; ?>">
                    <br>
                    </p>
                    <button type="Submit" name="blimed">Blimed</button>
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
    if (isset($_POST["blimed"])) {
        $aktivitetid = $_POST['AktivitetID'];
        $medlemid = $_SESSION['MedlemID'];
        // sett inn spørring her
        $sql = "INSERT INTO Kurs (MedlemID, AktivitetID) VALUES (:MedlemID, :AktivitetID)";
        $sp = $pdo->prepare($sql);
        $sp->bindParam(":AktivitetID", $aktivitetid, PDO::PARAM_INT);
        $sp->bindParam(":MedlemID", $medlemid, PDO::PARAM_INT);
        try {
            $sp->execute();
            echo "Du er meldt på kurset!";
        } catch (PDOException $e) {
            echo $e->getMessage() . "<br>";
        }
    }
    ?>
</body>

</html>