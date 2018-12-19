<?php
/**
 * index.php.old
 *
 * description
 *
 * Author: Caleb Snoozy
 * Date: 2/13/18
 */

require_once '../../common/index.php';
require_once '../../common/Account.php';

if ( !empty( $_SESSION[ 'user' ] ) ) {
  header( "Location: ../dashboard" );
  die( "Redirecting to ../dashboard" );
}

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
    }

    if ( $login_ok ) {
      $_SESSION[ 'user' ] = $account->getEmail();
      $_SESSION[ 'staff' ] = $account->isStaff();
      $_SESSION[ 'admin' ] = $account->isAdmin();

      header( "Location: ../dashboard" );
      die( "Redirecting to ../dashboard" );
    } else {
      printf( "Login Failed!" );
      $submitted_email = htmlentities( $_POST[ 'email' ], ENT_QUOTES, 'UTF-8' );
    }

  }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>SKCAC Staff Portal</title>
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="//fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="../css/signin.css">
</head>

<body class="text-center">
<form class="form-signin" method="post">
  <a href="/"><img class="mb-4" src="../resources/skcaclogo.png" alt="logo" width="128" height="128"></a>
  <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
  <label for="inputEmail" class="sr-only">Email address</label>
  <input name="email" type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
  <label for="inputPassword" class="sr-only">Password</label>
  <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Password" required>
  <!--  <div class="checkbox mb-3">-->
  <!--    <label>-->
  <!--      <input type="checkbox" value="remember-me"> Remember me-->
  <!--    </label>-->
  <!--  </div>-->
  <input type="submit" value="Sign In" class="btn btn-lg btn-primary btn-block">
  <p class="mt-5 mb-3 text-muted">&copy; 2017-2018</p>
</form>

<script src="http://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js"></script>
</body>
</html>