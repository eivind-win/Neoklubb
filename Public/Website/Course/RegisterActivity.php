<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kurs</title>
</head>

<body>
    <h1> Registrer aktivitet for Neo Ungdomsklubb </h1>

    <?php
    include_once "/Applications/XAMPP/xamppfiles/htdocs/NeoKlubb/Neoklubb/Private/Database/DatabaseConnection.php";

    $sql = "INSERT INTO NeoKlubb.Aktivitet (Aktivitet, Beskrivelse, StartDato, SluttDato) 
    VALUES (:Aktivitet, :Beskrivelse, :StartDato, :SluttDato)";

    $sp = $pdo->prepare($sql);

    $sp->bindParam(":Aktivitet", $aktivitet, PDO::PARAM_STR);
    $sp->bindParam(":Beskrivelse", $beskrivelse, PDO::PARAM_STR);
    $sp->bindParam(":StartDato", $startdato);
    $sp->bindParam(":SluttDato", $sluttdato);




    $aktivitet = isset($_POST['Aktivitet']) ? $_POST['Aktivitet'] : "";
    $beskrivelse = isset($_POST['Beskrivelse']) ? $_POST['Beskrivelse'] : "";
    $startpunkt = isset($_POST['StartDato']) ? $_POST['StartDato'] : "";
    $sluttpunkt = isset($_POST['SluttDato']) ? $_POST['SluttDato'] : "";

    //Forandrer tid og dato formattet til å kunne legges inn i databasen
    $startdato = date("Y-m-d\TH:i:s", strtotime($startpunkt));
    $sluttdato = date("Y-m-d\TH:i:s", strtotime($sluttpunkt));

    if (isset($_POST["Registreraktivitet"])) {


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
    <form method="POST" action="">
        <p>
            <label for="Aktivitet">Aktivitet</label>
            <input name="Aktivitet" type="text" required oninvalid="this.setCustomValidity('Aktivitet kan ikke være blank!')" onchange="this.setCustomValidity('')" value="<?php if (isset($_POST["Aktivitet"])) {
                                                                                                                                                                                echo $_POST["Aktivitet"];
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