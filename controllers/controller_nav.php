<?php

require_once 'controllers/controller.php';

class Controller_Nav extends Controller
{
	public function goToBack()
	{
		$_SESSION['back'] = true;
		header('Location: index.php');
	}

	public function goToFront()
	{
		$_SESSION['back'] = false;
		header('Location: index.php');
	}
}

?>