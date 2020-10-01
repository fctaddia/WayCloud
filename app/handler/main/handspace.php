<?php
	 
	$username = $_COOKIE[email];		
	$ris = "";
	$name = "";
	$surname = "";
	$id_user = 0;
	$password = "";
	$totalsize = 0;	
	
	$query = "select id_user,name,surname,password from users where email='$username'";
	$ris = $mysqli->query($query);
	while ($row = $ris -> fetch_assoc()) :
		$id_user = $row['id_user'];
		$name = $row['name'];
		$surname = $row['surname'];
		$password = $row['password'];		
	endwhile;
	
	$qsize = "select size from files where user=$id_user";
	$ris = $mysqli->query($qsize);
	while ($row = $ris -> fetch_assoc()) :
		$totalsize += $row['size'];
	endwhile;
	
	if (isset($_POST['download'])) :
		$dname = $_POST['download'];	
		$ALGORITHM = 'AES-256-CBC';
		$IV = '12dasdq3g5b2434b';
		$uploads_dir = 'users/'.$username;
		$pfile = $uploads_dir.'/'.$dname;
		$dfile = openssl_decrypt(file_get_contents($pfile), $ALGORITHM, $password, 0, $IV);		
		$tfile = mime_content_type($pfile);
		header("Content-type: $tfile");
		header("Content-Disposition: attachment; filename=$dname");
		echo $dfile;	
	endif;

	if (isset($_POST['remove'])) :
		$rname = $_POST['remove'];
		$filename = "";
		$qrname = "select name from files where id_file=$rname";
		$ris = $mysqli->query($qrname);
		while ($row = $ris -> fetch_assoc()) :
			$filename = $row['name'];
		endwhile;
		$uploads_dir = 'users/'.$username;
		if (unlink($uploads_dir.'/'.$filename)) :
			$qdel = "delete from files where id_file=$rname";
			$mysqli->query($qdel);
			header("Refresh:0");
		endif;
	endif;
	
	function get_client_ip_server() {
		$ipaddress = '';
		if ($_SERVER['HTTP_CLIENT_IP'])
		    $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
		else if($_SERVER['HTTP_X_FORWARDED_FOR'])
		    $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
		else if($_SERVER['HTTP_X_FORWARDED'])
		    $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
		else if($_SERVER['HTTP_FORWARDED_FOR'])
		    $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
		else if($_SERVER['HTTP_FORWARDED'])
		    $ipaddress = $_SERVER['HTTP_FORWARDED'];
		else if($_SERVER['REMOTE_ADDR'])
		    $ipaddress = $_SERVER['REMOTE_ADDR'];
		else
		    $ipaddress = 'UNKNOWN';
		return $ipaddress;
	}
?>
