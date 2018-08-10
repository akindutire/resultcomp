
<?php $me->verifylogin("hod",1); ?>
<head>
	
	<title>
		
		Result Calculator****

	</title>

		 <meta name="viewport" content="width=device-width, initial-scale=1"> 


</head>

<body>
	
	<div style="position: relative; height: 22%;">
		<div class="w3-top">

			<?php include_once('../images/layout/head.php'); ?>

			<?php include_once('../images/layout/menu.php'); ?>
		
		</div>
	</div>


	<div class="w3-container">


		<nav class="w3-sidenav w3-animate-left w3-left" style="position: relative; z-index: 0; width: 24.5%;">

			<ul class="w3-ul">
				
				<?php $me->loadmenu(1); ?>
					
			</ul>
		
		</nav>

		

		<div class="w3-right w3-border-left" style="width:75%;">

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
			<h1>Course Registration   

			<?php  

			$link=$connect->iconnect();

			$level=$_SESSION['lv_id'];
			$semester=$_SESSION['sem_id'];

			$sql=mysqli_query($link,"SELECT lv,sem FROM level,semester WHERE level.id='$level' AND semester.id='$semester'");

		list($lv,$sem)=mysqli_fetch_row($sql);

		echo ("$lv > $sem");

		?></h1>
				
				
				<form class="w3-form w3-half" method="post" action=<?php echo $config['control']['add']; ?> style="margin-left: 10%;">

					<label class="w3-label w3-text-red">*Course Ttile</label><input class="w3-input" type="text" name="costitle" id="costitle" required="required" /><br>

					<label class="w3-label w3-text-red">*Course Code</label><input class="w3-input" type="text" name="coscode" id="coscode" required="required" /><br>

					<label class="w3-label w3-text-red">Unit</label><input class="w3-input" type="number" name="cosunit" id="cosunit" required="required" /><br>

					

					<button class="w3-btn w3-center w3-indigo w3-text-white" type="submit" id="reg_cos">Register</button>


				</form>


		</div>

		

	</div>

	<?php include_once('../images/layout/footer.php'); ?>
</body>