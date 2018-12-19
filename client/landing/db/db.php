<?php
/**
 * Created by PhpStorm.
 * User: Joseph Bethards
 * Date: 2/19/2018
 * Time: 6:02 PM
 */
?>
<?php
/**
 * Created by PhpStorm.
 * User: Joseph Bethards
 * Date: 2/13/2018
 * Time: 5:35 PM
 */

// This file contains the database access information.
// This file also establishes a connection to MySQL,
// selects the database, and sets the encoding.
// Set the database access information as constants:
define('DB_USER', 'jacadeve_php');
define('DB_PASSWORD', '5]D2!Jtk[8c2');
define('DB_HOST', 'localhost');
define('DB_NAME', 'jacadeve_skcac_dev');
// Make the connection:
$dbc = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die('Could not connect to MySQL: ' . mysqli_connect_error() );
// Set the encoding...
mysqli_set_charset($dbc, 'utf8');



?>
