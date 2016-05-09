<?php
$dbdriver = 'mysql';
$dbhost = 'localhost';
$port = '3306';
$dbname = 'hive2';
$dbusername = 'root';
$dbpassword = '';

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
	$conn->exec("CREATE TABLE IF NOT EXISTS `hive2`.`members` ( `id` INT NOT NULL AUTO_INCREMENT , `firstName` VARCHAR(16) NOT NULL , `password` VARCHAR(255) NOT NULL , `email` VARCHAR(255) NOT NULL , `resume` TEXT NULL , `online` BOOLEAN NOT NULL DEFAULT FALSE , `wasOnline` DATETIME NULL , `friends` TEXT NOT NULL , `reqTo` TEXT NOT NULL , `reqFrom` TEXT NOT NULL , PRIMARY KEY (`id`), UNIQUE (`email`)) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;");
	//$conn->exec( "CREATE TABLE IF NOT EXISTS members (id int(11) auto_increment primary key,firstName varchar(16) not null,password varchar(255) not null,email varchar(255) not null,resume text,online tinyint(1) not null default 0, wasOnline datetime, friends text not null default 'a:0:{}', reqFrom text not null default 'a:0:{}', reqTo text not null default 'a:0:{}', UNIQUE(email), Index(id), Index(email)) engine=InnoDB DEFAULT CHARACTER SET = utf8 COLLATE = utf8_bin;" );
} catch(PDOException $e) {
	print($e->getMessage());
	die();
}
