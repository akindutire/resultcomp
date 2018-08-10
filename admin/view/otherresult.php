<?php 

	$me->verifylogin("hod",1); 

	$link=$connect->iconnect();

?>
<head>
	
	<title>
		
		Result Calculator****

	</title>

		 <meta name="viewport" content="width=device-width, initial-scale=1"> 


</head>

<body>
	
	
			<?php //include_once('../images/layout/head.php'); ?>

			<?php //include_once('../images/layout/menu.php'); ?>
	
	
	<div class="w3-container" style="position: relative; margin-top: 5%;">


		
		<nav class="w3-sidenav w3-animate-left w3-left" style="position: relative; z-index: 0; width: 0.0%;">

			
				
				
			
		</nav>
		
		

		<div class="w3-right w3-border-left" id="scoresheet" style="width: 75%; position: relative; z-index: 0; margin-left: 12%; margin-right: 12%;">
			
			
				
				<?php 

				//$me->cur_student($matric);
				
				echo "<br><br><oo>";

				$level=$check->sanitize($_POST['lv']);
				$semester=$check->sanitize($_POST['sem']);
				$matric_no=$check->sanitize($_POST['matric_no']);

				$record->get_past_result($level,$semester,$matric_no);

				
				echo "</oo>";

				 

				?>

				
		</div>

		

	</div>

	<?php //include_once('../images/layout/footer.php'); ?>
</body>

			