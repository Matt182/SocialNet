<?php
require_once 'config.php';

try {
	$conn = new PDO("$dbdriver:host=$dbhost", $dbusername, $dbpassword);
	$db = $conn->prepare( "CREATE SCHEMA IF NOT EXISTS $dbname");
	$db->execute();

} catch(PDOException $e) {
	echo 'unable ' . $e->getMessage();
	die();
}

try{
	$conn = new PDO("$dbdriver:host=$dbhost;dbname=$dbname", $dbusername, $dbpassword);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$conn->exec( "CREATE TABLE IF NOT EXISTS members (id int(11) auto_increment primary key,firstName varchar(16) not null,password varchar(256) not null,email varchar(256) not null,resume text,online tinyint(1) not null default 0, wasOnline datetime, Index(id), Index(email)) engine=InnoDB DEFAULT CHARACTER SET = utf8 COLLATE = utf8_bin;" );
} catch(PDOException $e) {
	echo "unable to create table members";
	die();
}