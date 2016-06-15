<?php
namespace hive2\controll\login;
use hive2\views\View;
use hive2\models\User;
use hive2\controll\login\DBActions;

/**
 * Do login stuff
 */
class LoginController
{

    public function __construct(DBLoginActions $dbLogin, View $view)
    {
        $this->view = $view;
        $this->dbLogin = $dbLogin;
    }

    public function index($arg)
    {
        print($this->view->render('login'));
    }

    public function authorize()
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
                $_SESSION['user'] = $user;
                header("Location:/profile/{$user->getId()}");
            } else {
                $msg = "Wrong password or login";
                print($view->render("login", ["error" => $msg]));
            }
        } else {
            $msg = "Please enter data";
            print($view->render("index", ["error" => $msg]));

        }
    }
}
