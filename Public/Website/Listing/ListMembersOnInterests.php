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


    if (isset($_POST["ListInteresser"])) {

        $interesser = $_POST['Interesser'];

        $sql = "SELECT Medlem.MedlemID, Medlem.Fornavn, Medlem.Etternavn, Interesser.Interesser 
        FROM Medlem INNER JOIN MineInteresser ON Medlem.MedlemID = MineInteresser.MedlemID 
        INNER JOIN Interesser ON MineInteresser.InteresseID = Interesser.InteresseID WHERE Interesser = :Interesser";

        $sp->bindParam(":Interesser", $interesser, PDO::PARAM_INT);
        $listinteresser = $pdo->prepare($sql);

        try {
            $listinteresser->execute();
        } catch (PDOException $e) {
            echo $e->getMessage() . "<br>";
        }
        $interesserMedlemmer = $listinteresser->fetchAll(PDO::FETCH_OBJ);

        if ($listinteresser->rowCount() > 0) {
            echo "<table>";
            echo "<tr>";
            echo "<th> Fornavn </th>";
            echo "<th> Etternavn </th>";
            echo "<th> Interesser </th>";
            echo "</tr>";

            //foreach som itererer gjennom alle feltene og printer ut i en tabell
            foreach ($interesserMedlemmer as $interesserMedlemmer) {
                echo "<tr>";
                echo "<td>" . $interesserMedlemmer->Fornavn . "</td>";
                echo "<td>" . $interesserMedlemmer->Etternavn . "</td>";
                echo "<td>" . $interesserMedlemmer->Interesser . "</td>";
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
            <label for="Interesser">Interesser</label>
            <input name="Interesser" type="text" required oninvalid="this.setCustomValidity('Interesse kan ikke være blank!')" onchange="this.setCustomValidity('')" value="">
        </p>
        <p>
            <button type="Submit" name="ListInteresser">Hent medlemmer</button>
        </p>
</body>

</html>