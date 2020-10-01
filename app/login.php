<?php
	require("handler/login/checker.php");	
	include "handler/login/handlon.php";

    if (checkPostLogin()) createSpaceUser();
    if (checkPostRegister()) createUser();
?>
<html>
    <head>
		<meta charset="UTF-8">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width, height=device-height">    
        <!-- Import Css -->
        <link rel='stylesheet' href='https://unpkg.com/material-components-web@latest/dist/material-components-web.css'>
        <link rel='stylesheet' href='https://fonts.googleapis.com/icon?family=Material+Icons'>
        <link rel="stylesheet" href="css/common.css">	
        <link rel="stylesheet" href="css/login.css">
        <!-- Import JavaScript -->
        <script type="text/javascript" src="js/login.js"></script>	
        
        <title>Accedi - WayCloud</title>	
    </head>
    <body style="background-color:#ecebeb;">    
		<header class="mdc-top-app-bar mdc-top-app-bar--short">
			<div class="mdc-top-app-bar__row">
		  		<span class="mdc-top-app-bar__title">
					<img class="logo" src="./img/waycloud_logo.png">
		  		</span>
		  		<section class="mdc-top-app-bar__section mdc-top-app-bar__section--align-end" role="toolbar">
					<p id="lblAction">Registrati</p>
					<button id="imgRegister" onclick="showR();" class="material-icons mdc-top-app-bar__action-item mdc-icon-button">person_add</button>
					<button style="display: none;" id="imgLogin" onclick="showR()" class="material-icons mdc-top-app-bar__action-item mdc-icon-button">login</button>
				</section>
			</div>
		</header>   
            
        <div class="card" style="display:block; text-align: center;" id="login">
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
							header('Refresh: 1; URL = myspace.php');
						else :
							echo '<button class="btn" type="submit" name = "login"><span>Accedi</span></button>';		            		
						endif;
		            ?>
		        </form>
        	</div>
        </div>
        
        <div class="card" style="height: 490px; text-align: center;" id="register" >
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

