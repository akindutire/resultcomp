<?php
	
	namespace cliqsFrameWork\sort;
	
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
	$record 	=	new record();
	
	$sortid=(int)filter_var(strip_tags(trim($_POST['sortid'])),FILTER_VALIDATE_INT);
			
			if($sortid==1){
				
				$filter=$check->sanitize($_POST['filteradmin']);
				$record->get_all_admin($filter);
			
			}else if($sortid==2){
				
				//Sort Fans OF dpts
				$filter=$check->sanitize($_POST['filterfans']);
				$dpt_id=$check->sanitize($_POST['dpts_id']);
				$record->get_all_fans($filter,$dpt_id);

			}else if($sortid==3){
				
				//Sort Fans OF dpts
				$filter=$check->sanitize($_POST['filterapplicants']);
				$dpt_id=$check->sanitize($_POST['dpts_id']);
				$record->get_all_applicants($filter,$dpt_id);
				
			}else if($sortid==4){
				
				
			}else if($sortid==5){
				
				
			}else if($sortid==6){
				
				
			}else if($sortid==7){
				
				
			}
			
	
	
exit();	
?>