<?php
namespace hive2\controll;

use hive2\controll\DBLoginActionsInterface;
use PDO;
use hive2\config\Config;
use hive2\models\User;

require_once 'DBLoginActionsInterface.php';

class DBLoginActions implements DBLoginActionsInterface
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


	public function getRecords($id)
  {
    $statement = $this->conn->query("select * from blog_records where author='$id'");
    $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
  }

	public function getByEmail($email)
	{
		$statement = $this->conn->query("select * from members where email='$email'");
		$row = $statement->fetch(PDO::FETCH_ASSOC);
		$row['records'] = $this->getRecords($row['id']);
		return $row;
	}

	public function setOnline($email)
	{
		$statement = $this->conn->query("update members set online='1' where email='$email'");
	}


	public function insertUser($name, $password, $email)
	{
		$friends = serialize([]);
		$reqTo = serialize([]);
		$reqFrom = serialize([]);
		try {
			$result = $this->conn->exec("insert into members (firstName, password, email, friends, reqTo, reqFrom) value ('$name', '$password', '$email','$friends','$reqTo','$reqFrom')");
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
		return $result;
	}
}
