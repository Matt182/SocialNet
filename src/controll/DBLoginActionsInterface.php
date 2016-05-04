<?php
namespace hive2\controll;

interface DBLoginActionsInterface
{
	public function getById($id);
	public function getByFirstName($firstName);
	public function getByEmail($email);

	public function setOnline($email);

	public function updateProfile();
	public function insertUser($name, $password, $email);

}
