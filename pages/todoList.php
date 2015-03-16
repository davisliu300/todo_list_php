<?php 




echo $_POST['title'];


	$title = $_POST["title"];
	$date= $_POST["date"];
	$details = $_POST["details"];
	
	
	
	$userEverything = $title." ".$date." ".$details;

//	setcookie("Total", $userEverything,time()+3600);
//	echo $_COOKIE['Total'];
	echo $userEverything;
?>