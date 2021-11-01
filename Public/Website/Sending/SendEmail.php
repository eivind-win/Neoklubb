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
    require_once "../../PHPMailer/src/PHPMailer.php";
    require_once "../../PHPMailer/src/Exception.php";
    require_once "../../PHPMailer/src/SMTP.php";
    $mail = new PHPMailer\PHPMailer\PHPMailer();
    $mail->CharSet = "UTF-8";
    $fornavn = $_POST['Fornavn'];
    $etternavn = $_POST['Etternavn'];
    $kode = rand(1, 5);
    $epost = $_POST['Epost'];



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
            $mld .= "Takk for at du registrerer deg hos oss. <br><br>";
            $mld .= "Vennligst klikk nedenfor for å sette opp kontoen din: <br>";
            $mld .= '<a href="http://localhost/bekreftelse.php?k=' . $kode . '">Bekreft din registrering</a> <br><br>';
            $mld .= "Hvis dette ikke var deg, kan du trygt ignorere denne e-posten. <br><br>";

            /* Meldingstekst for de som ikke kan motta HTML-epost */
            $amld  = "Kjære " . $fornavn . ". <br><br>";
            $amld .= "Takk for at du registrerer deg hos oss. \n\n";
            $amld .= "Vennligst klikk nedenfor for å sette opp kontoen din: \n";
            $amld .= "http://localhost/bekreftelse.php?k=" . $kode . " \n\n";
            $amld .= "Hvis dette ikke var deg, kan du trygt ignorere denne e-posten. \n\n";

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
    <h1> Registrer deg </h1>
    <h2> Legg til informasjon </h2>

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