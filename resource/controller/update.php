<?php

	namespace cliqsFrameWork\update;
	
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
	

	
		$up=$_POST['upid'];
		
		if($up==1){
			//'test':test_vals, 'matric':matric, 'cos':cos, 'upid':1
			
			$test_vals=$check->sanitize($_POST['test']);
			$matric=$check->sanitize($_POST['matric']);
			$cos_id=$check->sanitize($_POST['cos']);

			$me->update_grade_tab($matric,$cos_id,$test_vals,1);

		}else if($up==2){
			//'ca':ca_vals, 'upid'=2
			
			$ca_vals=$check->sanitize($_POST['ca']);
			$matric=$check->sanitize($_POST['matric']);
			$cos_id=$check->sanitize($_POST['cos']);

			$me->update_grade_tab($matric,$cos_id,$ca_vals,2);

			
		}else if($up==3){
			//'exam':exam_vals, 'upid'=3

			$exam_vals=$check->sanitize($_POST['exam']);
			$matric=$check->sanitize($_POST['matric']);
			$cos_id=$check->sanitize($_POST['cos']);

			$me->update_grade_tab($matric,$cos_id,$exam_vals,3);


		}else if($up==4){

			//'matric':matric, 'cos':cos, 'upid':4

			$matric=$check->sanitize($_POST['matric']);
			$cos_id=$check->sanitize($_POST['cos']);

			$me->recompute_grade($matric,$cos_id);			
			
		}else if($up==5){

			//Carry Over Update Test

			$test_vals=$check->sanitize($_POST['ctest']);
			$matric=$check->sanitize($_POST['matric']);
			$cos_id=$check->sanitize($_POST['cos']);

			$me->update_grade_tab($matric,$cos_id,$test_vals,4);
			
		}else if($up==6){
			
			//Carry Over Update CA

			$ca_vals=$check->sanitize($_POST['cca']);
			$matric=$check->sanitize($_POST['matric']);
			$cos_id=$check->sanitize($_POST['cos']);

			$me->update_grade_tab($matric,$cos_id,$ca_vals,5);

		}else if($up==7){

			//Carry over Update Exam

			$exam_vals=$check->sanitize($_POST['cexam']);
			$matric=$check->sanitize($_POST['matric']);
			$cos_id=$check->sanitize($_POST['cos']);

			$me->update_grade_tab($matric,$cos_id,$exam_vals,6);
			
		}else if($up==8){

			//Carry Over Update Grade

			$matric=$check->sanitize($_POST['matric']);
			$cos_id=$check->sanitize($_POST['cos']);

			$me->recompute_carry_over_grade($matric,$cos_id);
			
		}else if($up==9){
			
			//Forward Result

			$cos_id=$check->sanitize($_POST['cos']);
			

			$me->result_movement($cos_id,1);

		}else if ($up == 10 ) {
			# Return Result

			$cos_id=$check->sanitize($_POST['cos']);

			$me->result_movement($cos_id,2);
			
		}else if ($up == 11) {

			$costitle=ucwords($check->sanitize($_POST['costitle']));
			$coscode=strtoupper($check->sanitize($_POST['coscode']));
			$cosunit=$check->sanitize($_POST['cosunit']);
			$cos_id=$check->sanitize($_POST['cos_id']);

			$me->update_course($costitle,$coscode,$cosunit,$cos_id);

		}else if ($up == 12) {

			$cos_id=$check->sanitize($_POST['cos_id']);

			$me->unassign_course($cos_id);
			
		}elseif ($up == 15) {

			$new_level = $check->sanitize($_POST['lv']);
			$new_semester = $check->sanitize($_POST['sem']);

			$me->migrate_student($new_level,$new_semester);
			
		}else if ($up == 16) {

			$me->graduate_student();
		
		}else if ($up == 17) {
			# code...
		}else if ($up == 18) {
			# code...
		}
	


?>