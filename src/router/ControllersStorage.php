<?php
namespace hive2\router;

use hive2\controll\login\DBLoginActions;
use hive2\controll\login\LoginController;
use hive2\controll\login\RegistrationController;
use hive2\controll\profile\DBActions\DBProfileActions;
use hive2\controll\profile\DBActions\DBRecordsActions;
use hive2\controll\profile\ProfileController;
use hive2\controll\profile\MembersController;
use hive2\controll\profile\LogoutController;
use hive2\views\View;

/**
 * Make inicializtion of objects
 */
class ControllersStorage
{
    /**
     * Return appropriate object
     *
     * @param     string $name
     * @return    object
     */
    static public function get($controllerName)
    {
        switch ($controllerName) {
            case 'LoginController':
                return new LoginController(
                    self::get('DBLoginActions'),
                    self::get('View')
                );
                break;
            case 'ProfileController':
                return new ProfileController(
                    self::get('DBProfileActions'),
                    self::get('DBRecordsActions'),
                    self::get('View')
                );
                break;
            case 'RegistrationController':
                return new RegistrationController(
                    self::get('DBLoginActions'),
                    self::get('View')
                );
                break;
            case 'MembersController':
                return new MembersController(
                    self::get('DBProfileActions'),
                    self::get('DBRecordsActions'),
                    self::get('View')
                );
                break;
            case 'LogoutController':
                return new LogoutController(
                    self::get('DBProfileActions')
                );
                break;
            case 'DBLoginActions':
                return new DBLoginActions();
                break;
            case 'DBProfileActions':
                return new DBProfileActions();
                break;
            case 'DBRecordsActions':
                return new DBRecordsActions();
                break;
            case 'View':
                return new View();
                break;
            default:
                # code...
                break;
        }
    }

}
