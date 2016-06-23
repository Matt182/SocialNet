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

    /**
     * render login page
     *
     * @param     string $arg (not used in function just temporalely)
     * @return    void
     */
    public function index($arg)
    {
        print($this->view->render('login'));
    }

    /**
     * Authorize user
     * @return    void
     */
    public function authorize()
    {
        $view = new View();
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

        if(isset($email) && $email != "") {
            $loginHelper = new LoginHelper($email, $password);
            if($password != "" && $loginHelper->isUserRegistred()) {
                $user = $loginHelper->login();
                $_SESSION['user'] = $user;
                header("Location:/profile/{$user->getId()}");
            } else {
                $msg = "Wrong password or login";
                print($view->render("login", ["error" => $msg]));
            }
        } else {
            $msg = "Please enter data";
            print($view->render("login", ["error" => $msg]));

        }
    }
}
