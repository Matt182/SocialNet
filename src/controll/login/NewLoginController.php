<?php
namespace hive2\controll\login;
use hive2\views\IndexView;
/**
*
*/
class NewLoginController
{

	function __construct()
	{
		# code...
	}

	public function ActionIndex($name)
	{
		$view = new IndexView();
		$view->render($name);
	}

	public function ActionAuthorize()
	{
		$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
		$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

		if(isset($email) && $email != "") {
			$loginController = new LoginController($email, $password);
			if($password != "" && $loginController->isUserRegistred()) {
				session_start();
				$user = $loginController->getUser();
				$_SESSION['user'] = $user;
				header("Location:profile/{$user->getId()}");
			} else {
				$msg = "Wrong password or login";
				header("Location:login?msg=$msg");
			}
		} else {
			$msg = "Please enter data";
			header("Location:login?msg=$msg");
		}
	}

}
