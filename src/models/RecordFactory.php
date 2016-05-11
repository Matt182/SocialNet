<?php
namespace hive2\models;

use hive2\models\Record;

/**
 *
 */
class RecordFactory
{
  public static function createRecords(array $rows)
  {
    $result = [];
    foreach($rows as $row) {
      $result[] = new Record($row['id'], $row['author'], $row['content'], $row['likes'], $row['created'], $row['comments']);
    }
    return $result;
  }
}
