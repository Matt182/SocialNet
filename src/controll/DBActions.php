<?php
namespace hive2\controll;

use hive2\controll\DBActionsInterface;
use PDO;

require_once 'DBActionsInterface.php';

class DBActions implements DBActionsInterface
{
	private $conn = null;
	
	function __construct($dbdriver, $dbhost, $dbname, $dbusername, $dbpassword)
	{
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
		return $row;
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

	public function setOffline($email)
	{
		$statement = $this->conn->query("update members set online='0' where email='$email'");
	}

	public function updateProfile()
	{

	}

	public function insertUser($name, $password, $email)
	{
		try {
		$result = $this->conn->exec("insert into members (firstName, password, email) value ('$name', '$password', '$email')");
	} catch (PDOException $e) {
		echo $e->getMessage();
	}
	}
}