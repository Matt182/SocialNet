<?php
namespace hive2\controll\profile\DBActions;

use PDO;
use hive2\controll\DB;
use hive2\models\Record;
use hive2\controll\profile\DBActions\interfaces\DBRecordsActionsInterface;

/**
 * Class working with members data bases
 *
 */
class DBRecordsActions extends DB implements DBRecordsActionsInterface
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getComments($id)
    {
        $statement = $this->conn->query("select * from $this->dbname.comments where record_id ='$id'");
        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
        if(!$rows) {
            $rows = [];
        }
        return $rows;
    }

    public function getRecords($id)
    {
        $statement = $this->conn->query("select * from $this->dbname.blog_records where owner_id ='$id' order by created desc");
        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
        for ($i=0; $i < sizeof($rows); $i++) {
            $rows[$i]['comments'] = $this->getComments($rows[$i]['id']);
        }
        return $rows;
    }

    public function addRecord($authorId, $ownerId, $content)
    {
        $result = $this->conn->exec("insert into $this->dbname.blog_records (author_id, owner_id, content) values ('$authorId', '$ownerId', '$content')");
    }

    public function addComment($recordId, $userId, $content)
    {
        $result = $this->conn->exec(
            "insert into $this->dbname.comments (record_id, author_id, content)
        values ('$recordId', '$userId', '$content')"
        );
    }
}
