<?php
namespace hive2\controll\profile;

use hive2\controll\profile\Controller;
use hive2\models\RecordFactory;
use function hive2\controll\profile\getAvatar;

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
    * обрабатывает запрос на показ пользователя с соответствующим ид
    *
    * @param     int $id Ид соответвующего пользователя
    * @return    void
    */
    public function ActionIndex($id)
    {
        if ($requests = $this->user->getReqFrom()) {
            $requests = sizeof($requests);
        } else {
            $requests = "";
        }
        if (($id == $this->user->getId() || $id <= 0) || !$member = $this->dbProfile->getById($id) ) {
            $this->user = $this->dbProfile->updateMe($this->user->getId());
            $avatarName = getAvatar($this->user->getId());
            print($this->view->render(
                'profile/profile', ['globalUser' => $this->user,
                'user' => $this->user,
                'guest' => false,
                'friendReqNotify' => $requests,
                'records' => $this->user->getRecords(),
                'avatarName' => $avatarName]
            ));
        } else {
            $this->user = $this->dbProfile->updateMe($this->user->getId());
            $avatarName = getAvatar($this->user->getId());
            if(in_array($id, $this->user->getFriends()) ) {
                $relationCase = 1;
            } elseif (in_array($id, $this->user->getReqTo()) ) {
                $relationCase = 2;
            } elseif (in_array($id, $this->user->getReqFrom()) ) {
                $relationCase = 3;
            } else {
                $relationCase = 4;
            }
            print($this->view->render(
                'profile/profile', ['globalUser' => $this->user,
                'user' => $member,
                'guest' => $relationCase,
                'friendReqNotify' => $requests,
                'records' => $this->getRecords($id),
                'avatarName' => $avatarName]
            ));
        }
    }

    public function ActionConfirmFriend($id)
    {
        $this->dbProfile->addFriend($this->user, $id);
        $this->user = $this->dbProfile->updateMe($this->user->getId());
        $_SESSION['user'] = $this->user;
        header("Location:/profile/{$this->user->getId()}/friends");
    }

    public function ActionFriends($id)
    {
        $avatarName = getAvatar($this->user->getId());
        $reqRows = $this->dbProfile->getReqFrom($id);
        $reqRows = unserialize($reqRows['reqfrom']);
        $requests = [];
        if(!empty($reqRows)) {
            foreach ($reqRows as $requesterId) {
                $requests[] = $this->dbProfile->getById($requesterId);
            }
            $friendReqNotify = sizeof($requests);
        } else {
            $friendReqNotify = '';
        }

        $friendsRows = $this->dbProfile->getFriends($id);
        $friendsRows = unserialize($friendsRows['friends']);
        $friends = [];
        if(empty($friendsRows)) {
            print($this->view->render(
                'profile/friends', ['globalUser' => $this->user,
                'noFriends' => 'no friends yet',
                'user' => $this->user,
                'guest' => false,
                'requests' => $requests,
                'friendReqNotify' => $friendReqNotify,
                'avatarName' => $avatarName]
            ));
            return;
        }
        foreach ($friendsRows as $friendId) {
            $friends[] = $this->dbProfile->getById($friendId);
        }
        print($this->view->render(
            'profile/friends', ['globalUser' => $this->user,
            'members' => $friends,
            'user' => $this->user,
            'guest' => false,
            'requests' => $requests,
            'friendReqNotify' => $friendReqNotify,
            'avatarName' => $avatarName]
        ));
    }

    public function sendFriendRequest($id)
    {
        $this->dbProfile->sendFriendRequest($this->user, $id);
        $this->user = $this->dbProfile->updateMe($this->user->getId());
        $_SESSION['user'] = $this->user;
        header("Location:/profile/$id");
    }

    public function ActionPostRecord($ownerId)
    {
        $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_STRING);
        $this->dbRecords->addRecord($this->user->getId(), $this->user->getFirstName(), $ownerId, $content);
        $this->user = $this->dbProfile->updateMe($this->user->getId());
        $_SESSION['user'] = $this->user;
        print($this->view->render("profile/records",[
            'globalUser' => $this->user,
            'records' => $this->getRecords($ownerId),
            'user' =>  $this->dbProfile->getById($ownerId)
        ]));
    }

    public function ActionEdit()
    {
        $avatarName = getAvatar($this->user->getId());
        if ($requests = $this->user->getReqFrom()) {
            $requests = sizeof($requests);
        } else {
            $requests = "";
        }
        print($this->view->render(
            'profile/editProfile', ['globalUser' => $this->user,
            'user' => $this->user,
            'guest' => false,
            'friendReqNotify' => $requests,
            'avatarName' => $avatarName]
        ));
    }

    public function ActionAddComment($recordId, $locationId)
    {
        $content = filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_STRING);
        $this->dbRecords->addComment(
            $recordId, $this->user->getId(), $this->user->getFirstName(),
            $content
        );
        $this->user = $this->dbProfile->updateMe($this->user->getId());
        $_SESSION['user'] = $this->user;
        header("Location:/profile/$locationId");
    }

    public function getRecords($id)
    {
        $rows = $this->dbRecords->getRecords($id);
        return $records = RecordFactory::createRecords($rows);
    }

    public function ActionSaveEdits()
    {
        $src = $_POST['src'];
        $src = str_replace('data:image/png;base64,', '', $src);
        $src = str_replace(' ', '+', $src);
        $imgData = base64_decode($src);
        $avatarName = "{$this->user->getId()}avatar.jpg";
        file_put_contents("src/views/profile/avatars/$avatarName", $imgData);

        $name = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_STRING);
        $resume = filter_input(INPUT_POST, 'resume', FILTER_SANITIZE_STRING);
        $this->dbProfile->saveEdits($this->user->getId(), $name, $resume);
        header("Location:/profile/{$this->user->getId()}");
    }
}
