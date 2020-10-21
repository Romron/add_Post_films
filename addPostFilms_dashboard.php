<!DOCTYPE html>
<html>
<head>
	<title>addPostFilms_2.0 DashBoard</title>
	<link href="style.css" rel="stylesheet" type="css/text">
	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<?php
	// require_once("function.php");
	require_once("test_1.php");
?>

</head>
<body>
	<h1>addPostFilms DashBoard</h1>


	<p>
	<h3>Краткое описание принцыпа работы плагина:</h3>
		Цель:
			формирование записей с прикреплёнными постерами.<br>
			При этом каждая запись привязывать к:<br>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;существующим типам записей<br>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;существующим таксономиям<br>
			Страницы для типов записей создаються заранее в ручную в каталоге активной теммы


	<br><br><br>
	

	<br><br><br>
	</p>

	<input id="start_button" type="button" value="START">
	<div id="result">	
		<?php 
			// echo(plugins_url());



		// получаю массив информации о фильмах:
		$path_info = pathinfo(__file__);
		$file_name_json = $path_info['dirname'] . '/json/result_DateAboutAllFilms  TEST 10 .json';
		$arr_posts_from_json = get_arr_from_json_file($file_name_json);



		// $result_Insert_Posts = insert_Posts_films($arr_posts_from_json);

		?>



		
		<br><br>
		<h4>Список записей с вложениями:</h4>
		<?php
		// запрос
		$wpb_all_query = new WP_Query(array('post_type'=>'films', 'post_status'=>'publish', 'posts_per_page'=>-1)); ?>

		<?php if ( $wpb_all_query->have_posts() ) : ?>

		<ul>

			<!-- the loop -->
			<?php while ( $wpb_all_query->have_posts() ) : $wpb_all_query->the_post(); ?>
				<li>
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					<?php $media = get_attached_media( 'image');?> <pre><?php  # print_r( $media );  ?></pre>
				</li>

			<?php endwhile; ?>
			<!-- end of the loop -->

		</ul>

			<?php wp_reset_postdata(); ?>

		<?php else : ?>
			<p><?php _e( 'Извините, нет записей, соответствуюших Вашему запросу.' ); ?></p>
		<?php endif; ?>








	</div>
		

<!-- для ajax: -->
	<script src="<?echo(plugins_url('add_Post_films/addPostFilms_script.js'));?>"></script>



<script type="text/javascript">
	// перезагрузка страницы
	$('#start_button').click(function() {
	   location.reload();
	});
</script>



<!-- Для LiveReload: -->
<script>document.write('<script src="http://' + (location.host || 'localhost').split(':')[0] + ':35729/livereload.js?snipver=1"></' + 'script>')</script>
</body>
</html>

















 







