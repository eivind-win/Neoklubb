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

    include_once "/Applications/XAMPP/xamppfiles/htdocs/NeoKlubb/Neoklubb/Private/Database/DatabaseConnection.php";

    $sql = "INSERT INTO NeoKlubb.Medlem (Fornavn, Etternavn, Telefon, Epost, Fodselsdato, Kjonn, Passord) 
        VALUES (:Fornavn, :Etternavn, :Telefon, :Epost, :Fodselsdato, :Kjonn, :Passord)";

    $sp = $pdo->prepare($sql);

    $sp->bindParam(":Fornavn", $fornavn, PDO::PARAM_STR);
    $sp->bindParam(":Etternavn", $etternavn, PDO::PARAM_STR);
    $sp->bindParam(":Telefon", $telefon, PDO::PARAM_STR);
    $sp->bindParam(":Epost", $epost, PDO::PARAM_STR);
    $sp->bindParam(":Fodselsdato", $fodselsdato);
    $sp->bindParam(":Kjonn", $Kjonn, PDO::PARAM_STR);
    $sp->bindParam(":Passord", $passord, PDO::PARAM_STR);

    $fornavn = isset($_POST['Fornavn']) ? $_POST['Fornavn'] : "";
    $etternavn = isset($_POST['Etternavn']) ? $_POST['Etternavn'] : "";
    $telefon = isset($_POST['Telefon']) ? $_POST['Telefon'] : "";
    $epost = isset($_POST['Epost']) ? $_POST['Epost'] : "";
    $fodselsdato = isset($_POST['Fodselsdato']) ? $_POST['Fodselsdato'] : "";
    $Kjonn = isset($_POST['Kjonn']) ? $_POST['Kjonn'] : "";
    $passord = isset($_POST['Passord']) ? $_POST['Passord'] : "";

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
            <label for="Passord">Passord</label>
            <input name="Passord" type="text" required oninvalid="this.setCustomValidity('Passord kan ikke være blankt!')" onchange="this.setCustomValidity('')" value="<?php if (isset($_POST["Passord"])) {
                                                                                                                                                                            echo $_POST["Passord"];
                                                                                                                                                                        } ?>">
        </p>



        <p>
            <button type="Submit" name="Registrerdeg">Registrer deg</button>
        </p>

        <br><br>
        <a href="Index.php">Tilbake til hjemmesiden

</body>

</html>