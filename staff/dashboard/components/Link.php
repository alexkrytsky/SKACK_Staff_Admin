<?php
/**
 * Link.php
 *
 * description
 *
 * Author: Caleb Snoozy
 * Date: 2/24/18
 */

class Link {
  private $name;
  private $href;
  private $icon;
  private $active;

  /**
   * Link constructor.
   * @param $name string
   * @param $href string
   * @param $icon string
   * @param $active bool
   */
  public function __construct( $name = "Default", $href = "#", $icon = "add", $active = false ) {
    $this->name = $name;
    $this->href = $href;
    $this->icon = $icon;
    $this->active = $active;
  }

  public function navRender() {
    echo "
      <li class='nav-item'>
        <a class='nav-link " . ( $this->active ? "active" : "" ) . "' href='$this->href'>
          <span data-feather='$this->icon'></span>
          $this->name " . ( $this->active ? "<span class='sr-only'>(current)</span>" : "" ) . "
        </a>
      </li>
    ";
  }

  public function sideRender() {
    echo "
      <li class='nav-item list-group-item p-0 bg-light border-right'>
        <a class='nav-link p-2 " . ( $this->active ? "active" : "" ) . "' href='$this->href'>
          <span data-feather='$this->icon'></span>
          $this->name " . ( $this->active ? "<span class='sr-only'>(current)</span>" : "" ) . "
        </a>
      </li>
    ";
  }
}