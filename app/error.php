<?php if (isset($_POST['reaload'])) header('Refresh: 0; URL = login.php'); ?>
<html>
	<head>
		<title>Errore 500</title>
	</head>
	<body>
		<form method="POST">
			<h3>Errore 500 - MySqli Library non è importata</h3><br>
			<input type="submit" name="reload" value="Ricarica"></input>
		</form>		
	</body>
</html>
