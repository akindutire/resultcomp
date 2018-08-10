<?php
	
	namespace cliqsFrameWork\add;
	
	include_once('../../bootstrap/pageinit.php');
	//include_once('../../config/config.php');
	include_once('../class/users.php');
	
	use cliqsFrameWork\ic\yall as me;
	use cliqsFrameWork\ic\connect as connect;
	use cliqsFrameWork\ic\performance as ivalid;
	
	
	function redirect($url){

				$url=filter_var($url,FILTER_SANITIZE_URL);

				header("location:$url");
	}

	$me			=	new me();
	$connect	=	new connect();
	$check  	=	new ivalid();
	
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	$headers .= "from: Cyber Protection Corps Nigeria";

	
		$ad=(int)filter_var(strip_tags(trim($_POST['addid'])),FILTER_VALIDATE_INT);

		if($ad==1){

			//'fname':fname,'lname':lname,'tel':tel,'sex':sex,'adrank':adrank,'addid':1

			$fname=$check->sanitize($_POST['fname']);
			$pass=$check->sanitize($_POST['pass']);
			$email=$check->sanitize(filter_var($_POST['email'],FILTER_SANITIZE_EMAIL));
			$sex=$check->sanitize($_POST['sex']);
			$bk=0;
			
			$me->addadmin($fname,$pass,$email,$sex);

		}else if($ad==2){

			$costitle=ucwords($check->sanitize($_POST['costitle']));
			$coscode=strtoupper($check->sanitize($_POST['coscode']));
			$cosunit=$check->sanitize($_POST['cosunit']);
			
			$me->addcourse($costitle,$coscode,$cosunit);

		}else if($ad==3){

			//'assign_cos_id':data,'assign_lec_id':selected_lec,'addid':3
			
			$assign_lec_id=htmlentities($_POST['assign_lec_id']);
			$course=$_POST['assign_cos_id'];
			
			$me->map_course_lecturer($assign_lec_id,$course);

		}else if($ad==4){
			
			//'description':description,'privacy':privacy,'dpt':dpt
			
			
			
		}else if($ad==5){
			
			//'addid':5,'newsthread':newsthread,'pcomment':pcomment

						
		}else if ($ad==6) {
			
			//'addid':6,'state':state

			

		}else if ($ad==7) {

			//'addid':7,'state':state,'lga':lga

			
			
		}else if ($ad==8) {

			$link=$connect->iconnect();
			$uid=$check->sanitize($_POST['uid']);

			foreach ($_POST['dpts'] as $dp) {

				$fg=mysqli_query($link,"SELECT * FROM dpts_mem WHERE dpts_id='$dp' AND uid='$uid'");
				if(mysqli_num_rows($fg)==1){
					mysqli_query($link,"DELETE FROM dpts_mem WHERE dpts_id='$dp' AND uid='$uid'");
				}
	
			}
			

			$sql=mysqli_prepare($link,"INSERT INTO dpts_mem(id,uid,dpts_id,date) VALUES(?,?,?,?)");

			$date=date(time());
			$e='';
	
			mysqli_stmt_bind_param($sql,'iiis',$e,$uid,$dpts,$date);
			
			
			foreach ($_POST['dpts'] as $dpts) {
				
				mysqli_stmt_execute($sql);				
			
			}

			redirect("../../admin/index.php?q=extenddpt&uid=$uid");

		}else if ($ad==9) {
			
			//'addid':9,'areaname':areaname,'state':state,'lga':lga,'addr':addr,'cont':contact,'type':type

			$areaname=$check->sanitize($_POST['areaname']);
			$state=$check->sanitize($_POST['state']);
			$lga=$check->sanitize($_POST['lga']);
			$addr=$check->sanitize($_POST['addr']);
			$contact=$check->sanitize($_POST['cont']);
			$type=$check->sanitize($_POST['type']);

			$me->create_office($areaname,$state,$lga,$addr,$contact,$type);

		}else if ($ad==10) {

			$uid=$check->sanitize($_POST['uid']);
			$state=$check->sanitize($_POST['state']);
			$lga=$check->sanitize($_POST['lga']);
			if(!empty($lga)){
				$me->attach_an_individual_to_an_office($uid,$state,$lga);
			}else{
				echo "Please Select An L.G.A";
			}
			
		}else if ($ad==11) {	

			$dpts_id=$check->sanitize($_POST['dpts_id']);
			$posterid=$check->sanitize($_POST['poster_id']);
			$thread_topic=$check->sanitize($_POST['thread_topic']);

			$me->create_thread($dpts_id,$posterid,$thread_topic);

		}else if ($ad==12) {
			
			$dpts_id=$check->sanitize($_POST['dpts_id']);
			$thread_id=$check->sanitize($_POST['thread_id']);
			$thread_comment=strip_tags($_POST['thread_comment'],'<b>,<p>,<a>,<img>,<i>,<blockquote>,<u>,<hr>');

			$me->create_thread_comment($thread_id,$thread_comment,$dpts_id);


		}else if ($ad==13) {

			$email=filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
			$dpts=$check->sanitize($_POST['dpts']);
			$me->confirm_mail($email,$dpts);

		}else if ($ad==14) {
			

			$email=filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
			$fname=$check->sanitize($_POST['fname']);
			$lname=$check->sanitize($_POST['lname']);
			$addr=$check->sanitize($_POST['addr']);
			$tel=$check->sanitize($_POST['tel']);
			$state=$check->sanitize($_POST['state']);
			$lga=$check->sanitize($_POST['lga']);
			$country=$check->sanitize($_POST['country']);
			$comment=$check->sanitize($_POST['comment']);
			$sex=$check->sanitize($_POST['sex']);
			$tok=$check->sanitize($_POST['tok']);

			if (!empty($email) && !empty($comment) && !empty($_SESSION['funame'])) {

				$me->post_petition($email,$fname,$lname,$addr,$tel,$state,$lga,$country,$comment,$sex,$tok);
			
			}else{
				
				echo "Some field(s) missing";
			}
			
		
		}else if ($ad==15) {

			$email=filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
			$tok=$check->sanitize($_POST['tok']);
			$dpts=$check->sanitize($_POST['dpts']);
			$fname=$check->sanitize($_POST['fname']);
			$lname=$check->sanitize($_POST['lname']);
			$addr=$check->sanitize($_POST['addr']);
			$tel=$check->sanitize($_POST['tel']);
			$state=$check->sanitize($_POST['state']);
			$lga=$check->sanitize($_POST['lga']);
			$country=$check->sanitize($_POST['country']);
			$occupation=$check->sanitize($_POST['occ']);
			$body=$check->sanitize($_POST['body']);
			$sex=$check->sanitize($_POST['sex']);

			if (!empty($email) && !empty($addr) && !empty($_SESSION['funame'])) {
				$me->post_application($tok,$dpts,$email,$fname,$lname,$addr,$tel,$state,$lga,$country,$occupation,$body,$sex);
			}else{
				echo "Some field(s) missing";
			}

		}else if ($ad==16) {
			
			$sbj=strtoupper($check->sanitize($_POST['sbj']));
			$i=0;
			foreach($_POST['sendmailtofans'] as $mail){
				$i+=1;
				$msg=strip_tags($_POST['msg'],'<b>,<p>,<a>,<img>,<i>,<blockquote>,<u>,<hr>');
				mail($mail, $sbj , $msg, $headers);
			}
			echo "Mail Sent To $i Fans ";

		}else if ($ad==17) {
			
			$sbj=strtoupper($check->sanitize($_POST['sbj']));
			$i=0;
			foreach($_POST['sendmailtoapplicants'] as $mail){
				$i+=1;
				$msg=strip_tags($_POST['msg'],'<b>,<p>,<a>,<img>,<i>,<blockquote>,<u>,<hr>');
				mail($mail, $sbj , $msg, $headers);
			}
			echo "Mail Sent To $i Applicants ";

		}else if ($ad==18) {
			
			$sbj=strtoupper($check->sanitize($_POST['sbj']));
			
			$from_mail=filter_var($_POST['fromemail'],FILTER_SANITIZE_EMAIL);

			$mail=filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
				
				$msg=strip_tags($_POST['msg'],'<b>,<p>,<a>,<img>,<i>,<blockquote>,<u>,<hr>');
				
				mail($mail, $sbj , $msg, $headers);
			
			echo "Mail Sent";

		}else if ($ad==19) {
			
			//'fname':fname,'type':type,'comment':comment

			$fname=$check->sanitize($_POST['fname']);
			$type=$check->sanitize($_POST['type']);
			$comment=$check->sanitize($_POST['comment']);
			

			if (!empty($fname) && !empty($type)) {
				$me->create_album_sector($fname,$type,$comment);
			}else{
				echo "Some field(s) missing";
			}


		}else if ($ad==20) {
			
			//'fname':fname,'type':type,'comment':comment

			

		}else if ($ad==21) {
			

		}else if ($ad==22) {
			

		}else if ($ad==23) {
			

		}else if ($ad==24) {
			

		}else if ($ad==25) {
			

		}


?>