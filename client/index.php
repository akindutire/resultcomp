<?php
		

    include('../config/config.php');

    if($config['session']['cache']){
    	
    	if(isset($_GET['q'])){

			$view=is_string($_GET['q'])?$_GET['q']:die('Restricted Access');

		}else{

			$view='home';
		}

		$cachefile = "cache/$view.php";
	    $cachetime = 5 * 60; // 5 minutes


    	// Serve from the cache if it is younger than $cachetime
    	if (file_exists($cachefile) && (time() - $cachetime < filemtime($cachefile))) 
      		{

         	include($cachefile);

        	echo "<-- Cached ".date('jS F Y H:i:s a', filemtime($cachefile))." 
         	-->";
         	
         	exit();
      	}

     ob_start();
     }


	

	include_once('../bootstrap/pageinit.php');
	include_once('../resource/class/users.php');


	use cliqsFrameWork\ic\yall as me;
	use cliqsFrameWork\ic\connect as connectme;
	use cliqsFrameWork\ic\performance as ivalid;
	use cliqsFrameWork\ic\records as records;
	


	$me			=	new me();
	$connect	=	new connectme();
	$check  	=	new ivalid();
	$record 	=	new records();
	
	
	header('Content-Type:text/html; charset=utf-8');


		if(	$config['init']['trial']	){

			$check->checkSys();
		
		}else{
		
			echo "";
		
		}

		$view=@$_GET['q'];

		if($view	!=	null){
			
			$view=is_string($_GET['q'])?$_GET['q']:die('Restricted Access');

			if(	is_readable(__DIR__."/view/$view.php")	){

				include(__DIR__."/view/$view.php");

			}else{

				echo "Couldn't Found Requested Page";
			}

		}else{
	
			if(	is_readable(__DIR__."/view/home.php")	){

				include(__DIR__."/view/home.php");

			}else{

				echo "Application Error: Initialization Fail";
			}

		}

?>

<style type="text/css">
	
	@import "../css/web/w3.css";
	@import "../css/web/font-awesome-min.css";
	@import "../css/web/style.css";
	
  	
</style>

<script type="text/javascript" src="../js/jquery-1.9.0.min.js"></script>

<script type="text/javascript" src="../js/check.js"></script>

<script type="text/javascript" src="../js/jquery.cycle.all.js"></script>

<script type="text/javascript">
	
	$(document).ready(function(){
		$('#banner').cycle({

			fx: 'turnDown',
			
			delay: -2000
		});
	});

</script>

<?php
			if ($config['session']['cache']) {
				
				if(isset($_GET['q'])){

					$view=is_string($_GET['q'])?$_GET['q']:die('Restricted Access');

				}else{

					$view='home';
				}


				$cachefile = "cache/$view.php";
			    $cachetime = 5 * 60; // 5 minutes


				// open the cache file for writing
      			$fp = fopen($cachefile, 'w'); 

      			// save the contents of output buffer to the file
	  			fwrite($fp, ob_get_contents());
      			fclose($fp); 

				// Send the output to the browser
      			ob_end_flush(); 

         	}

?>
