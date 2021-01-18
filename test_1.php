<!DOCTYPE html>
<html>
<head>
	<title>Test_1</title>
	<meta charset="utf-8">
</head>
<body>

</body>
</html>



<?php
require_once("function_addPF_3.0.php");
set_time_limit(0);
// require($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');



get_all_img();



	//Устанавливаем доступы к базе данных:
	// 	$host = '127.0.0.1:3306'; //имя хоста, на локальном компьютере это localhost
	// 	$user = 'root'; //имя пользователя, по умолчанию это root
	// 	$password = ''; //пароль, по умолчанию пустой
	// 	$db_name = 'prostofilm'; //имя базы данных

	// //Соединяемся с базой данных используя наши доступы:
	// // $sql_link = mysqli_connect($host, $user, $password, $db_name);
	// $sql_link = new mysqli($host, $user, $password, $db_name);

	// $str_query = 'SELECT * FROM `wp_test_pf_posts` WHERE `post_type`= "attachment" AND `post_mime_type` = "image/jpeg"';
	// // $str_query = 'SELECT * FROM `wp_pf_posts`';

	// $result = $sql_link -> query($str_query);

	// while ($arr_row = $result->fetch_assoc()) {
	// 	// echo '<pre>'; print_r($arr_row); echo '</pre>';
	// 		$src = wp_get_attachment_image_src( $arr_row['ID'], 'thumbnail' );
	// 		echo '<pre>'; print_r($src); echo '</pre>'; // for tests
	    
	// }











// mysql_close($sql_link);

// global $wpdb;

// $wpdb = new wpdb( 'root', '', 'test-prostofilm-ml-local-host', '127.0.0.1:3306' );
// if ( ! empty($wpdb->error) ) {
// 	// echo 'ERR messeng:<br><pre>'; print_r($wpdb->error); echo '</pre>';
// 	wp_die($wpdb->error);
// }

// $str_SQL_query = 'SELECT * FROM `wp_test_pf_posts` WHERE `post_type`= "attachment" AND `post_mime_type` = "image/jpeg"';
// // $str_SQL_query = 'DELETE FROM `wp_test_pf_posts` WHERE `post_type`= "attachment" AND `post_mime_type` = "image/jpeg"';
// $results = $wpdb->get_results($str_SQL_query);
// echo '<pre>'; print_r($results); echo '</pre>';






?>
<script>document.write('<script src="http://' + (location.host || 'localhost').split(':')[0] + ':35729/livereload.js?snipver=1"></' + 'script>')</script>

