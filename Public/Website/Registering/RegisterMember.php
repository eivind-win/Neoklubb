<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrering</title>
</head>

<body>
    <?php
    include_once "/Applications/XAMPP/xamppfiles/htdocs/NeoKlubb/Private/Database/DatabaseConnection.php";
    include_once "/Applications/XAMPP/xamppfiles/htdocs/Neoklubb/Private/Include/LogoutHeader.php";

    // Sql for insert av registrert medlem i medlemtabell og adressetabell
    $sql =
        "INSERT INTO NeoKlubb.Medlem (Fornavn, Etternavn, Telefon, Epost, Fodselsdato, Kjonn, Passord)
            VALUES (:Fornavn, :Etternavn, :Telefon, :Epost, :Fodselsdato, :Kjonn, :Passord);
        INSERT INTO NeoKlubb.Adresse (Gateadresse, Poststed, Postnummer, MedlemID) 
            VALUES (:Gateadresse, :Poststed, :Postnummer, last_insert_id());
        INSERT INTO NeoKlubb.Kontigent (KontigentsStatus, MedlemID) 
            VALUES ('Ubetalt', last_insert_id());
            ";

    $sp = $pdo->prepare($sql);


    //binder variabler med insert parametere 

    $sp->bindParam(":Fornavn", $fornavn, PDO::PARAM_STR);
    $sp->bindParam(":Etternavn", $etternavn, PDO::PARAM_STR);
    $sp->bindParam(":Telefon", $telefon, PDO::PARAM_STR);
    $sp->bindParam(":Epost", $epost, PDO::PARAM_STR);
    $sp->bindParam(":Fodselsdato", $fodselsdato);
    $sp->bindParam(":Kjonn", $Kjonn, PDO::PARAM_STR);
    $sp->bindParam(":Passord", $passord, PDO::PARAM_STR);


    $sp->bindParam(":Gateadresse", $gateadresse, PDO::PARAM_STR);
    $sp->bindParam(":Poststed", $poststed, PDO::PARAM_STR);
    $sp->bindParam(":Postnummer", $postnummer, PDO::PARAM_STR);



    // setter tomme verdier for å slippe error for tomme variabler samt at variablene er eventuelt HTML input

    $fornavn = isset($_POST['Fornavn']) ? $_POST['Fornavn'] : "";
    $etternavn = isset($_POST['Etternavn']) ? $_POST['Etternavn'] : "";
    $telefon = isset($_POST['Telefon']) ? $_POST['Telefon'] : "";
    $epost = isset($_POST['Epost']) ? $_POST['Epost'] : "";
    $fodselsdato = isset($_POST['Fodselsdato']) ? $_POST['Fodselsdato'] : "";
    $Kjonn = isset($_POST['Kjonn']) ? $_POST['Kjonn'] : "";
    $passord = isset($_POST['Passord']) ? $_POST['Passord'] : "";

    $gateadresse = isset($_POST['Gateadresse']) ? $_POST['Gateadresse'] : "";
    $poststed = isset($_POST['Poststed']) ? $_POST['Poststed'] : "";
    $postnummer = isset($_POST['Postnummer']) ? $_POST['Postnummer'] : "";

    //Hasher passord som blir lagt inn i databasen gjennom form
    $passord = password_hash($passord, PASSWORD_DEFAULT);


    if (isset($_POST["Registrerdeg"])) {


        try {
            $sp->execute();
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
    <h1> Registrer deg </h1>
    <h2> Legg til informasjon </h2>

    <!-- HTML form som tar relevant informasjon i input, lagt inn isset for å reprinte inngitt verdi dersom noe annet skulle være feil, hindrer at bruker må fylle inn alt på nytt-->

    <form method="POST" action="">
        <p>
            <label for="Fornavn">Fornavn</label>
            <input name="Fornavn" type="text" required oninvalid="this.setCustomValidity('Fornavn kan ikke være blankt!')" onchange="this.setCustomValidity('')" value="<?php if (isset($_POST["Fornavn"])) {
                                                                                                                                                                            echo $_POST["Fornavn"];
                                                                                                                                                                        } ?>">
        </p>
        <p>
            <label for="Etternavn">Etternavn</label>
            <input name="Etternavn" type="text" required oninvalid="this.setCustomValidity('Etternavn kan ikke være blankt!')" onchange="this.setCustomValidity('')" value="<?php if (isset($_POST["Etternavn"])) {
                                                                                                                                                                                echo $_POST["Etternavn"];
                                                                                                                                                                            } ?>">
        </p>
        <p>
            <label for="Telefon">Telefon</label>
            <input name="Telefon" type="text" required oninvalid="this.setCustomValidity('Telefonnummer kan ikke være blankt!')" onchange="this.setCustomValidity('')" value="<?php if (isset($_POST["Telefon"])) {
                                                                                                                                                                                    echo $_POST["Telefon"];
                                                                                                                                                                                } ?>">
        </p>
        <p>
            <label for="Epost">Epost</label>
            <input name="Epost" type="text" required oninvalid="this.setCustomValidity('Epost kan ikke være blankt!')" onchange="this.setCustomValidity('')" value="<?php if (isset($_POST["Epost"])) {
                                                                                                                                                                        echo $_POST["Epost"];
                                                                                                                                                                    } ?>">
        </p>
        <p>
            <label for="Fodselsdato">Fødselsdato</label>
            <input name="Fodselsdato" type="date" required oninvalid="this.setCustomValidity('Fødselsdato kan ikke være blankt!')" onchange="this.setCustomValidity('')" value="<?php if (isset($_POST["Fodselsdato"])) {
                                                                                                                                                                                    echo $_POST["Fodselsdato"];
                                                                                                                                                                                } ?>">
        </p>
        <p>
            <label for="Kjonn">Kjønn</label>
            <select id="Kjonn" name="Kjonn" required oninvalid="this.setCustomValidity('Kjønn kan ikke være blankt!')" onchange="this.setCustomValidity('')">

                <option value="" disabled selected></option>
                <option value="Mann">Mann</option>
                <option value="Kvinne">Kvinne</option>
            </select>
        </p>
        <p>
            <label for="Gateadresse">Gateadresse</label>
            <input name="Gateadresse" type="text" required oninvalid="this.setCustomValidity('Gateadresse kan ikke være blank!')" onchange="this.setCustomValidity('')" value="<?php if (isset($_POST["Gateadresse"])) {
                                                                                                                                                                                    echo $_POST["Gateadresse"];
                                                                                                                                                                                } ?>">
        </p>
        <p>
            <label for="Poststed">Poststed</label>
            <input name="Poststed" type="text" required oninvalid="this.setCustomValidity('Poststed kan ikke være blankt!')" onchange="this.setCustomValidity('')" value="<?php if (isset($_POST["Poststed"])) {
                                                                                                                                                                                echo $_POST["Poststed"];
                                                                                                                                                                            } ?>">
        </p>
        <p>
            <label for="Postnummer">Postnummer</label>
            <input name="Postnummer" type="text" required oninvalid="this.setCustomValidity('Postnummer kan ikke være blankt!')" onchange="this.setCustomValidity('')" value="<?php if (isset($_POST["Postnummer"])) {
                                                                                                                                                                                    echo $_POST["Postnummer"];
                                                                                                                                                                                } ?>">
        </p>

        <p>
            <label for="Passord">Passord</label>
            <input name="Passord" type="text" required oninvalid="this.setCustomValidity('Passord kan ikke være blankt!')" onchange="this.setCustomValidity('')" value="<?php if (isset($_POST["Passord"])) {
                                                                                                                                                                            echo $_POST["Passord"];
                                                                                                                                                                        } ?>">
        </p>
        <p>
            <button type="Submit" name="Registrerdeg">Registrer deg</button>
        </p>
</body>

</html>