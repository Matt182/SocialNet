<?php
namespace hive2\controll\profile\DBActions\interfaces;

interface DBProfileActionsInterface
{
    public function updateMe($id);
    public function getById($id);
    public function getAllMembers();
    public function addFriend($user, $memberId);
    public function sendFriendRequest($user, $memberId);
    public function getFriends($id);
    public function getReqFrom($id);
    public function setOffline($id);
    public function setWasOnline($id);
}
