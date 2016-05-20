<?php
namespace hive2\controll\profile\DBActions;

use PDO;
use hive2\config\Config;
use hive2\models\User;
use hive2\models\RecordFactory;
use hive2\controll\profile\DBActions\interfaces\DBProfileActionsInterface;

class DBProfileActions implements DBProfileActionsInterface
{
  private $conn;

  function __construct()
  {
    $dbdriver = Config::getDBDriver();
    $dbhost = Config::getDBHost();
    $dbname = Config::getDBName();
    $dbusername = Config::getDBUsername();
    $dbpassword = Config::getDBPass();
    try{
      $this->conn = new PDO("$dbdriver:host=$dbhost;dbname=$dbname", $dbusername, $dbpassword);
    } catch(PDOException $e) {
      echo $e->getMessage();
    }
  }

  public function getComments($id)
	{
		$statement = $this->conn->query("select * from comments where record_id ='$id'");
		$rows = $statement->fetchAll(PDO::FETCH_ASSOC);
		if(!$rows) {
			$rows = [];
		}
		return $rows;
	}

  public function updateMe($id)
  {
    $statement = $this->conn->query("select * from members where id='$id'");
    $userRow = $statement->fetch(PDO::FETCH_ASSOC);
    $statement = $this->conn->query("select * from blog_records where owner_id='$id' order by created desc");
    $recordRows = $statement->fetchAll(PDO::FETCH_ASSOC);
    for ($i=0; $i < sizeof($recordRows); $i++) {
      $recordRows[$i]['comments'] = $this->getComments($recordRows[$i]['id']);
    }
    $records = RecordFactory::createRecords($recordRows);

    $user = new User($userRow['id'], $userRow['firstName'],$userRow['email'],
            $userRow['password'], $userRow['resume'], $userRow['online'],
            $userRow['wasOnline'], $userRow['friends'], $userRow['reqTo'],
            $userRow['reqFrom'], $records);
    return $user;
  }

  public function getById($id)
  {
    $statement = $this->conn->query("select * from members where id='$id'");
    $row = $statement->fetch(PDO::FETCH_ASSOC);
    if ($row) {
      $user = new User($row['id'], $row['firstName'],$row['email'], $row['password'], $row['resume'], $row['online'], $row['wasOnline'], $row['friends'], $row['reqTo'], $row['reqFrom']);
      return $user;
    } else {
      return null;
    }
  }

  public function getAllMembers()
  {
    $statement = $this->conn->query("select * from members limit 100");
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
      $statement = $this->conn->query("update members set friends='$friends' where id='{$user->getId()}'");

      $member = $this->getById($memberId);
      $friends = $member->getFriends();
      $friends[] = $user->getId();
      $friends = serialize($friends);
      $statement = $this->conn->query("update members set friends='$friends' where id='$memberId'");

      $reqFrom = $user->getReqFrom();
      $key = array_search($memberId, $reqFrom);
      unset($reqFrom[$key]);
      $reqFrom = serialize($reqFrom);
      $statement = $this->conn->query("update members set reqFrom='$reqFrom' where id='{$user->getId()}'");

      $reqTo = $member->getReqTo();
      $key = array_search($user->getId(), $reqTo);
      unset($reqTo[$key]);
      $reqTo = serialize($reqTo);
      $statement = $this->conn->query("update members set reqTo='$reqTo' where id='$memberId'");

      $this->conn->commit();
    } catch (Exception $e) {
      echo $e->getMessage();
      $this->conn->rollBack();
    }
  }

  public function sendFriendRequest($user, $memberId) {
    $this->conn->beginTransaction();
    try {
      $reqTo = $user->getReqTo();
      $reqTo[] = $memberId;
      $reqTo = serialize($reqTo);
      $statement = $this->conn->query("update members set reqTo='$reqTo' where id='{$user->getId()}'");
      $reqFrom = $this->getById($memberId)->getReqFrom();
      $reqFrom[] = $user->getId();
      $reqFrom = serialize($reqFrom);
      $statement = $this->conn->query("update members set reqFrom='$reqFrom' where id='$memberId'");

      $this->conn->commit();
    } catch (Exception $e) {
      echo $e->getMessage();
      $this->conn->rollBack();
    }
  }

  public function getFriends($id)
  {
    $statement = $this->conn->query("select friends from members where id='$id'");
    $row = $statement->fetch(PDO::FETCH_ASSOC);
    return $row;
  }

  public function getReqFrom($id)
  {
    $statement = $this->conn->query("select reqFrom from members where id='$id'");
    $row = $statement->fetch(PDO::FETCH_ASSOC);
    return $row;
  }

  public function setOffline($id)
  {
    $statement = $this->conn->query("update members set online='0' where id='$id'");
  }

  public function setWasOnline($id)
  {
    $statement = $this->conn->query("update members set wasOnline=now() where id='$id'");
  }
}