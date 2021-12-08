<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=
    <?php

    require_once "/Applications/XAMPP/xamppfiles/htdocs/NeoKlubb/Private/Include/PHPMailer/src/PHPMailer.php";
    require_once "/Applications/XAMPP/xamppfiles/htdocs/NeoKlubb/Private/Include/PHPMailer/src/Exception.php";
    require_once "/Applications/XAMPP/xamppfiles/htdocs/NeoKlubb/Private/Include/PHPMailer/src/SMTP.php";
    ?>

<html lang=" en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Kontaktskjema</title>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    </head>

<body>
    <!-- Form -->
    <h1>Send Nyheter</h1>
    <div class="form">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?> " method="POST">
            <div class="mb-3">
                <input type="email" name="email" placeholder="Email">
            </div>

            <input class="btn btn-primary" type="submit" value="Send nyhetsbrev!">
    </div>



    <?php
    if (isset($_REQUEST) == "POST") {
        $email = trim($_POST['email']);


        $mail = new PHPMailer\PHPMailer\PHPMailer();

        try {
            $mail->IsSMTP();
            $mail->SMTPDebug = 1; // debugging: 1 = feil og melding, 2 = kun meldinger
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = "tls"; // påkrevd for Gmail
            $mail->Host = "smtp.gmail.com";
            $mail->Port = 587;
            $mail->Username = "NeoKlubbOE@gmail.com";
            $mail->Password = "Neoklubb2021";
            $mail->CharSet = 'UTF-8';


            $mail->isHTML(true);
            $mail->From = "NeoKlubbOE@gmail.com";
            $mail->FromName = "NeoUngdommsklubb.com";
            $mail->addAddress($email, $fnavn . " " . $enavn);
            $mail->Subject = "Nyheter!";
            $mail->Body = file_get_contents('Epost.html');
            $mail->send();
            echo "E-post er sendt";
        } catch (Exception $e) {
            echo "Noe gikk galt: " . $e->getMessage();
        }
    }
    ?>
</body>

</html>

<style>
    /* sentreret form i en flex box med ramme og skygge */
    .form {
        display: flex;
        flex-direction: column;
        align-items: center;
        border: 1px solid black;
        border-radius: 10px;
        box-shadow: 0px 0px 10px black;
        padding: 10px;
    }
</style>
</head>

<body>

</body>

</html>