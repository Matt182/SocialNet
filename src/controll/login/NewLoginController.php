<?php
namespace hive2\controll\login;
use hive2\views\IndexView;
/**
* 
*/
class NewLoginController
{
	
	function __construct()
	{
		# code...
	}

	public function ActionIndex($name)
	{
		$view = new IndexView();
		$view->render($name);
	}

	public function ActionRegister($name)
	{
		$view = new IndexView();
		$view->render($name);
	}
}