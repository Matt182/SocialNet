<?php
/**
 * Different helpers functions
 *
 */
namespace hive2\controll\profile;

function getAvatar($id)
{
    if(file_exists("src/views/profile/avatars/{$id}avatar.jpg")) {
        return "/src/views/profile/avatars/{$id}avatar.jpg";
    } else {
        return "/src/views/profile/avatars/default.jpg";
    }
}
