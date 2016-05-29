<?php
namespace hive2\models;

use hive2\models\Comment;

/**
 *
 */
class CommentFactory
{
    public static function createComments(array $rows)
    {
        $result = [];
        foreach($rows as $row) {
            $result[] = new Comment(
                $row['id'], $row['record_id'], $row['author_id'],
                $row['author_name'], $row['content'], $row['created']
            );
        }
        return $result;
    }
}
