<?php
require($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');


// Образно говоря:

// add_action() - это аналог создания (определения) функции в PHP.
// do_action() - это аналог использования (вызова) функции в PHP.
// Вы в PHP тоже при создании функции, сразу ей переменные передаете, а какие?.. Или может, создаете функцию, определяете для неё какие переменные она может получить, а передаете переменные уже при вызове (использовании) функции?


function Json__addPF($file_name_addPF){

	$json_str = file_get_contents ($file_name_addPF);
	$arr_films_addPF = json_decode($json_str, true);
	// echo '<pre>'; print_r($arr_films_addPF); echo '</pre>';
	
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

function print_taxonomies(){
		$args = array(
			'public'   => true,
			'_builtin' => true
		);
		$output = 'names'; // или objects
		$operator = 'and'; // 'and' или 'or'
		$taxonomies = get_taxonomies( $args, $output, $operator );
		if( $taxonomies ){
			echo '<p><h3> Список зарегистрированных таксономий: </h3></p>';
			foreach( $taxonomies as $taxonomy ){
				$terms = get_terms( $taxonomy);
				echo '<p>'. $taxonomy. ':  </p>';
				echo '<pre>'; print_r($terms); echo '</pre>';
			}
		}else{echo '<p> Зарегистрированных таксаномий нет </p>';}
		}


//====================================================================================
//====================================================================================


// add_action('init', 'test_type_post_register');
// function test_type_post_register(){
// 	  $labels = array(
// 		    'name' => 'Кодекс',
// 		    'menu_name' => 'Кодекс',
// 		    'singular_name' => 'Кодекс',
// 		    'add_new' => 'Добавить запись',
// 		    'add_new_item' => 'Добавить новую запись',
// 		    'edit_item' => 'Редактировать запись',
// 		    'new_item' => 'Новая запись',
// 		    'all_items' => 'Все записи',
// 		    'view_item' => 'Посмотреть запись',
// 		    'search_items' => 'Найти запись',
// 		    'not_found' =>  'Ничего не найдено',
// 		    'not_found_in_trash' => 'В корзине ничего не найдено'
// 		  );
// 	  $args = array(
// 		    'labels' => $labels,
// 		    'public' => true,
// 		    'publicly_queryable' => true,
// 		    'show_ui' => true,
// 		    'show_in_menu' => true,
// 		    'query_var' => true,
// 		    'rewrite' => true,
// 		    'capability_type' => 'post',
// 		    'has_archive' => true,
// 		    'hierarchical' => false,
// 		    'menu_position' => null,
// 		    'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'post-formats', 'custom-fields')
// 		  );
// 	  register_post_type('kodex',$args);
// }

function test_func(){

	print_taxonomies();

	}

add_action( 'init', 'test_taxonomy_register' );
function test_taxonomy_register(){
    $labels = array(
            'name'                       => 'Моя котегория 2',
            'singular_name'              => 'Категория',
            'menu_name'                  => 'Моя котегория 2' ,
            'all_items'                  => 'Все Моя котегория',
            'edit_item'                  => 'Редактировать категорию',
            'view_item'                  => 'Посмотреть категорию',
            'update_item'                => 'Сохранить категорию',
            'add_new_item'               => 'Добавить новую категорию',
            'new_item_name'              => 'Новая категория',          
            'parent_item'                => 'Родительская категория',
            'parent_item_colon'          => 'Родительская категория:',
            'search_items'               => 'Поиск по категориям',
            'popular_items'              => 'Популярные Метки',
            'separate_items_with_commas' => 'Список Меток (разделяются запятыми)',
            'add_or_remove_items'        => 'Добавить или удалить Метку',
            'choose_from_most_used'      => 'Выбрать Метку',
            'add_or_remove_items'        => 'Добавить или удалить Метку',
            'not_found'                  => 'Меток не найдено',
            'back_to_items'              => 'Назад на страницу рубрик',
    		);
    $args = array(
        'labels'                => $labels,
        'label'                 => 'Моя котегория',
        'public'                => true,
        'publicly_queryable'    => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'show_in_nav_menus'     => true,
        'show_in_rest'          => false,
        'rest_base'             => 'url_rest',
        'rest_controller_class' => 'WP_REST_Terms_Controller',
        'show_tagcloud'         => true,
        'show_in_quick_edit'    => true,
        'meta_box_cb'           => null,
        'show_admin_column'     => true,
        'description'           => '',
        'hierarchical'          => true,
        'update_count_callback' => '',
        'query_var'             => $taxonomy,       
        'rewrite'               => true,
        'sort'                  => true,
        '_builtin'              => false,
    	);
	register_taxonomy('Моя котегория 2', array('post'), $args);

	


}
























function Create_category_addPF($value=''){
		# code...
	}	

function Create_tags_addPF($value=''){
		# code...
	}	
	



