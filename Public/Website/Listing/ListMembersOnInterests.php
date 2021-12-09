<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste medlemmer basert på interesser</title>
</head>

<body>
    <?php
    include_once "/Applications/XAMPP/xamppfiles/htdocs/Neoklubb/Private/Database/DatabaseConnection.php";
    include_once "/Applications/XAMPP/xamppfiles/htdocs/Neoklubb/Private/Include/LoginHeader.php";
    include_once "/Applications/XAMPP/xamppfiles/htdocs/Neoklubb/Private/Include/LogInChecker.php";
    include_once "/Applications/XAMPP/xamppfiles/htdocs/NeoKlubb/Public/Resources/Style/Table.html";

    $sql = "SELECT Medlem.Fornavn, Medlem.Etternavn, Interesser.Interesser 
        FROM Medlem INNER JOIN MineInteresser ON Medlem.MedlemID = MineInteresser.MedlemID 
        INNER JOIN Interesser ON MineInteresser.InteresseID = Interesser.InteresseID WHERE Interesser.InteresseID = :InteresseID";

    $sql2 = "SELECT InteresseID, Interesser FROM Interesser order by Interesser";

    $sp = $pdo->prepare($sql);
    $sp2 = $pdo->prepare($sql2);

    $sp->bindParam(":InteresseID", $interesseid);

    $sp2->execute();

    $muligeInteresser = $sp2->fetchAll();


    if (isset($_POST["ListInteresser"])) {
        $interesseid = $_POST['InteresseID'];

        try {
            $sp->execute();
        } catch (PDOException $e) {
            echo $e->getMessage() . "<br>";
        }
        $medlemsInteresser = $sp->fetchAll(PDO::FETCH_OBJ);


        if ($sp->rowCount() > 0) {
            echo "<table>";
            echo "<tr>";
            echo "<th> Fornavn </th>";
            echo "<th> Etternavn </th>";
            echo "<th> Interesser </th>";
            echo "</tr>";

            //foreach som itererer gjennom alle feltene og printer ut i en tabell
            foreach ($medlemsInteresser as $medlemsInteresse) {
                echo "<tr>";
                echo "<td>" . $medlemsInteresse->Fornavn . "</td>";
                echo "<td>" . $medlemsInteresse->Etternavn . "</td>";
                echo "<td>" . $medlemsInteresse->Interesser . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "Det er ingen medlemmer som interesserer seg for dette!";
        }
    }
    ?>
    <form method="POST" action="">

        <div>
            <select name="InteresseID">
                <?php foreach ($muligeInteresser as $muligInteresse) : ?>
                    <option value="<?= $muligInteresse['InteresseID']; ?>"><?= $muligInteresse['Interesser']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <p>
            <button type="Submit" name="ListInteresser">Hent medlemmer</button>
        </p>
</body>

</html>