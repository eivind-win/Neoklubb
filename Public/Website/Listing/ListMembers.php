<body>
    <!-- inkluderer config fil til databasen og velger hvilke entiteter som skal henters ut fra hvilket tabel i databasen.  -->
    <?php
    include_once "/Applications/XAMPP/xamppfiles/htdocs/Neoklubb/Private/Include/LogInChecker.php";
    include_once "/Applications/XAMPP/xamppfiles/htdocs/Neoklubb/Private/Include/LoginHeader.php";
    include_once "/Applications/XAMPP/xamppfiles/htdocs/NeoKlubb/Private/Database/DatabaseConnection.php";;
    include_once "/Applications/XAMPP/xamppfiles/htdocs/NeoKlubb/Public/Resources/Style/Table.html";

    $sql = "SELECT * FROM ((Medlem INNER JOIN Status ON Medlem.MedlemID = Status.MedlemID) INNER JOIN Kontigent ON Medlem.MedlemID = Kontigent.MedlemID) order by Medlem.MedlemID";
    $sp = $pdo->prepare($sql);

    try {
        $sp->execute();
    } catch (PDOException $e) {
        echo $e->getMessage() . "<br>";
        //denne meldingen bør vi logge isstedenfor å skrive ut på skjermen
    }
    //Lager en tabell og som inneholder alle radene 
    $Medlem = $sp->fetchAll(PDO::FETCH_OBJ);
    if ($sp->rowCount() > 0) {
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
        echo "<th> Kontigent </th>";

        echo "</tr>";

        //foreach som itererer gjennom alle feltene i tabell

        //foreach som itererer gjennom alle feltene og printer ut i en tabell
        foreach ($Medlem as $Medlem) {
            echo "<tr>";
            echo "<td>" . $Medlem->MedlemID . "</td>";
            echo "<td>" . $Medlem->Fornavn . "</td>";
            echo "<td>" . $Medlem->Etternavn . "</td>";
            echo "<td>" . $Medlem->Telefon . "</td>";
            echo "<td>" . $Medlem->Epost . "</td>";
            echo "<td>" . $Medlem->Fodselsdato . "</td>";
            echo "<td>" . $Medlem->Kjonn . "</td>";
            echo "<td>" . $Medlem->RegistreringsDato . "</td>";
            echo "<td>" . $Medlem->Status . "</td>";
            echo "<td>" . $Medlem->KontigentsStatus . "</td>";

            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "Det er ingen medlemmer som matcher denne beskrivelsen";
    }
    ?>
</body>

</html>