<?php
namespace hive2\controll\login;

use hive2\controll\login\LoginController;
require_once "{$_SERVER['DOCUMENT_ROOT']}/hive2/vendor/autoload.php";

$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

if(isset($email) && $email != "") {
	$loginController = new LoginController($email, $password);
	if($password != "" && $loginController->isUserRegistred()) {
		session_start();
		$user = $loginController->getUser();
		$_SESSION['user'] = $user;
		header("Location:/hive2/src/views/profile.php?user={$user->getId()}");
	} else {
		$msg = "Wrong password or login";
		header("Location:/hive2/src/views/index.php?msg=$msg");
	}
} else {
	$msg = "Please enter data";
	header("Location:/hive2/src/views/index.php?msg=$msg");
}
