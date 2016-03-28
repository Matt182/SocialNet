<?php
namespace hive2\controll;

use hive2\models\User;
use hive2\controll\DBActions;

require_once '../config/config.php';
require_once 'DBActions.php';



if(isset($_POST['firstName'])) {

	$db = new DBActions($dbdriver, $dbhost, $dbname, $dbusername, $dbpassword);

	$name = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_STRING);
	$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
	$password = password_hash($password, PASSWORD_BCRYPT);

	$db->insertUser($name, $password);
	$conn=null;
	header('Location:/hive2/src/views/index.php');
}