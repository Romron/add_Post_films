<?php
/*
    Plugin Name: add_Post_films
    Description: Добавляет посты с постерами 

 */


add_action("admin_menu", "admin_add_menu_add_Post_films");

function admin_add_menu_add_Post_films(){ 
    add_menu_page( 'Settings add_Post_films Plugin',  
                    'add_Post_films', 
                    'manage_options', 
                    plugin_dir_path( __FILE__ ).'settings.php',  
                    ''
                );
    };






