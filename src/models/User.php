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

	public function __construct($id, $firstName, $email, $password, $resume, $online, $friends)
	{
		$this->id = $id;
		$this->firstName = $firstName;
		$this->email = $email;
		$this->password = $password;
		$this->resume = $resume;
		$this->online = $online;
		$this->friends = unserialize($friends);
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
	public function getfriends()
	{
		return $this->friends;
	}
}
