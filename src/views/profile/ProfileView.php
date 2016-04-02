<?php
namespace hive2\views\profile;

/**
 *
 */
class ProfileView
{
  private $user;
  function __construct($user)
  {
    $this->user = $user;
  }

  public function render($id)
  {
    require_once("profile.php");
  }
}
