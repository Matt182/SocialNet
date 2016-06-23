<?php
namespace hive2\models;

use hive2\models\Comment;

/**
 * Produces comment models
 */
class CommentFactory
{
    public static function createComments(array $rows, $db)
    {
        $result = [];
        foreach($rows as $row) {
            $result[] = new Comment(
                $row['id'], $row['record_id'], $row['author_id'],
                $db->getFirstName($row['author_id']), $row['content'], $row['created']
            );
        }
        return $result;
    }
}
