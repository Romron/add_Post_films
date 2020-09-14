<?php


function Json__addPF($file_name_addPF){
	
	$json_str = file_get_contents ($file_name_addPF);
	$arr_addPF = json_decode($json_str, true);
	print_r($arr_addPF);

	}