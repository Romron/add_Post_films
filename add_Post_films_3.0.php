<?php
/*

    Plugin Name: add_Post_films_3.0
    Description: Плагин предназначен для наполнения сайтов контентом.
        получает данные по каждому посту в массив $arr_date_from_json из json файла.
        постера для должны быть заранее загруженны в папку W:\domains\Prostofilm.localhost\wp-content\uploads\posters
        создаёт элементы таксономий. Информацию для этого берёт из полей массива $arr_date_from_json.
        Таксономии и типы записей регестрируються заранее в дочерней теме.
щ    Записи добавляються только одного типа. Тип добавляемой записи установлен по умолчанию или его можно изменить с панели управления






 */





require_once("function_addPF_3.0.php");
define( 'ADDPOSTFILMS__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

add_action("admin_menu", "admin_add_menu_add_Post_films_3_0");
function admin_add_menu_add_Post_films_3_0(){ 
    add_menu_page( 'addPostFilms_dashboard_3.0.php',  
                   'add_Post_films_3.0.php', 
                   'manage_options', 
                   plugin_dir_path( __FILE__ ).'addPostFilms_dashboard_3.0.php',  
                    ''
                );
   
	wp_enqueue_script( 'script_addPF_3.0.js',  plugin_dir_url( __FILE__ ) . 'script_addPF_3.0.js');
	wp_enqueue_style( 'style_addPF_3.0.css', plugin_dir_url( __FILE__ ) . 'style_addPF_3.0.css');


}



