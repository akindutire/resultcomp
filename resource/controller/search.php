<?php
	
	namespace cliqsFrameWork\search;
	
	include_once('../../bootstrap/pageinit.php');
	include_once('../class/users.php');
	
	use cliqsFrameWork\ic\yall as me;
	use cliqsFrameWork\ic\connect as connectme;
	use cliqsFrameWork\ic\performance as ivalid;
	use cliqsFrameWork\ic\records as record;
	
	
	function redirect($url){

				$url=filter_var($url,FILTER_SANITIZE_URL);

				header("location:$url");
	}

	$me			=	new me();
	$connect	=	new connectme();
	$check  	=	new ivalid();
	$record  	=	new record();
	
		
		$searchid=(int)filter_var(strip_tags(trim($_POST['searchid'])),FILTER_VALIDATE_INT);
			
			if($searchid==1){
				
				//$record->searchmember($section,$sort);
			
			}else if($searchid==2){
				
				
			}else if($searchid==3){
				
				
			}else if($searchid==4){
				
				
			}else if($searchid==5){
				
				
			}else if($searchid==6){
				
				
			}else if($searchid==7){
				
				
			}
			
	
			
	exit();
?>