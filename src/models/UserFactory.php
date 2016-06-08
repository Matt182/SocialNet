<?php
namespace hive2\models;
use hive2\models\User;

/**
 *
 */
class UserFactory
{

    public function createUser(array $userData)
    {
        $user = new User(
            $userData['id'], $userData['firstname'],
            $userData['email'], $userData['password'], $userData['resume'],
            $userData['online'], $userData['wasonline'], $userData['friends'],
            $userData['reqto'], $userData['reqfrom']
        );
        return $user;
    }

    public function createMembers(array $membersData)
    {
        $result = [];
        foreach ($membersData as $member) {
            $result[] = new User(
                $member['id'], $member['firstname'],
                $member['email'], $member['password'], $member['resume'],
                $member['online'], $member['wasonline'], $member['friends'],
                $member['reqto'], $member['reqfrom']
            );
        }
        return $result;
    }
}

    ?>
