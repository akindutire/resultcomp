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
				
				?>

				<p class="w3-red w3-center w3-padding-4">NB: All Realated Details such as Result and Personal Data will be archieved, Archieved Student won't be able to participate in Result Processing. (An advanced form of Migration) </p>

			
				<h2 class="w3-center w3-indigo" style="width: 100%; margin: 0px;">Graduate Student</h2><br>
				
				<form method="post" action=<?php echo $config['control']['update']; ?> class="w3-form" style="padding:5%;">

					<input type="hidden" name="upid" value="16">

					
					<br>

					<p class="w3-center"><button class="w3-btn w3-indigo w3-center" type="submit" id="" >Graduate Student</button></p>
				</form>	
	

	

		</div>

		

	</div>

	<?php include_once('../images/layout/footer.php'); ?>
</body>


