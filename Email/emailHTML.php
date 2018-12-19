<!-- this page is a html mock up that shows how to send an email-->
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

    <form class="text-uppercase" method="POST" action="EmailScript.php">
        <div class="form-group text-uppercase">
            <br>
            <!--match id with variable in the next page i.e. id=email-->
           <!-- can include other inputs just match them with proper variable i.e id= message is $message-->
            <input name="email" type="email" id="email" class="form-control is-valid" placeholder="EMAIL*" required oninvalid="this.setCustomValidity('Please Enter valid email')" oninput="setCustomValidity('')">
            <div class="invalid-feedback"> Invalid email or password </div>
        </div>
        <button type="submit" value="continue" class="btn btn-success btn-lg btn-block text-uppercase">Continue

            <!--send email to the user. can send up to 99 messages-->

            <?php

            ?>
        </button>
    </form>
    <br>
</div>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>