<?php
namespace cliqsFrameWork\logoutclient;

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
	
	$me->logout(0);

?>