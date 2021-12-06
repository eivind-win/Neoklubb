<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mine Interesser</title>
</head>

<body>
    <?php
    //Diverse include filer for db connection, header og table utseende
    include_once "/Applications/XAMPP/xamppfiles/htdocs/Neoklubb/Private/Database/DatabaseConnection.php";
    include_once "/Applications/XAMPP/xamppfiles/htdocs/Neoklubb/Private/Include/LoginHeader.php";
    include_once "/Applications/XAMPP/xamppfiles/htdocs/Neoklubb/Private/Include/LogInChecker.php";
    include_once "/Applications/XAMPP/xamppfiles/htdocs/NeoKlubb/Public/Resources/Style/Table.html";

    $medlemid = $_SESSION['MedlemID'];

    //SQL query for å hente ut relevant informasjon i forhold til interesser
    $sql = "SELECT Medlem.MedlemID, Medlem.Fornavn, Medlem.Etternavn, Interesser.Interesser 
    FROM Medlem INNER JOIN MineInteresser ON Medlem.MedlemID = MineInteresser.MedlemID 
    INNER JOIN Interesser ON MineInteresser.InteresseID = Interesser.InteresseID";

    $sp = $pdo->prepare($sql);
    try {
        $sp->execute();
    } catch (PDOException $e) {
        echo $e->getMessage() . "<br>";
    }
    //Lager en tabell om rowcount er over 1, om ikke blir det gitt en error
    $Medlem = $sp->fetchAll(PDO::FETCH_OBJ);
    if ($sp->rowCount() > 0) {
        echo "<table>";
        echo "<tr>";
        echo "<th> Fornavn </th>";
        echo "<th> Etternavn </th>";
        echo "<th> Interesser </th>";

        echo "</tr>";


        //foreach som itererer gjennom alle feltene og printer ut i en tabell
        foreach ($Medlem as $Medlem) {
            echo "<tr>";
            echo "<td>" . $Medlem->Fornavn . "</td>";
            echo "<td>" . $Medlem->Etternavn . "</td>";
            echo "<td>" . $Medlem->Interesser . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "Det er ingen medlemmer som matcher denne beskrivelsen";
    }
    ?>
</body>

</html>