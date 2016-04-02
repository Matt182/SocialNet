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
	case 'registrate':
		$controller = new NewLoginController();
		$controller->ActionRegistrate();
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

					$controller->ActionLogout();
					break;
				default:
					//$controller->ActionIndex();
					break;
				}
			} else {
				$controller->ActionIndex();
				break;
			}
		break;
	default:
		echo $url[0];
		break;
}
