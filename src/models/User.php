<?php
namespace hive2\models;

class User
{
	private $id;
	private $firstName;
	private $email;
	private $password;
	private $online;

	public function __construct($id, $firstName, $password)
	{
		$this->id = $id;
		$this->firstName = $firstName;
		$this->password = $password;
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