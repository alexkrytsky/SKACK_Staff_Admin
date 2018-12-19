<?php
// index page

require_once 'common/index.php'; // Connect to index.

/*if ( !empty( $_SESSION[ 'user' ] ) ) {
    header( "Location: ../dashboard" );
    die( "Redirecting to ../dashboard" );
}*/

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once 'common/Account.php'; //Connect to Account
    /*require '../LandingPages/ForgotPassword';*/

    if ( !empty( $_POST ) ) {
        $submitted_email = $_POST[ 'email' ];
        $submitted_password = $_POST[ 'password' ];

        $account = Account::query_from_email( $submitted_email );
        if ( !empty( $account ) ) {

            for ( $round = 0; $round < 65537; $round++ ) {
                $submitted_password = hash( 'sha256', $submitted_password . $account->getSalt() );
            }

            if ( $submitted_password === $account->getPassword() ) {
                $login_ok = true;

                if ( $login_ok ) {
                    $_SESSION[ 'user' ] = $account->getEmail();
                    $_SESSION[ 'staff' ] = $account->isStaff();
                    $_SESSION[ 'admin' ] = $account->isAdmin();

                    // check if staff login redirect to staff dashboard ELSE if user redirect to user dashboard
                    if ($account->isStaff()){
                        header( "Location: /staff/dashboard/index.php" );
                        die( "Redirecting to /staff/dashboard/index.php" );
                    } else {
                        $_SESSION['email']=$submitted_email;
                        header( "Location: ../client/landing/UserLanding.php" );
                        die( "Redirecting to ../client/landing/UserLanding.php" );
                    }
                } else {
                    printf( "Login Failed! Email or Password are incorrect" );
                    $submitted_email = htmlentities( $_POST[ 'email' ], ENT_QUOTES, 'UTF-8' );
                }
            }else{
                printf( "Login Failed! Email or Password are incorrect" );
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
    <title>Sign In</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu+Mono" rel="stylesheet">
    <style>
        body{
        body {
            font-family: 'Quattrocento', serif;
            font-size: 20px;
        }
        }
        .footer {
            position: relative;
            right: 0;
            bottom: 0;
            left: 0;
            padding: 1rem;
            text-align: left;
        }
    </style>
</head>
<body>
<!--############################################################  Navbar goes here ##################################################-->
<?php
include ("client/header.html");
?>
<!--############################################################ logo goes here ##################################################-->
<?php
include ("client/logo.html");
?>
<!-- ############################################################ Body Text goes here ##################################################-->
<div class="container">
    <!--table goes here with message and colors-->
    <nav class="navbar bg-default">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link navbar-brand text-uppercase text-black" style="font-size: 45px; ">Sign in</a>
            </li>
        </ul>
    </nav>
</div>
<!--############################################################ Navbar ends here ##################################################-->
<!--############################################################ textboxes goes here ##################################################-->
<div class="container">
    <form class="text-uppercase" method="post" >
        <div class="form-group text-uppercase">
            <input name="email" type="email" id="inputEmail" class="form-control" style="font-size: 20px" placeholder="EMAIL*" required
                   oninvalid="this.setCustomValidity('Please enter email')" oninput="setCustomValidity('')" >
        </div>
        <div class="form-group text-uppercase">
            <br>
            <input name="password" type="password" id="inputPassword" class="form-control" style="font-size: 20px" placeholder="PASSWORD" required
                   oninvalid="this.setCustomValidity('Please enter password')" oninput="setCustomValidity('')">
        </div>
        <br>
        <button type="submit" value="SignIn" class="btn btn-success btn-lg btn-block text-uppercase">Sign in</button>
    </form>
    <br>
    <div class="text-center">
        <!--forgot password link onclick to be changed to official link-->
            <button name="forgotPassword" type="button" id="forgotPassword" class="btn btn-warning btn-lg form-action" onclick="location.href='http://jacadevelopment.greenriverdev.com/client/password/ForgotPassword.php'">FORGOT PASSWORD</button>
       <!--new user link to be changed to official link-->
        <br>
        <br>
            <button id="newSignIn" name="newSignIn" class="btn btn-primary btn-lg form-action" onclick="location.href='http://jacadevelopment.greenriverdev.com/client/register/register.php'"><strong>NEW? SIGN UP</strong></button>

    </div>
</div>
<!--############################################################ textboxes end here ##################################################-->
<!--################################### footer starts here ##############################################-->
<?php
require_once ('client/footer.html');
?>
<!--jQuery-->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<!--Bootstrap tooltips-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>