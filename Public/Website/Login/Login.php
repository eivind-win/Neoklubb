<?php
session_start();
include_once "/Applications/XAMPP/xamppfiles/htdocs/Neoklubb/Private/Database/DatabaseConnection.php";
include_once "/Applications/XAMPP/xamppfiles/htdocs/Neoklubb/Private/Include/LogoutHeader.php";


try {
    if (isset($_POST["login"])) {
        if (empty($_POST["Epost"]) || empty($_POST["Passord"])) {
            $message = '<label>Alle felter må fylles ut</label>';
        } else {
            $query = "SELECT * FROM Medlem WHERE Epost = :Epost AND Passord = :Passord";
            $statement = $pdo->prepare($query);
            $statement->execute(
                array(
                    'Epost'     =>     $_POST["Epost"],
                    'Passord'     =>     $_POST["Passord"]

                )
            );
            $count = $statement->rowCount();
            if ($count > 0) {
                $_SESSION["Epost"] = $_POST["Epost"];
                $_SESSION["Fornavn"] = $_POST["Fornavn"];
                header("location:../index/Forside.php");
            } else {
                $message = '<label>Feil brukernavn eller passord!</label>';
            }
        }
    }
} catch (PDOException $error) {
    $message = $error->getMessage();
}
?>
<!DOCTYPE html>
<html>

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

<body>
    <br />
    <div class="container" style="width:500px;">
        <?php
        if (isset($message)) {
            echo '<label class="text-danger">' . $message . '</label>';
        }
        ?>
        <style>
            body {
                background-image: url("/Neoklubb/Private/Include/bilde.jpeg");

            }
        </style>
        <h3 align="">Velkommen til Neo Ungdommsklubb</h3><br />
        <form method="post">
            <label>Username</label>
            <input type="text" name="Epost" class="form-control" />
            <br />
            <label>Password</label>
            <input type="password" name="Passord" class="form-control" />
            <br />
            <input type="submit" name="login" class="btn btn-info" value="Login" />
        </form>
    </div>
    <br />
</body>

</html>