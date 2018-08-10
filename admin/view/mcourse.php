<?php $me->verifylogin("hod",1); 


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

			
				
				<?php $me->loadmenu(1); ?>
				
				<hr>

				<a class='w3-hover-blue' href='index.php?q=coursereg' target='_new'>Add Courses</a>
					
			
		</nav>
		
		

		<div class="w3-right w3-border-left" id="scoresheet" style="width: 75%; position: relative; z-index: 0;">
			
			<div class="w3-modal" id="modal1">
					<div class="w3-modal-content w3-animate-zoom">
						
						<a class="w3-btn w3-right w3-red" onclick="document.getElementById('modal1').style.display='none'">X</a>

						<div class="w3-container">
						
								<p id="feedback" class='w3-center w3-padding-8'></p>

								<cc>
									<img src="../images/content/spinner.gif">	
								</cc>

								<br>

							</p>
						
						</div>

					</div>
						
		</div>
				
				<?php 
				$me->cur_profile();
				
				echo "<oo>";

				$me->course_list();
				 
				echo "</oo>";

				?>
				

		</div>

		

	</div>

	<?php include_once('../images/layout/footer.php'); ?>
</body>