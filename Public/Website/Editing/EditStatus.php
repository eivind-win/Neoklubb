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
    // Relevante include filer
    include_once "/Applications/XAMPP/xamppfiles/htdocs/Neoklubb/Private/Include/LogInChecker.php";
    include_once "/Applications/XAMPP/xamppfiles/htdocs/Neoklubb/Private/Include/LoginHeader.php";
    include_once "/Applications/XAMPP/xamppfiles/htdocs/NeoKlubb/Private/Database/DatabaseConnection.php";

    // Setter variabler basert på input i form
    $medlemid = $_POST['MedlemID'];
    $status = $_POST['Status'];
    // Query for å hente ut informasjon om medlem
    $sql = "SELECT MedlemID, Fornavn, Etternavn FROM Medlem order by Fornavn";
    // Query for å oppdatere status til angitt medlem
    $sql2 = "UPDATE Status SET Status = :Status WHERE MedlemID = :MedlemID";

    // Prepare statement for å unngå SQL injections
    $sp = $pdo->prepare($sql);
    $update = $pdo->prepare($sql2);

    $sp->execute();
    // Henter ut informasjonen om objektet og plasserer i en array
    $medlemmer = $sp->fetchAll();

    // Binder parameter med variabler for SQL query
    $update->bindParam(":MedlemID", $medlemid);
    $update->bindParam(":Status", $status);

    if (isset($_POST["OppdaterStatus"])) {

        try {
            $update->execute();
        } catch (PDOException $e) {
            echo $e->getMessage() . "<br>";
        }

        if ($update->rowCount() > 0) {
            echo $update->rowCount() . " oppføring" . ($update->rowCount() > 1 ? "er" : "") . " ble oppdatert.";
        } else {
            echo "Oppdatering feilet, ingen endringer er lagret";
        }
    }
    ?>
    <!-- Form som henter inn nødvendig informasjon for å oppdatere et medlem sin status -->

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