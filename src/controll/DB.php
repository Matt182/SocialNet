<?php
namespace hive2\controll;

use hive2\config\Config;
use PDO;
/**
 * DB root class
 */
class DB
{
    protected $conn;

    function __construct()
    {

        $dbopts = parse_url(getenv('DATABASE_URL'));

        $dsn = 'pgsql:dbname='.ltrim($dbopts["path"],'/').';host='.$dbopts["host"] . ';port=' . $dbopts["port"];
        //$dsn = "pgsql:dbname=hive2;host=localhost";
        /*
        $dbdriver = Config::getDBDriver();
        $dbhost = Config::getDBHost();
        $dbhost = Config::getDBHost();
        $dbname = Config::getDBName();
        */
        //$dbusername = Config::getDBUsername();
        //$dbpassword = Config::getDBPass()

        $dbusername = $dbopts["user"];
        $dbpassword = $dbopts["pass"];

        try{
        $this->conn = new PDO(/*"$dbdriver:host=$dbhost;dbname=$dbname"*/$dsn, $dbusername, $dbpassword);
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }
}
