<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List medlemmer basert på status</title>
</head>

<body>
    <?php
    // Relevante include filer
    include_once "/Applications/XAMPP/xamppfiles/htdocs/Neoklubb/Private/Include/LogInChecker.php";
    include_once "/Applications/XAMPP/xamppfiles/htdocs/Neoklubb/Private/Include/LoginHeader.php";
    include_once "/Applications/XAMPP/xamppfiles/htdocs/NeoKlubb/Private/Database/DatabaseConnection.php";
    include_once "/Applications/XAMPP/xamppfiles/htdocs/NeoKlubb/Public/Resources/Style/Table.html";

    // Kjører en query som henter ut alle medlemmer som er registrert som aktive
    if (isset($_POST["ListeAktive"])) {

        $sql = "SELECT * FROM Medlem INNER JOIN Status ON Medlem.MedlemID = Status.MedlemID
        INNER JOIN Kontigent ON Medlem.MedlemID = Kontigent.MedlemID 
        INNER JOIN MineRoller ON Medlem.MedlemID = MineRoller.MedlemID
        INNER JOIN Roller ON Roller.RolleID = MineRoller.RolleID WHERE Status.Status = 'Aktiv'";
        $aktiv = $pdo->prepare($sql);

        try {
            $aktiv->execute();
        } catch (PDOException $e) {
            echo $e->getMessage() . "<br>";
        }
        $aktiveMedlemmer = $aktiv->fetchAll(PDO::FETCH_OBJ);

        if ($aktiv->rowCount() > 0) {
            echo "<table>";
            echo "<tr>";
            echo "<th> MedlemID </th>";
            echo "<th> Fornavn </th>";
            echo "<th> Etternavn </th>";
            echo "<th> Telefon </th>";
            echo "<th> Epost </th>";
            echo "<th> Fodselsdato </th>";
            echo "<th> Kjønn </th>";
            echo "<th> RegistreringsDato </th>";
            echo "<th> Status </th>";
            echo "<th> Roller </th>";
            echo "<th> Kontigent </th>";
            echo "</tr>";


            //foreach som itererer gjennom alle feltene og printer ut i en tabell
            foreach ($aktiveMedlemmer as $aktiveMedlemmer) {
                echo "<tr>";
                echo "<td>" . $aktiveMedlemmer->MedlemID . "</td>";
                echo "<td>" . $aktiveMedlemmer->Fornavn . "</td>";
                echo "<td>" . $aktiveMedlemmer->Etternavn . "</td>";
                echo "<td>" . $aktiveMedlemmer->Telefon . "</td>";
                echo "<td>" . $aktiveMedlemmer->Epost . "</td>";
                echo "<td>" . $aktiveMedlemmer->Fodselsdato . "</td>";
                echo "<td>" . $aktiveMedlemmer->Kjonn . "</td>";
                echo "<td>" . $aktiveMedlemmer->RegistreringsDato . "</td>";
                echo "<td>" . $aktiveMedlemmer->Status . "</td>";
                echo "<td>" . $aktiveMedlemmer->Rolle . "</td>";
                echo "<td>" . $aktiveMedlemmer->KontigentsStatus . "</td>";

                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "Det er ingen medlemmer som matcher denne beskrivelsen";
        }
    }

    // Kjører en query som henter ut informasjonen om medlemmer som er registrerte som inaktive
    if (isset($_POST["ListeInaktive"])) {

        $sql = "SELECT * FROM Medlem INNER JOIN Status ON Medlem.MedlemID = Status.MedlemID 
        INNER JOIN Kontigent ON Medlem.MedlemID = Kontigent.MedlemID
        INNER JOIN MineRoller ON Medlem.MedlemID = MineRoller.MedlemID
        INNER JOIN Roller ON Roller.RolleID = MineRoller.RolleID 
        WHERE Status.Status = 'Inaktiv'";
        $inaktiv = $pdo->prepare($sql);

        try {
            $inaktiv->execute();
        } catch (PDOException $e) {
            echo $e->getMessage() . "<br>";
        }
        $inaktiveMedlemmer = $inaktiv->fetchAll(PDO::FETCH_OBJ);

        if ($inaktiv->rowCount() > 0) {
            echo "<table>";
            echo "<tr>";
            echo "<th> MedlemID </th>";
            echo "<th> Fornavn </th>";
            echo "<th> Etternavn </th>";
            echo "<th> Telefon </th>";
            echo "<th> Epost </th>";
            echo "<th> Fodselsdato </th>";
            echo "<th> Kjønn </th>";
            echo "<th> RegistreringsDato </th>";
            echo "<th> Status </th>";
            echo "<th> Roller </th>";
            echo "<th> Kontigent </th>";

            echo "</tr>";

            //foreach som itererer gjennom alle feltene i tabell

            //foreach som itererer gjennom alle feltene og printer ut i en tabell
            foreach ($inaktiveMedlemmer as $inaktiveMedlemmer) {
                echo "<tr>";
                echo "<td>" . $inaktiveMedlemmer->MedlemID . "</td>";
                echo "<td>" . $inaktiveMedlemmer->Fornavn . "</td>";
                echo "<td>" . $inaktiveMedlemmer->Etternavn . "</td>";
                echo "<td>" . $inaktiveMedlemmer->Telefon . "</td>";
                echo "<td>" . $inaktiveMedlemmer->Epost . "</td>";
                echo "<td>" . $inaktiveMedlemmer->Fodselsdato . "</td>";
                echo "<td>" . $inaktiveMedlemmer->Kjonn . "</td>";
                echo "<td>" . $inaktiveMedlemmer->RegistreringsDato . "</td>";
                echo "<td>" . $inaktiveMedlemmer->Status . "</td>";
                echo "<td>" . $inaktiveMedlemmer->Rolle . "</td>";
                echo "<td>" . $inaktiveMedlemmer->KontigentsStatus . "</td>";

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
            <button type="Submit" name="ListeAktive">List alle aktive medlem</button>
        </p>
        <p>
            <button type="Submit" name="ListeInaktive">List alle inaktive medlem</button>
        </p>


</body>

</html>