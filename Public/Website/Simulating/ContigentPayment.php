<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontigent betalingsside</title>
</head>

<body>
    <?php
    include_once "/Applications/XAMPP/xamppfiles/htdocs/NeoKlubb/Private/Database/DatabaseConnection.php";
    include_once "/Applications/XAMPP/xamppfiles/htdocs/Neoklubb/Private/Include/LogInChecker.php";
    include_once "/Applications/XAMPP/xamppfiles/htdocs/Neoklubb/Private/Include/LoginHeader.php";

    $medlemid = $_SESSION["MedlemID"];

    $medlem = $pdo->query("SELECT Medlem.Fornavn, Medlem.Etternavn, Medlem.Telefon, Medlem.Epost, Medlem.Fodselsdato, Medlem.Kjonn, Medlem.Passord, Status.Status FROM Medlem Inner JOIN Status ON Medlem.MedlemID = Status.MedlemID");
    foreach ($medlem as $medlem) {
        $medlem['MedlemID'] . "\n";
        $medlem['Fornavn'] . "\n";
    }

    $sql = "UPDATE Kontigent SET KontigentsStatus = 'Betalt' WHERE MedlemID = :MedlemID";

    $sp = $pdo->prepare($sql);

    $sp->bindParam(":MedlemID", $medlemid, PDO::PARAM_STR);

    if (isset($_POST["Betal"])) {

        try {
            $sp->execute();
            echo "Betaling vellykket, din kontigentsstatus er oppdatert!";
        } catch (PDOException $e) {
            echo $e->getMessage() . "<br>";
        }
        // $update->debugDumpParams();
    }
    ?>

    <h1> Betaling av kontigent</h1>
    <h2> Legg til betalingsinformasjon</h2>

    <!-- HTML form som tar relevant informasjon i input, lagt inn isset for å reprinte inngitt verdi dersom noe annet skulle være feil, hindrer at bruker må fylle inn alt på nytt-->

    <form method="POST" action="">
        <p>
            <label for="Fornavn">Fornavn</label>
            <input name="Fornavn" type="text" required oninvalid="this.setCustomValidity('Fornavn kan ikke være blankt!')" onchange="this.setCustomValidity('')" value="<?php echo $medlem['Fornavn'];
                                                                                                                                                                        ?>">
        </p>
        <p>
            <label for="Etternavn">Etternavn</label>
            <input name="Etternavn" type="text" required oninvalid="this.setCustomValidity('Etternavn kan ikke være blankt!')" onchange="this.setCustomValidity('')" value="<?php echo $medlem['Etternavn'];
                                                                                                                                                                            ?>">
        </p>
        <p>
            <label for="Kortnummer">Kortnummer</label>
            <input name="Kortnummer" type="number" required oninvalid="this.setCustomValidity('Kortnummer kan ikke være blankt!')" onchange="this.setCustomValidity('')">
        </p>
        <p>
            <label for="Utløpsdato">Utløpsdato</label>
            <input name="Utløpsdato" type="date" required oninvalid="this.setCustomValidity('Utløpsdato kan ikke være blankt!')" onchange="this.setCustomValidity('')">
        </p>
        <p>
            <label for="CVC">CVC</label>
            <input name="CVC" type="number" required oninvalid="this.setCustomValidity('Fødselsdato kan ikke være blankt!')" onchange="this.setCustomValidity('')">
        </p>
        <p>
            <button type="Submit" name="Betal">Betal</button>
        </p>

</body>

</html>