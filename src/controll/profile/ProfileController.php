<?php
namespace hive2\controll\profile;
use hive2\views\profile\ProfileView;
/**
 *
 */
class ProfileController
{
  private $user;

  function __construct()
  {
    session_start();
    if (isset($_SESSION['user'])) {
    	$this->user = $_SESSION['user'];
    } else {
    	header('Location:/hive2/login?msg=You need to authorize');
    }
  }

  public function ActionIndex($id)
  {
    $view = new ProfileView($this->user);
    $view->render($id);
  }

  public function ActionLogout()
  {
    require_once('logout.php');
  }
}
