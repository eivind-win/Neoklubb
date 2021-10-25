<?php

include "DatabaseConnection.php";
$epost = $_SESSION['Epost'];

$sql = "SELECT FROM NeoKlubb.Medlem WHERE Epost = :Epost";
$sp = $pdo->prepare($sql);

$sp->bindParam(":Fornavn", $fornavn, PDO::PARAM_STR);
$sp->bindParam(":Etternavn", $etternavn, PDO::PARAM_STR);
$sp->bindParam(":Telefon", $telefon, PDO::PARAM_STR);
$sp->bindParam(":Epost", $epost, PDO::PARAM_STR);
$sp->bindParam(":Fodselsdato", $fodselsdato);
$sp->bindParam(":Kjonn", $Kjonn, PDO::PARAM_STR);
$sp->bindParam(":Passord", $passord, PDO::PARAM_STR);

$sp->execute();

$print = $sp->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Endre medlemsinformasjon</title>
</head>

<body>
    <h1> Endre medlemsinformasjon </h1>
    <form action='Editor.php' method='POST'>
        <table>
            <tr>
                <td><input type='text' name='Fornavn' value='<?php echo $fornavn ?>' /></td>
                <td><input type='text' name='Etternavn' value='<?php echo $etternavn ?>' /></td>
                <td><input type='number' name='Telefon' value='<?php echo $telefon ?>' /></td>
                <td><input type='text' name='Epost' value='<?php echo $epost ?>' /></td>
                <td><input type='date' name='Fodselsdato' value='<?php echo $fodselsdato ?>' /></td>
                <td><input type='text' name='Kjonn' value='<?php echo $Kjonn ?>' /></td>
                <td><input type='text' name='Passord' value='<?php echo $passord ?>' /></td>
                <td><input type='submit' value='Editor' /></td>
            </tr>
        </table>
    </form>
</body>

</html>