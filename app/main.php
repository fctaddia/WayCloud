<?php
	if (!function_exists('mysqli_init') && !extension_loaded('mysqli')) header('Refresh: 0; URL = error.php');	
	session_start();
	$_SESSION['valid'] = true;
	$_SESSION['timeout'] = time();
	$username = $_COOKIE[email];		
	$ris = "";
	$name = "";
	$surname = "";
	$id_user = 0;
	$password = "";	

	$mysqli = new mysqli('localhost', 'root', 'password', 'waycloud');
	if ($mysqli -> connect_error) header('Refresh: 0; URL = error.php');
	$query = "select id_user,name,surname,password from users where email='$username'";
	$ris = $mysqli->query($query);
	while ($row = $ris -> fetch_assoc()) :
		$id_user = $row['id_user'];
		$name = $row['name'];
		$surname = $row['surname'];
		$password = $row['password'];		
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
?>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
  		<title>Il mio spazio - WayCloud</title>  		
  		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
		<link rel='stylesheet' href='https://fonts.googleapis.com/icon?family=Material+Icons'>
		<link rel='stylesheet' href='https://unpkg.com/material-components-web@latest/dist/material-components-web.css'>
		<link rel="stylesheet" href="css/main.css">
		<script>			
			function logout() {
				var r = confirm("Conferma uscita da WayCloud");
				if (r==true) { window.location.href = 'logout.php';	}
			}			
			function showU(){ 
				var x = document.getElementById("profile");
				if(window.getComputedStyle(x).display === "none") {
					document.getElementById('profile').style.display = 'block';
				} else {
					document.getElementById('profile').style.display = 'none';
				}				 
			}						
		</script>				
	</head>
	<body>
		<header class="mdc-top-app-bar mdc-top-app-bar--short">
			<div class="mdc-top-app-bar__row">
		  		<span class="mdc-top-app-bar__title">
					<img src="./img/waycloud_logo.png" style="width:180px;height:45px; position:absolute;top:5px; left:20px">
		  		</span>
				<section class="mdc-top-app-bar__section mdc-top-app-bar__section--align-end" role="toolbar">
					<?php echo "<p>".$name." ".$surname."</p>";?>
					<button onclick="showU()" class="material-icons mdc-top-app-bar__action-item mdc-icon-button" aria-label="L">account_box</button>
					<button onclick="logout()" class="material-icons mdc-top-app-bar__action-item mdc-icon-button" aria-label="L">exit_to_app</button>
				</section>
			</div>
		</header>
		
		<div class="card" style="top:50%; left:14%; display:block;">
        	<div class = "container">
        		<h3>Carica file</h3>
        		<form id="formUpload" method="post" enctype="multipart/form-data">
					<input style="width:77%;" type="file" name="file">
					<?php					
						if (isset($_POST['upload']) && !empty($_FILES["file"]["name"])) :
							$uploads_dir = 'users/'.$username;
							$pname = $_FILES["file"]["name"];
							$tname = $_FILES["file"]["tmp_name"];
							
							$file = addslashes(file_get_contents($_FILES["file"]["tmp_name"]));
							$data = my_encrypt($file,$password);
							$data1 = my_decrypt($data,$password);
							
							
							$tmp_size = filesize($_FILES['file']['tmp_name']);
							$size = round($tmp_size/1024, 2);
							move_uploaded_file($tname, $uploads_dir.'/'.$pname);
							$type = mime_content_type($uploads_dir.'/'.$pname);
							$sql = "insert into files(name,size,type,data,user) values('{$pname}','{$size}','{$type}','{$data}','{$id_user}')";
							$ris = $mysqli->query($sql);							
							if($ris):
								echo "<br><br>File caricato correttamente";
							else :
								echo "<br><br>Errore nel caricamento";
							endif;		
						else:
							echo "<br><br>Scegliere prima un file";
						endif;					
					?>
				</form>							
        	</div>
        </div>
        
        <div class="card" style="top:50%; left:52%; width:50%; height:70%; display:block;">
        	<div class = "container" style="margin-right:20px; margin-left:20px;">
        		<h3>I miei file</h3>
        		<form id="formFile" method="post">
        			<?php        			
		    			$qtable = "select id_file,name,size,type from files where user=$id_user";
		    			$ris = $mysqli->query($qtable);
		    			echo '<table id="customers" style="text-align:center;">';
		    			echo '<tr><th>Nome</th><th>Dimensione</th><th>Tipo</th><th>Scarica</th><th>Elimina</th></tr>';
						while ($row = $ris -> fetch_assoc()) :
							echo "<tr><td>".$row['name']."</td><td>".$row['size']." KB</td><td>".$row['type']."</td><td><button value=\"".$row['name']."\" type=\"submit\" name=\"download\" form=\"formFile\" class=\"material-icons mdc-top-app-bar__action-item mdc-icon-button\" aria-label=\"L\">get_app</button></td><td><button type=\"submit\" name=\"remove\" form=\"formFile\" value=\"".$row['id_file']."\" class=\"material-icons mdc-top-app-bar__action-item mdc-icon-button\" aria-label=\"L\">delete</button></td>";
						endwhile;
		    			echo '</table>';       		
		    		?>
        		</form>       		       							
        	</div>
        </div>
        
        <div class="card" style="top:25.5%; left:92%; width:15%; height:37%;" id="profile">
        	<div class="container">
        		<img src="./img/account.png" style="width:28%;height:22%; margin-top:10%;"><br>
        		<?php echo "<p>".$name." ".$surname."</p>";?>
        		<?php echo "<p>".$username."</p>";?>
        	</div>
        </div>		
				
		<button style="top: 72%; left: 10.6%; display:block;" form="formUpload" class="btn" type="submit" name="upload" id="btnUpload"><span>Carica</span></button>
		
	</body>
</html>

