<?php
namespace hive2\views\profile;

/**
 *
 */
class ProfileView
{
  function __construct()
  {

  }

  public function render($id)
  {
    $id = $id;
    require_once("profile.php");
  }
}
