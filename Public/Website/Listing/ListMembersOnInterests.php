<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    include_once "/Applications/XAMPP/xamppfiles/htdocs/Neoklubb/Private/Database/DatabaseConnection.php";
    include_once "/Applications/XAMPP/xamppfiles/htdocs/Neoklubb/Private/Include/LoginHeader.php";
    include_once "/Applications/XAMPP/xamppfiles/htdocs/Neoklubb/Private/Include/LogInChecker.php";
    include_once "/Applications/XAMPP/xamppfiles/htdocs/NeoKlubb/Public/Resources/Style/Table.html";

    if (isset($_POST["Listfotball"])) {

        $sql = "SELECT Medlem.MedlemID, Medlem.Fornavn, Medlem.Etternavn, Interesser.Interesser 
        FROM Medlem INNER JOIN MineInteresser ON Medlem.MedlemID = MineInteresser.MedlemID 
        INNER JOIN Interesser ON MineInteresser.InteresseID = Interesser.InteresseID WHERE Interesser = 'Fotball'";

        $fotball = $pdo->prepare($sql);

        try {
            $fotball->execute();
        } catch (PDOException $e) {
            echo $e->getMessage() . "<br>";
        }
        $fotballeMedlemmer = $fotball->fetchAll(PDO::FETCH_OBJ);

        if ($fotball->rowCount() > 0) {
            echo "<table>";
            echo "<tr>";
            echo "<th> Fornavn </th>";
            echo "<th> Etternavn </th>";
            echo "<th> Interesser </th>";
            echo "</tr>";

            //foreach som itererer gjennom alle feltene og printer ut i en tabell
            foreach ($fotballeMedlemmer as $fotballeMedlemmer) {
                echo "<tr>";
                echo "<td>" . $fotballeMedlemmer->Fornavn . "</td>";
                echo "<td>" . $fotballeMedlemmer->Etternavn . "</td>";
                echo "<td>" . $fotballeMedlemmer->Interesser . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "Det er ingen medlemmer som matcher denne beskrivelsen";
        }
    }
    ?>

    <form method="POST" action="">
        <p>
            <button type="Submit" name="Listfotball">List alle fotball medlem</button>
        </p>
</body>

</html>