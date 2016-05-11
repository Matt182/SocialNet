<?php
namespace hive2\controll;

interface DBLoginActionsInterface
{
	public function getByEmail($email);

	public function setOnline($email);

	public function insertUser($name, $password, $email);

}
