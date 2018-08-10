<?php
	
	namespace cliqsFrameWork\delete;
	
	include_once('../../bootstrap/pageinit.php');
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
	

		$dv=(int)filter_var(strip_tags(trim($_POST['deleteid'])),FILTER_VALIDATE_INT);
		
		if($dv==1){
			
			//'deleteid':1,'list':list
			$cos_id=$check->sanitize($_POST['cos_id']);
			$me->delete_course($cos_id);

		}else if($dv==2){
			
			//'deleteid':1,'list':list
			
		}else if($dv==3){
			
			
		}else if($dv==4){
			
			
		}else if($dv==5){
			
			
		}else if($dv==6){
			
			
		}

exit();
?>