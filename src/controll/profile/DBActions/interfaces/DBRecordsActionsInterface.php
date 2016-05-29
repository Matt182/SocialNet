<?php
namespace hive2\controll\profile\DBActions\interfaces;

interface DBRecordsActionsInterface
{
    public function getRecords($id);
    public function addRecord($authorId, $authorName, $ownerId, $content);
}
