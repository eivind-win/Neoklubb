<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logg inn</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
</head>

<body>
    <?php
    include_once "/Applications/XAMPP/xamppfiles/htdocs/Neoklubb/Private/Database/DatabaseConnection.php";
    include_once "/Applications/XAMPP/xamppfiles/htdocs/Neoklubb/Private/Include/LogoutHeader.php";

    // prepare sp, sjekker om feltene er gyllt ut og samsvarer med data i databsen.
    try {
        if (isset($_POST["login"])) {
            if (empty($_POST["Epost"]) || empty($_POST["Passord"])) {
                $message = '<label>Alle felter må fylles ut</label>';
            } else {
                $sql = "SELECT * FROM Medlem WHERE Epost = :Epost";
                $sp = $pdo->prepare($sql);
                $sp->bindParam(':Epost', $_POST["Epost"], PDO::PARAM_STR);
                $sp->execute();
                $Medlem = $sp->fetch(PDO::FETCH_OBJ);
                //lager variabel som henter fra db
                $hashedpassword = $Medlem->Passord;

                //metode som sjekker passord mot databasen
                if (password_verify($_POST["Passord"], $hashedpassword)) {
                    session_start();
                    $_SESSION["Epost"] = $Medlem->Epost;
                    $_SESSION["Fornavn"] = $Medlem->Fornavn;
                    $_SESSION["Etternavn"] = $Medlem->Etternavn;
                    $_SESSION["Telefon"] = $Medlem->Telefon;
                    $_SESSION["MedlemID"] = $Medlem->MedlemID;
                    $_SESSION["RegistreringsDato"] = $Medlem->RegistreringsDato;
                    // Redirecter til forside dersom passord stemmer 

                    header("location:../index/FrontPage.php");
                } else {
                    $message = '<label>Feil brukernavn eller passord!</label>';
                }
            }
        }
    } catch (PDOException $error) {
        $message = $error->getMessage();
    }
    ?>
    <br />
    <div class="container" style="width:500px;">
        <?php
        if (isset($message)) {
            echo '<label class="text-danger">' . $message . '</label>';
        }
        ?>
        <h3 align="">Velkommen til Neo Ungdomsklubb</h3><br />
        <form method="post">
            <label>Epost</label>
            <input type="text" name="Epost" class="form-control" />
            <br />
            <label>Passord</label>
            <input type="password" name="Passord" class="form-control" />
            <br />
            <input type="submit" name="login" class="btn btn-info" value="Login" />
        </form>
    </div>
    <br />
</body>

</html>