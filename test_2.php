<?php
require_once("function_addPF_3.0.php");
set_time_limit(0);


//------------------	ЧИСТОВИК	----------------------------

	switch ($_POST['param_1']) {
		case 'butt_start':

			$path_info = pathinfo(__file__);
			$file_name_json = $path_info['dirname'] . '/json/result_DateAboutAllFilms  TEST 10 .json';
			$arr_posts_from_json = get_arr_from_json_file($file_name_json);
			insert_Posts_films($arr_posts_from_json);
			
			get_all_posts();

			break;
		case 'butt_del_all_posts':
			del_all_posts();
			
			break;
		case 'butt_del_all_terms':
			del_all_terms();
			
			break;
		default:
			# code...
			break;
	}




//------------------	РАЗРАБОТКА	----------------------------

	function get_all_terms(){
		$json_arr_posts = json_encode($list_taxonomys,JSON_UNESCAPED_UNICODE);
	}


//------------------	ЧЕРНОВИК	----------------------------




?>

