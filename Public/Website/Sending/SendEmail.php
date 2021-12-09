<?php
include_once "/Applications/XAMPP/xamppfiles/htdocs/Neoklubb/Private/Include/LoginHeader.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send enkelt mail</title>
</head>

<body>
    <?php
    include_once "/Applications/XAMPP/xamppfiles/htdocs/Neoklubb/Private/Include/LogInChecker.php";
    include_once "/Applications/XAMPP/xamppfiles/htdocs/Neoklubb/Private/Include/LoginHeader.php";
    include_once "/Applications/XAMPP/xamppfiles/htdocs/NeoKlubb/Private/Database/DatabaseConnection.php";
    require_once "/Applications/XAMPP/xamppfiles/htdocs/NeoKlubb/Private/Include/PHPMailer/src/PHPMailer.php";
    require_once "/Applications/XAMPP/xamppfiles/htdocs/NeoKlubb/Private/Include/PHPMailer/src/Exception.php";
    require_once "/Applications/XAMPP/xamppfiles/htdocs/NeoKlubb/Private/Include/PHPMailer/src/SMTP.php";

    // Diverse variabler for sending av enkelt mail
    $mail = new PHPMailer\PHPMailer\PHPMailer();
    $mail->CharSet = "UTF-8";
    $fornavn = $_POST['Fornavn'];
    $epost = $_POST['Epost'];
    $emne = $_POST['Emne'];
    // Format for HTML melding
    $mld = " Hei ";
    $mld .= $_POST['Fornavn'];
    $mld .= ", ";
    $mld .= $_POST['Melding'];
    $mld .= "<br><br>";
    $mld .= "Vennlig hilsen Neo Ungdomsklubb!";

    // Format for klienter som ikke klarer å tolke HTML
    $amld = " Hei ";
    $amld .= $_POST['Fornavn'];
    $amld .= ", ";
    $amld .= $_POST['Melding'];
    $amld .= "\n\n";
    $amld .= "Vennlig hilsen Neo Ungdomsklubb!";



    // Om knappen "SendMail" blir trykket, vil koden under kjøre
    if (isset($_POST["SendMail"])) {
        try {
            $mail->IsSMTP();
            $mail->SMTPDebug = 0; // debugging: 1 = feil og melding, 2 = kun meldinger
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = "tls"; // påkrevd for Gmail
            $mail->Host = "smtp.gmail.com";
            $mail->Port = 587;
            $mail->Username = "neoklubboe@gmail.com";
            $mail->Password = "Neoklubb2021";


            $mail->isHTML(true);
            $mail->From = "neoklubboe@gmail.com";
            $mail->FromName = "Neo Ungdomsklubb";
            $mail->addAddress($epost, $fornavn . " " . $etternavn);
            $mail->Subject = $emne;
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
    <!--  HTML form for å hente inn relevant informasjon for sending av mail  -->
    <form method="POST" action="">

        <p>
            <label for="Epost">Epost</label>
            <input name="Epost" type="text" required oninvalid="this.setCustomValidity('Epost kan ikke være blankt!')" onchange="this.setCustomValidity('')">
        </p>
        <p>
            <label for="Fornavn">Fornavn</label>
            <input name="Fornavn" type="text" required oninvalid="this.setCustomValidity('Fornavn kan ikke være blankt!')" onchange="this.setCustomValidity('')">
        </p>
        <p>
            <label for="Emne">Emne</label>
            <input name="Emne" type="text" required oninvalid="this.setCustomValidity('Emne kan ikke være blank!')" onchange="this.setCustomValidity('')">
        </p>
        <p>
            <label for="Melding">Melding</label>
            <input name="Melding" type="text" required oninvalid="this.setCustomValidity('Meldingen kan ikke være blank!')" onchange="this.setCustomValidity('')">
        </p>


        <p>

            <button type="Submit" name="SendMail">Send Mail</button>
        </p>
</body>

</html>



</body>

</html>