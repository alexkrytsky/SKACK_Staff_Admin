<?php
/**
 * index.php.old
 *
 * description
 *
 * Author: Caleb Snoozy
 * Date: 2/14/18
 */

require '../../common/index.php';

unset($_SESSION['user']);
unset($_SESSION['staff']);
unset($_SESSION['admin']);

$_SESSION = array();

if (ini_get("session.use_cookies")) {
  $params = session_get_cookie_params();
  setcookie(session_name(), '', time() - 42000,
    $params["path"], $params["domain"],
    $params["secure"], $params["httponly"]
  );
}

session_destroy();

header("Location: ../../");
die("Redirecting to: ../../");