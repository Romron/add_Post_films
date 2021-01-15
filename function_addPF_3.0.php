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

//============================================================================
//		====================	ЧИСТОВИК	==================================


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
			Создаёт посты типа "Films"
			Добавляет в них новые поля
			Добавляет картинки

			Прикрепляет запись к термину (элементу таксономии). 
			Создавать термины, если их нет данные для этого берёт из полей массива $arr_date_from_json

		*/

		foreach ($arr_posts_from_json as $arr_date_film) {
			if (!array_key_exists('Id_kinopisk', $arr_date_film)) continue;
			// добавляю элементы существующим таксономиям
			
			$arr_post = array(
				'comment_status' => 'open',                // 'closed' означает, что комментарии закрыты.
				'ping_status'    => 'open',                // 'closed' означает, что пинги и уведомления выключены.
				'post_content'   => '<the text of the post>',  // Полный текст записи.
				'post_name'      => $arr_date_film['Id_kinopisk'],  // Альтернативное название записи (slug) будет использовано в УРЛе.
				'post_status'    => 'publish',   // Статус создаваемой записи.
				'post_title'     => $arr_date_film['Title'],  // Заголовок (название) записи.
				'post_type'      => 'films', // Тип записи.
			);
			$post_id = wp_insert_post( $arr_post );		# Безопасно вставляет/обновляет запись в базе данных.  т.е. Создаю пост
			// в только что созданный пост добавляю поля и значения в них
			foreach ($arr_date_film as $key => $value) {
				if ($key == 'link_PagePosters') {
					continue;
				}elseif ($key == 'Id_kinopisk') {
					$key = 'Plear_films';
					$plear_films = '<div id="yohoho" data-kinopoisk="'.$arr_date_film['Id_kinopisk'].'"></div> <script src="//yohoho.cc/yo.js"></script>';
					update_post_meta( $post_id, $key, $plear_films );  // Добавляю поля в запись
					continue;
				}
				if (is_array($value)) {
					$value = implode(', ',$value);
				}
				update_post_meta( $post_id, $key, $value );  // Добавляю поля в запись
			}

			// в только что созданный пост добаляю картинки
			// TODO: НЕ дабавлять уже существующие картинки!!!
			for ($n_poster=0; $n_poster < 6; $n_poster++) { 
				$name_img_file = $arr_date_film['Id_kinopisk'].'_'.$n_poster.'.jpeg';
				if ( !insert_IMG_in_post($name_img_file, $post_id) ){
					// echo('Постер   '.$name_img_file.'  для  '.$arr_date_film['Title'].'<font size="3" color="red" >   существует, но добавить его к посту не удалось!! </font><br>');
					continue;
				}
			}

			add_new_taxonomy_item($arr_date_film,$post_id);  // только что созданный пост прикрепляю к таксономиям
		}
	}

	function add_new_taxonomy_item($arr_date_film,$post_id){
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
					// add_term($taxonomy,$term,$post_id);
					wp_set_object_terms($post_id,$term,$taxonomy);
					break;
				case 'Country':
					// add_term($taxonomy,$term,$post_id);
					wp_set_object_terms($post_id,$term,$taxonomy);
					break;
				case 'Genre':
					// add_term($taxonomy,$term,$post_id);
					wp_set_object_terms($post_id,$term,$taxonomy);
					break;
				case 'Actors':
					// add_term($taxonomy,$term,$post_id);
					wp_set_object_terms($post_id,$term,$taxonomy);
					break;
				case 'Producer':
					// add_term($taxonomy,$term,$post_id);
					wp_set_object_terms($post_id,$term,$taxonomy);
					break;
				case 'Scenario':
					// add_term($taxonomy,$term,$post_id);
					wp_set_object_terms($post_id,$term,$taxonomy);
					break;
				case 'Director':
					// add_term($taxonomy,$term,$post_id);
					wp_set_object_terms($post_id,$term,$taxonomy);
					break;
			}
		}
	}

	function insert_IMG_in_post($name_img_file, $post_id = " " ){
		/*
			Добавляет медиафайл (вложение) в медиатеку WordPress т.е. в базу даных.
			Физичеси презаписывает картинки в папку типа: wp-content/uploads/2016/04/
			Картинки которые нужно добавить должны находиться в \wp-content\uploads\posters
			
		*/

		$upload_dir = wp_upload_dir();	// Получает данные о каталоге (папке) загрузок в виде массива параметров
		$image_url =  $upload_dir['baseurl'] .'/posters/'. $name_img_file;	// URL картинки которая находиться в папке 
																			// W:\domains\Prostofilm.localhost\wp-content\uploads\posters
		$headers = @get_headers($image_url);	// Возвращает все заголовки из ответа сервера на HTTP-запрос
		if(!isset($headers) || $headers[0] != 'HTTP/1.1 200 OK'){		// проверяю существования файла картинки
			return false;
			}
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
		}else{
		}

		return $attach_id;
	}

	function translit($str_rus,$flag_change_of_registers=0){

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
			// echo('Удxаляю запись с ID = '.$post->ID.'<br>');
			setup_postdata( $post );
			$massage_del = wp_delete_post($post->ID,'true');
		}
		wp_reset_postdata();
	}

	function get_all_posts(){
		/*
			Получает все посты
		*/

		$arg = array(
				'post_type' => 'any',
				'posts_per_page' => -1
				);
		$arr_posts = get_posts($arg);
		return $arr_posts;
	}

	function del_all_terms(){
		
		$args = array(
			'public'   => true,
			'_builtin' => false
		);
		$output = 'names';
		$list_all_terms = array();
		$list_taxonomys = get_taxonomies($args,$output);
		foreach ($list_taxonomys as $taxonomy) {
			$list_terms = get_terms( [
				'taxonomy' => $taxonomy,
				'hide_empty' => false,
			] );
			foreach ($list_terms as $term) {
				wp_delete_term( $term -> term_id, $term -> taxonomy );
			}
		}
	}









//============================================================================
//		====================	РАЗРОБОТКА	==================================

	function get_all_terms(){
		$args = array(
			'public'   => true,
			'_builtin' => false
		);
		$output = 'names';
		$list_taxonomys = get_taxonomies($args,$output);
		$arr_terms = get_terms( $list_taxonomys, array("hide_empty" => false));
		
		return $arr_terms;
	}






//============================================================================
//		====================	ЧЕРНОВИК	==================================



































