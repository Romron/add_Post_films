<?php
require_once("functions_add_Post_films.php");


$file_name_addPF = 'json/result_DateAboutAllFilms  TEST 10 .json';

// Json__addPF($file_name_addPF);		// for test

// echo '<pre>'; print_r(ABSPATH); echo '</pre>';
// echo '<pre>'; print_r(WORDPRESS_HOME); echo '</pre>';
// echo '<pre>'; print_r(pathinfo(__file__)); echo '</pre>';


Create_taxonomy_addPF($file_name_addPF);

?>