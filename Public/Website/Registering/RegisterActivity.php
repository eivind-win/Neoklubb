<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrer Kurs</title>
</head>

<body>
    <?php
    include_once "/Applications/XAMPP/xamppfiles/htdocs/Neoklubb/Private/Include/LogInChecker.php";
    include_once "/Applications/XAMPP/xamppfiles/htdocs/Neoklubb/Private/Include/LoginHeader.php";
    include_once "/Applications/XAMPP/xamppfiles/htdocs/NeoKlubb/Private/Database/DatabaseConnection.php";
    ?>
    <h1> Registrer kurs eller aktivitet for Neo Ungdomsklubb </h1>
    <?php

    // Sjekker at input i form ikke er tomme
    if (isset($_POST["Registreraktivitet"])) {
        $messages = array();

        if (empty($_POST['Aktivitet'])) {
            $messages[] = 'Husk en tittel på aktiviteten';
        }
        if (empty($_POST['Ansvarlig'])) {
            $messages[] = 'Vennligst gi aktiviteten en ansvarlig';
        }
        if (empty($_POST['Beskrivelse'])) {
            $messages[] = 'Vennligst gi en beskrivelse';
        }
        if (empty($_POST['StartDato'])) {
            $messages[] = 'Vennligst fyll inn når det starter!';
        }
        if (empty($_POST['SluttDato'])) {
            $messages[] = 'Vennligst fyll inn når det slutter!';
        }
        // om det ikke forekommer noen feilmelding så skjer det ingenting, men om for loopen teller over og finner noe så vil den sende ut den spesifikke advarselen
        if (empty($messages)) {
        } else {
            for ($i = 0; $i < count($messages); $i++) {
                echo $messages[$i] . "<br>";
            }
        }
    }

    $sql = "INSERT INTO NeoKlubb.Aktivitet (Aktivitet, Ansvarlig, Beskrivelse, StartDato, SluttDato) 
    VALUES (:Aktivitet, :Ansvarlig, :Beskrivelse, :StartDato, :SluttDato)";

    $sp = $pdo->prepare($sql);

    $sp->bindParam(":Aktivitet", $aktivitet, PDO::PARAM_STR);
    $sp->bindParam(":Ansvarlig", $ansvarlig, PDO::PARAM_STR);
    $sp->bindParam(":Beskrivelse", $beskrivelse, PDO::PARAM_STR);
    $sp->bindParam(":StartDato", $startdato);
    $sp->bindParam(":SluttDato", $sluttdato);


    $aktivitet = isset($_POST['Aktivitet']) ? $_POST['Aktivitet'] : "";
    $ansvarlig = isset($_POST['Ansvarlig']) ? $_POST['Ansvarlig'] : "";
    $beskrivelse = isset($_POST['Beskrivelse']) ? $_POST['Beskrivelse'] : "";
    $startpunkt = isset($_POST['StartDato']) ? $_POST['StartDato'] : "";
    $sluttpunkt = isset($_POST['SluttDato']) ? $_POST['SluttDato'] : "";

    //Forandrer tid og dato formattet til å kunne legges inn i databasen
    $startdato = date("Y-m-d\TH:i:s", strtotime($startpunkt));
    $sluttdato = date("Y-m-d\TH:i:s", strtotime($sluttpunkt));

    if (isset($_POST["Registreraktivitet"]) && empty($messages)) {

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
    <!-- Form for input fra brukeren -->
    <form method="POST" action="">
        <p>
            <label for="Aktivitet">Aktivitet</label>
            <input name="Aktivitet" type="text" required oninvalid="this.setCustomValidity('Aktivitet kan ikke være blank!')" onchange="this.setCustomValidity('')" value="<?php if (isset($_POST["Aktivitet"])) {
                                                                                                                                                                                echo $_POST["Aktivitet"];
                                                                                                                                                                            } ?>">
        </p>
        <p>
            <label for="Ansvarlig">Ansvarlig</label>
            <input name="Ansvarlig" type="text" required oninvalid="this.setCustomValidity('Kurset må ha en ansvarlig!')" onchange="this.setCustomValidity('')" value="<?php if (isset($_POST["Ansvarlig"])) {
                                                                                                                                                                            echo $_POST["Ansvarlig"];
                                                                                                                                                                        } ?>">
        </p>
        <p>
            <label for="Beskrivelse">Beskrivelse</label>
            <input name="Beskrivelse" type="text" required oninvalid="this.setCustomValidity('Beskrivelsen kan ikke være blank!')" onchange="this.setCustomValidity('')" value="<?php if (isset($_POST["Beskrivelse"])) {
                                                                                                                                                                                    echo $_POST["Beskrivelse"];
                                                                                                                                                                                } ?>">
        </p>
        <p>
            <label for="StartDato">Starter</label>
            <input name="StartDato" type="datetime-local" required oninvalid="this.setCustomValidity('Start tidspunkt kan ikke være blankt!')" onchange="this.setCustomValidity('')" value="<?php if (isset($_POST["StartDato"])) {
                                                                                                                                                                                                echo $_POST["StartDato"];
                                                                                                                                                                                            } ?>">
        </p>
        <p>
            <label for="SluttDato">Slutter</label>
            <input name="SluttDato" type="datetime-local" required oninvalid="this.setCustomValidity('Slutt tidspunkt kan ikke være blankt!')" onchange="this.setCustomValidity('')" value="<?php if (isset($_POST["SluttDato"])) {
                                                                                                                                                                                                echo $_POST["SluttDato"];
                                                                                                                                                                                            } ?>">
        </p>
        <p>
            <button type="Submit" name="Registreraktivitet">Registrer Aktivitet</button>
        </p>
</body>

</html>