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
        $friendInfo;
        if( in_array($id, $this->user->getFriends()) ) {
          $friendInfo = "<p>Your friend</p>";
        } elseif ( in_array($id, $this->user->getReqTo()) ) {
          $friendInfo = "<p>Friend request sended</p>";
        } elseif ( in_array($id, $this->user->getReqFrom()) ) {
          $friendInfo = "<p><a href = '$id/confirmFriendReq'>Confirm requst</a></p>";
        } else {
          $friendInfo = "<p><a href = '$id/sendFriendReq'>Send requst</a></p>";
        }
        print($this->view->render('profile/profile', ['globalUser' => $this->user,
                                                      'user' => $member,
                                                      'guest' => true,
                                                      'friendInfo' => $friendInfo]));
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

  public function ActionConfirmFriend($id)
  {
    $this->db->addFriend($this->user, $id);
    $this->user = $this->db->getById($this->user->getId());
    $_SESSION['user'] = $this->user;
    header("Location:/hive2/profile/$id");
  }

  public function ActionFriends($id)
  {
    $reqRows = $this->db->getReqFrom($id);
    $reqRows = unserialize($reqRows['reqFrom']);
    $requests = [];
    if(!empty($reqRows)) {
      foreach ($reqRows as $requesterId) {
        $requests[] = $this->db->getById($requesterId);
      }
    }

    $friendsRows = $this->db->getFriends($id);
    $friendsRows = unserialize($friendsRows['friends']);
    $friends = [];
    if(empty($friendsRows)) {
      print($this->view->render('profile/friends', ['globalUser' => $this->user,
                                                    'noFriends' => 'no friends yet',
                                                    'user' => $this->user,
                                                    'requests' => $requests]));
      return;
    }
    foreach ($friendsRows as $friendId) {
      $friends[] = $this->db->getById($friendId);
    }
    print($this->view->render('profile/friends', ['globalUser' => $this->user,
                                                  'members' => $friends,
                                                  'user' => $this->user,
                                                  'requests' => $requests]));
  }

  public function sendFriendRequest($id) {
    $this->db->sendFriendRequest($this->user, $id);
    $this->user = $this->db->getById($this->user->getId());
    $_SESSION['user'] = $this->user;
    header("Location:/hive2/profile/$id");
  }
}
