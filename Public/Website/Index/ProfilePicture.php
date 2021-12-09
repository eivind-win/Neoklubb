<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Skift ditt profilbilde</title>
</head>

<body>
    <?php
    // Relevante include filer
    include_once "/Applications/XAMPP/xamppfiles/htdocs/Neoklubb/Private/Include/LogInChecker.php";
    include_once "/Applications/XAMPP/xamppfiles/htdocs/Neoklubb/Private/Include/LoginHeader.php";

    //Setter variabel for filnavn
    $navn = $_SESSION["MedlemID"];

    // Om LastOpp blir trykket på vil denne printe ut relevant informasjon om bildet som blir lastet opp
    if (isset($_REQUEST['LastOpp'])) {
        echo "<pre>";
        echo "Filename: " . $_FILES['LastOppFil']['name'] . "<br>";
        echo "Type: " . $_FILES['LastOppFil']['type'] . "<br>";
        echo "Size: " . $_FILES['LastOppFil']['size'] . " bytes<br><br>";
        echo "</pre>";

        // Array for diverse meldinger til bruker 
        $messages = array();

        // Filen lastes opp 
        if (is_uploaded_file($_FILES['LastOppFil']['tmp_name'])) {

            $filetype = $_FILES['LastOppFil']['type'];
            $filesize = $_FILES['LastOppFil']['size'];

            //Aksepterte filtyper
            $accepted_types = array(
                "image/jpeg",
                "image/png"
            );

            //Setter maks størrelse til under 2MB i bytes
            $max_file_size = 1999999;
            $directory = $_SERVER['DOCUMENT_ROOT'] . "/NeoKlubb/Public/Resources/Image/";

            // Ved feil i mappe/finner ikke mappen
            if (!file_exists($directory)) {
                if (!mkdir($directory, 0777, true)) {
                    die("Kan ikke lage filkatalog..." . $directory);
                }
            }

            //Lager filnavn 
            $pos = strrpos($_FILES['LastOppFil']['type'], "/");
            $suffix = substr($_FILES['LastOppFil']['type'], $pos + 1);


            //Setter sammen variabel for navn og filtype

            $filename  =  $navn . "." . $suffix;

            if (file_exists("/NeoKlubb/Public/Resources/Image/" . $filename)) {
                unlink("/NeoKlubb/Public/Resources/Image/" . $filename);
            }

            //Sjekker etter feil i filtypen
            if (!in_array($filetype, $accepted_types)) {
                $types = implode(", ", $accepted_types);
                $messages[] = "Invalid filetype (only " . $types . " are accepted)";
            }
            if ($filesize > $max_file_size) {
                $messages[] = "The file (" . round($filesize * pow(10, -6), 2) . " MB) exceeds maximum filesize (" . round($max_file_size * pow(10, -6), 2) . " MB)";
            }

            //Sjekker at ingen feilmeldinger er tilstedet
            if (count($messages) < 1) {
                // Lagrer filen i tilegnet mappe
                $filepath = $directory . $filename;

                $uploaded_file = move_uploaded_file($_FILES['LastOppFil']['tmp_name'], $filepath);

                if (!$uploaded_file) {
                    $messages[] = "The file could not be uploaded";
                } else {
                    //Om alt gikk fint, blir det gitt melding til bruker
                    $messages[] = "The file was uploaded and is found here: <strong>" . $filepath . "</strong>";
                }
            }
        } else {
            $messages[] = "No file selected";
        }

        //Printer melding om noe skulle forekommer
        echo "<strong>Message(s) to the user: </strong>";
        foreach ($messages as $message) {
            echo $message . '<br>';
        }
    }
    ?>
    <!doctype html>
    <html>

    <head>
        <meta charset="utf-8">
        <title>M8 - upload file</title>
    </head>

    <body>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
            <p>
                <label for="LastOppFil">Velg fil</label>
                <input name="LastOppFil" type="file">
            </p>
            <p>
                <button type="submit" name="LastOpp">Last opp</button>
            </p>
        </form>
    </body>

    </html>