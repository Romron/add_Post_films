<?php
require_once("function_addPF_3.0.php");
set_time_limit(0);
 
// echo '<pre>**  '; print_r($_POST); echo '  **</pre>';

// echo('<br> массив GET:<br>');
var_dump($_GET['param_1']);

switch ($_GET['param_1']) {
	case 'butt_start':
		echo('<h1 color="red">OK</h1> ');
		break;
	
	default:
		# code...
		break;
}


//------------------	ЧИСТОВИК	----------------------------

	function del_all_posts(){
		/*
			удаляет все посты
		*/
		$arg = array(
			'post_type' => 'any',
			'posts_per_page' => -1
		);
		$arr_posts = get_posts($arg);
		foreach( $arr_posts as $post ){
			echo('Удxаляю запись с ID = '.$post->ID.'<br>');
			setup_postdata( $post );
			$massage_del = wp_delete_post($post->ID,'true');
		}
		wp_reset_postdata();

	}


//------------------	РАЗРАБОТКА	----------------------------


	function get_all_posts($value=''){
		/*
			Получает все посты
		*/



		$arg = array(
				'post_type' => 'any',
				'posts_per_page' => -1
				);
	$arr_posts = get_posts($arg);
	$json_arr_posts = json_encode($arr_posts);
	echo($json_arr_posts);
	// echo '<pre>'; print_r($arr_posts); echo '</pre>';


	}







//------------------	ЧЕРНОВИК	----------------------------




?>

