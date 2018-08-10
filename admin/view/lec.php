
<?php 

$me->verifylogin("hod",1); 

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
		
		


	<div class="w3-container">


		<nav class="w3-sidenav w3-animate-left w3-left" style="position: relative; z-index: 0; width: 24.5%;">

			<ul class="w3-ul">
				
				<?php $me->loadmenu(1); ?>

				<hr>
				<a class='w3-hover-blue' href='index.php?q=assignlec' target='_new'>Assign Lecturer</a>
				<a class='w3-hover-blue' href='index.php?q=addlec' target='_new'>Add Lecturer</a>

			</ul>
		
		</nav>

		

		<div class="w3-right w3-border-left" style="width:75%;">

		<div class="w3-modal" id="modal1">
					<div class="w3-modal-content w3-animate-zoom">
						
						<a class="w3-btn w3-right w3-red" onclick="document.getElementById('modal1').style.display='none'">X</a>

						<div class="w3-container">
							
							<p class="w3-center w3-padding-32">
								<p id="feedback"></p>
								<cc>
								
								<el class="w3-text-red w3-medium"></el>

										<oo>
											<img src="../images/content/spinner.gif">	
										</oo>
				
									
								</cc>

								<br>

							</p>
						
						</div>

					</div>
						
				</div>

			<h1>Lecturers</h1>
				
				
				<form class="w3-form" method="post" action=<?php echo $config['control']['add']; ?> id='courselist' style="margin-left: 10%;">
					
					<ee>
						
						<?php $me->lecturer_list(); ?>

					</ee>
					
					
				</form>


		</div>

		

	</div>

	<?php include_once('../images/layout/footer.php'); ?>
</body>