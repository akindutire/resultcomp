
<?php $me->verifylogin("lecturer",1); 
$course_id=$check->sanitize($_GET['course_id']);

$course_id=filter_var($course_id,FILTER_SANITIZE_NUMBER_INT);

?>
<head>
	
	<title>
		
		Result Calculator****

	</title>

		 <meta name="viewport" content="width=device-width, initial-scale=1"> 


</head>

<body>
	
	
			<?php include_once('../images/layout/head.php'); ?>

			<?php include_once('../images/layout/menu.php'); ?>
	
	
	<div class="w3-container" style="position: relative; margin: 0;">


		
		<nav class="w3-sidenav w3-animate-left w3-left" style="position: relative; z-index: 0; width: 24.5%;">

			
				
				<?php $me->loadmenu(2); ?>
					
			
		</nav>
		
		

		<div class="w3-right w3-border-left" id="scoresheet" style="width: 75%; position: relative; z-index: 0;">
			
			<div class="w3-modal" id="modal1">
					<div class="w3-modal-content w3-animate-zoom">
						
						<div class="w3-container">
							
							<p class="w3-center w3-padding-64">
								
								<cc>
									<img src="../images/content/spinner.gif">	
								</cc>

								<br>

								<button class="w3-btn w3-blue w3-margin-16" onclick="document.getElementById('modal1').style.display='none'" id="close_btn_on_cond">Ok</button>
							</p>
						
						</div>

					</div>
						
		</div>
				
				<?php 
				$me->cur_profile();
				$me->scoresheet($course_id); 


				?>
				<p class='w3-center'>
					
					<button id="btnexportresult" type='button' class='w3-green w3-text-white w3-btn' data-tableid='iscoresheet'> <i class="fa fa-file-excel-o"></i>&nbsp;Export to Excel </button>

					<button id="btnexportresult" type='button' class='w3-green w3-text-white w3-btn' data-tableid='ciscoresheet'> <i class="fa fa-file-excel-o"></i>&nbsp;Export Carry Overs </button>
				

					<button data-cos=<?php echo $course_id; ?> id="btnforwardresult" type='button' class='w3-indigo w3-text-white w3-btn'> Forward Result </button>
				</p>

		</div>

		

	</div>

	<?php include_once('../images/layout/footer.php'); ?>
</body>