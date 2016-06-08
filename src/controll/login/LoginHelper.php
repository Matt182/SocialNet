<?php
namespace hive2\controll\login;

use hive2\models\User;
use hive2\models\RecordFactory;
use hive2\controll\login\DBLoginActions;

/**
* Login Controller helping functions
*/
class LoginHelper implements LoginInterface
{
    private $email;
    private $password;
    private $db;
    private $user;

    public function __construct($email, $pass)
    {
        $this->email = $email;
        $this->password = $pass;
        $this->db = new DBLoginActions();
    }

    public function isUserRegistred()
    {
        $row = $this->db->getByEmail($this->email);
        if (!$row) {
            return false;
        }
        if(password_verify($this->password, $row['password'])) {
            return true;
        } else {
            return false;
        }
    }

    public function login()
    {
        $this->db->setOnline($this->email);
        $row = $this->db->getByEmail($this->email);
        $row['records'] = RecordFactory::createRecords($row['records']);
        $this->user = new User(
            $row['id'], $row['firstname'], $row['email'], $row['password'],
            $row['resume'], $row['online'], $row['wasonline'], $row['friends'],
            $row['reqto'], $row['reqfrom'], $row['records']
        );
    }

    public function getUser()
    {
        return $this->user;
    }

}
