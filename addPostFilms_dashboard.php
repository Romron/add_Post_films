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
	


	<input id="start_jQuery" type="button" value="jQuery">


	
<!-- 	<script>
	jQuery(function($){
		$('#start_jQuery').click(function(){
			console.log('Если это работает, уже неплохо');
		});
	});
	</script> -->

	<?php
	// echo( plugin_dir_url(__FILE__) . 'test_1.php' );

	?>

<script>
	jQuery(function($){
		$('#start_jQuery').click(function(){
			$.ajax({
				// url: 'http://test-local-host/wp-content/plugins/add_Post_films/test_1.php',
				url: '<?php echo admin_url("admin-ajax.php") ?>',
				type: 'GET',
				data: 'action=my_action¶m1=2¶m2=3', // можно также передать в виде объекта
				// beforeSend: fucntion( xhr ){
				// 	$('#start_jQuery').text('Загрузка, 5 сек...');	
				// },
				success: function( data ){
					$('#start_jQuery').text('Отправить');	
					// alert( data );
				}
			});
			// если элемент – ссылка, то не забываем:
			// return false;
		});
	});
</script>












<!-- для ajax: -->
	<script src="<?echo(plugins_url('add_Post_films/addPostFilms_script.js'));?>"></script>
<!-- Для LiveReload: -->
<script>document.write('<script src="http://' + (location.host || 'localhost').split(':')[0] + ':35729/livereload.js?snipver=1"></' + 'script>')</script>
</body>
</html>

















 







