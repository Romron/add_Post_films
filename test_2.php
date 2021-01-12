<?php
require_once("function_addPF_3.0.php");
set_time_limit(0);

	// $arg = array(
	// 	'post_type' => 'any',
	// 	'posts_per_page' => -1
	// );
	// $arr_posts = get_posts($arg);
	// foreach( $arr_posts as $post ){
	// 	echo('Удxаляю запись с ID = '.$post->ID.'<br>');
	// 	setup_postdata( $post );
	// 	$massage_del = wp_delete_post($post->ID,'true');
	// }
	// wp_reset_postdata();


		$arg = array(
				'post_type' => 'any',
				'posts_per_page' => -1
				);
	$arr_posts = get_posts($arg);
	$json_arr_posts = json_encode($arr_posts);
	echo($json_arr_posts);
	// echo '<pre>'; print_r($arr_posts); echo '</pre>';




?>

