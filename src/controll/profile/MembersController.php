<?php
namespace hive2\controll\profile;

use hive2\models\UserFactory;
use hive2\controll\profile\Controller;

class MembersController extends Controller
{

  private static $instance = null;

  public static function getInstance()
  {
    if (is_null(self::$instance)) {
      self::$instance = new self();
    }
      return self::$instance;
  }

  protected function __construct()
  {
    session_start();
    parent::__construct();
  }

  public function ActionIndex()
  {
    $result = $this->db->getAllMembers();
    if (sizeof($this->user->getReqFrom())) {
      $requests = sizeof($this->user->getReqFrom());
    } else {
      $requests = "";
    }
    $UF = new UserFactory();
    $members = $UF->createMembers($result);
    print($this->view->render('profile/members', ['globalUser' => $this->user,
                                                  'members' => $members,
                                                  'user' => $this->user,
                                                  'friendReqNotify' => $requests]));
  }

}
