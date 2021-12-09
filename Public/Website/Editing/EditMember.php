<?php
include_once "/Applications/XAMPP/xamppfiles/htdocs/Neoklubb/Private/Include/LoginHeader.php";
include_once "/Applications/XAMPP/xamppfiles/htdocs/NeoKlubb/Private/Database/DatabaseConnection.php";
include_once "/Applications/XAMPP/xamppfiles/htdocs/Neoklubb/Private/Include/LogInChecker.php";

$medlemid = $_SESSION['MedlemID'];

// Sql query for å hente ut eksisterende informasjon om medlem
$medlem = $pdo->query("SELECT Medlem.Fornavn, Medlem.Etternavn, Medlem.Telefon, Medlem.Epost, Medlem.Fodselsdato, 
Medlem.Kjonn, Medlem.Passord FROM Neoklubb.Medlem Where MedlemID = $medlemid;");

$medlemStatus = $pdo->query("SELECT Status.Status FROM Neoklubb.Status WHERE MedlemID = $medlemid");

// Foreach loop som printer ut eksisterende informasjon om medlemmet
foreach ($medlem as $medlem) {
    $medlem['MedlemID'] . "\n";
    $medlem['Fornavn'] . "\n";
    $medlem['Telefon'] . "\n";
    $medlem['Epost'] . "\n";
    $medlem['Fodselsdato'] . "\n";
    $medlem['Kjonn'] . "\n";
    $medlem['Passord'] . "\n";
}
foreach ($medlemStatus as $medlemStatus) {
    $medlemStatus['Status'] . "\n";
}

// Sql query for å oppdatere informasjon om medlemmet om noe forandres
$updateSql = "UPDATE NeoKlubb.Medlem SET Fornavn = :Fornavn, Etternavn = :Etternavn , Telefon = :Telefon , Epost = :Epost
        , Fodselsdato = :Fodselsdato , Kjonn = :Kjonn , Passord = :Passord WHERE MedlemID = '$medlemid';
    UPDATE Neoklubb.Status SET Status = :Status WHERE MedlemID = '$medlemid'";

$update = $pdo->prepare($updateSql);

// Binder parameter med variabler
$update->bindParam(":Fornavn", $fornavn, PDO::PARAM_STR);
$update->bindParam(":Etternavn", $etternavn, PDO::PARAM_STR);
$update->bindParam(":Telefon", $telefon, PDO::PARAM_STR);
$update->bindParam(":Epost", $epost, PDO::PARAM_STR);
$update->bindParam(":Fodselsdato", $fodselsdato);
$update->bindParam(":Kjonn", $kjonn, PDO::PARAM_STR);
$update->bindParam(":Passord", $passord, PDO::PARAM_STR);
$update->bindParam(":Status", $status, PDO::PARAM_STR);

// Setter variablene som tomme for å unngå error, samt at de er input fra HTML
$fornavn = isset($_POST['Fornavn']) ? $_POST['Fornavn'] : "";
$etternavn = isset($_POST['Etternavn']) ? $_POST['Etternavn'] : "";
$telefon = isset($_POST['Telefon']) ? $_POST['Telefon'] : "";
$epost = isset($_POST['Epost']) ? $_POST['Epost'] : "";
$fodselsdato = isset($_POST['Fodselsdato']) ? $_POST['Fodselsdato'] : "";
$kjonn = isset($_POST['Kjonn']) ? $_POST['Kjonn'] : "";
$passord = isset($_POST['Passord']) ? $_POST['Passord'] : "";
$status = isset($_POST['Status']) ? $_POST['Status'] : "";


// Hasher passord om det blir forandret
$passord = password_hash($passord, PASSWORD_DEFAULT);

if (isset($_POST["Lagreendringer"])) {

    try {
        $update->execute();
    } catch (PDOException $e) {
        echo $e->getMessage() . "<br>";
    }
    // $update->debugDumpParams();

    if ($update->rowCount() > 0) {
        echo $update->rowCount() . " oppføring" . ($update->rowCount() > 1 ? "er" : "") . " ble oppdatert.";
    } else {
        echo "Oppdatering feilet, ingen endringer er lagret";
    }
}

?>
<!-- HTML form som tar alt relevant input. Standard verdiene er satt til å være eksisterende informasjon om medlemmet -->

<body>
    <h1> Endre personopplysninger </h1>
    <form method="POST" action="">
        <p>
            <label for="Fornavn">Fornavn</label>
            <input name="Fornavn" type="text" required oninvalid="this.setCustomValidity('Fornavn kan ikke være blankt!')" onchange="this.setCustomValidity('')" value="<?php echo $medlem['Fornavn']; ?>">
        </p>

        <p>
            <label for="Etternavn">Etternavn</label>
            <input name="Etternavn" type="text" required oninvalid="this.setCustomValidity('Fornavn kan ikke være blankt')" onchange="this.setCustomValidity('')" value="<?php echo $medlem["Etternavn"]; ?>">
        </p>
        <p>
            <label for="Telefon">Telefon</label>
            <input name="Telefon" type="number" required oninvalid="this.setCustomValidity('Telefonnummer kan ikke være blankt')" onchange="this.setCustomValidity('')" min="0" max="99999999" value="<?php echo $medlem["Telefon"]; ?>">
        </p>
        <p>
            <label for="Epost">Epost</label>
            <input name="Epost" type="text" required oninvalid="this.setCustomValidity('Epost kan ikke være blank')" onchange="this.setCustomValidity('')" value="<?php echo $medlem["Epost"]; ?>">
        </p>
        <p>
            <label for="Fodselsdato">Fødselsdato</label>
            <input name="Fodselsdato" type="date" required oninvalid="this.setCustomValidity('Fødselsdato kan ikke være blank')" onchange="this.setCustomValidity('')" value="<?php echo $medlem["Fodselsdato"]; ?>">
        </p>
        <p>
            <label for="Kjonn">Kjønn</label>
            <select id="Kjonn" name="Kjonn" required oninvalid="this.setCustomValidity('Kjønn kan ikke være blankt!')" onchange="this.setCustomValidity('')">

                <option selected><?php echo $medlem["Kjonn"]; ?> </option>
                <option value="Mann">Mann</option>
                <option value="Kvinne">Kvinne</option>
            </select>
        </p>
        <p>
            <label for="Status">Status</label>
            <select id="Status" name="Status" required oninvalid="this.setCustomValidity('Status kan ikke være blankt!')" onchange="this.setCustomValidity('')">

                <option disabled selected><?php echo $medlemStatus["Status"]; ?></option>
                <option value="Aktiv">Aktiv</option>
                <option value="Inaktiv">Inaktiv</option>
            </select>
        </p>
        <p>
            <label for="Passord">Passord</label>
            <input name="Passord" type="Password">
        </p>
        <p>
            <button type="Submit" name="Lagreendringer">Lagre endringer</button>
        </p>
    </form>


</body>

</html>