<?php
namespace hive2\controll\profile\DBActions;

use PDO;
use hive2\config\Config;
use hive2\models\Record;
use hive2\controll\profile\DBActions\interfaces\DBRecordsActionsInterface;


class DBRecordsActions implements DBRecordsActionsInterface
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

    public function getComments($id)
    {
        $statement = $this->conn->query("select * from comments where record_id ='$id'");
        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
        if(!$rows) {
            $rows = [];
        }
        return $rows;
    }

    public function getRecords($id)
    {
        $statement = $this->conn->query("select * from blog_records where owner_id ='$id' order by created desc");
        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
        for ($i=0; $i < sizeof($rows); $i++) {
            $rows[$i]['comments'] = $this->getComments($rows[$i]['id']);
        }
        return $rows;
    }

    public function addRecord($authorId, $authorName, $ownerId, $content)
    {
        $result = $this->conn->exec("insert into blog_records (author_id, author_name, owner_id, content) value ('$authorId', '$authorName', '$ownerId', '$content')");
    }

    public function addComment($recordId, $userId, $userName, $content)
    {
        $result = $this->conn->exec(
            "insert into comments (record_id, author_id, author_name, content)
        value ('$recordId', '$userId', '$userName', '$content')"
        );
    }
}
