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


    $sql = "SELECT Interesser, InteresseID from Interesser ORDER BY InteresseID";

    $updateSql = "INSERT INTO MineInteresser VALUES :MedlemID, :InteresseID";

    // $update->bindParam(":MedlemID", $medlemid, PDO::PARAM_STR);
    // $update->bindParam(":InteresseID", $interesseid, PDO::PARAM_STR);

    $update = $pdo->prepare($updateSql);


    try {
        $sp = $pdo->prepare($sql);
        $sp->execute();
        $resultat = $sp->fetchAll();
    } catch (PDOException $e) {
        echo $e->getMessage() . "<br>";
    }

    if (isset($_POST["RegistrerMineInteresser"])) {

        try {
            $update->execute();
            echo "<meta http-equiv='refresh' content='0'>";
        } catch (PDOException $e) {
            echo $e->getMessage() . "<br>";
        }
        $update->debugDumpParams();
    }

    ?>
    <h1> Registrer dine interesser </h1>

    <form method="POST" action="">
        <p>
            <label>Interesse
                <select name="Interesser" id="Interesser">
                    <?php foreach ($resultat as $row) : ?>
                        <option><?= $row["Interesser"]; ?></option>
                    <?php endforeach ?>
                </select>
        </p>

        <p>
            <button type="Submit" name="RegistrerDineInteresser">Registrer min interesse</button>
        </p>


</body>

</html>