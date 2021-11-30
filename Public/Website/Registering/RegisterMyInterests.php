<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrer mine interesser</title>
</head>

<body>
    <?php
    include_once "/Applications/XAMPP/xamppfiles/htdocs/NeoKlubb/Private/Database/DatabaseConnection.php";
    include_once "/Applications/XAMPP/xamppfiles/htdocs/Neoklubb/Private/Include/LogInChecker.php";
    include_once "/Applications/XAMPP/xamppfiles/htdocs/Neoklubb/Private/Include/LoginHeader.php";

    $medlemid = $_SESSION['MedlemID'];
    $interessid = $_POST['Interesser'];

    $sp = $pdo->prepare('SELECT * FROM Interesser');
    $sp->execute();
    $interesser = $sp->fetchAll();

    $sql = "INSERT INTO NeoKlubb.MineInteresser VALUES $medlemid, $interessid";
    $update = $pdo->prepare($sql);



    if (isset($_POST["RegistrerMinInteresse"])) {
        try {
            $update->execute();
        } catch (PDOException $e) {
            echo $e->getMessage() . "<br>";
        }
    }

    ?>
    <h1> Velg interesser </h1>
    <select name="Interesser" id="Interesser">
        <?php foreach ($interesser as $row) : ?>
            <option><?= $row["Interesser"] ?></option>
        <?php endforeach ?>
    </select>
    <p>
        <button type="Submit" name="RegistrerMinInteresse">Registrer ny interesse</button>
    </p>


</body>

</html>