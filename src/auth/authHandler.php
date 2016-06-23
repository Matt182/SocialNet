<?php
namespace hive2\auth;

/**
 * Authentification handler, not completed yet
 * just checks if session got user
 * @return    boolval
 */
function isAuthorized()
{
    return (!empty($_SESSION['user']));
}
