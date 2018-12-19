<?php
/**
 * index.php.old
 *
 * description
 *
 * Author: Caleb Snoozy
 * Date: 2/13/18
 */

require_once '../common/index.php.old';

$query = " 
INSERT INTO Account 
(email, first_name, last_name, password, salt) 
VALUES 
(?, ?, ?, ?, ?)";

set_time_limit(0);
$myFile = fopen( "MOCK_DATA.txt", 'r' ) or die( "Unable to open file" );
$contents = fread( $myFile, filesize( 'MOCK_DATA.txt' ) );
$contents = explode( "\n", $contents );

foreach ( $contents as $str ) {
  $account = explode( ',', $str );

  $salt = dechex( mt_rand( 0, 2147483647 ) ) . dechex( mt_rand( 0, 2137483647 ) );
  $password = hash( 'sha256', $account[ 3 ] . $salt );

// Super hash the password
  for ( $round = 0; $round < 65536; $round++ ) {
    $password = hash( 'sha256', $password . $salt );
  }

  $email = $account[ 0 ];
  $first_name = $account[ 1 ];
  $last_name = $account[ 2 ];

  $statement = mysqli_prepare( $db, $query );
  mysqli_stmt_bind_param( $statement, 'sssss', $email, $first_name, $last_name, $password, $salt );

  try {
//    mysqli_stmt_execute( $statement );
  } catch ( mysqli_sql_exception $exception ) {
    die( 'SQL Exception: ' . $exception->getMessage() );
  }

  mysqli_stmt_close( $statement );

}