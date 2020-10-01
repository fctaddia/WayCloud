function showUpload() {
	var x = document.getElementById("uploads");
	if(window.getComputedStyle(x).display === "none") {
		document.getElementById('myspace').style.background = "rgba(3, 156, 152, 0)";
		document.getElementById('myspace').style.pointerEvents = 'auto';
		document.getElementById('upload').style.background = "rgba(3, 156, 152, 0.15)";
		document.getElementById('upload').style.pointerEvents = 'none';
		document.getElementById('storage').style.background = "rgba(181, 181, 181, 0)";
		document.getElementById('storage').style.pointerEvents = 'auto';
		
		document.getElementById('files').style.display = 'none';
		document.getElementById('profile').style.display = 'none';
		document.getElementById('storages').style.display = 'none';
		document.getElementById('uploads').style.display = 'block';
		
		document.getElementById('txtProfile').style.display = 'none';
		document.getElementById('txtSpace').style.display = 'none';
		document.getElementById('txtArch').style.display = 'none';
		document.getElementById('txtUpload').style.display = 'block';
		
		document.getElementById('imgRefresh').style.display = 'none';				
	}
}

function showSpace() {
	var x = document.getElementById("files");
	if(window.getComputedStyle(x).display === "none") {
		document.getElementById('upload').style.background = "rgba(3, 156, 152, 0)";
		document.getElementById('upload').style.pointerEvents = 'auto';
		document.getElementById('myspace').style.background = "rgba(3, 156, 152, 0.15)";
		document.getElementById('myspace').style.pointerEvents = 'none';
		document.getElementById('storage').style.background = "rgba(181, 181, 181, 0)";
		document.getElementById('storage').style.pointerEvents = 'auto';
		
		document.getElementById('uploads').style.display = 'none';
		document.getElementById('profile').style.display = 'none';
		document.getElementById('storages').style.display = 'none';
		document.getElementById('files').style.display = 'block';
		
		document.getElementById('txtProfile').style.display = 'none';
		document.getElementById('txtUpload').style.display = 'none';
		document.getElementById('txtArch').style.display = 'none';
		document.getElementById('txtSpace').style.display = 'block';
		
		document.getElementById('imgRefresh').style.display = 'block';		
	}
}

function showUser() {
	var x = document.getElementById("profile");
	if(window.getComputedStyle(x).display === "none") {
		document.getElementById('upload').style.background = "rgba(3, 156, 152, 0)";
		document.getElementById('upload').style.pointerEvents = 'auto';
		document.getElementById('myspace').style.background = "rgba(3, 156, 152, 0)";
		document.getElementById('myspace').style.pointerEvents = 'auto';
		document.getElementById('storage').style.background = "rgba(181, 181, 181, 0)";
		document.getElementById('storage').style.pointerEvents = 'auto';
		
		document.getElementById('uploads').style.display = 'none';
		document.getElementById('storages').style.display = 'none';
		document.getElementById('files').style.display = 'none';
		document.getElementById('profile').style.display = 'block';
		
		document.getElementById('txtUpload').style.display = 'none';
		document.getElementById('txtSpace').style.display = 'none';
		document.getElementById('txtArch').style.display = 'none';
		document.getElementById('txtProfile').style.display = 'block';
		
		document.getElementById('imgRefresh').style.display = 'none';
	}
}

function showStorage() {
	var x = document.getElementById("storages");
	if(window.getComputedStyle(x).display === "none") {
		document.getElementById('storage').style.background = "rgba(181, 181, 181, 0.5)";
		document.getElementById('storage').style.pointerEvents = 'none';
		document.getElementById('upload').style.background = "rgba(3, 156, 152, 0)";
		document.getElementById('upload').style.pointerEvents = 'auto';
		document.getElementById('myspace').style.background = "rgba(3, 156, 152, 0)";
		document.getElementById('myspace').style.pointerEvents = 'auto';
		
		document.getElementById('uploads').style.display = 'none';
		document.getElementById('files').style.display = 'none';
		document.getElementById('profile').style.display = 'none';
		document.getElementById('storages').style.display = 'block';
		
		document.getElementById('txtUpload').style.display = 'none';
		document.getElementById('txtSpace').style.display = 'none';
		document.getElementById('txtProfile').style.display = 'none';
		document.getElementById('txtArch').style.display = 'block';
		
		document.getElementById('imgRefresh').style.display = 'none';
	}
}

function logout() {
	var r = confirm("Conferma uscita da WayCloud");
	if (r==true) { window.location.href = '../logout.php';	}
}

function refresh() {
	location.reload();
}

