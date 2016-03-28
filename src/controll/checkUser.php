<?php
namespace hive2\controll;

use hive2\models\User;
use hive2\controll\DBActions;

require_once '../models/User.php';
require_once '../config/config.php';
require_once 'DBActions.php';

if(isset($_POST['firstName'])) {
	$db = new DBActions($dbdriver, $dbhost, $dbname, $dbusername, $dbpassword);
	$name = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_STRING);
	$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

	$row = $db->getByFirstName($name);

	if(password_verify($password, $row['password'])) {
		session_start();
		error_reporting(E_ALL);
		ini_set('display_errors', 'On');
		$user = new User($row['id'], $row['firstName'], $row['password']);
		$_SESSION['user'] = $user;

		header('Location:/hive2/src/views/profile.php');
	} else {

		header('Location:/hive2/src/views/index.php');
	}
} else {

	header('Location:/hive2/src/views/index.php');
}