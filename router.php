<?php
namespace hive2;
use hive2\controll\login\LoginController;
use hive2\controll\login\RegistrationController;
use hive2\controll\profile\ProfileController;
use hive2\controll\profile\FriendsController;
use hive2\controll\profile\MembersController;
use hive2\controll\profile\LogoutController;

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
		$controller = ProfileController::getInstance();
		if($controller->isLogin()) {
			if(isset($url[2])) {
				$controller = FriendsController::getInstance();
				switch ($url[2]) {
					case 'sendFriendReq':
						$controller->sendFriendRequest($url[1]);
						break;
					case 'confirmFriendReq':
						$controller->ActionConfirmFriend($url[1]);
						break;
					case 'friends':
						$controller->ActionIndex($url[1]);
						break;
					default:
						# code...
						break;
				}
				break;
			}
			if ($url[1] == 'postRecord') {
				$controller->ActionPostRecord();
				return;
			}
			$controller->ActionIndex(isset($url[1])?$url[1]:-1);
		}
		break;
	case 'members':
		$controller = MembersController::getInstance();
		if($controller->isLogin()) {
			$controller->ActionIndex();
		}
		break;
	case 'logout':
	 $controller = new LogoutController();
	break;
	default:
		echo $url[0];
		break;
}
