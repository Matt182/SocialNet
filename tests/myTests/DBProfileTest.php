<?php
namespace hive2\tests\myTests;

require_once '../../vendor/autoload.php';
use hive2\controll\profile\DBProfileActions;
use PDO;
use hive2\config\Config;
use hive2\models\User;

$db = new DBProfileActions();

print_r($db->updateMe(2)->getRecords());
