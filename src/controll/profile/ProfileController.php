<?php
namespace hive2\controll\profile;
use hive2\views\profile\ProfileView;
use hive2\models\User;
use hive2\views\View;
/**
 *
 */
class ProfileController
{
  private $user;

  function __construct()
  {
    $view = new View();
    session_start();
    if (isset($_SESSION['user'])) {
    	$this->user = $_SESSION['user'];
      print($view->render('profile/profile', ['user' => $this->user]));
    } else {

      $msg = 'you need to authorize';
    	print($view->render('index', ['error' => $msg]));
    }
  }

  public function ActionIndex()
  {
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);
    $view = new ProfileView();
    $view->render($id);
  }

  public function ActionLogout()
  {
    require_once('logout.php');
  }
}
