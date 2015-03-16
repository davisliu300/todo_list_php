<?php
//require the functions.php file, make sure it is only added one time
	require_once('../includes/functions.php');
//create an array for error messages
	$error_array = [];
//create an array for output
	$output_array = [];
	
	$saveFile = '../data/todo.json';
if(isset($_POST)){  //check if the post variable exists
    if(empty($_POST['title'])){  //check if the title is an empty string
        //add to the error array, set the title to an appropriate error message: $error['title']='your message'
		$error_array['title'] = "must be something to do as a subject";
    }
    if(empty($_POST['date'])){ //chek if the date is an empty string
        //add to the error array, set the date to an appropriate error message
		$error_array['date'] = "Date must be a real date with numbers";
		}
		else{ //if the date is not blank
			//convert the date storing to a utime with strtotime
			$utime = strtotime($_POST['date']);
//			print $utime;
			if($utime === false){   //if the utime is false, the date string wasn't valid, and we display an error
				//add to the error array, set the date to an appropirate error message
				$error_array['date'] = "time data or format is not correct";
			}
			else if($utime<=time()) //else if the utime is less than now (date set in past).  can find current time with time()
			{
				//add to the error array, set the date to an appropriate error message
				$error_array['date']="Time needs to be in future";
			}
		}
	if(!empty($_POST['detail'])){ //if the details are blank
            //add to the error array, set the detail to an appropriate error message
			$error_array['detail'] = "Detail cannot be empty";
    }
    if(empty($error_array)){  //if there were no errors, ie the error array has no elements
        
        //make an associative array to hold the pieces of our date, the title, the date (converted to a utime), and the etails
		//$newToDo 
		$todo_item = [
			'title' => $_POST['title'],
			'date' => $utime,
			'details' => $_POST['details'] 
		];
        //get the contents of our todo.json file with file_get_contents.  This is so we can add to it if it exists
		//$fileContents = file_get_contents('../data/todo.json');
		$todoListJson = file_get_contents($saveFile);
		
        if(strlen($todoListJson)==0){  //if the length of the file's contents are 0 (ie the file was empty)
            //make a variable to hold our list's associative array
			$todoList = [];
        }
        else{  //if the length is not 0, 
           //json_decode the file's contents.  make sure to use "true" in the second argument so that the output is an associative array instead of standard object
		   $todoList = json_decode($todoListJson, true);
        }
        //make a name for this record from: concatenate the utime with a random string, so we have unique IDs
			$timingVar = $utime.'-'.generateRandomString(); //$name = $timingVar
        // add a new associative array to our todo.json array, key=name generated on line above, and value is the array generated from the input data
			$todoList[$timingVar] = $todo_item;// json_decode('../data/todo.json');
        //json encode the modified list array, so we can replace the original file
			$tempObjJson = json_encode($todoList);
        //use file_put_contents to replace the contents of the todo.json with our json_encoded object
			$addFile = file_put_contents('../data/todo.json', $tempObjJson);
        if($addFile == true){  //test if the result of the file add is > 0.  If it is 0, the file add failed.
		//if it was greater than 0, we had a successful add.  add a success field to our output array with a boolean value of true
			$output['success'] = true;
			$output['congratesMsg'] = "Holy Cow, we added the file successful";
            //add a successful message to our output array
        }
        else{ //if the result was not greater than 0, there was an error saving the file
            // add a success field to our output array, and set it to false
            //give an appropriate message indicating failure
			$output['success'] = false;
			$output['errorMsg'] = "no file is added";
        }
    }
    else{ //if error count > 0, we had an error and need to report it back to the page
        // add a success field to our output array, and set it to false
		$output['success'] = false;
		
        //give an appropriate message indicating failure
		$output['errorMsg'] = "failed to add to json file";
        //add our error array to a key in our output array, so we can report exact errors and/or show appropriate errors on different inputs
		$output['errorKey'] = $error_array;
    }
}
else{ //post wasn't set, no data was available
    // add a success field to our output array, and set it to false
    //give an appropriate message indicating failure
	$output['success'] = false;
	$output['errorMsg'] = "something went wrong in form $ _POST";
}
//json_encode our output array, and echo it
	echo json_encode($output, true);
//	echo $outputFinal;
?>