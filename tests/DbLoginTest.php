<?php
namespace tests;

use PDO;
use tests\DatabaseTestCase;
use hive2\controll\login\DBLoginActions;

class DbLoginTest extends \PHPUnit_Extensions_Database_TestCase
{
    private $conn;
    private $dbLogin;

    protected function setUp()
    {
        putenv ('driver=pgsql');
        putenv ('dbname=test_hive2');
        putenv ('host=localhost');
        putenv ('username=postgres');
        putenv ('pass=root');
        $this->dbLogin = new DBLoginActions();
    }

    final public function getConnection()
    {
        $this->conn = $this->createDefaultDBConnection(  new PDO( 'pgsql:dbname=test_hive2;host=localhost', 'postgres', 'root' ) );
        return $this->conn;
    }

    /**
     * Prepare data set for database tests
     *
     * @return \PHPUnit_Extensions_Database_DataSet_AbstractDataSet
     */
    public function getDataSet()
    {
        return new MyApp_DbUnit_ArrayDataSet( array(
            'test_hive2.members' => [
                [
                    'id' => 1, 'first_name' => 'matt', 'password' => 'qwre',
                    'email' => 'matt@mail.ru', 'resume' => 'simple text', 'on_line' => 0,
                    'was_online' => '09.07.2014', 'friends' => serialize([2]), 'req_to' => serialize([]),
                    'req_from' => serialize([])
                ],
                [
                    'id' => 2, 'first_name' => 'matt2', 'password' => 'qwre',
                    'email' => 'matt2@mail.ru', 'resume' => 'simple text', 'on_line' => 0,
                    'was_online' => '09.08.2014', 'friends' => serialize([]), 'req_to' => serialize([]),
                    'req_from' => serialize([])
                ]
            ],
            'test_hive2.blog_records' => [
                [
                    'id' => 1, 'author_id' => 1, 'author_name' => 'matt',
                     'owner_id' => 1, 'content' => 'simple text', 'likes' => 0,
                     'created' => '09.06.2015', 'hascomments' => 0
                ],
                [
                    'id' => 2, 'author_id' => 1, 'author_name' => 'matt',
                    'owner_id' => 1, 'content' => 'simple text', 'likes' => 0,
                    'created' => '09.06.2015', 'hascomments' => 0
                ]
            ],
            'test_hive2.comments' => [
                [
                    'id' => 1, 'record_id' => 1, 'author_id' => 1,
                    'author_name' => 'matt', 'content' => 'xyz', 'created' => '09.07.2015'
                ],
                [
                    'id' => 2, 'record_id' => 2, 'author_id' => 2,
                    'author_name' => 'matt2', 'content' => 'xyz', 'created' => '09.07.2015'
                ]
            ]
        ));
    }

    public function testGetComments()
    {
        $comments = $this->dbLogin->getComments(1);
        $this->assertEquals('matt', $comments[0]['author_name']);
        $comments = $this->dbLogin->getComments(3);
        $this->assertEmpty($comments);
    }

    public function testGetRecords()
    {
        $records = $this->dbLogin->getRecords(1);
        $this->assertEquals(1, $records[0]['id']);
        $records = $this->dbLogin->getRecords(3);
        $this->assertEmpty($records);
    }

    public function testGetByEmail()
    {
        $user = $this->dbLogin->getByEmail('matt@mail.ru');
        $this->assertEquals('matt', $user['first_name']);

    }

    public function testSetOnline()
    {
        $user = $this->dbLogin->getByEmail('matt@mail.ru');
        $this->assertEquals(false, $user['on_line']);
        $this->dbLogin->setOnline('matt@mail.ru');
        $user = $this->dbLogin->getByEmail('matt@mail.ru');
        $this->assertEquals(true, $user['on_line']);
    }

    public function testInsertUser()
    {

    }

}
