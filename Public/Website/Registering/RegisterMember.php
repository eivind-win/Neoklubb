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
    require_once "/Applications/XAMPP/xamppfiles/htdocs/Neoklubb/Public/Resources/Style/style.html";

    if (isset($_POST["Registrerdeg"])) {
        $messages = array();

        if (empty($_POST['Fornavn'])) {
            $messages[] = 'Du må fylle inn fornavn!';
        }
        if (empty($_POST['Etternavn'])) {
            $messages[] = 'Du må fylle inn etternavn!';
        }
        if (empty($_POST['Telefon'])) {
            $messages[] = 'Du må fylle inn telefon!';
        }
        if (empty($_POST['Epost'])) {
            $messages[] = 'Du må fylle inn epost!';
        }
        if (empty($_POST['Fodselsdato'])) {
            $messages[] = 'Du må fylle inn fødselsdato!';
        }
        if (empty($_POST['Kjonn'])) {
            $messages[] = 'Du må fylle inn kjønn!';
        }
        if (empty($_POST['Gateadresse'])) {
            $messages[] = 'Du må fylle inn gateadresse!';
        }
        if (empty($_POST['Poststed'])) {
            $messages[] = 'Du må fylle inn poststed!';
        }
        if (empty($_POST['Postnummer'])) {
            $messages[] = 'Du må fylle inn postnummer!';
        }
        if (empty($_POST['Passord'])) {
            $messages[] = 'Du må fylle inn passord!';
        }
        if (empty($_POST['BekreftPassord'])) {
            $messages[] = 'Vennligst bekreft passord!';
        }
        if (strlen($passord) < 6) {
            $messages[] = "Passordet må være lenger enn 6 tegn!";
        }
        // om det ikke forekommer noen feilmelding så skjer det ingenting, men om for loopen teller over og finner noe så vil den sende ut den spesifikke advarselen
        if (empty($messages)) {
        } else {
            for ($i = 0; $i < count($messages); $i++) {
                echo $messages[$i] . "<br>";
            }
        }
    }

    // Sql for insert av registrert medlem i medlemtabell og adressetabell
    $sql =
        "INSERT INTO NeoKlubb.Medlem (Fornavn, Etternavn, Telefon, Epost, Fodselsdato, Kjonn, Passord)
            VALUES (:Fornavn, :Etternavn, :Telefon, :Epost, :Fodselsdato, :Kjonn, :Passord);
        INSERT INTO NeoKlubb.Kontigent (KontigentsStatus, MedlemID) 
            VALUES ('Ubetalt', last_insert_id());
        INSERT INTO NeoKlubb.Status (Status, MedlemID) 
            VALUES ('Aktiv', last_insert_id());
        INSERT INTO NeoKlubb.MineRoller (MedlemID, RolleID)
            VALUES  (last_insert_id(), 1);
        INSERT INTO NeoKlubb.Adresse (Gateadresse, Poststed, Postnummer, MedlemID) 
            VALUES (:Gateadresse, :Poststed, :Postnummer, last_insert_id());
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
    $passord = isset($_POST['Passord']) ? $_POST['Passord'] : "";
    $bekreftpassord = isset($_POST['BekreftPassord']) ? $_POST['BekreftPassord'] : "";

    if ($passord != $bekreftpassord) {
        echo "Passordene matcher ikke!";
    }


    if (isset($_POST["Registrerdeg"]) && empty($messages) && $passord === $bekreftpassord) {

        $passord = password_hash($passord, PASSWORD_DEFAULT);

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
    <br>
    <h3> Legg til informasjon </h3>
    <br>

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
            <input name="Passord" type="Password" required oninvalid="this.setCustomValidity('Passord kan ikke være blankt!')" onchange="this.setCustomValidity('')" value="<?php if (isset($_POST["Passord"])) {
                                                                                                                                                                                echo $_POST["Passord"];
                                                                                                                                                                            } ?>">
        </p>
        <p>
            <label for="BekreftPassord">Bekreft passord</label>
            <input name="BekreftPassord" type="Password" required oninvalid="this.setCustomValidity('Vennligst bekreft passord!')" onchange="this.setCustomValidity('')" value="">
        </p>
        <p>
            <button type="Submit" name="Registrerdeg">Registrer deg</button>
        </p>
</body>

</html>