<?php
/**
 * bulk_email.php
 *
 * description
 *
 * Author: Caleb Snoozy
 * Date: 3/5/18
 */

require_once '../../../common/index.php';
require_once '../../../common/Account.php';
require_once '../../../common/Logging.php';

verify_session( true );

if ( $_SERVER[ 'REQUEST_METHOD' ] == "POST" ) {

  $sender = 'jacadeve@jacadevelopment.greenriverdev.com';

  if ( isset( $_POST[ 'message' ] ) )
    $message = $_POST[ 'message' ];
  else {
    header( "Location: /staff/dashboard/email" );
    die( "Message not Found!" );
  }

  if ( isset( $_POST[ 'target' ] ) )
    $target = $_POST[ 'target' ];
  else {
    header( "Location: /staff/dashboard/email" );
    die( "Target not Found!" );
  }

  if ( isset( $_POST[ 'subject' ] ) )
    $subject = $_POST[ 'subject' ];
  else {
    header( "Location: /staff/dashboard/email" );
    die( "Subject not Found!" );
  }

  switch ( $target ) {
    case "all":
      $accounts = Account::query_all();
      break;
    case "staff":
      $accounts = Account::query_staff();
      break;
    case "participants":
      $accounts = Account::query_participants();
      break;
  }

  $log = array();

  $_SESSION[ 'mail_result' ] = true;
  $to = "";
  foreach ( $accounts as $account ) {
    $to .= $account->getFirstName() . " " . $account->getLastName() . "<" . $account->getEmail() . ">,";
  }

  $headers[] = 'MIME_Version: 1.0';
  $headers[] = 'Content-type: text/html; charset=utf-8';
  $headers[] = 'To: ' . $to;
  $headers[] = 'From: ' . $sender;
  $headers[] = 'Reply-To: ' . $sender;

  $_SESSION[ 'mail_result' ] = mail( $to, $subject, $message, implode( "\r\n", $headers ) );
  $log[] = implode( "\r\n", $headers ) . ": " . $message;

  Logging::insert_log( implode( "\r\n", $log ) );

  header( "Location: /staff/dashboard" );
  die();
} else {
  header( "Location: /staff/dashboard" );
  die();
}