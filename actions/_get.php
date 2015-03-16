<?php
	$saveFile = 'data/todo.json';
    //get the contents of our todo.json file with file_get_contents
    //make an output array
	$jsonOrigin= file_get_contents($saveFile);
	
//	echo "<div> This should be seen in HTML </div> ";
	
    if(strlen($jsonOrigin) > 0){  //if the strlen of our file contents is > 0, there is something to do!
        //json_decode the contents of the todo.json, make sure to convert it to an associative array with true as the second arguement for json_decode
//		echo "you should see me";
        $decodedArray = json_decode($jsonOrigin, true);
//		var_dump($decodedArray);
        //make an variable to hold our html output, set it to a blank string
		$htmlOutput = '';
//		print_r( $decodedArray);
        //loop through the elements of our todo array, fetching the key and record for each one
		foreach ($decodedArray as $data_id =>$data_contents){
            //make an html element set to contain our todo record, much like our student record from Student Grade Table;  It should include a data-id attribute with the key (for later deleting / editing), the title, the date converted to a human-readable format, and the todo details.  Make sure to use the nl2br() function on the details so it looks right in html
            //add the html element set to our html output variable

//	$htmlOutput = $decodedArray[$data_id];
	
//	$html_contents = $data_contents;

	
//	echo $data_contents;
	echo "<div>$data_contents[title]</div>";					
	echo "<div>".time($data_contents['date'])."</div>";					
	echo "<div>$data_contents[details]</div>";					

        }
        //add a success=true and html elements to our output array.  html element should hold the generated HTML from above
    }
    else{  
	//if the strlen was 0, there were no todo items
        //add a success=false condition and appropriate error message indicating there were no records
		
    }
    //json encode the output array and echo it
//	print_r($decodedArray);
?>