<?php
namespace hive2\auth;

function isAuthorized()
{
    return !empty($_SESSION['user']);

}
