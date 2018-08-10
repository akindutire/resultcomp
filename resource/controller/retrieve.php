<?php
	
	namespace cliqsFrameWork\retrieve;
	
	include_once('../../bootstrap/pageinit.php');
	include_once('../class/users.php');
	
	use cliqsFrameWork\ic\yall as me;
	use cliqsFrameWork\ic\connect as connect;
	use cliqsFrameWork\ic\performance as ivalid;
	use cliqsFrameWork\ic\records as record;

	function redirect($url){

				$url=filter_var($url,FILTER_SANITIZE_URL);

				header("location:$url");
	}

	$me			=	new me();
	$connect	=	new connect();
	$check  	=	new ivalid();
	$record  	=	new record();

			
			
		$rv=(int)filter_var(strip_tags(trim($_POST['retrieveid'])),FILTER_VALIDATE_INT);
		
		if($rv==1){
			
			//'retrieveid':1
			
			$record->load_lecturer();

		}else if($rv==2){
			
			//'retrieveid':2
			$record->load_course();

		}else if($rv==3){
			
			$cos=$check->sanitize(filter_var($_POST['cos_id'],FILTER_SANITIZE_NUMBER_INT));
			$record->scoresheet($cos);
			//'retrieveid':3,'uid':id

		}else if($rv==4){

			$id=$check->sanitize($_POST['id']);
			$record->get_context($id);

		}else if($rv==5){
			
			$id=$check->sanitize($_POST['id']);
			$record->get_news_context($id);

		}else if($rv==6){
			
			
			$record->course_list();

		}else if($rv==7){
			
			$cos_id=$check->sanitize($_POST['cos_id']);
			$record->fetch_course_update_form($cos_id);

		}else if ($rv == 8) {
			
			//'retrieveid':8, 'cos_id':cos_id
			$cos_id=$check->sanitize($_POST['cos_id']);
			$record->fetch_course_details($cos_id);

		}else if ($rv == 9) {
			
			$level=$check->sanitize($_POST['lv']);
			$semester=$check->sanitize($_POST['sem']);
			$matric_no=$check->sanitize($_POST['matric_no']);

			$record->get_past_result($level,$semester,$matric_no);

		}
			
		
		
	
	exit();
?>