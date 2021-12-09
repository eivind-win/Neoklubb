<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Endre roller</title>
</head>

<body>
    <?php
    include_once "/Applications/XAMPP/xamppfiles/htdocs/NeoKlubb/Private/Database/DatabaseConnection.php";
    include_once "/Applications/XAMPP/xamppfiles/htdocs/Neoklubb/Private/Include/LoginHeader.php";
    include_once "/Applications/XAMPP/xamppfiles/htdocs/NeoKlubb/Private/Include/LoginChecker.php";

    $medlemid = $medlem['MedlemID'];
    $rolleid = $rolle['RolleID'];

    $sql = "SELECT MedlemID, Fornavn FROM Medlem order by Fornavn";

    $sql2 = "SELECT RolleID, Rolle FROM Roller order by Rolle";

    $sql3 = "INSERT INTO MineRoller VALUES :MedlemID, :RolleID";

    $sql4 = "DELETE FROM MineRoller VALUES :MedlemID, :RolleID";

    $sp = $pdo->prepare($sql);
    $sp2 = $pdo->prepare($sql2);
    $update = $pdo->prepare($sql3);

    $sp->execute();
    $sp2->execute();

    $medlem = $sp->fetchAll();
    $rolle = $sp2->fetchAll();

    $update->bindParam(":MedlemID", $medlemid, PDO::PARAM_STR);
    $update->bindParam(":RolleID", $rolleid, PDO::PARAM_STR);



    if (isset($_POST["LagreRolle"])) {

        try {
            $update->execute();
        } catch (PDOException $e) {
            echo $e->getMessage() . "<br>";
        }
        $update->debugDumpParams();

        if ($update->rowCount() > 0) {
            echo $update->rowCount() . " oppføring" . ($update->rowCount() > 1 ? "er" : "") . " ble oppdatert.";
        } else {
            echo "Oppdatering feilet, ingen endringer er lagret";
        }
    }
    if (isset($_POST["FjernRolle"])) {

        try {
            $update->execute();
        } catch (PDOException $e) {
            echo $e->getMessage() . "<br>";
        }
        $update->debugDumpParams();

        if ($update->rowCount() > 0) {
            echo $update->rowCount() . " oppføring" . ($update->rowCount() > 1 ? "er" : "") . " ble oppdatert.";
        } else {
            echo "Oppdatering feilet, ingen endringer er lagret";
        }
    }

    ?>
    <br>
    <select>
        <?php foreach ($medlem as $medlem) : ?>
            <option value="<?= $medlem['MedlemID']; ?>"><?= $medlem['Fornavn']; ?></option>
        <?php endforeach; ?>
    </select>
    <br>
    <br>
    <select>
        <?php foreach ($rolle as $rolle) : ?>
            <option value="<?= $rolle['RolleID']; ?>"><?= $rolle['Rolle']; ?></option>
        <?php endforeach; ?>
    </select>
    <p>
        <button type="Submit" name="LagreRolle">Lagre rolle</button>
    </p>

    <p>
        <button type="Submit" name="FjernRolle">Fjern rolle</button>
    </p>



</body>

</html>