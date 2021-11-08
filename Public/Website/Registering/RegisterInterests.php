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
    include_once "/Applications/XAMPP/xamppfiles/htdocs/NeoKlubb/Private/Database/DatabaseConnection.php";
    include_once "/Applications/XAMPP/xamppfiles/htdocs/Neoklubb/Private/Include/LogInChecker.php";


    $sql = "INSERT INTO INTERESSER(INTERESSER) VALUES (:Interesser);";

    $sp = $pdo->prepare($sql);

    $sp->bindParam(":Interesser", $interesser, PDO::PARAM_STR);

    $interesser = isset($_POST['Interesser']) ? $_POST['Interesser'] : "";

    if (isset($_POST["RegistrerInteresse"])) {

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