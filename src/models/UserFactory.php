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
            $userData['id'], $userData['first_name'],
            $userData['email'], $userData['resume'],
            $userData['online'], $userData['was_online'], $userData['friends'],
            $userData['req_to'], $userData['req_from']
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
                $member['id'], $member['first_name'],
                $member['email'], $member['resume'],
                $member['online'], $member['was_online'], $member['friends'],
                $member['req_to'], $member['req_from']
            );
        }
        return $result;
    }
}

    ?>
