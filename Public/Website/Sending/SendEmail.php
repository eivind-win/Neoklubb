<?php
include_once "/Applications/XAMPP/xamppfiles/htdocs/Neoklubb/Private/Include/LoginHeader.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Email</title>
</head>

<body>
    <?php
    require_once "/Applications/XAMPP/xamppfiles/htdocs/NeoKlubb/Private/Include/PHPMailer/src/PHPMailer.php";
    require_once "/Applications/XAMPP/xamppfiles/htdocs/NeoKlubb/Private/Include/PHPMailer/src/Exception.php";
    require_once "/Applications/XAMPP/xamppfiles/htdocs/NeoKlubb/Private/Include/PHPMailer/src/SMTP.php";
    $mail = new PHPMailer\PHPMailer\PHPMailer();
    $mail->CharSet = "UTF-8";
    $fornavn = $_POST['Fornavn'];
    $etternavn = $_POST['Etternavn'];
    $kode = rand(1, 5);
    $epost = $_POST['Epost'];

    /* $sql = "SELECT
    Medlem.Fornavn,
    Medlem.Etternavn,
    Medlem.Epost,
    Kontigent.Kontigentsstatus
    FROM Medlem
    INNER JOIN Kontigent
    ON Medlem.MedlemID = Kontigent.MedlemID 
    WHERE Kontigentsstatus = 'Ubetalt'";
    foreach ($pdo->query($sql) as $row) {
        $email->AddAddress($row["Epost"]);
    }

*/
    if (isset($_POST["SendMail"])) {
        try {
            $mail->IsSMTP();
            $mail->SMTPDebug = 1; // debugging: 1 = feil og melding, 2 = kun meldinger
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = "tls"; // påkrevd for Gmail
            $mail->Host = "smtp.gmail.com";
            $mail->Port = 587;
            $mail->Username = "neoklubboe@gmail.com";
            $mail->Password = "Neoklubb2021";

            /* Meldingstekst for HTML-mottakere */
            $mld  = "Kjære " . $fornavn . ". <br><br>";

            /* Meldingstekst for de som ikke kan motta HTML-epost */
            $amld  = "Kjære " . $fornavn . ". <br><br>";

            $mail->isHTML(true);
            $mail->From = "NeoKlubbOE@gmail.com";
            $mail->FromName = "Ikke svar";
            $mail->addAddress($epost, $fornavn . " " . $etternavn);
            $mail->Subject = "Registrering: kun ett steg unna nå!";
            $mail->Body = $mld;
            $mail->AltBody = $amld;
            $mail->send();

            echo "E-post er sendt";
        } catch (Exception $e) {
            echo "Noe gikk galt: " . $e->getMessage();
        }
    }
    ?>
    <h1>Send Email</h1>
    <!-- HTML form som tar relevant informasjon i input, lagt inn isset for å reprinte inngitt verdi dersom noe annet skulle være feil, hindrer at bruker må fylle inn alt på nytt-->

    <form method="POST" action="">
        <p>
            <label for="Fornavn">Fornavn</label>
            <input name="Fornavn" type="text" required oninvalid="this.setCustomValidity('Fornavn kan ikke være blankt!')" onchange="this.setCustomValidity('')">
        </p>
        <p>
            <label for="Etternavn">Etternavn</label>
            <input name="Etternavn" type="text" required oninvalid="this.setCustomValidity('Etternavn kan ikke være blankt!')" onchange="this.setCustomValidity('')">
        </p>
        <p>
            <label for="Epost">Epost</label>
            <input name="Epost" type="text" required oninvalid="this.setCustomValidity('Epost kan ikke være blankt!')" onchange="this.setCustomValidity('')">
        </p>


        <p>

            <button type="Submit" name="SendMail">Send Mail</button>
        </p>
</body>

</html>



</body>

</html>