<?php
namespace hive2\controll\profile;
use hive2\views\profile\ProfileView;
use hive2\models\User;
use hive2\models\UserFactory;
use hive2\views\View;
use hive2\controll\DBActions;
/**
 *
 */
class ProfileController
{
  private $user;

  public function __construct()
  {
    session_start();
    if (isset($_SESSION['user'])) {
    	$this->user = $_SESSION['user'];
    } else {
      $msg = "you need to authorize";
    	print($view->render('index', ['error' => $msg]));
    }
  }

  public function ActionIndex($id)
  {
    $view = new View();
    if($id == $this->user->getId()) {
      print($view->render('profile/profile', ['user' => $this->user,
                                              'guest' => false]));
    } else {
      $db = new DBActions();
      $member = $db->getById($id);
      if($member){
        print($view->render('profile/profile', ['user' => $member,
                                                'guest' => true]));
      } else {
        print($view->render('profile/profile', ['user' => $this->user,
                                                'guest' => false]));
      }
    }
  }

  public function ActionMembers()
  {
    $view = new View();
    $db = new DBActions();
    $result = $db->getAllMembers();
    $UF = new UserFactory();
    $members = $UF->createMembers($result);
    print($view->render('profile/members', ['members' => $members]));
  }

  public function ActionAddFriend($id)
  {
    $db = new DBActions();
    $db->addFrined($this->user, $id);
    header("Location:/hive2/profile/$id");
  }

  public function ActionFriends($id)
  {
    $view = new View();
    $db = new DBActions();
    $result = $db->getFriends($id);
    $result = unserialize($result['friends']);
    $friends = [];
    $UF = new UserFactory();
    if(empty($result)) {
      print($view->render('profile/friends', ['empty' => 'no friends yet']));
      return;
    }
    foreach ($result as $friendId) {
      $friends[] = $db->getById($friendId);
    }
    print($view->render('profile/friends', ['members' => $friends]));
  }
}
