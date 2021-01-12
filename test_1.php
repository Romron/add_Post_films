<!DOCTYPE html>
<html>
<head>
	<title>Test_1</title>
	<meta charset="utf-8">
</head>
<body>

</body>
</html>



<?php
require_once("function_addPF_3.0.php");
set_time_limit(0);
// require($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');

/*
	Таксономии:
		"ProductionYear"
		"Country"
		"Genre"
		"Actors"
		"Producer"
		"Scenario"
		"Director"
*/

// добавляю записи
$path_info = pathinfo(__file__);
$file_name_json = $path_info['dirname'] . '/json/result_DateAboutAllFilms  TEST 10 .json';
$arr_posts_from_json = get_arr_from_json_file($file_name_json);
insert_Posts_films($arr_posts_from_json);






echo('<br>===============	Результаты на экран	===========================<br>');
print_taxonomies();


$file_name_json = 'json/result_DateAboutAllFilms  TEST 10 .json';

$arr_date_from_json = get_arr_from_json_file($file_name_json);
// echo '<pre>'; print_r($arr_date_from_json); echo '</pre>';

foreach ($arr_date_from_json as $key_1 => $value_1) {
	if ($key_1 == 0) continue;
	// echo($key_1.'.<br>');
	foreach ($value_1 as $key_2 => $value_2) {
		// echo '<pre>'; 
		// 	print_r($key_2 . '  =>  ' . $value_2); 
		// echo '</pre>';
	
		switch ($key_2) {
			case 'ProductionYear':
				$ProductionYear[] = $value_2;
				break;
			case 'Country':
				if (is_array($value_2)) {
					foreach ($value_2 as $key_Country => $val_Country ) {
						$Country[] = $val_Country;
					}
				}else{
					$Country[] = $value_2;
				}			
				break;
			case 'Genre':
				if (is_array($value_2)) {
					foreach ($value_2 as $key_Genre => $val_Genre ) {
						$Genre[] = $val_Genre;
					}
				}else{
					$Genre[] = $value_2;
				}
				break;
			case 'Actors':
				if (is_array($value_2)) {
					foreach ($value_2 as $key_Actors => $val_Actors ) {
						$Actors[] = $val_Actors;
					}
				}else{
					$Actors[] = $value_2;
				}
				break;
			case 'Producer':
				if (is_array($value_2)) {
					foreach ($value_2 as $key_Producer => $val_Producer ) {
						$Producer[] = $val_Producer;
					}
				}else{
					$Producer[] = $value_2;
				}
				break;
			case 'Scenario':
				if (is_array($value_2)) {
					foreach ($value_2 as $key_Scenario => $val_Scenario ) {
						$Scenario[] = $val_Scenario;
					}
				}else{
					$Scenario[] = $value_2;
				}
				break;
			case 'Director':
				if (is_array($value_2)) {
					foreach ($value_2 as $key_Director => $val_Director ) {
						$Director[] = $val_Director;
					}
				}else{
					$Director[] = $value_2;
				}				
				break;
		}



	}

}

echo('<h4>ProductionYear: </h4>');
foreach ($ProductionYear as $val_ProductionYear) echo ($val_ProductionYear . "<br>");

echo('<h4>Country: </h4>');
foreach ($Country as $val_Country) echo ($val_Country . "<br>");

echo('<h4>Genre: </h4>');
foreach ($Genre as $val_Genre) echo ($val_Genre . "<br>");

echo('<h4>Actors: </h4>');
foreach ($Actors as $val_Actors) echo ($val_Actors . "<br>");

echo('<h4>Producer: </h4>');
foreach ($Producer as $val_Producer) echo ($val_Producer . "<br>");

echo('<h4>Scenario: </h4>');
foreach ($Scenario as $val_Scenario) echo ($val_Scenario . "<br>");

echo('<h4>Director: </h4>');
foreach ($Director as $val_Director) echo ($val_Director . "<br>");









?>
<script>document.write('<script src="http://' + (location.host || 'localhost').split(':')[0] + ':35729/livereload.js?snipver=1"></' + 'script>')</script>

