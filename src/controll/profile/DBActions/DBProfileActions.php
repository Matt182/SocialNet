<?php
namespace hive2\controll\profile\DBActions;

use PDO;
use hive2\controll\DB;
use hive2\config\Config;
use hive2\models\User;
use hive2\models\RecordFactory;
use hive2\controll\profile\DBActions\interfaces\DBProfileActionsInterface;

/**
 * Class working with members data base
 *
 */
class DBProfileActions extends DB implements DBProfileActionsInterface
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getFirstName($id)
    {
        $statement = $this->conn->query("select first_name from $this->dbname.members where id ='$id'");
        if (!$statement) {
            return;
        }
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        return $row['first_name'];
    }

    public function getComments($id)
    {
        $statement = $this->conn->query("select * from $this->dbname.comments where record_id ='$id'");
        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
        if(!$rows) {
            $rows = [];
        }
        return $rows;
    }

    public function updateMe($id)
    {
        $statement = $this->conn->query("select * from $this->dbname.members where id='$id'");
        $userRow = $statement->fetch(PDO::FETCH_ASSOC);
        $statement = $this->conn->query("select * from $this->dbname.blog_records where owner_id='$id' order by created desc");
        $recordRows = $statement->fetchAll(PDO::FETCH_ASSOC);
        for ($i=0; $i < sizeof($recordRows); $i++) {
            $recordRows[$i]['comments'] = $this->getComments($recordRows[$i]['id']);
        }
        $records = RecordFactory::createRecords($recordRows, $this);

        $user = new User(
            $userRow['id'], $userRow['first_name'], $userRow['email'],
            $userRow['resume'], $userRow['online'],
            $userRow['was_online'], $userRow['friends'], $userRow['req_to'],
            $userRow['req_from'], $records
        );
        return $user;
    }

    public function getById($id)
    {
        $statement = $this->conn->query("select * from $this->dbname.members where id='$id'");
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $user = new User($row['id'], $row['first_name'], $row['email'],$row['resume'],
            $row['online'], $row['was_online'], $row['friends'], $row['req_to'], $row['req_from']);
            return $user;
        } else {
            return null;
        }
    }

    public function getAllMembers()
    {
        $statement = $this->conn->query("select * from $this->dbname.members limit 100");
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function addFriend($user, $memberId)
    {
        $this->conn->beginTransaction();
        try {
            $friends = $user->getFriends();
            $friends[] = $memberId;
            $friends = serialize($friends);
            $statement = $this->conn->query("update $this->dbname.members set friends='$friends' where id='{$user->getId()}'");

            $member = $this->getById($memberId);
            $friends = $member->getFriends();
            $friends[] = $user->getId();
            $friends = serialize($friends);
            $statement = $this->conn->query("update $this->dbname.members set friends='$friends' where id='$memberId'");

            $reqFrom = $user->getReqFrom();
            $key = array_search($memberId, $reqFrom);
            unset($reqFrom[$key]);
            $reqFrom = serialize($reqFrom);
            $statement = $this->conn->query("update $this->dbname.members set req_from='$reqFrom' where id='{$user->getId()}'");

            $reqTo = $member->getReqTo();
            $key = array_search($user->getId(), $reqTo);
            unset($reqTo[$key]);
            $reqTo = serialize($reqTo);
            $statement = $this->conn->query("update $this->dbname.members set req_to='$reqTo' where id='$memberId'");

            $this->conn->commit();
        } catch (Exception $e) {
            echo $e->getMessage();
            $this->conn->rollBack();
        }
    }

    public function sendFriendRequest($user, $memberId)
    {
        $this->conn->beginTransaction();
        try {
            $reqTo = $user->getReqTo();
            $reqTo[] = $memberId;
            $reqTo = serialize($reqTo);
            $statement = $this->conn->query("update $this->dbname.members set req_to='$reqTo' where id='{$user->getId()}'");
            $reqFrom = $this->getById($memberId)->getReqFrom();
            $reqFrom[] = $user->getId();
            $reqFrom = serialize($reqFrom);
            $statement = $this->conn->query("update $this->dbname.members set req_from='$reqFrom' where id='$memberId'");

            $this->conn->commit();
        } catch (Exception $e) {
            echo $e->getMessage();
            $this->conn->rollBack();
        }
    }

    public function getFriends($id)
    {
        $statement = $this->conn->query("select friends from $this->dbname.members where id='$id'");
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        return $row;
    }

    public function getReqFrom($id)
    {
        $statement = $this->conn->query("select req_from from $this->dbname.members where id='$id'");
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        return $row;
    }

    public function setOffline($id)
    {
        $statement = $this->conn->query("update $this->dbname.members set online='0' where id='$id'");
    }

    public function setWasOnline($id)
    {
        $statement = $this->conn->query("update $this->dbname.members set was_online=now() where id='$id'");
    }

    public function saveEdits($id, $name, $resume)
    {
        $this->conn->query("update $this->dbname.members set first_name='$name', resume='$resume' where id='$id'");
    }
}
