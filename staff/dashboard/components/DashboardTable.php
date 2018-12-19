<?php
/**
 * DashboardTable.php
 *
 * description
 *
 * Author: Caleb Snoozy
 * Date: 2/25/18
 */

require_once '../../../common/Account.php';
require_once '../../../common/index.php';

verify_session( true );

if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' ) {
  $get_offset = isset( $_POST[ 'offset' ] ) ? $_POST[ 'offset' ] : 0;
  $get_search = isset( $_POST[ 'search' ] ) ? $_POST[ 'search' ] : "";
  $get_column = isset( $_POST[ 'column' ] ) ? $_POST[ 'column' ] : "name";
  $get_order = isset( $_POST[ 'order' ] ) ? $_POST[ 'order' ] == "true" : true;
  dashboardTable( $get_offset, $get_search, $get_column, $get_order );
}

/**
 * @param int $offset
 * @param string $search
 * @param string $column
 * @param bool $order
 */
function dashboardTable( int $offset = 0, string $search = "", string $column = "name", bool $order = true ) {
  // Query the database for participants matching the search.

  $results = Participant::query_search( $offset, $search, $column, $order );

  // Insert the table and it's header

  // Render each participant as a row
  array_map( 'row', $results );

  // Display if there are no results
  if ( count( $results ) == 0 ) {
    echo "    
      <tr>
        <td colspan='6'>No Results</td>
      </tr>";
  }

  // Disable the next button if list is not full.
  if ( count( $results ) < 25 ) {
    echo '<script> $("#next").prop("disabled", true); </script>';
  } else {
    echo '<script> $("#next").prop("disabled", false); </script>';
  }

  // Disable the back button if on first page.
  if ( $offset === 0 ) {
    echo '<script> $("#back").prop("disabled", true); </script>';
  } else {
    echo '<script> $("#back").prop("disabled", false); </script>';
  }
}


/**
 * @param $participant Participant
 */
function row( $participant ) {
  echo "
      <tr>
        <td><a href='client?client_id=" . $participant->getClientId() . "'>" . $participant->getLastName() . ", " . $participant->getFirstName() . "</a></td>
        <td>" . $participant->getEmail() . "</td>
        <td>" . render_phone_number( $participant->getPhone() ) . "</td>
        <td class='d-none d-lg-table-cell'>" . $participant->getLastUpdate() . "</td>
        <td class='text-center'><a href='client/emergency/?client_id=" . $participant->getClientId() . "'>
        <span class='d-none d-lg-inline'>Emergency Info </span><span data-feather='phone'>Emergency</span>
        </a></td>
      </tr>
    ";
}