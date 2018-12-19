<?php
/**
 * StaffSidebar.php
 *
 * description
 *
 * Author: Caleb Snoozy
 * Date: 2/24/18
 */

require_once "Link.php";

/**
 * @param $links Link[]
 */
function staffSidebar( $links ) {
  echo "
    <nav class='col-md-3 col-lg-2 d-none d-md-block bg-light sidebar'>
      <div class='sidebar-sticky p-0 m-0'>
        <ul class='nav flex-column list-group list-group-flush'>";

  foreach ( $links as $link ) {
    $link->sideRender();
  }

  echo "</ul>
      </div>
    </nav>
  ";
}