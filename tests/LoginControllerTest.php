<?php
namespace hive2\tests;
use hive2\controll\login\LoginController;

require_once "{$_SERVER['DOCUMENT_ROOT']}/hive2/vendor/autoload.php";

$lc = new LoginController('matt@mail.ru', 'matt');
if ($lc->isUserRegistred()) {
	echo "true";
} else {
	echo "false";
}
