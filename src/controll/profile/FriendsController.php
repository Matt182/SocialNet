<?php
namespace hive2\controll\profile;

class FriendsController extends Controller
{

  private static $instance = null;

  public static function getInstance($dbProfile, $dbRecords)
  {
    if (is_null(self::$instance)) {
      self::$instance = new self($dbProfile, $dbRecords);
    }
      return self::$instance;
  }

  protected function __construct($dbProfile, $dbRecords)
  {
    parent::__construct($dbProfile, $dbRecords);
  }

  public function ActionConfirmFriend($id)
  {
    $this->dbProfile->addFriend($this->user, $id);
    $this->user = $this->dbProfile->updateMe($this->user->getId());
    $_SESSION['user'] = $this->user;
    header("Location:/hive2/profile/{$this->user->getId()}/friends");
  }

  public function ActionIndex($id)
  {
    $reqRows = $this->dbProfile->getReqFrom($id);
    $reqRows = unserialize($reqRows['reqFrom']);
    $requests = [];
    if(!empty($reqRows)) {
      foreach ($reqRows as $requesterId) {
        $requests[] = $this->db->getById($requesterId);
      }
      $friendReqNotify = sizeof($requests);
    } else {
      $friendReqNotify = '';
    }

    $friendsRows = $this->dbProfile->getFriends($id);
    $friendsRows = unserialize($friendsRows['friends']);
    $friends = [];
    if(empty($friendsRows)) {
      print($this->view->render('profile/friends', ['globalUser' => $this->user,
                                                    'noFriends' => 'no friends yet',
                                                    'user' => $this->user,
                                                    'requests' => $requests,
                                                    'friendReqNotify' => $friendReqNotify]));
      return;
    }
    foreach ($friendsRows as $friendId) {
      $friends[] = $this->dbProfile->getById($friendId);
    }
    print($this->view->render('profile/friends', ['globalUser' => $this->user,
                                                  'members' => $friends,
                                                  'user' => $this->user,
                                                  'requests' => $requests,
                                                  'friendReqNotify' => $friendReqNotify]));
  }

  public function sendFriendRequest($id) {
    $this->dbProfile->sendFriendRequest($this->user, $id);
    $this->user = $this->dbProfile->updateMe($this->user->getId());
    $_SESSION['user'] = $this->user;
    header("Location:/hive2/profile/$id");
  }
}
