<?php
// require_once("./includes/taxonomy.php");
// require_once( "../wp-load.php" );
// require_once(WORDPRESS_HOME. 'wp-admin/includes/taxonomy.php');

// require_once( ABSPATH . '/wp-admin/includes/taxonomy.php');


function Json__addPF($file_name_addPF){

	$json_str = file_get_contents ($file_name_addPF);
	$arr_films_addPF = json_decode($json_str, true);
	



	// echo '<pre>'; print_r($arr_films_addPF); echo '</pre>';	// for test
	return $arr_films_addPF;
	}

function Insert_posts_addPF($arr_films_addPF){
	
	// Необходимо:
		// проверить наличие таксаномии указанной в текущем элементе массива $arr_films_addPF 

	$n_arr_posts_addPF = 1; // т.к. в нулевом элементе массива находиться служебная инфа
	$len_arr_posts_addPF = count($arr_films_addPF);

	while ($n_arr_posts_addPF < $len_arr_posts_addPF) {
		foreach ($arr_films_addPF[$n_arr_posts_addPF] as $key => $value) {
			$arr_post_addPF = array(
				'comment_status' => 'open',
				'ping_status'   => 'open',
				'post_content'  => '... ... ... ... ...',
				'post_name'     => $arr_films_addPF[$n_arr_posts_addPF]['Title'],	// Альтернативное название записи (slug) будет использовано в УРЛе.
				'post_status'   => 'publish',
				'post_title'    => $arr_films_addPF[$n_arr_posts_addPF]['Title'],
				'post_type'     => 'post',
				'post_category' => array( 'category id', '<...>' ),// Категория к которой относится пост (указываем ярлыки, имена или ID).
				'tags_input'    => array( 'tag, tag, <...>' ),        // Метки поста (указываем ярлыки, имена или ID).
				'tax_input'     => array( 'taxonomy_name' => array( 'term', 'term2', 'term3' ) ), // К каким таксам прикрепить
			);
		};

		$arrAll_post_addPF[] = $arr_post_addPF;
		$n_arr_posts_addPF++;
	};

	echo('<pre>');		# for tests
	print_r($arrAll_post_addPF);		# for tests
	echo('</pre>');		# for tests	

	return $arrAll_post_addPF;
	}

function  translit($str_rus,$flag_change_of_registers=0){

  	$rus=array('А','Б','В','Г','Д','Е','Ё','Ж','З','И','Й','К','Л','М','Н','О','П','Р','С','Т','У','Ф','Х','Ц','Ч','Ш','Щ','Ъ','Ы','Ь','Э','Ю','Я','а','б','в','г','д','е','ё','ж','з','и','й','к','л','м','н','о','п','р','с','т','у','ф','х','ц','ч','ш','щ','ъ','ы','ь','э','ю','я',' ');
	$lat=array('a','b','v','g','d','e','e','gh','z','i','y','k','l','m','n','o','p','r','s','t','u','f','h','c','ch','sh','sch','y','y','y','e','yu','ya','a','b','v','g','d','e','e','gh','z','i','y','k','l','m','n','o','p','r','s','t','u','f','h','c','ch','sh','sch','y','y','y','e','yu','ya',' ');

	$str_rus = strval($str_rus); // преобразуем в строковое значение
	$str_rus = strip_tags($str_rus); // убираем HTML-теги
	$str_rus = str_replace(array("\n", "\r"), " ", $str_rus); // убираем перевод каретки
	$str_rus = preg_replace("/\s+/", ' ', $str_rus); // удаляем повторяющие пробелы
	$str_rus = trim($str_rus); // убираем пробелы в начале и конце строки
	// Может пригодиться для формирования URL-ов:
	if ($flag_change_of_registers == 1) {	// переводим строку в нижний регистр (иногда надо задать локаль)
		$str_rus = function_exists('mb_strtolower') ? mb_strtolower($str_rus) : strtolower($str_rus); 
		}
	// $str_rus = preg_replace("/[^0-9a-z-_ ]/i", "", $str_rus); // очищаем строку от недопустимых символов
	// $str_rus = str_replace(" ", "-", $str_rus); // заменяем пробелы знаком минус

	$str_lat = str_replace($rus, $lat, $str_rus);
 	return $str_lat;

	}


function Create_taxonomy_addPF($file_name_addPF){
	// В этой ф-ции производятся все необходимые подготовительные операции для создания таксономий
	// а непосредственно создание таксономий в ф-ции Create_taxonomy()
	// Создать массив категорий из указанных элементов массива $arr_films_addPF
	// Создать категорию для каждого ээлемента полученного массива
	
	$arr_films_addPF = Json__addPF($file_name_addPF);
	$len_arr_posts_addPF = count($arr_films_addPF);	
	$n_arr_posts_addPF = 1;

	$arr_taxonomy = [
					'ProductionYear',
					'Country',
					'Genre',
					'Actors',
					'Producer',
					'Scenario',
					'Director',
				];

	// echo('<pre>');		# for tests
	// print_r($arr_taxonomy);		# for tests
	// echo('</pre>');		# for tests	

		while ($n_arr_posts_addPF < $len_arr_posts_addPF) {
			foreach ($arr_films_addPF[$n_arr_posts_addPF] as $key => $value) {
				if (is_array($value)) {
					

					}

				$arr_args = [
					'label'                 => '', // определяется параметром $labels->name
					'labels'                => [
						'name'              => 'Genres',
						'singular_name'     => 'Genre',
						'search_items'      => 'Search Genres',
						'all_items'         => 'All Genres',
						'view_item '        => 'View Genre',
						'parent_item'       => 'Parent Genre',
						'parent_item_colon' => 'Parent Genre:',
						'edit_item'         => 'Edit Genre',
						'update_item'       => 'Update Genre',
						'add_new_item'      => 'Add New Genre',
						'new_item_name'     => 'New Genre Name',
						'menu_name'         => 'Genre',
					],
					'description'           => '', // описание таксономии
					'public'                => true,
					// 'publicly_queryable'    => null, // равен аргументу public
					// 'show_in_nav_menus'     => true, // равен аргументу public
					// 'show_ui'               => true, // равен аргументу public
					// 'show_in_menu'          => true, // равен аргументу show_ui
					// 'show_tagcloud'         => true, // равен аргументу show_ui
					// 'show_in_quick_edit'    => null, // равен аргументу show_ui
					'hierarchical'          => false,

					'rewrite'               => true,
					//'query_var'             => $taxonomy, // название параметра запроса
					'capabilities'          => array(),
					'meta_box_cb'           => null, // html метабокса. callback: `post_categories_meta_box` или `post_tags_meta_box`. false — метабокс отключен.
					'show_admin_column'     => false, // авто-создание колонки таксы в таблице ассоциированного типа записи. (с версии 3.5)
					'show_in_rest'          => null, // добавить в REST API
					'rest_base'             => null, // $taxonomy
					// '_builtin'              => false,
					//'update_count_callback' => '_update_post_term_count',
				];

				Create_taxonomy('$taxonomy_name','post',$arr_args);
				};
		$n_arr_posts_addPF ++;
		};

		echo(get_home_path());


	}	


function Create_taxonomy($taxonomy_name,$object_type='post',$arr_args){
	echo('Создаю котегорию 2');
	register_taxonomy( $taxonomy_name, $object_type, $arr_args );

	}










function Create_category_addPF($value=''){
		# code...
	}	

function Create_tags_addPF($value=''){
		# code...
	}	
	
