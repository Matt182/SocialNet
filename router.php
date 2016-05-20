<?php
namespace hive2;
use hive2\controll\login\LoginController;
use hive2\controll\login\RegistrationController;
use hive2\controll\profile\ProfileController;
use hive2\controll\profile\FriendsController;
use hive2\controll\profile\MembersController;
use hive2\controll\profile\LogoutController;
use hive2\controll\profile\DBActions\DBRecordsActions;
use hive2\controll\profile\DBActions\DBProfileActions;
//use hive2\controll\profile\DBActions\interfaces\DBProfileActionsInterface;

require_once 'vendor/autoload.php';

$dbProfile = new DBProfileActions();
$dbRecords = new DBRecordsActions();



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
		$controller = ProfileController::getInstance($dbProfile, $dbRecords);
		if($controller->isLogin()) {
			if(isset($url[2])) {
				$controller = FriendsController::getInstance($dbProfile, $dbRecords);
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
					case 'postRecord':
						$controller = ProfileController::getInstance($dbProfile, $dbRecords);
						$controller->ActionPostRecord($url[1]);
						break;
					case 'edit':
						$controller = ProfileController::getInstance($dbProfile, $dbRecords);
						$controller->ActionEdit();
						break;
						case preg_match("/^[0-9]/i", $url[2]) ? true : false:
							if($url[3] == 'addComment') {
								$controller = ProfileController::getInstance($dbProfile, $dbRecords);
								$controller->ActionAddComment($url[2], $url[1]);
							}
							break;
					default:
						# code...
						break;
				}
				break;
			}

			$controller->ActionIndex(isset($url[1])?$url[1]:-1);
		}
		break;
	case 'members':
		$controller = MembersController::getInstance($dbProfile, $dbRecords);
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
