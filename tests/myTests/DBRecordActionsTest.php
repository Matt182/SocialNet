<?php
namespace hive2\tests\myTests;

use hive2\models\RecordFactory;
require_once '../../vendor/autoload.php';
use hive2\controll\profile\DBRecordsActions;
use PDO;
use hive2\config\Config;
use hive2\models\Record;

$db = new DBRecordsActions();
