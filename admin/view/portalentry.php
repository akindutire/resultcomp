
<?php 



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
		
	
	
<br>

	<div class="w3-row">


		<div class="w3-col w3-container w3-grey" style="width:20%;">
			
			

		</div>

		<div class="w3-col w3-container w3-white" style="width:80%;">
			
			<div class="w3-half  w3-container w3-card-4" style="padding: 0px; margin-left: 20%; margin-top: 10%; margin-bottom: 10%;">
				
				<h2 class="w3-center w3-indigo" style="width: 100%; margin: 0px;">Enter A Level</h2><br>
				
				<form method="post" action=<?php echo $config['control']['splogin']; ?> class="w3-form" style="padding:5%;">

					<input type="hidden" name="loginid" value="1">

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

					<button class="w3-btn w3-indigo w3-center" type="submit" id="btnloginportal">Enter</button>
				</form>	

			</div><br>
			


		</div>

	</div>

		

	</div>

	<?php include_once('../images/layout/footer.php'); ?>
</body>