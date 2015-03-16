<?php
	$myFile = '../data/todo.json';
    $jsonOrigin= file_get_contents($myFile);
	$decodedJson = json_decode($jsonOrigin,true);
	
//	var_dump($jsonOrigin);
//	var_dump($decodedJson);

	$deleteBtn = $_POST['button'];
	var_dump($deleteBtn);
	foreach($decodedJson as $data_id=>$data_contents){
		$delID = $data_id;
		$decodedJson['success'] = true;
		$decodedJson[$delID] = null;
	}
	
	
	
	














?>