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

    //Om knappen "SendMail" blir trykket, vil koden inni kjøre
    if (isset($_POST["SendMail"])) {



        //SQL query med innerjoin for å hente ut medleminformasjon samt kontigentsstatus
        $sql = "SELECT
        Medlem.Fornavn,
        Medlem.Epost,
        Kontigent.KontigentsStatus
        FROM Medlem
        INNER JOIN Kontigent
        ON Medlem.MedlemID = Kontigent.MedlemID 
        WHERE Kontigentsstatus = 'Ubetalt'";

        //Prepared statement
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        //While loop for å hente ut fornavn, epost og kontigentsstatus
        while ($row = $stmt->fetch()) {
            $fornavn = $row['Fornavn'];
            $epost = $row['Epost'];
            $kontigentsstatus = $row['KontigentsStatus'];

            $fornavn = $row['Fornavn'];

            //Kaller SendEmail funksjon
            SendEmail($fornavn, $epost, $kontigentsstatus, $mld, $amld);
        }
    }
    // Funksjon for å sende email
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
        $mld  = "Hei " . $fornavn . " din kontigentsstatus er " . $kontigentsstatus . " vennligst husk å betale kontigent hos Neo Ungdomsklubb.";


        /* Meldingstekst for de som ikke kan motta HTML-epost */
        $amld  = "Hei " . $fornavn . " din kontigentsstatus er " . $kontigentsstatus . " vennligst husk å betale kontigent hos Neo Ungdomsklubb.";

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
    <!-- HTML form for å legge inn melding som skal sendes til medlemmer -->
    <form method="POST" action="">
        <p>
            <button type="Submit" name="SendMail">Send bulk mail til de som ikke har betalt kontigent</button>
        </p>
</body>

</html>