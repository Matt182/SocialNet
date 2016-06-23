<?php
namespace hive2\controll\profile;
use hive2\controll\profile\DBActions\DBProfileActions;
use hive2\models\User;

/**
 * Logout controller
 */
class LogoutController
{
    private $db;

    public function __construct(DBProfileActions $db)
    {
        $this->db = $db;
    }

    /**
     * logouts user
     * @return    void
     */
    public function index()
    {
        $user = $_SESSION['user'];

        $this->db->setOffline($user->getId());
        $this->db->setWasOnline($user->getId());

        $_SESSION = array();
        if (session_id() != "" || isset($_COOKIE[session_name()])) {
            setcookie(session_name(), '', time()-2592000, '/');
        }

        session_destroy();

        header('Location:/login');
    }
}
