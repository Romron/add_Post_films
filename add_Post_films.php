<?php
/*
 * Plugin Name: add_Post_films
 */






/* Запускаем функцию установки */
register_activation_hook(__FILE__,'my_plugin_install');

/* Запускаем функцию деактивации*/
register_deactivation_hook( __FILE__, 'my_plugin_remove' );
Функция установки плагина:
function my_plugin_install() {

    global $wpdb;

    $the_page_title = 'Заголовок страницы';
    $the_page_name = 'Имя страницы';

    // Меняем название в меню
    delete_option("my_plugin_page_title");
    add_option("my_plugin_page_title", $the_page_title, '', 'yes');
    // имя страницы (slug)
    delete_option("my_plugin_page_name");
    add_option("my_plugin_page_name", $the_page_name, '', 'yes');
    // ID
    delete_option("my_plugin_page_id");
    add_option("my_plugin_page_id", '0', '', 'yes');

    $the_page = get_page_by_title( $the_page_title );

    if ( ! $the_page ) {

        // Создаем пост
        $_p = array();
        $_p['post_title'] = $the_page_title; //Заголовок страницы
        $_p['post_content'] = "Можно вписать контент.";
        $_p['post_status'] = 'publish'; //Статус публикации
        $_p['post_type'] = 'page'; //Тип поста post или page
        $_p['comment_status'] = 'closed'; //Статус комментариев
        $_p['ping_status'] = 'closed'; //Пинги для поста
        $_p['post_category'] = array(1); // Категории поста, по умолчанию "Без категории"

        // Добавляем пост в бд
        $the_page_id = wp_insert_post( $_p );

    }
    else {
        // Плагин мог быть активнее и страница могла быть перемещена в корзину

        $the_page_id = $the_page->ID;

        //Обновляем статус страницы
        $the_page->post_status = 'publish';
        $the_page_id = wp_update_post( $the_page );

    }
//Обновляем ID
    delete_option( 'my_plugin_page_id' );
    add_option( 'my_plugin_page_id', $the_page_id );
}




//Функция удаления плагина
function my_plugin_remove() {

    global $wpdb;

    $the_page_title = get_option( "my_plugin_page_title" );
    $the_page_name = get_option( "my_plugin_page_name" );

    // Получаем ID поста
    $the_page_id = get_option( 'my_plugin_page_id' );
    if( $the_page_id ) {

        wp_delete_post( $the_page_id ); // переносим в корзину (полностью не удаляем)

    }
//Удаляем опции
    delete_option("my_plugin_page_title");
    delete_option("my_plugin_page_name");
    delete_option("my_plugin_page_id");

}