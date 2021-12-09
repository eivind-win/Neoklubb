<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste medlemmer basert på kurs påmelding</title>
</head>

<body>
    <?php
    include_once "/Applications/XAMPP/xamppfiles/htdocs/Neoklubb/Private/Database/DatabaseConnection.php";
    include_once "/Applications/XAMPP/xamppfiles/htdocs/Neoklubb/Private/Include/LoginHeader.php";
    include_once "/Applications/XAMPP/xamppfiles/htdocs/Neoklubb/Private/Include/LogInChecker.php";
    include_once "/Applications/XAMPP/xamppfiles/htdocs/NeoKlubb/Public/Resources/Style/Table.html";

    $sql = "SELECT Medlem.Fornavn, Medlem.Etternavn, Aktivitet.AktivitetID, Aktivitet, Beskrivelse 
        FROM Medlem INNER JOIN Kurs ON Medlem.MedlemID = Kurs.MedlemID 
        INNER JOIN Aktivitet on Kurs.AktivitetID = Aktivitet.AktivitetID WHERE Aktivitet.AktivitetID = :AktivitetID";

    $sql2 = "SELECT AktivitetID, Aktivitet FROM Aktivitet order by Aktivitet";

    $sp = $pdo->prepare($sql);
    $sp2 = $pdo->prepare($sql2);

    $sp->bindParam(":AktivitetID", $aktivitetid);

    $sp2->execute();

    $muligeAktiviteter = $sp2->fetchAll();


    if (isset($_POST["ListAktiviteter"])) {
        $aktivitetid = $_POST['AktivitetID'];

        try {
            $sp->execute();
        } catch (PDOException $e) {
            echo $e->getMessage() . "<br>";
        }
        $medlemsAktiviteter = $sp->fetchAll(PDO::FETCH_OBJ);


        if ($sp->rowCount() > 0) {
            echo "<table>";
            echo "<tr>";
            echo "<th> Fornavn </th>";
            echo "<th> Etternavn </th>";
            echo "<th> AktivitetID </th>";
            echo "<th> Aktivitet </th>";
            echo "<th> Beskrivelse </th>";
            echo "</tr>";

            //foreach som itererer gjennom alle feltene og printer ut i en tabell
            foreach ($medlemsAktiviteter as $medlemsAktivitet) {
                echo "<tr>";
                echo "<td>" . $medlemsAktivitet->Fornavn . "</td>";
                echo "<td>" . $medlemsAktivitet->Etternavn . "</td>";
                echo "<td>" . $medlemsAktivitet->AktivitetID . "</td>";
                echo "<td>" . $medlemsAktivitet->Aktivitet . "</td>";
                echo "<td>" . $medlemsAktivitet->Beskrivelse . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "Det er ingen medlemmer som interesserer seg for dette!";
        }
    }
    ?>
    <form method="POST" action="">

        <div>
            <select name="AktivitetID">
                <?php foreach ($muligeAktiviteter as $muligAktivitet) : ?>
                    <option value="<?= $muligAktivitet['AktivitetID']; ?>"><?= $muligAktivitet['Aktivitet']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <p>
            <button type="Submit" name="ListAktiviteter">Hent medlemmer</button>
        </p>
</body>

</html>