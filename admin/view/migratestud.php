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

				<p class="w3-red w3-center w3-padding-4">NB: Next Level Must Be Empty </p>

			
				<h2 class="w3-center w3-indigo" style="width: 100%; margin: 0px;">Choose Level : Migrate To</h2><br>
				
				<form method="post" action=<?php echo $config['control']['update']; ?> class="w3-form" style="padding:5%;">

					<input type="hidden" name="upid" value="15">

					<label>Level</label>
					<select class="w3-input" name="lv">
						
						<?php $me->load_level(); ?>

					</select>

					<br>

					<label>Semester</label>
					<select class="w3-input" name="sem">
						
						<?php $me->load_semester(); ?>

					</select>
					<br>

					<button class="w3-btn w3-indigo w3-center" type="submit" id="" >Migrate</button>
				</form>	
	

		</div>

		

	</div>

	<?php include_once('../images/layout/footer.php'); ?>
</body>


