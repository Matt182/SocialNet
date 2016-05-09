<?php
namespace hive2\models;

class User
{
	private $id;
	private $firstName;
	private $email;
	private $password;
	private $resume;
	private $online;
	private $friends;
	private $reqTo;
	private $reqFrom;

	public function __construct($id, $firstName, $email, $password, $resume, $online, $friends, $reqTo, $reqFrom)
	{
		$this->id = $id;
		$this->firstName = $firstName;
		$this->email = $email;
		$this->password = $password;
		$this->resume = $resume;
		$this->online = $online;
		$this->friends = unserialize($friends);
		$this->reqTo = unserialize($reqTo);
		$this->reqFrom = unserialize($reqFrom);
	}

	public function getId()
	{
		return $this->id;
	}

	public function getFirstName()
	{
		return $this->firstName;
	}

	public function getEmail()
	{
		return $this->email;
	}

	public function isOnline()
	{
		return $this->online;
	}
	public function getFriends()
	{
		return $this->friends;
	}

	public function getReqTo()
	{
		return $this->reqTo;
	}

	public function getReqFrom()
	{
		return $this->reqFrom;
	}
}
