<head>
	
	<title>
		
		Result Calculator

	</title>

		 <meta name="viewport" content="width=device-width, initial-scale=1"> 

</head>

<body>
	
	<header class="w3-container w3-blue-grey">
		
		<h1 class="w3-center">Result Calculator</h1>

	</header>

	<div class="w3-row">

		<div class="w3-container w3-half w3-center w3-white w3-card-4" style="height: auto; margin-left: 24%; margin-right: 24%; margin-top: 5%; margin-bottom: 10%; padding: 0px;">
		
		<header class="w3-container w3-blue-grey" style="margin: 0px;">
		
			<h2 class="w3-left w3-text-white">Login</h2>
		
		</header>

			<form class="w3-container w3-center" method="post" action=<?php echo $config['control']['login']; ?> style="padding: 10px; margin-left:10%; margin-right: 10%; margin-top: 5%; ">

				<label class="w3 label w3-left">Username</label><input class="w3-input" type="text" required><br>
				
				<label class="w3 label w3-left">Password</label><input class="w3-input" type="password" required><br>				

				<p><button class="w3-btn w3-blue-grey w3-text-white w3-center">Login</button> or <a href="index.php?q=forgetpass">Forgot Password?</a></p>

			</form>

			
			
		</div>

		</div>

		

	</div>

	<footer class="w3-container w3-blue-grey w3-center"><h4>Project 2015</h4></footer>
</body>