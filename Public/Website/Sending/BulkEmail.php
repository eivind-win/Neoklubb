<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send epost i bulk</title>
</head>

<body>
    <?php
    require_once "/Applications/XAMPP/xamppfiles/htdocs/NeoKlubb/Private/Include/PHPMailer/src/PHPMailer.php";
    require_once "/Applications/XAMPP/xamppfiles/htdocs/NeoKlubb/Private/Include/PHPMailer/src/Exception.php";
    require_once "/Applications/XAMPP/xamppfiles/htdocs/NeoKlubb/Private/Include/PHPMailer/src/SMTP.php";
    include_once "/Applications/XAMPP/xamppfiles/htdocs/NeoKlubb/Private/Database/DatabaseConnection.php";

    if (isset($_POST["SendMail"])) {

        $mld = $_POST['Melding'];
        $amld = $_POST['Melding'];

        $sql = "SELECT
        Medlem.Fornavn,
        Medlem.Epost,
        Kontigent.Kontigentsstatus
        FROM Medlem
        INNER JOIN Kontigent
        ON Medlem.MedlemID = Kontigent.MedlemID 
        WHERE Kontigentsstatus = 'Ubetalt'";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        while ($row = $stmt->fetch()) {
            $fornavn = $row['Fornavn'];
            $epost = $row['Epost'];
            $kontigentsstatus = $row['KontigentsStatus'];

            SendEmail($fornavn, $epost, $kontigentsstatus, $mld, $amld);
        }
    }

    function SendEmail($fornavn, $epost, $kontigentsstatus, $mld, $amld)
    {
        $mail = new PHPMailer\PHPMailer\PHPMailer();
        $mail->CharSet = "UTF-8";

        $mail->IsSMTP();
        $mail->SMTPDebug = 1; // debugging: 1 = feil og melding, 2 = kun meldinger
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "tls"; // påkrevd for Gmail
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 587;
        $mail->Username = "neoklubboe@gmail.com";
        $mail->Password = "Neoklubb2021";

        /* Meldingstekst for HTML-mottakere */
        //$mld  = "Hei " . $fornavn . " din kontigentsstatus er " . $kontigentsstatus . " vennligst husk å betale kontigent hos Neo Ungdomsklubb.";


        /* Meldingstekst for de som ikke kan motta HTML-epost */
        //$amld  = "Hei " . $fornavn . " din kontigentsstatus er " . $kontigentsstatus . " vennligst husk å betale kontigent hos Neo Ungdomsklubb.";

        $mail->isHTML(true);
        $mail->From = "NeoKlubbOE@gmail.com";
        $mail->FromName = "Ikke svar";
        $mail->addAddress($epost);
        $mail->Subject = "Velkommen til Neo Ungdomsklubb";
        $mail->Body = $mld;
        $mail->AltBody = $amld;
        $mail->send();

        if (!$mail->send()) {
            echo "Mail ble ikke sendt, noe har gått galt.";
            echo $mail->ErrorInfo;
        } else {
            echo "Mail ble sendt til.";
        }
    }
    ?>
    <form method="POST" action="">
        <p>
        <p>
            <label for="Melding">Melding</label>
            <input name="Melding" type="text" required oninvalid="this.setCustomValidity('Melding kan ikke være blank!')" onchange="this.setCustomValidity('')">
        </p>

        <button type="Submit" name="SendMail">Send bulk mail til de som ikke har betalt kontigent</button>
        </p>
</body>

</html>