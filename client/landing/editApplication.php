<?php
session_start();
/**
 * Created by PhpStorm.
 * User: Joseph Bethards
 * Date: 2/21/2018
 * Time: 7:19 PM
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>SKCAC Home Page</title>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="//fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--  <link rel="stylesheet" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">-->
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Tangerine">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu+Mono" rel="stylesheet">
    <link rel="stylesheet" href="../../Joseph/css/navbarStyle.css">
    <link rel="stylesheet" href="css/userLanding.css">

    <style>
        body {
            font-family: 'Quattrocento', serif;
            font-size: 20px;
        }
    </style>
</head>

<body>

<!--############################################################  Navbar goes here ##################################################-->
<?php
//include ("../headerUser.html");
include("../headerUserNew.html");

?>

<!--############################################################  Text goes here ##################################################-->
<div class="container">

    <!--    <nav class="navbar bg-default">-->
    <!--        <ul class="navbar-nav">-->
    <!--            <li class="nav-item">-->
    <!--                <a class="nav-link navbar-brand text-uppercase text-black" style="font-size: 45px; ">Welcome,</a>-->
    <!--            </li>-->
    <!--        </ul>-->
    <!--    </nav>-->

    <!--Show user name-->
    <?php
    require("/home/jacadeve/public_html/client/landing/db/db.php");

    $q = "SELECT Account.first_name, Account.last_name,Account.email,Account.account_id FROM Account Inner Join Clients on Clients.account_id=Account.account_id WHERE email ='$_SESSION[email]';";
    $r = @mysqli_query($dbc, $q);
    while ($rs = mysqli_fetch_assoc($r)) {
        $first_name = $rs['first_name'];
        $last_name = $rs['last_name'];
        $acnt = $rs['account_id'];
    }
    if ($r) {

    } else {
        $q = "SELECT Account.first_name, Account.last_name,Account.email,Account.account_id FROM Account Inner Join Clients on Clients.account_id=Account.account_id WHERE email ='$_SESSION[email2]';";
        $r = @mysqli_query($dbc, $q);
        while ($rs = mysqli_fetch_assoc($r)) {
            $first_name = $rs['first_name'];
            $last_name = $rs['last_name'];
            $acnt = $rs['account_id'];
        }

    }
    $joesQ = "SELECT client_id FROM Clients WHERE account_id=$acnt";
    $p = @mysqli_query($dbc, $joesQ);
    while ($e = mysqli_fetch_assoc($p)) {
        $clie = $e["client_id"];
    }
    // End of if ($r) IF.// End of if ($r) IF.

    $_SESSION['clientid'] = $clie;
    $_SESSION['name'] = $first_name . " " . $last_name;
    $_SESSION['accountID'] = $acnt;
    echo "
                    <div class='container-fluid'>
                    <h1 class='display-4'>$_SESSION[name]</h1>
                    </div>";
    ?>

    <div class="container">

        <a class="nav-link navbar-brand  text-black" style="font-size: 45px;"><u>Profile</u></a>
        <br>

        <a href="http://jacadevelopment.greenriverdev.com/Abdalla/construction.php" class="btn btn-lg btn-primary " style="font-size: 20px;">Edit Profile</a>
        <br>

        <a class="nav-link navbar-brand  text-black" style="font-size: 45px;"><u>Information</u></a>
        <br>

         <a href="http://jacadevelopment.greenriverdev.com/client/documents/index.php" class="btn btn-lg btn-warning">Information</a>
        <br>

        <a class="nav-link navbar-brand  text-black" style="font-size: 45px;"><u>Emergency Contact</u></a>
        <br>

        <a href="../landing/updateContact12.php" class="btn btn-lg btn-success">Add Emergency Contact</a>
        <!--modal here-->

        <br><br>

        <a href="../landing/updateContact12.php" class="btn btn-lg btn-warning">Edit Emergency Contact</a>
        <br>

        <a class="nav-link navbar-brand  text-black" style="font-size: 45px;"><u>Medication</u></a>
        <br>

        <a href="../landing/addMedication.php" class="btn btn-lg btn-success">Add Medication</a>
        <br><br>

        <a href="#" class="btn btn-lg btn-warning">Edit Medication</a>
    </div>
    <br>

    <!--footer starts here -->
    <?php
    require_once('../footer.html');
    ?>
    <!-- Icons -->
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script>
        feather.replace()
    </script>

    <!--<script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>-->
    <!--jQuery-->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
            crossorigin="anonymous"></script>
    <!--Bootstrap tooltips-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>
    <script src="js/userLanding.js"></script>
</body>
</html>
