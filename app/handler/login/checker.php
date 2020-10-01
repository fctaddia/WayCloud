<?php
	if (isset($_COOKIE['email']) || !empty($_COOKIE['email'])) :
		header('Refresh: 0; URL = myspace.php');
		session_start();
		$_SESSION['valid'] = true;
		$_SESSION['timeout'] = time();
	endif;
?>
