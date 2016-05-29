<?php
namespace hive2\controll\profile;

use hive2\models\UserFactory;
use hive2\controll\profile\Controller;

class MembersController extends Controller
{
    public function __construct($dbProfile, $dbRecords)
    {
        session_start();
        parent::__construct($dbProfile, $dbRecords);
    }

    public function ActionIndex()
    {
        $result = $this->dbProfile->getAllMembers();
        if (sizeof($this->user->getReqFrom())) {
            $requests = sizeof($this->user->getReqFrom());
        } else {
            $requests = "";
        }
        $UF = new UserFactory();
        $members = $UF->createMembers($result);
        print($this->view->render(
            'profile/members', ['globalUser' => $this->user,
            'members' => $members,
            'user' => $this->user,
            'friendReqNotify' => $requests]
        ));
    }

}
