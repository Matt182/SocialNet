<?php
namespace hive2;
use hive2\controll\login\NewLoginController;
use hive2\controll\profile\ProfileController;
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
	case 'authorize':
		$controller = new NewLoginController();
		$controller->ActionAuthorize();
		break;
	case 'profile':
		$controller = new ProfileController();
		if (isset($url[1])) {
			switch ($url[1]) {
				case 'logout':
					$controller = new ProfileController();
					$controller->ActionLogout();
					break;
				default:
					$controller->ActionIndex($url[1]);
					break;
				}
			}
		break;
	default:
		echo $url[0];
		break;
}
