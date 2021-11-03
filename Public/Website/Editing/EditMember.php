<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Endre medlem</title>
</head>
<?php

include "/Applications/XAMPP/xamppfiles/htdocs/NeoKlubb/Private/Database/DatabaseConnection.php";
<<<<<<< HEAD
session_start();
$epost = $_SESSION["Epost"];

// Sql query for å hente ut eksisterende informasjon om medlem
$medlem = $pdo->query("SELECT Fornavn, Etternavn, Telefon, Epost, Fodselsdato, Kjonn, Passord FROM NeoKlubb.Medlem WHERE Epost = '$epost'");
=======
include_once "/Applications/XAMPP/xamppfiles/htdocs/Neoklubb/Private/Include/LoginHeader.php";


$medlem = $pdo->query('SELECT Fornavn, Etternavn, Telefon, Epost, Fodselsdato, Kjonn, Passord FROM NeoKlubb.Medlem WHERE Epost = "anders@uia.no"');
>>>>>>> a281fba07df1a01b69c1ed9d205b8d72ddc49706
foreach ($medlem as $medlem) {
    $medlem['Fornavn'] . "\n";
    $medlem['Telefon'] . "\n";
    $medlem['Epost'] . "\n";
    $medlem['Fodselsdato'] . "\n";
    $medlem['Kjonn'] . "\n";
    $medlem['Passord'] . "\n";
}

// Sql query for å oppdatere informasjon om medlemmet om noe forandres
$updateSql =
<<<<<<< HEAD
    "UPDATE NeoKlubb.Medlem SET Fornavn = :Fornavn, Etternavn = :Etternavn , Telefon = :Telefon , Epost = :Epost
        , Fodselsdato = :Fodselsdato , Kjonn = :Kjonn , Passord = :Passord WHERE Epost = '$epost'";
=======
    'UPDATE NeoKlubb.Medlem SET Fornavn = :Fornavn, Etternavn = :Etternavn , Telefon = :Telefon , Epost = :Epost
        , Fodselsdato = :Fodselsdato , Kjonn = :Kjonn , Passord = :Passord WHERE Epost = "anders@uia.no"';
>>>>>>> a281fba07df1a01b69c1ed9d205b8d72ddc49706

$update = $pdo->prepare($updateSql);

// Binder parameter med variabler
$update->bindParam(":Fornavn", $fornavn, PDO::PARAM_STR);
$update->bindParam(":Etternavn", $etternavn, PDO::PARAM_STR);
$update->bindParam(":Telefon", $telefon, PDO::PARAM_STR);
$update->bindParam(":Epost", $epost, PDO::PARAM_STR);
$update->bindParam(":Fodselsdato", $fodselsdato);
$update->bindParam(":Kjonn", $kjonn, PDO::PARAM_STR);
$update->bindParam(":Passord", $passord, PDO::PARAM_STR);


// Setter variablene som tomme for å unngå error, samt at de er input fra HTML
$fornavn = isset($_POST['Fornavn']) ? $_POST['Fornavn'] : "";
$etternavn = isset($_POST['Etternavn']) ? $_POST['Etternavn'] : "";
$telefon = isset($_POST['Telefon']) ? $_POST['Telefon'] : "";
$epost = isset($_POST['Epost']) ? $_POST['Epost'] : "";
$fodselsdato = isset($_POST['Fodselsdato']) ? $_POST['Fodselsdato'] : "";
$kjonn = isset($_POST['Kjonn']) ? $_POST['Kjonn'] : "";
$passord = isset($_POST['Passord']) ? $_POST['Passord'] : "";

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
    <h1> Endre opplysninger </h1>
    <h2> Legg til endringer </h2>
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
            <label for="Passord">Passord</label>
            <input name="Passord" type="text" required oninvalid="this.setCustomValidity('Passord kan ikke være blank')" onchange="this.setCustomValidity('')">
        </p>
        <p>
            <button type="Submit" name="Lagreendringer">Lagre endringer</button>
        </p>
    </form>


</body>
<a href="../Index/Forside.php">Tilbake til hjemmesiden

</html>