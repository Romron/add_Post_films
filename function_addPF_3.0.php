<?php
require($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');
if ( ! function_exists( 'wp_crop_image' ) ) {		// возникала ошибка связанная с тем что wp_generate_attachment_metadata() неопределена
  include( ABSPATH . 'wp-admin/includes/image.php' );
}

// Образно говоря:
// add_action() - это аналог создания (определения) функции в PHP.
// do_action() - это аналог использования (вызова) функции в PHP.
// Вы в PHP тоже при создании функции, сразу ей переменные передаете, а какие?.. Или может, создаете Фильм, определяете для неё какие переменные она может получить, а передаете переменные уже при вызове (использовании) функции?


// Перечень всех файлов в дериктории плагина можно получить по адресу: http://prostofilm.localhost/wp-content/plugins/add_Prosto_films_3.0/


// то такое web socket!!!!!!!!!!!!!

//==========================================================================================
//		====================	ЧИСТОВИК	=======================================


function get_arr_from_json_file($file_name_json){
	/*
		получает файл импорта в формате json 
		возвращает массив подготовленный для добавления постов
	*/
	// echo "<br>Получен файл импорта:&nbsp;&nbsp;". $file_name_json ."<br>";

	$json_str = file_get_contents ($file_name_json);
	$arr_date_from_json = json_decode($json_str, true);

	// echo "<pre>";
	// print_r($arr_date_from_json);
	// echo "</pre>";
	return $arr_date_from_json;
}

function insert_Posts_films($arr_posts_from_json){
	/*
		Получает массив информации о фильмах

		создаёт элементы таксономий. Информацию для этого информацию из полей массива $arr_date_from_json

		Создаёт посты типа "Films"
		Добавляет в них новые поля
		Добавляет картинки

	*/

	// $plear_films = '<div id="yohoho" data-kinopoisk="'.$Id_kinopisk.'"></div> <script src="//yohoho.cc/yo.js"></script>';
	// $plear_films = '<div id="yohoho" data-kinopoisk="'.$Id_kinopisk.'"></div> ';

	foreach ($arr_posts_from_json as $arr_date_film) {
		
		if (!array_key_exists('Id_kinopisk', $arr_date_film)) continue;

		// добавляю элементы существующим таксономиям
		add_new_taxonomy_item($arr_date_film);

		$arr_post = array(
			'comment_status' => 'open',                // 'closed' означает, что комментарии закрыты.
			'ping_status'    => 'open',                // 'closed' означает, что пинги и уведомления выключены.
			'post_content'   => '<the text of the post>',  // Полный текст записи.
			'post_name'      => $arr_date_film['Id_kinopisk'],  // Альтернативное название записи (slug) будет использовано в УРЛе.
			'post_status'    => 'publish',   // Статус создаваемой записи.
			'post_title'     => $arr_date_film['Title'],  // Заголовок (название) записи.
			'post_type'      => 'films', // Тип записи.
			// 'post_category'  => array( <category id>, <...> ),    // Категория к которой относится пост (указываем ярлыки, имена или ID).
			// 'tags_input'     => array( <tag>, <tag>, <...> ),     // Метки поста (указываем ярлыки, имена или ID).
			'tax_input'      => array( 'taxonomy_name' => array( 'term', 'term2', 'term3' ) ), // К каким таксам прикрепить запись (указываем ярлыки, имена или ID).
			// 'meta_input'     => [ 'meta_key'=>'meta_value' ],    // добавит указанные мета поля. По умолчанию: ''. с версии 4.4.
		);

		$post_id = wp_insert_post( $arr_post, $wp_error );		# Безопасно вставляет/обновляет запись в базе данных.  т.е. Создаю пост
		// в только что созданный пост добавляю поля и значения в них
		foreach ($arr_date_film as $key => $value) {
			if ($key == 'link_PagePosters') {
				continue;
			}elseif ($key == 'Id_kinopisk') {
				$key = 'Plear_films';
				$plear_films = '<div id="yohoho" data-kinopoisk="'.$arr_date_film['Id_kinopisk'].'"></div> <script src="//yohoho.cc/yo.js"></script>';
				update_post_meta( $post_id, $key, $plear_films );  
				continue;
			}
			if (is_array($value)) {
				$value = implode(', ',$value);
			}
			update_post_meta( $post_id, $key, $value );  
		}

		// в только что созданный пост добаляю картинки
		for ($n_poster=0; $n_poster < 6; $n_poster++) { 
			$name_img_file = $arr_date_film['Id_kinopisk'].'_'.$n_poster.'.jpeg';
			if ( !insert_IMG_in_post($name_img_file, $post_id) ){
				// echo('Постер   '.$name_img_file.'  для  '.$arr_date_film['Title'].'<font size="3" color="red" >   существует, но добавить его к посту не удалось!! </font><br>');
				continue;
			}
		}
	}
}

function insert_IMG_in_post($name_img_file, $post_id = " " ){
<<<<<<< HEAD:function.php
	
=======
	/*
		Добавляет медиафайл (вложение) в медиатеку WordPress т.е. в базу даных.
		Физичеси презаписывает картинки в папку типа: wp-content/uploads/2016/04/
		Картинки которые нужно добавить должны находиться в \wp-content\uploads\posters
		
	*/
>>>>>>> origin/master:function_addPF_3.0.php

	// add_image_size( 'size-for-posters', 240, 250 );	// регестрирую новый размер для ростеров


	echo "<br>Пытаюсь добавить картинку: &nbsp;";
	echo( '<br> name_img_file = '. $name_img_file );
	
	$upload_dir = wp_upload_dir();	// Получает данные о каталоге (папке) загрузок в виде массива параметров

	$image_url =  $upload_dir['baseurl'] .'/posters/'. $name_img_file;	// URL картинки которая находиться в папке 
																		// W:\domains\Prostofilm.localhost\wp-content\uploads\posters
	echo( '<br>Для &nbsp;'. $name_img_file . ': &nbsp;image_url = '. $image_url .'<br>');

	$headers = @get_headers($image_url);	// Возвращает все заголовки из ответа сервера на HTTP-запрос

	if(!isset($headers) || $headers[0] != 'HTTP/1.1 200 OK'){		// проверяю существования файла картинки
		echo'<font size="3" color="red" > Файл  &nbsp;&nbsp;'.$name_img_file.'&nbsp;&nbsp;  не нанайден!</font><br>';
		return false;
		}
		echo'<font size="3" color="LimeGreen" > Файл  &nbsp;&nbsp;'.$name_img_file.'&nbsp;&nbsp;  нанайден!</font><br>';
	$image_data = file_get_contents( $image_url );		// читает файл в строку
	$filename = basename( $image_url );		// Возвращает имя файла из указанного пути
	if ( wp_mkdir_p( $upload_dir['path'] ) ) {		// если папка $upload_dir['path'] существует
		$file = $upload_dir['path'] . '/' . $filename;		// то формируем имя файла
		} else {
			$file = $upload_dir['basedir'] . '/' . $filename;
			}
	file_put_contents( $file, $image_data );	//	записываю файл
	$wp_filetype = wp_check_filetype( $filename, null );	// получаем расшрение и тип файла
	$attachment = array(
		'post_mime_type' => $wp_filetype['type'],
		'post_title' => sanitize_file_name( $filename ),
		'post_content' => '',
		'post_status' => 'inherit'
		);	

	$attach_id = wp_insert_attachment( $attachment, $file, $post_id  );		// Добавляет медиафайл (вложение) в медиатеку WordPress. 
																		// Файл физически НЕ добавляется — функция создает запись в таблице wp_posts
																		// в базе данных и возвращает ID созданной записи.
	$attach_data = wp_generate_attachment_metadata( $attach_id, $file );	// Генерирует метаданные для картинки-вложения 
																			// и создает промежуточные копии изображения - 
																			// миниатюры всех зарегистрированных размеров.
																			// Промежуточные размеры указываются в «Настройках медиафайлов» 
																			// (миниатюра, средний, большой), также они могут быть созданы 
																			// функцией add_image_size() в теме или плагине.
	wp_update_attachment_metadata( $attach_id, $attach_data );	// Обновляет метаданные вложения (медиафайла). 
																// Обновляемые данные - это массив данных о файле.

	if( set_post_thumbnail( $post_id, $attach_id ) ){  //Устанавливает миниатюру записи по переданным ID записи и ID вложения (медиафайла). Если указанного вложения нет в базе данных, то функция удалит миниатюру записи.
		
		// echo 'Миниатюра установлена.';
	}else{
		echo '<br><font size="2" color="red" >Для поста: ' . $filename . ' Не удалось вставить миниатюру. </font>';
	}

	return $attach_id;
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

function add_new_taxonomy_item($arr_date_film){
	/*
		Получает:
			массив данных о текущем фильме
			название таксономии из ключа массива 
			название элемента таксономии из поля массива
		Переирает существующие таксономии 
		Вызывает для каждой таксономии add_term() которая и добавляет элемент таксономии


	*/
	foreach ($arr_date_film as $taxonomy => $term) {
		switch ($taxonomy) {
			case 'ProductionYear':
				add_term($taxonomy,$term);
				break;
			case 'Country':
				break;
			case 'Genre':
				add_term($taxonomy,$term);
				break;
			case 'Actors':
				add_term($taxonomy,$term);
				break;
			case 'Producer':
				add_term($taxonomy,$term);
				break;
			case 'Scenario':
				add_term($taxonomy,$term);
				break;
			case 'Director':
				add_term($taxonomy,$term);
				break;
		}
	}
}

function add_term($taxonomy,$term){
	/*
		Проверяет отсутствие добавляемого элемента в таксономии
		Добавляет єлемент таксономии


	*/
	if (is_array($term)) {
		foreach ($term as $key_term => $val_term) {
			if (!term_exists($val_term, $taxonomy)){
				$slug = translit($val_term);
				wp_insert_term($val_term, $taxonomy, array('slug' => $slug,
												'description' => $val_Genre));
			}
		}
	}else{
		if (!term_exists($term, $taxonomy)){
			echo('Такой таксономии нет <br>');
			$slug = translit($term);
			wp_insert_term($term, $taxonomy, array('slug' => $slug,
											'description' => $taxonomy));
		}
	}
}




//==========================================================================================
//		====================	ЧЕРНОВИК	=======================================



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


function print_taxonomies(){
		$args = array(
			'public'   => true,
			'_builtin' => true
		);
		$output = 'names'; // или objects
		// $operator = 'and'; // 'and' или 'or'
		$taxonomies = get_taxonomies( $args, $output, $operator );
		// $taxonomies = get_taxonomies();
		if( $taxonomies ){
			echo '<p><h3> Список зарегистрированных таксономий: </h3></p>';
			foreach( $taxonomies as $taxonomy ){
				echo '<p>'. $taxonomy. ':  </p>';
				$terms = get_terms($taxonomy);
				echo '<pre>'; print_r($terms); echo '</pre>';
			}
		}else{echo '<p> Зарегистрированных таксаномий нет </p>';}
}

add_action('init', 'add_custom_fields');
function add_custom_fields(){
	add_post_type_support( 'films', 'custom-fields');
}






//====================================================================================
//====================================================================================


































//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

function test_func(){

	print_taxonomies();

	}

function Create_category_addPF($value=''){
		# code...
	}	

function Create_tags_addPF($value=''){
		# code...
	}	
	



