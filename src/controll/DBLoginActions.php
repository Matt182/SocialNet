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

	public function getById($id)
	{
		$statement = $this->conn->query("select * from members where id='$id'");
		$row = $statement->fetch(PDO::FETCH_ASSOC);
		if ($row) {
			$user = new User($row['id'], $row['firstName'],$row['email'], $row['password'], $row['resume'], $row['online'], $row['friends']);
			return $user;
		} else {
			return null;
		}
	}

	public function getByFirstName($firstName)
	{
		$statement = $this->conn->query("select * from members where firstName='$firstName'");
		$row = $statement->fetch(PDO::FETCH_ASSOC);
		return $row;
	}
	public function getByEmail($email)
	{
		$statement = $this->conn->query("select * from members where email='$email'");
		$row = $statement->fetch(PDO::FETCH_ASSOC);

		return $row;
	}

	public function setOnline($email)
	{
		$statement = $this->conn->query("update members set online='1' where email='$email'");
	}

	public function updateProfile()
	{
		return;
	}

	public function insertUser($name, $password, $email)
	{
		$friends = serialize([]);
		try {
			$result = $this->conn->exec("insert into members (firstName, password, email, friends) value ('$name', '$password', '$email','$friends')");
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
		return $result;
	}
}
