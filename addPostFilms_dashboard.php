<!DOCTYPE html>
<html>
<head>
	<title>addPostFilms DashBoard</title>
<?php
	require_once("functions_add_Post_films.php");
	require_once("style_add_Post_films.css");
	// $parth_to_plugin = plugin_dir_path( __FILE__ );
	// echo($parth_to_plugin);
	// require_once("script_add_Post_films.js");
?>

</head>
<body>
	<h1>addPostFilms DashBoard</h1>
	<input type="button" value="START">
	
	<?echo(plugins_url('add_Post_films/addPostFilms_script.js'));?>

	<script src="<?echo(plugins_url('add_Post_films/addPostFilms_script.js'));?>"></script>
	
</body>
</html>

















 







