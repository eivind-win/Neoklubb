<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Endre</title>
</head>

<body>
    <?php
    include "DatabaseConnection.php";

    $nyttFornavn = $_POST['Fornavn'];
    $nyttEtternavn = $_POST['Etternavn'];
    $nyTelefon = $_POST['Telefon'];
    $nyEpost = $_POST['Epost'];
    $nyFodselsdato = $_POST['Fodselsdato'];
    $nyttKjonn = $_POST['Kjonn'];
    $nyttPassord = $_POST['Passord'];

    $sql = "UPDATE NeoKlubb.Medlem SET 
    Fornavn = :Fornavn,
    Etternavn = :Etternavn,
    Telefon = :Telefon,
    Epost = :Epost, 
    Fodselsdato = :Fodselsdato,
    Kjonn = :Kjonn,
    Passord = :Passord
    WHERE Epost = :Epost";

    $sp = $pdo->prepare($sql);

    $sp->bindParam(":Fornavn", $nyttFornavn, PDO::PARAM_STR);
    $sp->bindParam(":Etternavn", $nyttEtternavn, PDO::PARAM_STR);
    $sp->bindParam(":Telefon", $nyTelefon, PDO::PARAM_STR);
    $sp->bindParam(":Epost", $nyEpost, PDO::PARAM_STR);
    $sp->bindParam(":Fodselsdato", $nyFodselsdato);
    $sp->bindParam(":Kjonn", $nyttKjonn, PDO::PARAM_STR);
    $sp->bindParam(":Passord", $nyttPassord, PDO::PARAM_STR);

    $sp->execute();

    $sqlCheck = "SELECT *
    FROM NeoKlubb.Medlem
    WHERE Epost = :Epost";

    $spCheck->prepare($sqlCheck);

    $spCheck->bindParam(":Fornavn", $nyttFornavn, PDO::PARAM_STR);
    $spCheck->bindParam(":Etternavn", $nyttEtternavn, PDO::PARAM_STR);
    $spCheck->bindParam(":Telefon", $nyTelefon, PDO::PARAM_STR);
    $spCheck->bindParam(":Epost", $nyEpost, PDO::PARAM_STR);
    $spCheck->bindParam(":Fodselsdato", $nyFodselsdato);
    $spCheck->bindParam(":Kjonn", $nyttKjonn, PDO::PARAM_STR);
    $spCheck->bindParam(":Passord", $nyttPassord, PDO::PARAM_STR);

    echo "Antall endringer: " . $spCheck->execute();






    ?>
</body>

</html>