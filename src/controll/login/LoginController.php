<?php
namespace hive2\controll\login;

use hive2\models\User;
use hive2\controll\DBActions;

//require_once '../../../vendor/autoload.php';
require_once "{$_SERVER['DOCUMENT_ROOT']}/hive2/vendor/autoload.php";


class LoginController implements LoginInterface
{
	private $email;
	private $password;
	private $db;
	private $user;

	public function __construct($email, $pass)
	{
		$this->email = $email;
		$this->password = $pass;
		$this->db = new DBActions();
	}

	public function isUserRegistred()
	{
		$row = $this->db->getByEmail($this->email);
		if(password_verify($this->password, $row['password'])) {
			$this->db->setOnline($this->email);
			$row = $this->db->getByEmail($this->email);
			$this->user = new User($row['id'], $row['firstName'],$row['email'], $row['password'], $row['resume'], $row['online']);
			return true;
		} else {
			return false;
		}
	}

	public function getUser()
	{
		return $this->user;
	}

}
/*
if(isset($_POST['email']) && $_POST['email'] != "") {
	$db = new DBActions();
	$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
	$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

	$row = $db->getByEmail($email);

	if(password_verify($password, $row['password'])) {
		session_start();
		$db->setOnline($email);
		$row = $db->getByEmail($email);
		$user = new User($row['id'], $row['firstName'],$row['email'], $row['password'], $row['resume'], $row['online']);
		$_SESSION['user'] = $user;
		header("Location:/hive2/src/views/profile.php?user={$row['id']}");
	} else {
		$msg = "Wrong password or login";
		header("Location:/hive2/src/views/index.php?msg=$msg");
	}
} else {
	$msg = "Please enter data";
	header("Location:/hive2/src/views/index.php?msg=$msg");
}
*/
