<?php
namespace hive2\controll\profile;

use hive2\views\profile\ProfileView;
use hive2\models\User;
use hive2\models\UserFactory;
use hive2\views\View;
use hive2\controll\profile\DBActions\DBProfileActions;
use hive2\controll\profile\DBActions\interfaces\DBProfileActionsInterface;
use hive2\controll\profile\DBActions\interfaces\DBRecordsActionsInterface;
use hive2\controll\profile\DBActions\DBRecordsActions;

/**
* Base controller class
*/
abstract class Controller
{
    /** @var User $user contains authorized User object */
    protected $user;

    /** @var DBProfileActions $dbProfile contains db of users connection */
    protected $dbProfile;

    /** @var DBRecordsActions $dbRecords contains db of records connection */
    protected $dbRecords;

    /** @var View $view contains View object */
    protected $view;

    /**  @var boolval $login */
    protected $login;

    public function __construct(
        DBProfileActionsInterface $DBProfileActions,
        DBRecordsActionsInterface $DBRecordsActions,
        View $view)
    {
        $this->user = $_SESSION['user'];
        $this->view = $view;
        $this->dbProfile = $DBProfileActions;
        $this->dbRecords = $DBRecordsActions;
        $this->login = true;
    }

    public function isLogin()
    {
        return $this->login;
    }

    abstract public function index($arg);
}
