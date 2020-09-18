<?php
// require_once("function.php");
require($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');



$file_name_addPF = 'json/result_DateAboutAllFilms  TEST 10 .json';



// test_func();



add_action( 'init', 'test_taxonomy_register' );
function test_taxonomy_register(){
    $labels = array(
            'name'                       => 'Моя котегория 3',
            'singular_name'              => 'Категория',
            'menu_name'                  => 'Моя котегория 3' ,
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
	register_taxonomy('Моя котегория 3', array('post'), $args);

}


?>