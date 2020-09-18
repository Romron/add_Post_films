<?php
require_once("function.php");



$file_name_addPF = 'json/result_DateAboutAllFilms  TEST 10 .json';

// Json__addPF($file_name_addPF);


// Create_taxonomy_addPF($file_name_addPF);


add_action( 'wp_ajax_my_action', 'test_func' ); // wp_ajax_{ЗНАЧЕНИЕ ПАРАМЕТРА ACTION!!}
add_action( 'wp_ajax_nopriv_my_action', 'test_func' );  // wp_ajax_nopriv_{ЗНАЧЕНИЕ ACTION!!}
test_func();



?>