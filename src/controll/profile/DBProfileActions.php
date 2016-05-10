<?php
namespace hive2\controll\profile;

use PDO;
use hive2\config\Config;
use hive2\models\User;


class DBProfileActions
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

  public function getById($id)
  {
    $statement = $this->conn->query("select * from members where id='$id'");
    $row = $statement->fetch(PDO::FETCH_ASSOC);
    if ($row) {
      $user = new User($row['id'], $row['firstName'],$row['email'], $row['password'], $row['resume'], $row['online'], $row['friends'], $row['reqTo'], $row['reqFrom']);
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
      //$file = fopen('C:\\xampp\\htdocs\\hive2\\src\\controll\\profile\\log.txt', 'w');
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
      die();
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

  public function setOffline($email)
  {
    $statement = $this->conn->query("update members set online='0' where email='$email'");
  }
}
