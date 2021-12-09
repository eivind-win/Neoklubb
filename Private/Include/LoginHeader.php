<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <div class="navbar">
        <a href="../Index/FrontPage.php">Hjem</a>
        <div class="subnav">
            <button class="subnavbtn">Profil <i class="fa fa-caret-down"></i></button>
            <div class="subnav-content">
                <a href="../Index/MyProfile.php">Min profil</a>
                <a href="../Listing/ListMyInterests.php">Mine interesser </a>
                <a href="../Simulating/ContigentPayment.php">Betal Kontigent </a>
                <a href="../Editing/EditMember.php">Endre opplysninger </a>
                <a href="../Registering/registermyinterests.php">Legg til dine interesser </a>
                <a href="../Sending/Feedback.php">Gi feedback</a>
            </div>
        </div>
        <div class="subnav">
            <button class="subnavbtn">Medlemmer <i class="fa fa-caret-down"></i></button>
            <div class="subnav-content">
                <a href="../Listing/ListMembersOnStatus.php">List på status</a>
                <a href="../Listing/ListMembersOnInterests.php">List på interesser</a>
                <a href="../Registering/RegisterInterests.php">Registrer nye interesser</a>
                <a href="../Editing/EditRoles.php">Endre roller</a>
                <a href="../Editing/EditStatus.php">Endre status</a>
                <a href="../Editing/DeleteMember.php">Slett medlemmer</a>
            </div>
        </div>
        <div class="subnav">
            <button class="subnavbtn">Epost <i class="fa fa-caret-down"></i></button>
            <div class="subnav-content">
                <a href="../Sending/SendEmail.php">Send</a>
                <a href="../Sending/BulkEmail.php">Bulk </a>
                <a href="../Sending/NewsLetter.php">Nyhetsbrev</a>
            </div>
        </div>
        <div class="subnav">
            <button class="subnavbtn">Kurs <i class="fa fa-caret-down"></i></button>
            <div class="subnav-content">
                <a href="../Listing/ListActivities.php">Bli med på kurs</a>
                <a href="../Listing/ListMembersOnCourse.php">Oversikt kursdeltagere</a>
                <a href="../Registering/RegisterActivity.php">Registrer kurs </a>
            </div>
        </div>
        <a href="../Sending/Feedback.php">Kontakt oss</a>
        <div>
            <div style="display: flex; justify-content: flex-end">
                <a href="../Login/LogOut.php">Logg ut</a>
            </div>
        </div style>
    </div>

</body>

</html>
<style>
    body {
        font-family: Arial, Helvetica, sans-serif;
        margin: 0;
    }

    .navbar {
        overflow: hidden;
        background-color: #333;
    }

    .navbar a {
        float: left;
        font-size: 16px;
        color: white;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
    }

    .subnav {
        float: left;
        overflow: hidden;
    }

    .subnav .subnavbtn {
        font-size: 16px;
        border: none;
        outline: none;
        color: white;
        padding: 14px 16px;
        background-color: inherit;
        font-family: inherit;
        margin: 0;
    }

    .navbar a:hover,
    .subnav:hover .subnavbtn {
        background-color: grey;
    }

    .subnav-content {
        display: none;
        position: absolute;
        left: 0;
        background-color: #04AA6D;
        width: 100%;
        z-index: 1;
    }

    .subnav-content a {
        float: left;
        color: white;
        text-decoration: none;
    }

    .subnav-content a:hover {
        background-color: #eee;
        color: black;
    }

    .subnav:hover .subnav-content {
        display: block;
    }
</style>