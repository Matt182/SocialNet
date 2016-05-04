<?php
namespace hive2\controll\profile;
use hive2\views\profile\ProfileView;
use hive2\models\User;
use hive2\models\UserFactory;
use hive2\views\View;
use hive2\controll\profile\DBProfileActions;
/**
 *
 */
class ProfileController
{
  private $user;
  private $db;
  private $view;

  public function __construct()
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
  public function isLogin()
  {
    return $this->login;
  }

  public function ActionIndex($id)
  {
    if ($id < 0) {
      return;
    }
    if($id == $this->user->getId()) {
      print($this->view->render('profile/profile', ['globalUser' => $this->user,
                                                    'user' => $this->user,
                                                    'guest' => false]));
    } else {
      $member = $this->db->getById($id);
      if($member){
        print($this->view->render('profile/profile', ['globalUser' => $this->user,
                                                      'user' => $member,
                                                      'guest' => true]));
      } else {
        print($this->view->render('profile/profile', ['globalUser' => $this->user,
                                                      'user' => $this->user,
                                                      'guest' => false]));
      }
    }
  }

  public function ActionMembers()
  {
    $result = $this->db->getAllMembers();
    $UF = new UserFactory();
    $members = $UF->createMembers($result);
    print($this->view->render('profile/members', ['globalUser' => $this->user,
                                                  'members' => $members,
                                                  'user' => $this->user]));
  }

  public function ActionAddFriend($id)
  {
    $this->db->addFrined($this->user, $id);
    header("Location:/hive2/profile/$id");
  }

  public function ActionFriends($id)
  {
    $result = $this->db->getFriends($id);
    $result = unserialize($result['friends']);
    $friends = [];
    $UF = new UserFactory();
    if(empty($result)) {
      print($this->view->render('profile/friends', ['globalUser' => $this->user,
                                                    'empty' => 'no friends yet',
                                                    'user' => $this->user]));
      return;
    }
    foreach ($result as $friendId) {
      $friends[] = $this->db->getById($friendId);
    }
    print($this->view->render('profile/friends', ['globalUser' => $this->user,
                                                  'members' => $friends,
                                                  'user' => $this->user]));
  }
}
