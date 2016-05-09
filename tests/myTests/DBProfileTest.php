<?php
namespace hive2\tests\myTests;

require_once '../../vendor/autoload.php';
use hive2\controll\profile\DBProfileActions;
use PDO;
use hive2\config\Config;
use hive2\models\User;

$db = new DBProfileActions();

$user = $db->getById(3);

print_r($user->getFriends());
print_r($friends);

$db->addFriend($user, 9);
$user = $db->getById(3);
print_r(serialize($user->getFriends()));
