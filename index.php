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

use hive2\router\Router;
use hive2\router\Request;

require_once 'vendor/autoload.php';
require_once 'src/config/Config.php';

/**
 * To make rout add as first argument only controller name as it will be in uri
 * without slashes, the Request class will do all the thing. Add second argement
 * as real controller name. Right now you need to add manualy appropriate controller to
 * ControllersStorage.
 */

$router = new Router();
phpinfo();
$router->get('login', 'LoginController');
$router->get('profile', 'ProfileController');
$router->get('register', 'RegistrationController');
$router->get('logout', 'LogoutController');
$router->get('members', 'MembersController');

$router->post('register', 'RegistrationController');
$router->post('login', 'LoginController');
$router->post('profile', 'ProfileController');



session_start();
$request = new Request();

/*
try {
    $request->baba();
} catch (\Exception $e) {
    echo "okkke";
}
*/
$router->current($request);


/*
$dbProfile = new DBProfileActions();
$dbRecords = new DBRecordsActions();

if (isset($_GET['url'])) {
    $url = explode('/', $_GET['url']);
    switch ($url[0]) {
    	case '':
    	case 'login':
    		$controller = new LoginController();
    		$controller->ActionIndex('login');
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
    		$controller = new ProfileController($dbProfile, $dbRecords);
    		if ($controller->isLogin()) {
    			if(isset($url[2])) {
    				switch ($url[2]) {
    					case 'sendFriendReq':
    						$controller->sendFriendRequest($url[1]);
    						break;
    					case 'confirmFriendReq':
    						$controller->ActionConfirmFriend($url[1]);
    						break;
    					case 'friends':
    						$controller->ActionFriends($url[1]);
    						break;
    					case 'postRecord':
    						$controller->ActionPostRecord($url[1]);
    						break;
    					case 'edit':
    						$controller->ActionEdit();
    						break;
    					case 'saveEdits':
    						$controller->ActionSaveEdits();
    						break;
    					case preg_match("/^[0-9]/i", $url[2]) ? true : false:
    						if($url[3] == 'addComment') {
    							$controller->ActionAddComment($url[2], $url[1]);
    						}
    						break;
    					default:
    						# code...
    						break;
    				}
    				break;
    			}
    		}
    		$controller->ActionIndex(isset($url[1])?$url[1]:-1);
    		break;
    	case 'members':
    		$controller = new MembersController($dbProfile, $dbRecords);
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

} else {
    $controller = new LoginController();
    $controller->ActionIndex('login');
}
*/
