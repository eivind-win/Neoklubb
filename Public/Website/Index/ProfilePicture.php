<?php
include_once "/Applications/XAMPP/xamppfiles/htdocs/Neoklubb/Private/Include/LogInChecker.php";
include_once "/Applications/XAMPP/xamppfiles/htdocs/Neoklubb/Private/Include/LoginHeader.php";

//Setter variabel for filnavn

$navn = $_SESSION["MedlemID"];

if (isset($_REQUEST['upload-send'])) {
    echo "<pre>";
    echo "This script: " . $_SERVER['SCRIPT_FILENAME'] . "<br>";
    echo "Filename: " . $_FILES['upload-file']['name'] . "<br>";
    echo "Tmp location/name: " . $_FILES['upload-file']['tmp_name'] . "<br>";
    echo "Type: " . $_FILES['upload-file']['type'] . "<br>";
    echo "Size: " . $_FILES['upload-file']['size'] . " bytes<br><br>";
    echo "</pre>";

    // Array for diverse meldinger til bruker 
    $messages = array();

    // Filen lastes opp 
    if (is_uploaded_file($_FILES['upload-file']['tmp_name'])) {

        $filetype = $_FILES['upload-file']['type'];
        $filesize = $_FILES['upload-file']['size'];

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
        $pos = strrpos($_FILES['upload-file']['type'], "/");
        $suffix = substr($_FILES['upload-file']['type'], $pos + 1);


        //Setter sammen variabel for navn og filtype
        do {
            $filename  =  $navn . "." . $suffix;
        } while (file_exists($directory . $filename));

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

            $uploaded_file = move_uploaded_file($_FILES['upload-file']['tmp_name'], $filepath);

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
            <label for="upload-file">Velg fil</label>
            <input name="upload-file" type="file">
        </p>
        <p>
            <button type="submit" name="upload-send">Last opp</button>
        </p>
    </form>
</body>

</html>