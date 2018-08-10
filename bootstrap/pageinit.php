<?php
	

	if(is_readable('../config/config.php')){

		include_once('../config/config.php');
			
	}else if(is_readable('../../config/config.php')){

		include_once('../../config/config.php');

	}
	
	/*
		|-----------------------------------------------------
		|	Session Configurations
		|-----------------------------------------------------
		|
		|
		|
		*/
		

		session_name($config['session']['name']);

		
		if($config['session']['savepath']){
	
			session_save_path($config['session']['storage']);

		}

		session_start();

		
		
		
		/*
		|-----------------------------------------------------
		|	Error Reporting
		|-----------------------------------------------------
		|
		|
		|
		*/

		error_reporting($config['err']['all']);


		/*
		|-----------------------------------------------------
		|	Application Token
		|-----------------------------------------------------
		|
		|
		|
		*/

		

		function redirect($url){

				$url=filter_var($url,FILTER_SANITIZE_URL);

				header("location:$url");
		}


?>