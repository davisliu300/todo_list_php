<?php
	$saveFile = '../data/todo.json';
    //get the contents of our todo.json file with file_get_contents
    //make an output array
	$jsonOrigin= file_get_contents($saveFile);
//	$jsonOrigin= file_get_contents('data/todo.json');
//	var_dump($jsonOrigin);
//	echo "<div> This should be seen in HTML </div> ";
	
    if(strlen($jsonOrigin) > 0){  //if the strlen of our file contents is > 0, there is something to do!
        //json_decode the contents of the todo.json, make sure to convert it to an associative array with true as the second arguement for json_decode
//		echo "you should see me";
        $decodedArray = json_decode($jsonOrigin, true);
//		var_dump($decodedArray);
        //make an variable to hold our html output, set it to a blank string
		$htmlContents= [];
		$response = ['success'=>false, 'html' =>''];		
		
//		print_r( $decodedArray);
        //loop through the elements of our todo array, fetching the key and record for each one
		foreach ($decodedArray as $data_id =>$data_contents){
            //make an html element set to contain our todo record, much like our student record from Student Grade Table;  It should include a data-id attribute with the key (for later deleting / editing), the title, the date converted to a human-readable format, and the todo details.  Make sure to use the nl2br() function on the details so it looks right in html
            //add the html element set to our html output variable
			
//			var_dump($data_id);
			
			
			$htmlContents = "<div id =".$data_id. "> <span>".
			
			$data_contents['title']."</span>".
						"<span>".date("Y/m/d", $data_contents['date'])."</span>".
						"<span>".$data_contents['details']."</span>".
						"<button id =".$data_id.">". "X"."</button>".
						"</div>";
						
			$response['html'] .= $htmlContents;
// 	echo $htmlOutput;
        }
        //add a success=true and html elements to our output array.  html element should hold the generated HTML from above
			$response['success']= true;
    }
    else{  
	//if the strlen was 0, there were no todo items
        //add a success=false condition and appropriate error message indicating there were no records
		$response['success'] = false;
    }
    //json encode the output array and echo it
	
	echo json_encode($response);
?>