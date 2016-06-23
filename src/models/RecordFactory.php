<?php
namespace hive2\models;

use hive2\models\Record;
use hive2\models\CommentFactory;

/**
 * produces records models
 */
class RecordFactory
{
    public static function createRecords(array $rows, $db)
    {
        $result = [];
        foreach($rows as $row) {
            $row['comments'] = CommentFactory::createComments($row['comments'], $db);
            $result[] = new Record($row['id'], $row['author_id'], $db->getFirstName($row['author_id']), $row['owner_id'], $row['content'], $row['likes'], $row['created'], $row['hascomments'], $row['comments']);
        }
        return $result;
    }
}
