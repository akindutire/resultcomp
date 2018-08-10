<?php
//First that execute Sys Config

include_once('../config/config.php');

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
		|	Application Initialization
		|-----------------------------------------------------
		|
		|
		|
		*/

			function exists($array){


				foreach ($array as $key => $value) {
				
					if(	file_exists($value)	){
	
						$control 	=	true;

					}else{
					
						$control 	=	false;

					}

				}

				return $control;

			}

			function redirect($url){

				$url=filter_var($url,FILTER_SANITIZE_URL);

				header("location:$url");
			}

		

		if(exists($config['controlValidation'])	==	1 	&&	!$config['init']['glock']){


			redirect('../'.$config['init']['dir'].'/');

		}else{

			echo "Bad Gateway , App. Initialization Failed";
		}

			

		exit();

?>