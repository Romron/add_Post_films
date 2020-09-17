<!DOCTYPE html>
<html>
<head>
	<title>addPostFilms DashBoard</title>
	<link href="style.css" rel="stylesheet" type="css/text">
<?php
	require_once("functions_add_Post_films.php");
	// require_once("style_add_Post_films.css");
	// $parth_to_plugin = plugin_dir_path( __FILE__ );
	// echo($parth_to_plugin);
	// require_once("script_add_Post_films.js");
?>

</head>
<body>
	<h1>addPostFilms DashBoard</h1>

	<?# echo(plugins_url('add_Post_films/addPostFilms_script.js'));?>
	<input id="start_button" type="button" value="START">
	<div id="result"></div>
	<script src="<?echo(plugins_url('add_Post_films/addPostFilms_script.js'));?>"></script>
	









<!-- Для LiveReload: -->
<script>document.write('<script src="http://' + (location.host || 'localhost').split(':')[0] + ':35729/livereload.js?snipver=1"></' + 'script>')</script>
</body>
</html>

















 







