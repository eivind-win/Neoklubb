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

    $medlemid = $_POST['MedlemID'];
    $rolleid = $_POST['RolleID'];

    $sql = "SELECT MedlemID, Fornavn, Etternavn FROM Medlem order by Fornavn";

    $sql2 = "SELECT RolleID, Rolle FROM Roller order by Rolle";

    $sql3 = "INSERT INTO MineRoller (MedlemID, RolleID) VALUES (:MedlemID, :RolleID)";

    $sql4 = "DELETE FROM MineRoller WHERE MedlemID = :MedlemID and RolleID = :RolleID";

    $sp = $pdo->prepare($sql);
    $sp2 = $pdo->prepare($sql2);
    $update = $pdo->prepare($sql3);
    $delete = $pdo->prepare($sql4);

    $sp->execute();
    $sp2->execute();

    $medlemmer = $sp->fetchAll();
    $roller = $sp2->fetchAll();

    $update->bindParam(":MedlemID", $medlemid);
    $update->bindParam(":RolleID", $rolleid);

    $delete->bindParam(":MedlemID", $medlemid);
    $delete->bindParam(":RolleID", $rolleid);



    if (isset($_POST["LagreRolle"])) {
        $medlemid = $_POST['MedlemID'];
        $rolleid = $_POST['RolleID'];

        try {
            $update->execute();
        } catch (PDOException $e) {
            echo $e->getMessage() . "<br>";
        }
        //$update->debugDumpParams();

        if ($update->rowCount() > 0) {
            echo $update->rowCount() . " oppføring" . ($update->rowCount() > 1 ? "er" : "") . " ble oppdatert.";
        } else {
            echo "Oppdatering feilet, ingen endringer er lagret";
        }
    }
    if (isset($_POST["FjernRolle"])) {
        $medlemid = $_POST['MedlemID'];
        $rolleid = $_POST['RolleID'];

        try {
            $delete->execute();
        } catch (PDOException $e) {
            echo $e->getMessage() . "<br>";
        }
        //$delete->debugDumpParams();

        if ($delete->rowCount() > 0) {
            echo $delete->rowCount() . " oppføring" . ($delete->rowCount() > 1 ? "er" : "") . " ble oppdatert.";
        } else {
            echo "Oppdatering feilet, ingen endringer er lagret";
        }
    }

    ?>

    <body>
        <h1> Rediger roller og ansvarsområder </h1>
        <form method="POST" action="">
            <div>
                <select name="MedlemID">
                    <?php foreach ($medlemmer as $medlem) : ?>
                        <option value="<?= $medlem['MedlemID']; ?>"><?= $medlem['Fornavn']; ?> <?= $medlem['Etternavn']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <br>
            <div>
                <select name="RolleID">
                    <?php foreach ($roller as $rolle) : ?>
                        <option value="<?= $rolle['RolleID']; ?>"><?= $rolle['Rolle']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <p>
                <button type="Submit" name="LagreRolle">Lagre rolle</button>
            </p>

            <p>
                <button type="Submit" name="FjernRolle">Fjern rolle</button>
            </p>
        </form>



    </body>

</html>