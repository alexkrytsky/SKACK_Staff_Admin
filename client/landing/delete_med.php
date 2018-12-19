<?php
/**
 * Created by PhpStorm.
 * User: Joseph Bethards
 * Date: 3/7/2018
 * Time: 5:02 PM
 */

require ('/home/jacadeve/public_html/client/landing/db/db.php');
if ( (isset($_GET['id'])) && (is_numeric($_GET['id'])) ) { // From view_users.php
    $id = $_GET['id'];
} elseif ( (isset($_POST['id'])) && (is_numeric($_POST['id'])) ) { // Form submission.
    $id = $_POST['id'];
} else { // No valid ID, kill the script.
    $id=$_SESSION['bid'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Emergency Contact</title>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="//fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--  <link rel="stylesheet" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">-->
    <link rel="stylesheet" href="/css/navbarStyle.css">
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Tangerine">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu+Mono" rel="stylesheet">

</head>
<style>
    body{
        font-family: 'Quattrocento', serif;
        font-size: 20px;
    }

    /* .header{
           margin-right: 2%;
           margin-left: 2%;
           margin-top:1%;

       }
       .nav1{
           padding:0px;
       }
       .navitem2{
           float: right;
       }
       .font{
           font-family: 'Vollkron', serif;
           font-size: 100px;
       }*/
</style>
<body>

<!--############################################################  Navbar goes here ##################################################-->
<?php
include ("../headerUserNew.html");
?>
<?php

$q = "UPDATE `Clients_Medications` SET `active`=0 WHERE  `id`=$id;";
$r = @mysqli_query($dbc, $q);
if (mysqli_affected_rows($dbc) == 1) { // If it ran OK.
    // Print a message:
    echo "<div class='container'>";
    echo '<h1>The Medication has been deleted.</h1>';
    echo '<a href=Medication1.1.php><button class="btn btn-primary btn-lg">Return</button></a>';
    echo "</div>";
}

else { // If the query did not run OK.
    echo '<p class="error">The medication could not be deleted due to a system error.</p>'; // Public message.
    echo '<p>' . mysqli_error($dbc) . '<br>Query: ' . $q . '</p>'; // Debugging message.
    echo '<p>The medication has NOT been deleted.</p>';
    echo '<a href=Medication1.1.php><button class="btn btn-primary">Return</button></a>';
}


?>
<?php
require_once ('../footer.html');
?>


<!--jQuery-->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<!--Bootstrap tooltips-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>