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
			
			$arr_posts = get_all_posts();
			$arr_terms = get_all_terms();
			$arr_img = get_all_img();
			$arr_date[] = $arr_posts;
			$arr_date[] = $arr_terms;
			$arr_date[] = $arr_img;

			$json_arr_date = json_encode($arr_date,JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
			echo($json_arr_date);

			break;

		case 'butt_del_all_posts':
			del_all_posts();
			break;

		case 'butt_del_all_terms':
			del_all_terms();
			break;	

		case 'butt_del_all_img':
			echo("Получен  butt_del_all_img");
			del_all_img();
			break;

		default:
			# code...
			break;
	}




//------------------	РАЗРАБОТКА	----------------------------



//------------------	ЧЕРНОВИК	----------------------------




?>

