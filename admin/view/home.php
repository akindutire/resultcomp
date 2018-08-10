<head>
	
	<title>
		
		Result Calculator****

	</title>

		 <meta name="viewport" content="width=device-width, initial-scale=1"> 

</head>

<body>
	
	<?php include_once('../images/layout/head.php'); ?>

	<hr style="color: navyblue;"></hr>

	<div class="w3-row">

		<div class="w3-container w3-half w3-center w3-white w3-card-4" style="height: auto; margin-left: 24%; margin-right: 24%; margin-top: 5%; margin-bottom: 10%; padding: 0px;">
		
		
		
			<h2 class="w3-center w3-indigo" style="width: 100%; margin: 0px;">login</h2><br>
		
	 		<p id="feedback" class="w3-text-red"></p>

			<form class="w3-form" method="post" action=<?php echo $config['control']['login']; ?> style="padding:5%;">

				<label class="w3 label w3-left">Username</label><input class="w3-input" type="text"id="usr" required><br>
				
				<label class="w3 label w3-left">Password</label><input class="w3-input" type="password" id="pwd" required><br>				

				<p><button id="btnlogin" class="w3-btn w3-indigo w3-center">Login</button> or <a href="index.php?q=forgetpass">Forgot Password?</a></p>

			</form>

			
			
		</div>

		</div>

		

	</div>

	<?php include_once('../images/layout/footer.php'); ?>

</body>