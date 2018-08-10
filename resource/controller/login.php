<?php
	
	namespace cliqsFrameWork\login;
	
	include_once('../../bootstrap/pageinit.php');
	//include_once('../../config/config.php');
	include_once('../class/users.php');
	
	use cliqsFrameWork\ic\yall as me;
	use cliqsFrameWork\ic\connect as connectme;
	use cliqsFrameWork\ic\performance as ivalid;
	
	function redirect($url){

				$url=filter_var($url,FILTER_SANITIZE_URL);

				header("location:$url");
	}


	$me			=	new me();
	$connect	=	new connectme();
	$check  	=	new ivalid();
	
	
	if($_SERVER['REQUEST_METHOD']=='POST'){
		
		$mat=stripslashes(strip_tags(trim($_POST['usr'])));
		$pwd=sha1(stripslashes(strip_tags($_POST['pwd'])));
		
	
		if(is_string($mat) && is_string($pwd)){
			
			//$connectme->iconnect();
			
			$me->login($mat,$pwd);
			
		}else{
			echo "<img src='../images/cancel.png' width='auto' height='14px'>&nbsp;Incorrect Field Format";
		}
	}
	exit();
?>