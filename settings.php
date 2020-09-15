<h1>add_Post_films</h1>
<?php

require_once("functions_add_Post_films.php");
require_once("style_add_Post_films.css");
require_once("script_add_Post_films.js");


$file_name_addPF = __DIR__. '\json\result_DateAboutAllFilms  TEST 10 .json';

$arr_posts_addPF = Json__addPF($file_name_addPF);

// echo('<pre>');
// print_r($arr_posts_addPF);
// echo('</pre>');

Insert_posts_addPF($arr_posts_addPF);


