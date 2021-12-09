<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nyhetsbrev</title>
</head>

<body>
    <?php
    require_once "/Applications/XAMPP/xamppfiles/htdocs/NeoKlubb/Private/Include/PHPMailer/src/PHPMailer.php";
    require_once "/Applications/XAMPP/xamppfiles/htdocs/NeoKlubb/Private/Include/PHPMailer/src/Exception.php";
    require_once "/Applications/XAMPP/xamppfiles/htdocs/NeoKlubb/Private/Include/PHPMailer/src/SMTP.php";
    include_once "/Applications/XAMPP/xamppfiles/htdocs/NeoKlubb/Private/Database/DatabaseConnection.php";
    include_once "/Applications/XAMPP/xamppfiles/htdocs/Neoklubb/Private/Include/LoginHeader.php";
    include_once "/Applications/XAMPP/xamppfiles/htdocs/NeoKlubb/Private/Include/LoginChecker.php";

    $sql = "SELECT
        Medlem.Fornavn,
        Medlem.Epost,
        Status.Status
        FROM Medlem
        INNER JOIN Status
        ON Medlem.MedlemID = Status.MedlemID 
        WHERE Status.Status = 'Aktiv'";

    //Prepared statement
    $sp = $pdo->prepare($sql);

    if (isset($_POST["SendBrev"])) {

        $sp->execute();

        //While loop for å hente ut fornavn, epost og kontigentsstatus
        while ($row = $sp->fetch()) {
            $epost = $row['Epost'];
            //Kaller SendEmail funksjon
            SendEmail($epost);
        }
    }
    // Funksjon for å sende email
    function SendEmail($epost)

    {
        $mail = new PHPMailer\PHPMailer\PHPMailer();
        $mail->CharSet = "UTF-8";
        $mail->IsSMTP();
        $mail->SMTPDebug = 0; // debugging: 1 = feil og melding, 2 = kun meldinger
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "tls"; // påkrevd for Gmail
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 587;
        $mail->Username = "neoklubboe@gmail.com";
        $mail->Password = "Neoklubb2021";
        $mail->isHTML(true);
        $mail->From = "NeoKlubbOE@gmail.com";
        $mail->FromName = "Ikke svar";
        $mail->addAddress($epost);
        $mail->Subject = "Velkommen til Neo Ungdomsklubb";
        $mail->Body = file_get_contents('../../../Private/Include/Epost.html');
        $mail->send();

        if (!$mail->send()) {
            echo "Nyhetsbrev ble ikke sendt, noe har gått galt.";
            echo $mail->ErrorInfo;
        } else {
            echo "Nyhetsbrev ble sendt";
        }
    }
    ?>
    <!-- HTML form for å legge inn melding som skal sendes til medlemmer -->
    <form method="POST" action="">
        <p>
            <button type="Submit" name="SendBrev">Send nyhetsbrev til alle aktive medlemmer</button>
        </p>
</body>

</html>