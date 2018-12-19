<?php
/**
 * index.php.old
 *
 * description
 *
 * Author: Caleb Snoozy
 * Date: 2/12/18
 */

ini_set( 'display_errors', 1 );
ini_set( 'display_startup_errors', 1 );
error_reporting( E_ALL );

##### DATABASE SETTINGS

$db_user = 'jacadeve_php';
$db_password = '5]D2!Jtk[8c2';
$db_host = "localhost";
$db_name = "jacadeve_skcac_dev";

$db = null;

try {
  $db = mysqli_connect( $db_host, $db_user, $db_password, $db_name );
} catch ( mysqli_sql_exception $exception ) {
  die( "Failed to connect to the database: " . $exception->getMessage() );
}

mysqli_set_charset( $db, 'utf8' );

##### UTILITY FUNCTIONS #####

/**
 * Formats a phone number into a standard format.
 *
 * @param $number int Un-formatted phone number.
 * @return string Formatted phone number.
 */
function render_phone_number( $number ) {
  return preg_replace( '~.*(\d{3})[^\d]{0,7}(\d{3})[^\d]{0,7}(\d{4}).*~', '($1) $2-$3', $number );
}

/**
 * Checks the session and redirects if necessary.
 *
 * @param bool $require_staff Is a _staff check required
 */
function verify_session( bool $require_staff ) {
  if ( empty( $_SESSION[ 'user' ] ) ) {
    // There is no user, send them to login.
    header( "Location: /" );
    die( "Redirecting to /" );
  } elseif ( $require_staff && ( empty( $_SESSION[ 'staff' ] ) || !$_SESSION[ 'staff' ] ) ) {
    // The user is not _staff, send them to the homepage.
    header( "Location: /" );
    die( "Redirecting to homepage" );
  }
}

/**
 * Output a message to a logfile located at
 * /home/jacadeve/skcac_log.txt
 *
 * @param string $tag Tag used for keyword assistance.
 * @param $message string Message to output.
 */
function log_file( $tag = "", $message) {
  $file = "/home/jacadeve/skcac_log.txt";
  file_put_contents($file,
    "[" . date('y-m-d H:i:s') . "] [" .
    str_replace('/home/jacadeve/public_html', '', debug_backtrace()[0]['file']) . "] [" .
    $tag . "]: " .
    $message .
    "\r" . PHP_EOL,
    FILE_APPEND | LOCK_EX);
}

##### PAGE LOAD #####

// Remove Magic Quotes, for PHP 5.3 and prior.
if ( function_exists( 'get_magic_quotes_gpc' ) && get_magic_quotes_gpc() ) {
  function undo_magic_quotes_gpc( &$array ) {
    foreach ( $array as &$value ) {
      if ( is_array( $value ) )
        undo_magic_quotes_gpc( $value );
      else
        $value = stripslashes( $value );
    }
  }

  undo_magic_quotes_gpc( $_POST );
  undo_magic_quotes_gpc( $_GET );
  undo_magic_quotes_gpc( $_COOKIE );
}

header( 'Content-Type: text/html; charset=utf-8' );

if ( !session_start() )
  die( "Session failed to start!" );