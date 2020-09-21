<?php	
	require("handler/connect_db.php");
	require("handler/main/checker.php");	
	include "handler/main/handspace.php";		       
?>
<html>
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width, height=device-height">		  
  		<!-- Import Css -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
		<link rel='stylesheet' href='https://unpkg.com/material-components-web@latest/dist/material-components-web.css'>
		<link rel='stylesheet' href='https://fonts.googleapis.com/icon?family=Material+Icons'>
		<link rel="stylesheet" href="css/common.css">	
		<link rel="stylesheet" href="css/main.css">	
		<!-- Import JavaScript -->
		<script type="text/javascript" src="js/main.js"></script>
		
		<title>Il mio spazio - WayCloud</title>			
	</head>
	<body>
	
		<header class="mdc-top-app-bar mdc-top-app-bar--short">
			<div class="mdc-top-app-bar__row">
		  		<span class="mdc-top-app-bar__title">
					<img class="logo" src="./img/waycloud_logo.png">
		  		</span>
				<section class="mdc-top-app-bar__section mdc-top-app-bar__section--align-end" role="toolbar">
					<?php echo "<p>".$name." ".$surname."</p>";?>
					<button onclick="showUser();" class="material-icons mdc-top-app-bar__action-item mdc-icon-button">account_box</button>
					<button onclick="logout();" class="material-icons mdc-top-app-bar__action-item mdc-icon-button">exit_to_app</button>
				</section>
			</div>
		</header>

		<div class="stool">
			<h2 id="txtSpace" class="txtStool">Il mio spazio</h2>
			<h2 id="txtUpload" class="txtStool" style="display:none;">Carica file</h2>
			<h2 id="txtProfile" class="txtStool" style="display:none;">Il mio profilo</h2>
			<h2 id="txtArch" class="txtStool" style="display:none;">Archiviazione</h2>
			<img id="imgRefresh" onclick="refresh();" class="refresh" src="./img/refresh.png">
		</div>
		
		<div class="drawer">
			<div class="upload-btn-wrapper" onclick="showUpload();" >
				<button class="btnUpload"><span>Nuovo</span></button>
				<input type="file" name="file" />
			</div>
			<div onclick="showSpace();" class="myspace" id="myspace">
				<img class="imgMySpace" src="./img/folder.png">
				<p class="txtMySpace">Il mio spazio</p>
			</div>
			<div onclick="showUpload();" class="upload" id="upload">
				<img class="imgUpload" src="./img/upload.png">
				<p class="txtUpload">Carica file</p>
			</div>
			<div onclick="showStorage();" class="storage" id="storage">
				<img class="imgStorage" src="./img/storage.png">
				<?php echo "<p class=\"txtStorage\">".$totalsize." KB</p>"; ?>
			</div>
		</div>

		
		<!--
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
        </div> -->
        
        
        <div id="files" class="contFU"">
        	<div class = "container">
        		<form id="formFile" method="post">
        			<?php        			
		    			$qtable = "select id_file,name,size,type from files where user=$id_user";
		    			$ris = $mysqli->query($qtable);
		    			echo '<table id="customers">';
		    			echo '<tr><th>Nome</th><th>Dimensione</th><th>Tipo</th><th>Scarica</th><th>Elimina</th></tr>';
						while ($row = $ris -> fetch_assoc()) :
							echo "<tr><td>".$row['name']."</td><td>".$row['size']." KB</td><td>".$row['type']."</td><td><button value=\"".$row['name']."\" type=\"submit\" name=\"download\" form=\"formFile\" class=\"material-icons mdc-top-app-bar__action-item mdc-icon-button\">get_app</button></td><td><button type=\"submit\" name=\"remove\" form=\"formFile\" value=\"".$row['id_file']."\" class=\"material-icons mdc-top-app-bar__action-item mdc-icon-button\">delete</button></td>";
						endwhile;
		    			echo '</table>';       		
		    		?>
        		</form>     		       							
        	</div>
        </div>
        
        <div id="uploads" class="contFU" style="display: none; background-color:red;">
        	<div class = "container">
        		
        	</div>
        </div>
        
        <div id="profile" class="contFU" style="display: none; background-color:green;">
			<div class = "container">
				
			</div>
        </div>
        
        <div id="storages" class="contFU" style="display: none; background-color:blue;">
			<div class = "container">
				
			</div>
        </div>		
	</body>
</html>

