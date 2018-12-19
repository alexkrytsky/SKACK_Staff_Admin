<?php
/**
 * index.php.old
 *
 * description
 *
 * Author: Caleb Snoozy
 * Date: 2/16/18
 */

require_once 'MyAPI.php';

try {
  $API = new MyAPI( $_REQUEST[ 'request' ] );
  echo $API->processAPI();
} catch ( Exception $e ) {
  echo json_encode( Array( 'error' => $e->getMessage() ) );
}