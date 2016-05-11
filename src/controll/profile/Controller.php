<?php
namespace hive2\controll\profile;

use hive2\views\profile\ProfileView;
use hive2\models\User;
use hive2\models\UserFactory;
use hive2\views\View;
use hive2\controll\profile\DBProfileActions;
use hive2\controll\profile\Controller;

/**
 * Базовый класс контроллеров работающих с авторизованым пользователем


 */
class Controller
{
  /** @var User $user contains authorized User object */
  protected $user;
  /** @var DBProfileActions $db contains db connection */
  protected $db;
  protected $view;
  protected $login;

  protected function __construct()
  {
    if (isset($_SESSION['user'])) {
    	$this->user = $_SESSION['user'];
      $this->view = new View();
      $this->db = new DBProfileActions();
      $this->login = true;
    } else {
      $this->login = false;
      $msg = "you need to authorize";
      $view = new View();
    	print($view->render('index', ['error' => $msg]));
    }
  }

  public function isLogin()
  {
    return $this->login;
  }
}
