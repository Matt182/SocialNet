<?php
/**
* Creates schema an databases
*/

$dbdriver = 'pgsql';
$dbhost = 'localhost';
$dbusername = 'postgres';
$dbpassword = 'root';
$dbname = 'test_hive2';

/*
$dbopts = parse_url(getenv('DATABASE_URL'));
$dsn = 'pgsql:dbname='.ltrim($dbopts["path"],'/').';host='.$dbopts["host"] . ';port=' . $dbopts["port"];
$dbusername = $dbopts["user"];
$dbpassword = $dbopts["pass"];
*/

try {
    $conn = new PDO("$dbdriver:dbname=$dbname;host=$dbhost", $dbusername, $dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db = $conn->prepare("CREATE SCHEMA IF NOT EXISTS $dbname");
    $db->execute();

    $conn->exec(
    "CREATE TABLE IF NOT EXISTS $dbname.members ( id SERIAL PRIMARY KEY,
        first_name VARCHAR(16) NOT NULL , password VARCHAR(255) NOT NULL ,
        email VARCHAR(255) NOT NULL , resume TEXT NULL ,
        online BOOLEAN NOT NULL DEFAULT FALSE , was_online TIMESTAMP NULL ,
        friends TEXT NOT NULL , req_to TEXT NOT NULL , req_from TEXT NOT NULL ,
        UNIQUE (email));"
    );

    $conn->exec(
    "CREATE TABLE IF NOT EXISTS $dbname.blog_records ( id SERIAL PRIMARY KEY,
        author_id INT NOT NULL, owner_id INT NOT NULL ,
        content TEXT NOT NULL ,
        likes INT NOT NULL DEFAULT '0' , created TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
        hasComments BOOLEAN NOT NULL DEFAULT FALSE);"
    );

    $conn->exec(
    "CREATE TABLE IF NOT EXISTS $dbname.comments ( id SERIAL PRIMARY KEY,
        record_id INT NOT NULL , author_id INT NOT NULL ,
        content TEXT NOT NULL ,
        created TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP);"
    );
    echo "created";
} catch(PDOException $e) {
    echo 'unable' . $e->getMessage();
}
