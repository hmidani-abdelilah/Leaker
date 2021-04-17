<!DOCTYPE html>
<html>
<head>
	<meta charset = "UTF-8">
	<title> jjapsomware 0.0.1 </title>
	<style>
		body {
			text-align: center;
			margin: 0 0 0 0;
			padding: 0 0 0 0;
			background-color: black;
		}
		
		#container {
			padding-top: 5%;
		}
		
		#container h2 {
			font-size: 135%;
			color: white;
		}
		
		#container p {
			font-size: 115%;
			color: white;
		}
	</style>
</head>
<body>
	<div id = "container">
		<h2> This website has been disabled by jjapsomware </h2>
		<p> Press the 'decrypt' below to recover. </p>
		<br>
		<form action = "./exethis!.php" method = "POST">
			<button type = "submit" name = "decrypt" value = "RUN"><b>Decrypt</b></button>
		</form>
		<?php #require_once "./exethis!.php"; ?>
	</div>
</body>
</html>
