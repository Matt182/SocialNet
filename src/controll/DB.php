<?php
namespace hive2\controll;

use PDO;

/**
 * DB base class
 */
class DB
{
    protected $conn;
    protected $dbname;

    function __construct()
    {
        /*
         * uncomment on production server
         *
        $dbopts = parse_url(getenv('DATABASE_URL'));
        $dsn = 'pgsql:dbname='.ltrim($dbopts["path"],'/').';host='.$dbopts["host"] . ';port=' . $dbopts["port"];
        $dbusername = $dbopts["user"];
        $dbpassword = $dbopts["pass"];
        */

        /*
         * uncomment on local server
         */
        $this->dbname = getenv('dbname');
        $dsn = getenv('driver') . ":dbname=" . $this->dbname . ";host=" . getenv('host');
        $dbusername = getenv('username');
        $dbpassword = getenv('pass');

        try{
        $this->conn = new PDO($dsn, $dbusername, $dbpassword);
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }
}
