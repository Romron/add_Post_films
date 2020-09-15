<?php


function Json__addPF($file_name_addPF){
	
	$json_str = file_get_contents ($file_name_addPF);
	$arr_posts_addPF = json_decode($json_str, true);
	return $arr_posts_addPF;

	}

function Insert_posts_addPF($arr_posts_addPF){
	
	$n_arr_posts_addPF = 1; // т.к. в нулевом элементе массива находиться служебная инфа

	$len_arr_posts_addPF = count($arr_posts_addPF);

	while ($n_arr_posts_addPF < $len_arr_posts_addPF) {

		foreach ($arr_posts_addPF[$n_arr_posts_addPF] as $key => $value) {
			
			$arr_post_addPF = array(
				'comment_status' => 'open',
				'ping_status'   => 'open',
				'post_content'  => '... ... ... ... ...',
				'post_name'     => $arr_posts_addPF[$n_arr_posts_addPF]['Title'],	// Альтернативное название записи (slug) будет использовано в УРЛе.
				'post_status'   => 'publish',
				'post_title'    => $arr_posts_addPF[$n_arr_posts_addPF]['Title'],
				'post_type'     => 'post',
				'post_category' => array( 'category id', '<...>' ),// Категория к которой относится пост (указываем ярлыки, имена или ID).
				'tags_input'    => array( 'tag, tag, <...>' ),        // Метки поста (указываем ярлыки, имена или ID).
				'tax_input'     => array( 'taxonomy_name' => array( 'term', 'term2', 'term3' ) ), // К каким таксам прикрепить
			);


		};

		$arrAll_post_addPF[] = $arr_post_addPF;

		$n_arr_posts_addPF++;
	};

	echo('<pre>');
	print_r($arrAll_post_addPF);
	echo('</pre>');	



	}