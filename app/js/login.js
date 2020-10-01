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
