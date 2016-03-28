<?php
namespace hive2\controll;

use hive2\models\User;
use hive2\controll\DBActions;

require_once '../../models/User.php';
require_once '../../config/config.php';
require_once '../DBActions.php';

$msg = "";
if(isset($_POST['email']) && $_POST['email'] != "") {
	$db = new DBActions($dbdriver, $dbhost, $dbname, $dbusername, $dbpassword);
	$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
	$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

	$row = $db->getByEmail($email);

	if(password_verify($password, $row['password'])) {
		session_start();
		$user = new User($row['id'], $row['firstName'],$row['email'], $row['password'], $row['resume']);
		$_SESSION['user'] = $user;
		$db->setOnline($email);
		header('Location:/hive2/src/views/profile.php');
	} else {
		$msg = "Wrong password or login";
		header("Location:/hive2/src/views/index.php?msg=$msg");
	}
} else {
	$msg = "Please enter data";
	header("Location:/hive2/src/views/index.php?msg=$msg");
}