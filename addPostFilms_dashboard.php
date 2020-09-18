<!DOCTYPE html>
<html>
<head>
	<title>addPostFilms DashBoard</title>
	<link href="style.css" rel="stylesheet" type="css/text">
	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<?php
	require_once("function.php");
?>

</head>
<body>
	<h1>addPostFilms DashBoard</h1>

	<?# echo(plugins_url('add_Post_films/addPostFilms_script.js'));?>
	<input id="start_button" type="button" value="START">
	<div id="result"></div>
	





<!-- для ajax: -->
	<script src="<?echo(plugins_url('add_Post_films/addPostFilms_script.js'));?>"></script>
<!-- Для LiveReload: -->
<script>document.write('<script src="http://' + (location.host || 'localhost').split(':')[0] + ':35729/livereload.js?snipver=1"></' + 'script>')</script>
</body>
</html>

















 







