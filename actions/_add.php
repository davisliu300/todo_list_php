<?php
	require_once('../includes/functions.php');
	$error_array = [];
	$output_array = [];
	$saveFile = '../data/todo.json';
if(isset($_POST)){ 
    if(empty($_POST['title'])){  
        $error_array['title'] = "must be something to do as a subject";
    }
    if(empty($_POST['date'])){ 
		$error_array['date'] = "Date must be a real date with numbers";
		}
		else{ 
			$utime = strtotime($_POST['date']);
			if($utime === false){   
				$error_array['date'] = "time data or format is not correct";
			}
			else if($utime<=time()) 
			{
				$error_array['date']="Time needs to be in future";
			}
		}
	if(!empty($_POST['detail'])){ 
            $error_array['detail'] = "Detail cannot be empty";
    }
    if(empty($error_array)){  
		$todo_item = [
			'title' => $_POST['title'],
			'date' => $utime,
			'details' => $_POST['details'] 
		];
        
		$todoListJson = file_get_contents($saveFile);
		
        if(strlen($todoListJson)==0){  
			$todoList = [];
        }
        else{  
		   $todoList = json_decode($todoListJson, true);
        }
        	$timingVar = $utime.'-'.generateRandomString(); //$name = $timingVar
        	$todoList[$timingVar] = $todo_item;// json_decode('../data/todo.json');
			$tempObjJson = json_encode($todoList);
			$addFile = file_put_contents('../data/todo.json', $tempObjJson);
        if($addFile == true){
			$output['success'] = true;
			$output['congratesMsg'] = "Holy Cow, we added the file successful";
        }
        else{
			$output['success'] = false;
			$output['errorMsg'] = "no file is added";
        }
    }
    else{ 
		$output['success'] = false;
		$output['errorMsg'] = "failed to add to json file";
        $output['errorKey'] = $error_array;
    }
}
else{ 
	$output['success'] = false;
	$output['errorMsg'] = "something went wrong in form $ _POST";
}
	echo json_encode($output, true);
?>