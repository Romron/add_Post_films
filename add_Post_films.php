<?php
/*

    Plugin Name: add_Post_films
    Description: Добавляет посты с постерами. При добавлении записи необходимо указать: Заголовок (название) записи. Тип записи.(?) Категория к которой относится пост (указываем ярлыки, имена или ID). Метки поста (указываем ярлыки, имена или ID). К каким таксам прикрепить запись (указываем ярлыки, имена или ID).


 */
define( 'ADDPOSTFILMS__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
require_once( ADDPOSTFILMS__PLUGIN_DIR . 'functions_add_Post_films.php' );

add_action("admin_menu", "admin_add_menu_add_Post_films");

function admin_add_menu_add_Post_films(){ 
    add_menu_page( 'addPostFilms_dashboard.php',  
                    'add_Post_films', 
                    'manage_options', 
                    plugin_dir_path( __FILE__ ).'addPostFilms_dashboard.php',  
                    ''
                );
   
		wp_enqueue_script( 'script_add_Post_films.js',  plugin_dir_url( __FILE__ ) . 'script_add_Post_films.js');
		wp_enqueue_style( 'style', plugin_dir_url( __FILE__ ) . 'style.css');





    };



