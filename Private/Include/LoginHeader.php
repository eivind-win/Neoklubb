<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>
</head>

<body>
    <div class="topnav">
        <a class="active" href="../Index/Forside.php">Home</a>
        <a href="..//Login/LogOut.php">LogOut</a>
        <a href="../Register/RegisterMember.php">Registrer Deg</a>
        <a href="../EditMember/Editor.php">Endre medlemsinformasjon</a>
        <a href="../ListMembers/ListMembers.php">List opp medlemmer</a>
    </div>
    <style>
        .topnav {
            background-color: #333;
            overflow: hidden;
        }

        /* Style the links inside the navigation bar */
        .topnav a {
            float: right;
            color: #f2f2f2;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            font-size: 17px;
        }

        /* Change the color of links on hover */
        .topnav a:hover {
            background-color: #ddd;
            color: black;
        }

        /* Add a color to the active/current link */
        .topnav a.active {
            background-color: #04AA6D;
            color: white;
        }
    </style>
</body>

</html>