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
        parent::setUp();
        putenv ('driver=pgsql');
        putenv ('dbname=test_hive2');
        putenv ('host=localhost');
        putenv ('username=postgres');
        putenv ('pass=root');
        $this->dbLogin = new DBLoginActions();
        $this->conn = new PDO( 'pgsql:dbname=test_hive2;host=localhost', 'postgres', 'root' );
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
        $this->expected = array(
            'test_hive2.members' => [
                [
                    'id' => 1, 'first_name' => 'matt', 'password' => 'qwre',
                    'email' => 'matt@mail.ru', 'resume' => 'simple text', 'online' => 0,
                    'was_online' => '2015-09-07 00:00:00', 'friends' => serialize([2]), 'req_to' => serialize([]),
                    'req_from' => serialize([])
                ],
                [
                    'id' => 2, 'first_name' => 'matt2', 'password' => 'qwre',
                    'email' => 'matt2@mail.ru', 'resume' => 'simple text', 'online' => 0,
                    'was_online' => '2015-09-07 00:00:00', 'friends' => serialize([]), 'req_to' => serialize([]),
                    'req_from' => serialize([])
                ]
            ],
            'test_hive2.blog_records' => [
                [
                    'id' => 1, 'author_id' => 1,
                     'owner_id' => 1, 'content' => 'simple text', 'likes' => 0,
                     'created' => '2015-09-07 00:00:00', 'hascomments' => 0
                ],
                [
                    'id' => 2, 'author_id' => 1,
                    'owner_id' => 1, 'content' => 'simple text', 'likes' => 0,
                    'created' => '2015-09-07 00:00:00', 'hascomments' => 0
                ]
            ],
            'test_hive2.comments' => [
                [
                    'id' => 1, 'record_id' => 1, 'author_id' => 1,
                    'content' => 'xyz', 'created' => '2015-09-07 00:00:00'
                ],
                [
                    'id' => 2, 'record_id' => 2, 'author_id' => 2,
                    'content' => 'xyz', 'created' => '2015-09-07 00:00:00'
                ]
            ]
        );
        return new MyApp_DbUnit_ArrayDataSet($this->expected);
    }

    public function testGetFirstName()
    {
        $firstName = $this->dbLogin->getFirstName(1);
        $this->assertEquals('matt', $firstName);
    }

    public function testGetComments()
    {
        $comments = $this->dbLogin->getComments(1);
        $this->assertEquals($this->expected['test_hive2.comments'][0], $comments[0]);
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
        $this->assertEquals(false, $user['online']);
        $this->dbLogin->setOnline('matt@mail.ru');
        $user = $this->dbLogin->getByEmail('matt@mail.ru');
        $this->assertEquals(true, $user['online']);
    }

    public function testInsertUser()
    {
        // TODO: different db structure -> reqfrom req_from
    }

    protected function tearDown()
    {
        $this->conn->exec('TRUCATE test_hive2.members;');
        $this->conn->exec('TRUCATE test_hive2.blog_records;');
        $this->conn->exec('TRUCATE test_hive2.comments;');
    }

}
