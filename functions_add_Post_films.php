<?php


function Json__addPF($file_name_addPF){
	
	$json_str = file_get_contents ($file_name_addPF);
	$arr_posts_addPF = json_decode($json_str, true);
	return $arr_posts_addPF;

	}

function Insert_posts_addPF($arr_posts_addPF){
	foreach ($arr_posts_addPF as $key => $value) {
		// $post_id = wp_insert_post($value, true );
		echo($key . '=>' . $value);
		}
	
	}