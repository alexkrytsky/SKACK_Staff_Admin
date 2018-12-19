<?php

require_once '../common/index.php'; // Connect to index.

    //email from user
    $email = $_POST['email'];
    // retrieve the salt
    $querySalt = "SELECT salt FROM Account WHERE email='$email' Limit 1";

    $resultQuery = mysqli_query($db, $querySalt);

    /*if (mysqli_num_rows($resultQuery) == 0) {*/

        // email posted by user
        //$email = trim($_POST['email']);

        $salt = mysqli_fetch_assoc($resultQuery)['salt'];

        // salt new password
        $password = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2137483647));

        // password sent to the user
        $originalpassword = $password;

        //run hash
        for ($round = 0; $round < 65537; $round++) {
            $password = hash('sha256', $password . $salt);
        }

        // Update new hashed password in the database
        $changedpassword = "UPDATE Account SET password='$password' WHERE email = '$email'";

        //runs query
        $sql = mysqli_query($db, $changedpassword);

// where email is from
$from="jacadevelopment@greenriverdev.com";
// what email is posted from the form
$email=$_POST['email'];
// subject the user will see in their email
$subject="You requested a password change";
// message the user will see in their email
$message= " Hi,
        
You requested a password change: 

copy and paste password in the log in

Temporary password: $originalpassword

LOG IN HERE: http://jacadevelopment.greenriverdev.com";

// to send the mail                         // tells user where its from
mail($email, $subject, $message, "From: ".$from);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Check Email</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.5.0/css/mdb.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu+Mono" rel="stylesheet">
    <style>
        body{
            font-family: 'Ubuntu Mono', monospace;
            font-size: 20px;
        }
    </style>
</head>
<body>
<!--############################################################  Navbar goes here ##################################################-->
<div>
    <nav class="navbar navbar-expand-lg navbar-light bg-light text-uppercase ">
        <img src="http://jacadevelopment.greenriverdev.com/Abdalla/LandingPages/mini_logo.png"  width="100px" height="60px" alt="logo" >
        <a class="navbar-brand text-black" href=""> </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-item nav-link active navbar-brand" href="https://www.skcacindustries.com">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-item nav-link active navbar-brand" href="https://www.skcacindustries.com/employment-services/">Employment Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-item nav-link active navbar-brand" href="https://www.skcacindustries.com/production-services/">Production Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-item nav-link active navbar-brand" href="https://www.skcacindustries.com/donate/">Donate</a>
                </li>
                <li class="nav-item">
                    <a class="nav-item nav-link active navbar-brand" href="https://www.skcacindustries.com/resources-links/">Resources</a>
                </li>
            </ul>
        </div>
    </nav>
</div>

<!--############################################################  Navbar ends here ##################################################-->

<!--############################################################ logo goes here ##################################################-->
<div class="container text-center">
    <p>
        <br>
        <!--<a href="http://jacadevelopment.greenriverdev.com/">-->
        <img src="http://jacadevelopment.greenriverdev.com/logo.png" alt="header">
    </p>
</div>
<!--############################################################ logo ends here ##################################################-->

<div class="container">
    <label style="font-size: 60px">FORGOT PASSWORD</label>
</div>

<div class="container">
    <div class="container">
        <label style="font-size: 40px">TEMPORARY PASSWORD SEND TO YOUR EMAIL</label>
        <label style="font-size: 40px">CAN'T FIND IT: CHECK YOUR SPAM FOLDER</label>
    </div>
    <br>
</div>


<?php
require_once ('../register/footer.html');
?>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.5.0/js/mdb.min.js"></script>
</body>
</html>