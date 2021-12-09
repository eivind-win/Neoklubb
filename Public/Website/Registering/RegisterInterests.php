<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrer nye interesser</title>
</head>

<body>
    <?php
    include_once "/Applications/XAMPP/xamppfiles/htdocs/Neoklubb/Private/Include/LogInChecker.php";
    include_once "/Applications/XAMPP/xamppfiles/htdocs/Neoklubb/Private/Include/LoginHeader.php";
    include_once "/Applications/XAMPP/xamppfiles/htdocs/NeoKlubb/Private/Database/DatabaseConnection.php";

    // Sjekker at variablene ikke er tom
    if (isset($_POST["RegistrerInteresse"])) {
        $messages = array();

        if (empty($_POST['Interesser'])) {
            $messages[] = 'Vennligst fyll inn en interesse';
        }
        // om det ikke forekommer noen feilmelding så skjer det ingenting, men om for loopen teller over og finner noe så vil den sende ut den spesifikke advarselen
        if (empty($messages)) {
        } else {
            for ($i = 0; $i < count($messages); $i++) {
                echo $messages[$i] . "<br>";
            }
        }
    }


    $sql = "INSERT INTO INTERESSER(INTERESSER) VALUES (:Interesser);";

    $sp = $pdo->prepare($sql);

    $sp->bindParam(":Interesser", $interesser, PDO::PARAM_STR);

    $interesser = isset($_POST['Interesser']) ? $_POST['Interesser'] : "";

    if (isset($_POST["RegistrerInteresse"]) && empty($messages)) {

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
    <h1> Registrer nye interesser </h1>

    <form method="POST" action="">
        <p>
            <label for="Interesser">Interesser</label>
            <input name="Interesser" type="text" required oninvalid="this.setCustomValidity('Interesse kan ikke være blank!')" onchange="this.setCustomValidity('')" value="<?php if (isset($_POST["Interesser"])) {
                                                                                                                                                                                echo $_POST["Interesser"];
                                                                                                                                                                            } ?>">
        </p>

        <p>
            <button type="Submit" name="RegistrerInteresse">Registrer ny interesse</button>
        </p>



</body>

</html>