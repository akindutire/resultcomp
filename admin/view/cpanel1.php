
<?php $me->verifylogin("hod",1); ?>
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
					
			
		</nav>
		
		

		<div class="w3-right w3-border-left" style="width: 75%; position: relative; z-index: 0;">
			
				
				<?php 
				$me->cur_profile();
				$me->load_students(); 


				?>


		</div>

		

	</div>

	<?php include_once('../images/layout/footer.php'); ?>
</body>