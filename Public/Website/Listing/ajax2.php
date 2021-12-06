<?php
include_once "/Applications/XAMPP/xamppfiles/htdocs/Neoklubb/Private/Database/DatabaseConnection.php";

$medlem  = new medlem;

$q = intval($_GET['q']);

$medlem = $medlem->User($q);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700&display=swap" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <title>Document</title>
</head>

<body>
    <table class="table">
        <tr>
            <th>MedlemID</th>
            <th>Fornavn</th>
            <th>Etternavn</th>
            <th>Telefon</th>
            <th>Epost</th>
            <th>Fodselsdato</th>
            <th>Kjonn</th>
            <th>RegistreringsDato</th>

        </tr>
        <?php
        foreach ($medlem as $medlem) : ?>
            <tr>
                <td><?= $medlem->MedlemID; ?></td>
                <td><?= $medlem->Fornavn; ?></td>
                <td><?= $medlem->Etternavn; ?></td>
                <td><?= $medlem->Telefon; ?></td>
                <td><?= $medlem->Epost; ?></td>
                <td><?= $medlem->Fodselsdato; ?></td>
                <td><?= $medlem->Kjonn; ?></td>
                <td><?= $medlem->RegistreringsDato; ?></td>

            </tr>

        <?php endforeach; ?>
    </table>


</body>

</html>