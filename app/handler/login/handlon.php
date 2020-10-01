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
        	require("handler/connect_db.php");
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
			if (!file_exists($dir)) mkdir($dir, 0777);
            console.log('Email e password validi');
			echo '<style type="text/css">#err_ep {display: none; text-align: center;}</style>';                
        else :
			console.log('Email e password errati');
			echo '<style type="text/css">#err_ep {display: block; text-align: center;}</style>';    
        endif;
    }
    
    function createUser() {
    	require("handler/connect_db.php");
    	$name = $_POST['name'];
    	$surname = $_POST['surname'];
    	$email = $_POST['eemail'];
    	$password = $_POST['ppassword'];
    	$quser = "insert into users(name,surname,email,password) values('{$name}','{$surname}','{$email}',sha1('{$password}'))";
    	$ris = $mysqli->query($quser);
    	if ($ris) :
			echo '<style type="text/css">#succ_reg{display: block; text-align: center;}</style>'; 
		else:
			echo '<style type="text/css">#err_ep {display: err_reg; text-align: center;}</style>'; 
    	endif;
    }
    
    function lastCheck() {
		if (checkPostLogin() && checkUserData()) :
			$epost = $_POST["email"];
			setcookie($cookie_user, "", 1, "/");
			setcookie($cookie_user, $epost, $scadenza, "/");            				
			echo '<div class="spinner"> <div class="bounce1"></div> <div class="bounce2"></div> <div class="bounce3"></div> </div>';
			header('Refresh: 1; URL = myspace.php');
		else :
			echo '<button class="btn" type="submit" name = "login"><span>Accedi</span></button>';		            		
		endif;
    }
?>
