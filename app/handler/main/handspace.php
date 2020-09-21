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
		$uploads_dir = 'users/'.$username;
		$dname = $_POST['download'];
		$pfile = $uploads_dir.'/'.$dname;
		$dfile = file_get_contents($pfile);
		$tfile = mime_content_type($pfile);		
		header("Content-type: ".$tfile."");
		header("Content-Disposition: attachment; filename=".$dname."");		
		echo $dfile;		
	endif;

	if (isset($_POST['remove'])) :	
		$fid = $_POST['remove'];
		$qdel = "delete from files where id_file=$fid";
		$mysqli->query($qdel);		
	endif;
	
	function my_encrypt($data, $key) {
		$encryption_key = base64_decode($key);
		$iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
		$encrypted = openssl_encrypt($data, 'aes-256-cbc', $encryption_key, 0, $iv);
		return base64_encode($encrypted . '::' . $iv);
	}

	function my_decrypt($data, $key) {
		$encryption_key = base64_decode($key);
		list($encrypted_data, $iv) = explode('::', base64_decode($data), 2);
		return openssl_decrypt($encrypted_data, 'aes-256-cbc', $encryption_key, 0, $iv);
	}
	
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
