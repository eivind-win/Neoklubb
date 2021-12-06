<body>
    <?php

    //Include for å liste opp eksisterende medlemmer
    include_once "../Listing/ListMembers.php";
    include_once "/Applications/XAMPP/xamppfiles/htdocs/Neoklubb/Private/Include/LoginHeader.php";

    ?>
    <h3> Her kan du slette all informasjon om profilen din fra databasen </h3>
    <?php

    //SQL for å slette alt relatert til Medlemmet, rekkefølgen er for å slette alt som refererer til MedlemID først
    $sql = "DELETE FROM NeoKlubb.Kontigent WHERE MedlemID = :MedlemID;
                DELETE FROM NeoKlubb.MineInteresser WHERE MedlemID = :MedlemID;
                DELETE FROM NeoKlubb.Kurs WHERE MedlemID = :MedlemID;
                DELETE FROM NeoKlubb.Status WHERE MedlemID = :MedlemID;
                DELETE FROM NeoKlubb.MineRoller WHERE MedlemID = :MedlemID;
                DELETE FROM NeoKlubb.Adresse WHERE MedlemID = :MedlemID;
                DELETE FROM NeoKlubb.Medlem WHERE MedlemID = :MedlemID;";

    // Prepared statement 
    $sp = $pdo->prepare($sql);

    // Binder parameter med variaber, og setter den som tom for å unngå feilkode om tomme variabler
    $sp->bindParam(":MedlemID", $medlemID, PDO::PARAM_STR);
    $medlemID = isset($_POST['MedlemID']) ? $_POST['MedlemID'] : "";

    // Om "SlettMedlem" knappen blir trykket, vil koden prøve å kjøre query's
    if (isset($_POST["SlettMedlem"])) {
        try {
            $sp->execute();
            echo "<meta http-equiv='refresh' content='0'>";
        } catch (PDOException $e) {
            echo $e->getMessage() . "<br>";
        }
        //$sp->debugDumpParams();
    }
    ?>
    <!-- HTML form for å hente ID -->
    <form method="POST" action="">

        <p>
            <label for="MedlemID">Medlemmets ID</label>
            <input name="MedlemID" type="text" required oninvalid="this.setCustomValidity('Medlemmets ID kan ikke være blank!')" onchange="this.setCustomValidity('')">
        </p>


        <p>

            <button type="Submit" name="SlettMedlem">Slett medlem</button>
        </p>


</body>

</html>