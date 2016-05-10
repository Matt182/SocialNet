<?php
namespace hive2\controll\profile;

/**
 * НЕ используется на этот момент
 *
 * @param
 * @return    void
 * @author
 * @copyright
 */
class Controller
{

  private $user;
  private $db;
  private $view;
  private static $instance = null;

  public static function getInstance()
  {
    if (is_null(self::$instance)) {
      self::$instance = new self();
    }
      return self::$instance;
  }

  private function __construct()
  {
    session_start();
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
}
