<?php
namespace hive2\controll\profile;

use hive2\controll\profile\Controller;
use hive2\models\RecordFactory;

/**
 * Контроллер отвечает за оброботку запроса на показ страници пользователя
 */
class ProfileController extends Controller
{

  public function __construct($dbProfile, $dbRecords)
  {
    session_start();
    parent::__construct($dbProfile, $dbRecords);
  }

  /**
   *
   * обрабатывает запрос на показ пользователя с соответствующим ид
   *
   * @param int $id Ид соответвующего пользователя
   * @return void
   * @author matt
   * @copyright matt
   */
   public function ActionIndex($id)
   {
    if ($requests = $this->user->getReqFrom()) {
      $requests = sizeof($requests);
    } else {
      $requests = "";
    }
    //file_put_contents('log.txt', print_r($this->user, true));
    if ( ($id == $this->user->getId() || $id <= 0) || !$member = $this->dbProfile->getById($id) ) {
      print($this->view->render('profile/profile', ['globalUser' => $this->user,
                                                    'user' => $this->user,
                                                    'guest' => 0,
                                                    'friendReqNotify' => $requests,
                                                    'records' => $this->user->getRecords()]));
    } else {
      $this->user = $this->dbProfile->updateMe($this->user->getId());
      if( in_array($id, $this->user->getFriends()) ) {
        $relationCase = 1;
      } elseif ( in_array($id, $this->user->getReqTo()) ) {
        $relationCase = 2;
      } elseif ( in_array($id, $this->user->getReqFrom()) ) {
        $relationCase = 3;
      } else {
        $relationCase = 4;
      }
      print($this->view->render('profile/profile', ['globalUser' => $this->user,
                                                    'user' => $member,
                                                    'guest' => $relationCase,
                                                    'friendReqNotify' => $requests,
                                                    'records' => $this->getRecords($id)]));
    }
  }

  public function getRecords($id)
  {
    $rows = $this->dbRecords->getRecords($id);
    return $records = RecordFactory::createRecords($rows);
  }

  public function ActionPostRecord($ownerId)
  {
    $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_STRING);
    $this->dbRecords->addRecord($this->user->getId(), $this->user->getFirstName(), $ownerId, $content);
    $this->user = $this->dbProfile->updateMe($this->user->getId());
    $_SESSION['user'] = $this->user;
    header("Location:/hive2/profile/$ownerId");
  }

  public function ActionEdit()
  {
    if ($requests = $this->user->getReqFrom()) {
      $requests = sizeof($requests);
    } else {
      $requests = "";
    }
    print($this->view->render('profile/editProfile', ['globalUser' => $this->user,
                                                      'user' => $this->user,
                                                      'friendReqNotify' => $requests]));
  }

  public function ActionAddComment($recordId, $locationId)
  {
    $content = filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_STRING);
    $this->dbRecords->addComment($recordId, $this->user->getId(), $this->user->getFirstName(),
                                  $content);
    $this->user = $this->dbProfile->updateMe($this->user->getId());
    $_SESSION['user'] = $this->user;
    header("Location:/hive2/profile/$locationId");
  }
}
