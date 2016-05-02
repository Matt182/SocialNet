<?php
namespace hive2\models;
use hive2\models\User;

/**
 *
 */
class UserFactory
{

  public function createUser(array $userData) {
    $user = new User($userData['id'], $userData['firstName'], $userData['email'], $userData['password'], $userData['resume'], $userData['online'], $userData['friends']);
    return $user;
  }

  public function createMembers(array $membersData)
  {
    $result = [];
    foreach ($membersData as $member) {
      $result[] = new User($member['id'], $member['firstName'], $member['email'], $member['password'], $member['resume'], $member['online'], $member['friends']);
    }
    return $result;
  }
}

 ?>
