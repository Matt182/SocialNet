<?php
/**
* Different helpers functions
*
*/
namespace hive2\controll\profile;

/**
* Return src of image of appropriate user, return default image if user doesnt have own one
*
* @param     int $id
* @return    string
*/
function getAvatar($id)
{
    if(file_exists("src/views/profile/avatars/{$id}avatar.jpg")) {
        return "/src/views/profile/avatars/{$id}avatar.jpg";
    } else {
        return "/src/views/profile/avatars/default.jpg";
    }
}
