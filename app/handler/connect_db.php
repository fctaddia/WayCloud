<?php 
	if (!function_exists('mysqli_init') && !extension_loaded('mysqli')) header('Refresh: 0; URL = error.php');
	$mysqli = new mysqli('localhost', 'root', 'password', 'waycloud');
	if ($mysqli -> connect_error) header('Refresh: 0; URL = error.php');
?>
