<?php
namespace hive2\models;
use hive2\models\User;

/**
 * produces user models
 */
class UserFactory
{
    /**
     * Produces one user
     *
     * @param     array $userData
     * @return    User
     */
    public function createUser(array $userData)
    {
        $user = new User(
            $userData['id'], $userData['firstname'],
            $userData['email'], $userData['resume'],
            $userData['online'], $userData['wasonline'], $userData['friends'],
            $userData['reqto'], $userData['reqfrom']
        );
        return $user;
    }

    /**
     * Produces some users
     *
     * @param     array $membersData
     * @return    array
     */
    public function createMembers(array $membersData)
    {
        $result = [];
        foreach ($membersData as $member) {
            $result[] = new User(
                $member['id'], $member['firstname'],
                $member['email'], $member['resume'],
                $member['online'], $member['wasonline'], $member['friends'],
                $member['reqto'], $member['reqfrom']
            );
        }
        return $result;
    }
}

    ?>
