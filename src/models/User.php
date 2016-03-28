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

	public function __construct($id, $firstName, $email, $password, $resume)
	{
		$this->id = $id;
		$this->firstName = $firstName;
		$this->email = $email;
		$this->password = $password;
		$this->resume = $resume;
		$this->online = 1;
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
}