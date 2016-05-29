<?php
/**
 * Creates schema an databases
 */
$dbdriver = 'mysql';
$dbhost = 'localhost';
$port = '3306';
$dbname = 'hive2';
$dbusername = 'root';
$dbpassword = '';

try {
    $conn = new PDO("$dbdriver:host=$dbhost", $dbusername, $dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db = $conn->prepare("CREATE SCHEMA IF NOT EXISTS $dbname");
    $db->execute();

    $conn->exec(
        "CREATE TABLE IF NOT EXISTS `hive2`.`members` ( `id` INT NOT NULL AUTO_INCREMENT ,
		 					`firstName` VARCHAR(16) NOT NULL , `password` VARCHAR(255) NOT NULL ,
							`email` VARCHAR(255) NOT NULL , `resume` TEXT NULL ,
							`online` BOOLEAN NOT NULL DEFAULT FALSE , `wasOnline` DATETIME NULL ,
							`friends` TEXT NOT NULL , `reqTo` TEXT NOT NULL , `reqFrom` TEXT NOT NULL ,
							PRIMARY KEY (`id`), UNIQUE (`email`)) ENGINE = InnoDB
							 CHARACTER SET utf8 COLLATE utf8_general_ci;"
    );

    $conn->exec(
        "CREATE TABLE IF NOT EXISTS `hive2`.`blog_records` ( `id` INT NOT NULL AUTO_INCREMENT ,
							`author_id` INT NOT NULL , 'author_name' VARCHAR(16) , `owner_id` INT NOT NULL , `content` TEXT NOT NULL ,
							`likes` INT NOT NULL DEFAULT '0' , `created` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ,
							`hasComments` BOOLEAN NOT NULL DEFAULT FALSE , PRIMARY KEY (`id`), INDEX (`owner_id`))
							 ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;" 
    );

    $conn->exec(
        "CREATE TABLE IF NOT EXISTS `hive2`.`comments` ( `id` INT NOT NULL AUTO_INCREMENT ,
							`record_id` INT NOT NULL , `author_id` INT NOT NULL ,
							`author_name` VARCHAR(16) NOT NULL , `content` TEXT NOT NULL ,
							`created` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id`), INDEX (`record_id`))
							 ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;"
    );
} catch(PDOException $e) {
    echo 'unable' . $e->getMessage();
}
