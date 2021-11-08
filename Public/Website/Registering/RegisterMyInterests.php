<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Legg til interesser</title>
</head>

<body>
    <?php
    include_once "/Applications/XAMPP/xamppfiles/htdocs/NeoKlubb/Private/Database/DatabaseConnection.php";
    include_once "/Applications/XAMPP/xamppfiles/htdocs/Neoklubb/Private/Include/LogInChecker.php";

    $medlemid = $_SESSION["MedlemID"];
    $interesseid = $output['InteresseID'];

    $sql = "SELECT Interesser, InteresseID from Interesser ORDER BY InteresseID";
    $sqlAdd = "INSERT INTO MineInteresser Values :MedlemID, :InteresseID";

    //$sp->bindParam(":MedlemID", $medlemid, PDO::PARAM_INT);
    // $sp->bindParam(":InteresseID", $interesseid, PDO::PARAM_INT);

    try {
        $sp = $pdo->prepare($sql);
        $sp->execute();
        $resultat = $sp->fetchAll();
    } catch (PDOException $e) {
        echo $e->getMessage() . "<br>";
    }

    if (isset($_POST["RegistrerDineInteresser"])) {


        try {
            $sp->execute($sqlAdd);
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
    <h1> Registrer dine interesser </h1>

    <form method="POST" action="">
        <p>
            <label>Interesse
                <select>
                    <option> Velg interesse </option>
                    <?php foreach ($resultat as $output) { ?>
                        <option><?php echo $output['Interesser']; ?></option>
                    <?php } ?>
        </p>

        <p>
            <button type="Submit" name="RegistrerDineInteresser">Registrer min interesse</button>
        </p>


</body>

</html>