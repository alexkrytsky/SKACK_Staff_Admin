<?php
// forgot password

// checks session of user
if ( !empty( $_SESSION[ 'user' ] ) ) {
    header("Location: ../dashboard");
    die("Redirecting to ../dashboard");
}

// check if connected to server
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once '../common/Account.php'; //Connect to Account

    // check to see if input is empty
    if ( !empty( $_POST) ) {
        $submitted_email = $_POST[ 'email' ];

        $identity = mysqli_query("SELECT email FROM Account WHERE email='$email'");

        if(!$identity){
            echo "The username does not exist";
        }else{

            $account = Account::query_from_email( $submitted_email );

        if($submitted_email == $account->getEmail()){
            // if input is not empty
            if ( !empty( $account ) ) {

                // check if email matches
                if ( $submitted_email === $account->getEmail() ) {
                    $match_ok = true;
                }

                // if email matches move on to the next page
                if ( $match_ok ) {
                    $_SESSION[ 'user' ] = $account->getEmail();
                    $_SESSION[ 'staff' ] = $account->isStaff();
                    $_SESSION[ 'admin' ] = $account->isAdmin();

                    // take to next page for checking mail
                    header( "Location: ../password/checkMail.php" );
                    die( "Redirecting to ../password/checkMail.php" );
                }
                // if the do no match show error
                else{
                    printf( "Email does not match" );
                    $submitted_email = htmlentities( $_POST[ 'email' ], ENT_QUOTES, 'UTF-8' );
                }

            }
        } else{
            echo 'email does not exist';
        }
        }
    }
}


?>

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
<!--############################################################  Navbar goes here ##################################################-->
<?php
include ("../Abdalla/header.html");
?>
<!--############################################################ logo goes here ##################################################-->
<?php
include ("../Abdalla/logo.html");
?>
<!--############################################################ textboxes start here ##################################################-->

<div class="container">
    <label style="font-size: 60px">FORGOT PASSWORD</label>
</div>

 <div class="container">
            <form class="text-uppercase" method="POST" action="checkMail.php">
                <div class="form-group text-uppercase">
                    <br>
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