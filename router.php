<?php
namespace hive2;
use hive2\controll\login\LoginController;
use hive2\controll\login\RegistrationController;
use hive2\controll\profile\ProfileController;
require_once 'vendor/autoload.php';

$url = explode('/', $_GET['url']);
switch ($url[0]) {
	case '':
	case 'login':
		$controller = new LoginController();
		$controller->ActionIndex('index');
		break;
	case 'register':
		$controller = new LoginController();
		$controller->ActionIndex('register');
		break;
	case 'registrate':
		$controller = new RegistrationController();
		$controller->ActionRegistrate();
		break;
	case 'authorize':
		$controller = new LoginController();
		$controller->ActionAuthorize();
		break;
	case 'profile':
		$controller = new ProfileController();
		break;
	case 'logout':
	require_once 'src/controll/profile/logout.php';
	break;
	default:
		echo $url[0];
		break;
}
