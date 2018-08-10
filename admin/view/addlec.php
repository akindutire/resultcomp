
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
		
	

	<div class="w3-container">


		<nav class="w3-sidenav w3-animate-left w3-left" style="position: relative; z-index: 0; width: 24.5%;">

			<ul class="w3-ul">
				
				<?php $me->loadmenu(1); ?>
					
			</ul>
		
		</nav>

		

		<div class="w3-right w3-border-left" style="width:75%;">
		
		

		<h1>Add Lecturer</h1>

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
				

				<form class="w3-form w3-half" method="post" action=<?php echo $config['control']['add']; ?> style="margin-left: 10%;">

					<label class="w3-label w3-text-red">*Fullname</label><input class="w3-input" type="text" name="fname" id="fname" required="required" /><br>

					<label class="w3-label w3-text-red">*Password</label><input class="w3-input" type="password" name="pass" id="pass" required="required" /><br>

					<label class="w3-label">E-mail</label><input class="w3-input" type="email" name="email" id="email" required="required" /><br>

					<label class="w3-label">Sex</label><select class="w3-input" name="sex" id="sex">
						
						<option value="Male">Male</option>
						<option value="Female">Female</option>
					</select><br>

					<button class="w3-btn w3-center w3-indigo w3-text-white" type="submit" id="reg_lec">Register</button>


				</form>


		</div>

		

	</div>

	<?php include_once('../images/layout/footer.php'); ?>
</body>