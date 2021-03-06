<?php
namespace hive2\controll\login;

use hive2\controll\login\DBLoginActionsInterface;
use PDO;
use hive2\controll\DB;
use hive2\config\Config;
use hive2\models\User;

require_once 'DBLoginActionsInterface.php';
/**
* Class with methods to interact with DB on login and authoriztion phase
*/
class DBLoginActions extends DB implements DBLoginActionsInterface
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getFirstName($id)
    {
        $statement = $this->conn->query("select first_name from $this->dbname.members where id ='$id'");
        if (!$statement) {
            return;
        }
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        return $row['first_name'];
    }

    /**
     * Get comment of record with $id
     *
     * @param     int $id
     * @return    array
     */
    public function getComments($id)
    {
        $statement = $this->conn->query("select * from $this->dbname.comments where record_id ='$id'");
        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
        if(!$rows) {
            $rows = [];
        }
        return $rows;
    }

    /**
    * Get records rows of user with appropriate id
    *
    * @param  int $id
    * @return array
    */
    public function getRecords($id)
    {
        $statement = $this->conn->query("select * from $this->dbname.blog_records where owner_id ='$id' order by created desc");
        if (!$statement) {
            return [];
        }
        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
        for ($i=0; $i < sizeof($rows); $i++) {
            $rows[$i]['comments'] = $this->getComments($rows[$i]['id']);
        }
        return $rows;
    }

    /**
    * Get user row by email
    *
    * @param  string $email
    * @return array $row
    */
    public function getByEmail($email)
    {
        $statement = $this->conn->query("select * from $this->dbname.members where email='$email'");
        if (!$statement) {
            return false;
        }
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        if (!$row) {
            return false;
        }
        $row['records'] = $this->getRecords($row['id']);
        return $row;
    }

    /**
    * Set user online with appropriate id
    *
    * @param  string $email
    * @return void
    */
    public function setOnline($email)
    {
        $statement = $this->conn->query("update $this->dbname.members set online=true where email='$email'");
    }

    /**
    * Insert newly registered user into DB
    *
    * @param string $name
    * @param string $password
    * @param string $email
    *
    * @return int $result 0 - something wrong, 1 - user inserted
    */
    public function insertUser($name, $password, $email)
    {
        $friends = serialize([]);
        $reqTo = serialize([]);
        $reqFrom = serialize([]);
        $result = $this->conn->exec("insert into $this->dbname.members
            (first_name, password, email, friends, req_to, req_from)
            values ('$name', '$password', '$email','$friends','$reqTo','$reqFrom')");
        return $result;
    }
}
