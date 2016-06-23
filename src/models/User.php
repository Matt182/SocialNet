<?php
namespace hive2\models;

/**
* User model
*/
class User
{
    private $id;
    private $firstName;
    private $email;
    private $resume;
    private $online;
    private $wasOnline;
    private $friends;
    private $reqTo;
    private $reqFrom;
    private $records;

    public function __construct($id, $firstName, $email, $resume, $online, $wasOnline, $friends, $reqTo, $reqFrom, $records = [])
    {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->email = $email;
        $this->resume = $resume;
        $this->online = $online;
        $this->wasOnline = $wasOnline;
        $this->friends = unserialize($friends);
        $this->reqTo = unserialize($reqTo);
        $this->reqFrom = unserialize($reqFrom);
        $this->records = $records;
    }

    /**
    *
    *
    * Get the value of Id
    *
    * @return int
    */
    public function getId()
    {
        return $this->id;

    }

    /**
    *
    *
    * Get the value of First Name
    *
    * @return string
    */
    public function getFirstName()
    {
        return $this->firstName;

    }

    /**
    *
    *
    * Get the value of Email
    *
    * @return string
    */
    public function getEmail()
    {
        return $this->email;

    }

    public function getResume()
    {
        return $this->resume;

    }

    /**
    *
    *
    * Get the value of Online
    *
    * @return boolval
    */
    public function isOnline()
    {
        return $this->online;

    }

    /**
    *
    *
    * Get the value of Was Online
    *
    * @return DateTime
    */
    public function wasOnline()
    {
        return $this->wasOnline;

    }

    /**
    *
    *
    * Get the value of Friends
    *
    * @return array
    */
    public function getFriends()
    {
        return $this->friends;

    }

    /**
    *
    *
    * Get the value of sended requests
    *
    * @return array
    */
    public function getReqTo()
    {
        return $this->reqTo;

    }

    /**
    *
    *
    * Get the value of recived requests
    *
    * @return array
    */
    public function getReqFrom()
    {
        return $this->reqFrom;

    }

    public function getRecords()
    {
        return $this->records;

    }

}
