<body>
    <?php
    include_once "/Applications/XAMPP/xamppfiles/htdocs/Neoklubb/Private/Include/LoginHeader.php";
    include_once "/Applications/XAMPP/xamppfiles/htdocs/NeoKlubb/Public/Resources/Style/Css/Profil.html";
    ?>
    <h1> Velkommen til Neo Ungdomsklubb! </h1>
    <?php

    session_start();
    // dersom det IKKE er startet noe session blir med redirectet til loginsiden igjen.
    if (!isset($_SESSION['Epost'])) {

        header("location: ../Login/Login.php");
    }

    ?>

</body>

</html>