<?php
	
	namespace cliqsFrameWork\hupload;
	
	include_once('../../bootstrap/pageinit.php');
	include_once('../class/users.php');
	
	use cliqsFrameWork\ic\yall as me;
	use cliqsFrameWork\ic\connect as connectme;
	use cliqsFrameWork\ic\performance as ivalid;
	
	$me			=	new me();
	$connect	=	new connectme();
	$check  	=	new ivalid();
	
	

	function redirect($url){

				$url=filter_var($url,FILTER_SANITIZE_URL);

				header("location:$url");
	}

	
	$attachments=null;
	
	$count = 0;
	
	$valid_formats = array('application/pdf','application/vnd.openxmlformats-officedocument.wordprocessingml.document','application/epub+zip','application/vnd.openxmlformats-officedocument.presentationml.presentation','image/jpeg','image/gif','image/png');
		
		$max_file_size=(int)($_POST['assigned_file_size'])*1024;

		if ($_SERVER['REQUEST_METHOD'] == "POST") {
			
			// Loop $_FILES to execute all files
			foreach ($_FILES['xhfile']['name'] as $f => $name) {     
	    		
	    		$name=str_replace(' ','',strtolower($_FILES['xhfile']['name'][$f]));
				$name=str_replace('-', '', $name); $name=str_replace('_', '', $name);

	    		if ($_FILES['xhfile']['error'][$f] == 4) {
	        		continue; // Skip file if any error found

	    		}	       

	    		if ($_FILES['xhfile']['error'][$f] == 0) {	           
	        	
	        		if ($_FILES['xhfile']['size'][$f] < $max_file_size && in_array($_FILES['xhfile']['type'][$f], $valid_formats)) {
	            		
	            		$y="Y"; 

	        			#Append Upload timestamp to file to avoid data Collision
						$filename=md5(time().$config['init']['token']).$name;
	            		//echo $filename;
	            		if(move_uploaded_file($_FILES["xhfile"]["tmp_name"][$f],"../../uploads/$y/removed"."/$filename")) {
	            			$count++; // Number of successfully uploaded files

	            			$attachments.=$filename."|";

	            		}
			
					}else{
						
						$message = "An Error Occured, File Format Not Supported";
						continue; // Skip invalid file formats
					}
	        
	        	}
		}
	}

	

			$comment=$check->sanitize($_POST['comment']);

			$group_id = $check->sanitize($_POST['upload_group']);
			
			$comment=empty($comment)?" ":$comment;
	

			$me->upload_to_downloads($group_id,$attachments,$comment);    

	exit();

?>