<?php
namespace hive2\controll\login;
use hive2\views\IndexView;
use hive2\models\User;
use hive2\controll\DBActions;
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
				header("Location:profile?id={$user->getId()}");
			} else {
				$msg = "Wrong password or login";
				header("Location:login?msg=$msg");
			}
		} else {
			$msg = "Please enter data";
			header("Location:login?msg=$msg");
		}
	}

	public function ActionRegistrate()
	{
		if(isset($_POST['firstName'])) {

			$db = new DBActions();

			$name = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_STRING);
			$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
			$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
			$password = password_hash($password, PASSWORD_BCRYPT);

			$result = $db->insertUser($name, $password, $email);
			if ($result == 0) {
				$msg = "$email is already exists";
				$conn=null;
				header("Location:register?msg=$msg");
			} else {
				$msg = "regestration completed by $name";
				$conn=null;
				header("Location:login?msg=$msg");
			}

		}
	}

}
