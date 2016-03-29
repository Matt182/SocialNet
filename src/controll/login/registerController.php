<?php
namespace hive2\controll;

use hive2\models\User;
use hive2\controll\DBActions;

require_once '../../../vendor/autoload.php';
//require_once '../../config/config.php';

if(isset($_POST['firstName'])) {

	$db = new DBActions();

	$name = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_STRING);
	$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
	$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
	$password = password_hash($password, PASSWORD_BCRYPT);

	$result = $db->insertUser($name, $password, $email);
	if ($result == 0) {
		$msg = "$email is already exists";
		$conn=null;
		header("Location:/hive2/src/views/register.php?msg=$msg");
	} else {
		$msg = "regestration completed by $name";
		$conn=null;
		header("Location:/hive2/src/views/index.php?msg=$msg");
	}
	
}