<?php 
	if (!isset($_COOKIE['email']) || empty($_COOKIE['email'])) :
		header('Refresh: 0; URL = login.php');
	else:
		session_start();
		$_SESSION['valid'] = true;
		$_SESSION['timeout'] = time();		
	endif;
?>
