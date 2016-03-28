<?php
namespace hive2\controll;

interface DBActionsInterface
{
	public function getById($id);
	public function getByFirstName($firstName);
	public function getByEmail($email);

	public function setOnline($email);
	public function setOffline($email);

	public function updateProfile();
	public function insertUser($name, $password, $email);
	
}