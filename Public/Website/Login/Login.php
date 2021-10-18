<?php
session_start();
$host = "localhost";
$username = "root";
$password = "";
$database = "NeoKlubb";
$message = "";
//koblet til tatabasen og gjør den klar
try {
    $connect = new PDO("mysql:host=$host; dbname=$database", $username, $password);
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if (isset($_POST["login"])) {
        if (!empty($_POST["Epost"]) || !empty($_POST["Password"])) {
            $message = '<label>Begge felter må fylles ut</label>';
        } else {
            $query = "SELECT * FROM Medlem WHERE Epost = :Epost AND Passord = :Passord";
            $statement = $connect->prepare($query);
            $statement->execute(
                array(
                    'Epost'     =>     $_POST["Epost"],
                    'Passord'     =>     $_POST["Passord"]
                )
            );
            $count = $statement->rowCount();
            if ($count > 0) {
                $_SESSION["Epost"] = $_POST["Passord"];
                header("location:login_success.php");
            } else {
                $message = '<label>Wrong Data</label>';
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
</head>

<body>
    <br />
    <div class="container" style="width:500px;">
        <?php
        if (isset($message)) {
            echo '<label class="text-danger">' . $message . '</label>';
        }
        ?>
        <h3 align="">Login Neo Ungdomsklubb</h3><br />
        <form method="post">
            <label>Epost</label>
            <input type="text" name="Epost" class="form-control" />
            <br />
            <label>Password</label>
            <input type="Passord" name="Passord" class="form-control" />
            <br />
            <input type="submit" name="login" class="btn btn-info" value="Login" />
        </form>
    </div>
    <br />
</body>

</html>