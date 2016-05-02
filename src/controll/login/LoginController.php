<?php
namespace hive2\controll\login;
use hive2\views\View;
use hive2\models\User;
use hive2\controll\DBActions;
/**
*
*/
class LoginController
{

	public function ActionIndex($name)
	{
		$view = new View();
		session_start();
		if (isset($_SESSION['user'])) {
			$user = $_SESSION['user'];
			header("Location:profile/{$user->getId()}");
		}else {
			print($view->render($name));
		}
	}

	public function ActionAuthorize()
	{
		$view = new View();
		$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
		$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

		if(isset($email) && $email != "") {
			$loginHelper = new LoginHelper($email, $password);
			if($password != "" && $loginHelper->isUserRegistred()) {
				session_start();
				$loginHelper->login();
				$user = $loginHelper->getUser();
				print_r($user);
				$_SESSION['user'] = $user;
				header("Location:profile/{$user->getId()}");
			} else {
				$msg = "Wrong password or login";
				print($view->render("index", ["error" => $msg]));
			}
		} else {
			$msg = "Please enter data";
			print($view->render("index", ["error" => $msg]));

		}
	}
}
