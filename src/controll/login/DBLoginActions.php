<?php
namespace hive2\controll\login;

use hive2\controll\login\DBLoginActionsInterface;
use PDO;
use hive2\config\Config;
use hive2\models\User;

require_once 'DBLoginActionsInterface.php';
/**
 * Class with methods to interact with DB on login and authoriztion phase
 *
 */
class DBLoginActions implements DBLoginActionsInterface
{
	/** @var PDO $conn contains PDO connection to DB*/
	private $conn;

	/**
	 * creates PDO connection
	 *
	 * @param     void
	 * @return    void
	 */
	function __construct()
	{
		$dbdriver = Config::getDBDriver();
		$dbhost = Config::getDBHost();
		$dbname = Config::getDBName();
		$dbusername = Config::getDBUsername();
		$dbpassword = Config::getDBPass();
		try{
			$this->conn = new PDO("$dbdriver:host=$dbhost;dbname=$dbname", $dbusername, $dbpassword);
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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

	/**
	 * Get records rows of user with appropriate id
	 *
	 * @param     int $id
	 * @return    array $rows
	 */
	public function getRecords($id)
  {
    $statement = $this->conn->query("select * from blog_records where owner_id ='$id' order by created desc");
    $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
		file_put_contents('log.txt', print_r($rows, true), FILE_APPEND);
		for ($i=0; $i < sizeof($rows); $i++) {
			file_put_contents('log.txt', print_r($rows[$i]['id'], true), FILE_APPEND);
			$rows[$i]['comments'] = $this->getComments($rows[$i]['id']);

		}
    return $rows;
  }

	/**
	 * Get user row by email
	 *
	 * @param     string $email
	 * @return    array $row
	 */
	public function getByEmail($email)
	{
		$statement = $this->conn->query("select * from members where email='$email'");
		$row = $statement->fetch(PDO::FETCH_ASSOC);
		$row['records'] = $this->getRecords($row['id']);
		return $row;
	}

	/**
	 * Set user online with appropriate id
	 *
	 * @param     string $email
	 * @return    void
	 */
	public function setOnline($email)
	{
		$statement = $this->conn->query("update members set online='1' where email='$email'");
	}

	/**
	 * Insert newly registered user into DB
	 *
	 * @param     string $name
	 * @param			string $password
	 * @param			string $email
	 * @return    int $result 0 - something wrong, 1 - user inserted
	 */
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
