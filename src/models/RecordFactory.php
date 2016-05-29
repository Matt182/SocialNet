<?php
namespace hive2\models;

use hive2\models\Record;
use hive2\models\CommentFactory;

/**
 *
 */
class RecordFactory
{
    public static function createRecords(array $rows)
    {
        $result = [];
        foreach($rows as $row) {
            $row['comments'] = CommentFactory::createComments($row['comments']);
            $result[] = new Record($row['id'], $row['author_id'], $row['author_name'], $row['owner_id'], $row['content'], $row['likes'], $row['created'], $row['has_comments'], $row['comments']);
        }
        return $result;
    }
}
