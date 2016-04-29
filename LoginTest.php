<?php
namespace hive2\tests;
require_once 'vendor/autoload.php';
use hive2\hive2\controll\login\NewLoginController;

class LoginTest extends PHPUnit_Framework_TestCase
{
  public function testWrongCredentials()
  {
    isset($_SESSION) ? print("was seted") : print("not setted");
  }
}
