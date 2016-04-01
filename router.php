<?php
namespace hive2;
use hive2\controll\login\NewLoginController;
require_once 'vendor/autoload.php';

$url = explode('/', $_GET['url']);
switch ($url[0]) {
	case 'login':
		$controller = new NewLoginController();
		$controller->ActionIndex('index');
		break;
	case 'register':
		$controller = new NewLoginController();
		$controller->ActionIndex('register');
		break;
	case 'profile':
		echo "log3";
		break;
	default:
		echo "log";
		break;
}