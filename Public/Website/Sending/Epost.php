<?php
require_once "PHPMailer/src/PHPMailer.php";
require_once "PHPMailer/src/Exception.php";
require_once "PHPMailer/src/SMTP.php";
$mail = new PHPMailer\PHPMailer\PHPMailer();
$fnavn = "Silje";
$enavn = "Johansen";
$kode = "abc";
$epost = "peter@pox.no";

try {
    $mail->IsSMTP();
    $mail->SMTPDebug = 1; // debugging: 1 = feil og melding, 2 = kun meldinger
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = "tls"; // påkrevd for Gmail
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 587;
    $mail->Username = "***@gmail.com";
    $mail->Password = "";

    /* Meldingstekst for HTML-mottakere */
    $mld  = "Kjære " . $fnavn . ". <br><br>";
    $mld .= "Takk for at du registrerer deg hos oss. <br><br>";
    $mld .= "Vennligst klikk nedenfor for å sette opp kontoen din: <br>";
    $mld .= '<a href="http://localhost/bekreftelse.php?k=' . $kode . '">Bekreft din registrering</a> <br><br>';
    $mld .= "Hvis dette ikke var deg, kan du trygt ignorere denne e-posten. <br><br>";

    /* Meldingstekst for de som ikke kan motta HTML-epost */
    $amld  = "Kjære " . $fnavn . ". <br><br>";
    $amld .= "Takk for at du registrerer deg hos oss. \n\n";
    $amld .= "Vennligst klikk nedenfor for å sette opp kontoen din: \n";
    $amld .= "http://localhost/bekreftelse.php?k=" . $kode . " \n\n";
    $amld .= "Hvis dette ikke var deg, kan du trygt ignorere denne e-posten. \n\n";

    $mail->isHTML(true);
    $mail->From = "eivind.win95@gmail.com";
    $mail->FromName = "Ikke svar";
    $mail->addAddress($epost, $fnavn . " " . $enavn);
    $mail->Subject = "Registrering: kun ett steg unna nå!";
    $mail->Body = $mld;
    $mail->AltBody = $amld;
    $mail->send();
    echo "E-post er sendt";
} catch (Exception $e) {
    echo "Noe gikk galt: " . $e->getMessage();
}
