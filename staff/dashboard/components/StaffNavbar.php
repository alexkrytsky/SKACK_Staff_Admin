<?php
/**
 * StaffNavbar.php
 *
 * description
 *
 * Author: Caleb Snoozy
 * Date: 2/24/18
 */

require_once 'Link.php';

/**
 * @param $links Link[]
 * @param $showSearch bool
 */
function staffNavbar( $links, $showSearch = false ) {
  echo "
    <nav class='navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 navbar-expand-md'>
      <a class='navbar-brand col-10 col-md-3 col-lg-2 mr-0' href='/staff/dashboard'>SKCAC Staff Portal</a>
      <button class='navbar-toggler col-2' type='button' data-toggle='collapse' data-target='#navbar-dropdown' aria-controls='navbar-dropdown' aria-expanded='false' aria-label='Toggle navigation'>
        <span class='navbar-toggler-icon'></span>
      </button>";
  if ( $showSearch ) {
    echo "<input id='search-bar' class='form-control form-control-dark w-100' type='text' placeholder='Search' aria-label='Search'>";
  }
  echo "<div class='collapse navbar-collapse' id='navbar-dropdown'>
        <ul class='navbar-nav px-3 d-md-none'>
    ";
  foreach ( $links as $link ) {
    $link->navRender();
  }
  echo "
        </ul>
      </div>
    </nav>
    ";
}