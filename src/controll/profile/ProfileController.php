<?php
namespace hive2\controll\profile;

use hive2\controll\profile\Controller;
use hive2\controll\profile\DBRecordsActions;
use hive2\models\RecordFactory;

/**
 * Контроллер отвечает за оброботку запроса на показ страници пользователя
 */
class ProfileController extends Controller
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
    if ( ($id == $this->user->getId() || $id <= 0) || !$member = $this->db->getById($id) ) {
      print($this->view->render('profile/profile', ['globalUser' => $this->user,
                                                    'user' => $this->user,
                                                    'guest' => 0,
                                                    'friendReqNotify' => $requests,
                                                    'records' => $this->user->getRecords()]));
    } else {
      $this->user = $this->db->updateMe($this->user->getId());
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
    $DBrec = new DBRecordsActions();
    $rows = $DBrec->getRecords($id);
    return $records = RecordFactory::createRecords($rows);
  }

  public function ActionPostRecord()
  {
    $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_STRING);
    $DBrec = new DBRecordsActions();
    $DBrec->addRecord($this->user->getId(), $content);
    $this->user = $this->db->updateMe($this->user->getId());
    $_SESSION['user'] = $this->user;
    header("Location:/hive2/profile/{$this->user->getId()}");
  }
}
