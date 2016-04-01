<?php
namespace hive2\views;

/**
* 
*/
class IndexView
{
	
	function __construct()
	{
		# code...
	}

	public function render($name)
	{
		require_once("$name.php");
	}
}