<?php
// send email with this php code here.
// where email is from. Will show on user email
$from="jacadevelopment@greenriverdev.com";
// what email is posted from the form
$email=$_POST['email'];
// subject the user will see in their email
$subject="You requested a password change";

// message the user will see in their email. T
// Type message you want user to see here in their email

$message= " Hello,
You requested a mail change: follow the following link";

//this section is how the mail will be sent
// variables are included here

mail($email, $subject, $message, "From: ".$from);

?>


<!-- this page is a contains php code that shows the email is sent -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Forgot Password</title>
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

<div class="container">
    <label style="font-size: 60px">SEND EMAIL</label>
</div>

<div class="container">

    <!--action links to the php script for sending the message-->


        <div class="container">
            <div class="container">
                <label style="font-size: 40px">CHECK YOUR EMAIL TO CHANGE YOUR PASSWORD </label>
                <label style="font-size: 40px">CAN'T FIND IT: CHECK YOUR SPAM FOLDER</label>
            </div>
            <form method="post" action="emailHTML.php">
                <button type="submit" value="SignIn" class="btn btn-success btn-lg btn-block text-uppercase" style="font-size: 20px">Back home</button>
            </form>
        </div>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>
