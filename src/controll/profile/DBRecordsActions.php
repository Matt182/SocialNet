<?php
namespace hive2\controll\profile;

use PDO;
use hive2\config\Config;
use hive2\models\Record;


class DBRecordsActions
{
  private $conn;

  function __construct()
  {
    $dbdriver = Config::getDBDriver();
    $dbhost = Config::getDBHost();
    $dbname = Config::getDBName();
    $dbusername = Config::getDBUsername();
    $dbpassword = Config::getDBPass();
    try{
      $this->conn = new PDO("$dbdriver:host=$dbhost;dbname=$dbname", $dbusername, $dbpassword);
    } catch(PDOException $e) {
      echo $e->getMessage();
    }
  }

  public function getRecords($id)
  {
    $statement = $this->conn->query("select * from blog_records where author='$id'");
    $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
  }

  public function addRecord($id, $content)
  {
    $result = $this->conn->exec("insert into blog_records (author, content) value ('$id', '$content')");
  }
}
