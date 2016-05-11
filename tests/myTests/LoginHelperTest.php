<?php
namespace hive2\tests\myTests;


require_once '../../vendor/autoload.php';
use hive2\controll\login\LoginHelper;

$lh = new LoginHelper('matt@mail.ru', 'matt');
$lh->login();
$user = $lh->getUser();
print_r($user->getRecords());
