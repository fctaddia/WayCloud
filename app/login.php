<?php
	$cookie_user = "email";
	$name = "";
	$surname = "";
	$email = "";
	$password = "";
	$scadenza = time() + 3600 * 24 * 30;
	
	if (!function_exists('mysqli_init') && !extension_loaded('mysqli')) header('Refresh: 0; URL=error.php');

    function checkPostLogin() {
        if (isset($_POST['login']) && !empty($_POST['email']) && !empty($_POST['password'])) :        	
            return true;
        else :
            return false;
        endif;
    }
    
    function checkPostRegister() {
    	if (isset($_POST['register']) && !empty($_POST['eemail']) && !empty($_POST['ppassword']) && !empty($_POST['name']) && !empty($_POST['surname'])):
    		return true;
    	else:
    		return false;
    	endif;
    }

    function checkUserData() {
        if (checkPostLogin()) :
        	$mysqli = new mysqli('localhost', 'root', 'password', 'waycloud');
    		if($mysqli->connect_error) header('Refresh: 0; URL = ciao.php');
			$email = $_POST["email"];
			$password = sha1($_POST["password"]);					
            $query = "select email,password from users where email='$email' and password='$password'";
            $risultato= $mysqli->query($query);            
            if(!$risultato || $risultato->num_rows==0) :         	
				return false;
            else :
				return true;
            endif;					
        endif;
    }

    function createSpaceUser() {
        if (checkUserData()) :
            $dir = './users/'.$_POST["email"];
			if (!file_exists($dir)) {
				mkdir($dir, 0777);
			}
            console.log('Email e password validi');
			echo '<style type="text/css">
					#err_ep {
						display: none;
					}
			      </style>'; 
                    
        else :
			console.log('Email e password errati');
			echo '<style type="text/css">
					#err_ep {
						display: block;
					}
			      </style>';    
        endif;
    }
    
    function createUser() {
		$mysqli = new mysqli('localhost', 'root', 'password', 'waycloud');
		if($mysqli->connect_error) header('Refresh: 0; URL = ciao.php');
    	$name = $_POST['name'];
    	$surname = $_POST['surname'];
    	$email = $_POST['eemail'];
    	$password = $_POST['ppassword'];
    	$quser = "insert into users(name,surname,email,password) values('{$name}','{$surname}','{$email}',sha1('{$password}'))";
    	$ris = $mysqli->query($quser);
    	if ($ris) :
			echo '<style type="text/css">
					#succ_reg {
						display: block;
					}
			      </style>'; 
		else:
			echo '<style type="text/css">
					#err_ep {
						display: err_reg;
					}
			      </style>'; 
    	endif;
    }

    if (checkPostLogin()) createSpaceUser();
    if (checkPostRegister()) createUser();

?>
<html>
    <head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">    
        <title>Accedi - WayCloud</title>
        <link rel='stylesheet' href='https://unpkg.com/material-components-web@latest/dist/material-components-web.css'>
        <link rel='stylesheet' href='https://fonts.googleapis.com/icon?family=Material+Icons'>
        <link rel="stylesheet" href="css/login.css">
        <script>
			function showR(){ 
				var x = document.getElementById("register");
				if(window.getComputedStyle(x).display === "none") {
					document.getElementById('login').style.display = 'none';
					document.getElementById('register').style.display = 'block';
					document.getElementById('lblAction').innerHTML = "Accedi";
					document.getElementById('imgRegister').style.display = 'none';
					document.getElementById('imgLogin').style.display = 'block';
					document.getElementById('err_ep').style.display = 'none';
				} else {
					document.getElementById('register').style.display = 'none';
					document.getElementById('login').style.display = 'block';
					document.getElementById('lblAction').innerHTML = "Registrati";
					document.getElementById('imgLogin').style.display = 'none';
					document.getElementById('imgRegister').style.display = 'block';
					document.getElementById('succ_reg').style.display = 'none';
					document.getElementById('err_reg').style.display = 'none';
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
					<p id="lblAction">Registrati</p>
					<button id="imgRegister" onclick="showR()" class="material-icons mdc-top-app-bar__action-item mdc-icon-button" aria-label="L">person_add</button>
					<button style="display: none;" id="imgLogin" onclick="showR()" class="material-icons mdc-top-app-bar__action-item mdc-icon-button" aria-label="L">login</button>
				</section>
			</div>
		</header>   
            
        <div class="card" style="display:block;" id="login">
        	<div class = "container">
		        <form class = "form-signin" method = "post">
		            <div class="group">      
		                <input style="margin-top: 30px;" type="text" name = "email" required>	                
		                <span class="bar"></span>
		                <label style="margin-top: 30px;">Email</label>
		            </div><br><br>
		            <div class="group">      
		                <input type="password" name = "password" required>
		                <span class="bar"></span>		                
		                <label>Password</label>
		            </div><br>
		            <?php
		            	if (checkPostLogin() && checkUserData()) :
		            		$epost = $_POST["email"];
            				setcookie($cookie_user, "", 1, "/");
            				setcookie($cookie_user, $epost, $scadenza, "/");            				
		            		echo '<div class="spinner"> <div class="bounce1"></div> <div class="bounce2"></div> <div class="bounce3"></div> </div>';
							header('Refresh: 1; URL = main.php');
		            	else :
		            		echo '<button class="btn" type="submit" name = "login"><span>Accedi</span></button>';		            		
		            	endif;
		            ?>
		        </form>
        	</div>
        </div>
        
        <div class="card" style="height: 490px;" id="register" >
    		<h3>Registrazione</h3>
    		<div class = "container">
    			<form class = "form-signin" method = "post">	
	    			<div class="group">      
			            <input style="margin-top: 5px;" type="text" name = "name" required>
			            <span class="bar"></span>
			            <label style="margin-top: 5px;">Nome</label>
			        </div><br><br>
			        <div class="group">      
			            <input style="margin-top: 5px;" type="text" name = "surname" required>
			            <span class="bar"></span>		                
			            <label style="margin-top: 5px;">Cognome</label>
			        </div><br><br>
			        <div class="group">      
			            <input style="margin-top: 5px;" type="text" name = "eemail" required>
			            <span class="bar"></span>		                
			            <label style="margin-top: 5px;">Email</label>
			        </div><br><br>
			        <div class="group">      
			            <input style="margin-top: 5px;" type="password" name = "ppassword" required>
			            <span class="bar"></span>		                
			            <label style="margin-top: 5px;">Password</label>
			        </div>
			        <button class="btn" type="submit" name="register"><span>Registrati</span></button>
				</form>
    		</div>
        </div>
        
        <div style="top:340px; height:70px; background-color:rgba(52, 167, 83,0.2);" class="card" id="succ_reg"><p style="margin-top:25px; font-size:19px;">Registrazione riuscita</p></div>
        
        <div style="top:340px; height:70px; background-color:rgba(255, 102, 102,0.2);" class="card" id="err_reg"><p style="margin-top:25px; font-size:19px;">Errore nella registrazione</p></div>
        
        <div style="top:340px; height:70px; background-color:rgba(255, 102, 102,0.2);" class="card" id="err_ep"><p style="margin-top:25px; font-size:19px;">Email o password errati</p></div>
              
    </body>
</html>

