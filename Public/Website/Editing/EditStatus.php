<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Endre status på medlemmer</title>
</head>

<body>
    <?php
    include_once "/Applications/XAMPP/xamppfiles/htdocs/NeoKlubb/Private/Database/DatabaseConnection.php";
    include_once "/Applications/XAMPP/xamppfiles/htdocs/Neoklubb/Private/Include/LoginHeader.php";
    include_once "/Applications/XAMPP/xamppfiles/htdocs/NeoKlubb/Private/Include/LoginChecker.php";


    $medlemid = $_POST['MedlemID'];
    $status = $_POST['Status'];

    $sql = "SELECT MedlemID, Fornavn, Etternavn FROM Medlem order by Fornavn";

    $sql2 = "UPDATE Status SET Status = :Status WHERE MedlemID = :MedlemID";


    $sp = $pdo->prepare($sql);
    $update = $pdo->prepare($sql2);

    $sp->execute();

    $medlemmer = $sp->fetchAll();

    $update->bindParam(":MedlemID", $medlemid);
    $update->bindParam(":Status", $status);

    if (isset($_POST["OppdaterStatus"])) {
        $medlemid = $_POST['MedlemID'];
        $status = $_POST['Status'];

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
            <p>
                <label for="Status">Status</label>
                <select id="Status" name="Status" required oninvalid="this.setCustomValidity('Status kan ikke være blankt!')" onchange="this.setCustomValidity('')">
                    <option disabled selected></option>
                    <option value="Aktiv">Aktiv</option>
                    <option value="Inaktiv">Inaktiv</option>
                </select>
            </p>
            <p>
                <button type="Submit" name="OppdaterStatus">Lagre status</button>
            </p>
        </form>



    </body>

</html>