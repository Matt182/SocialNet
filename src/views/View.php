<?php
namespace hive2\views;

/**
*
*/
class View
{

    function __construct()
    {
        // code...
    }

    public function render($page, $args=[])
    {
        extract($args);
        ob_start();
        include_once "$page.php";
        return ob_get_clean();
    }

    public function redirect($page)
    {
        header("Location:$page");
    }
}
