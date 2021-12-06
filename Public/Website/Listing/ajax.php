<?php
include include_once "/Applications/XAMPP/xamppfiles/htdocs/Neoklubb/Private/Database/DatabaseConnection.php";
//include_once "/Applications/XAMPP/xamppfiles/htdocs/NeoKlubb/Public/Resources/Style/Table.html";

$sql = "SELECT * FROM ((Medlem INNER JOIN Status ON Medlem.MedlemID = Status.MedlemID) INNER JOIN Kontigent ON Medlem.MedlemID = Kontigent.MedlemID) order by Fornavn";
$sp = $pdo->prepare($sql);

try {
    $sp->execute();
} catch (PDOException $e) {
    echo $e->getMessage() . "<br>";
    //denne meldingen bør vi logge isstedenfor å skrive ut på skjermen
}
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
    <form>
        <select id="users" name="users" onchange="showUser(this.value)">
            <option value="">Velg en medlem:</option>
            <?php foreach ($medlem as $medlem) : ?>

                <option value="<?= $medlem->Fornavn ?>"><?= $medlem->Fornavn ?></option>

                </tr>
            <?php endforeach; ?>
        </select>
    </form>
    <br>
    <div id="txtHint"><b>Person info will be listed here.</b></div>

</body>
<script>
    function showUser(str) {
        if (str == "") {
            document.getElementById("txtHint").innerHTML = "";
            return;
        } else {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("txtHint").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", "ajax2.php?q=" + str, true);
            xmlhttp.send();
        }
    }
</script>

</html>