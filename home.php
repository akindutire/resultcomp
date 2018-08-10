<?php

$r='client';

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--
Design by cliqs Studio
http://realcliqs.com
Released for free under the Creative Commons Attribution License

Name       : ClearFigure 
Description: A two-column, fixed-width design with dark color scheme.
Version    : 1.0
Released   : 20140310

-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


<title>Organisation Of Cyber Protection Development</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link rel="icon" href="../images/content/thumb.gif">

<!--[if IE 6]>
<link href="default_ie6.css" rel="stylesheet" type="text/css" />
<![endif]-->
	

</head>
<body>
<div id="wrapper">

	<?php include_once("../images/layout/chead.php"); ?>
	

	<center>
		
		<?php include_once("../images/layout/slide.php"); ?>

    </center>

    <hr>

	<div id="page" class="container" style="padding-top:2px;">
		<div id="content" style="background:rgba(244, 255, 255, 0.87); width:70%; height:auto;">
			<div class="title">
				<h2>Cyber Crime History</h2>
			
			<!--<span class="byline">Phasellus nec erat sit amet nibh pellentesque congue</span>--> 

			</div>
			
			
			<?php
				$record->gethistory();
			?>

			

		</div>

		<!--<div style="clear:both;"></div>-->

		<div id="sidebar" style="width:28%;">
			<div class="box2">
				<div class="title">
					<h2>Our Mission</h2>
				</div>

				<p>
					Providing a powerful and highly visible investigative response to the most serious incidents of cyber crime: pursuing cyber criminals at a national and international level.

				</p>

				<p>
					Working proactively to target criminal vulnerabilities and prevent criminal opportunities.
				</p>

				<p>
					Assisting the NCA and wider law enforcement to pursue those who utilise the internet or ICT for criminal means. This includes offering technical, strategic and intelligence support to law enforcement, as well as supporting the training and rehabilitate on Cyber Crime in Nigeria.
				</p>

				<p>
					Driving a step-change in the UK’s overall capability to tackle cyber crime, supporting partners in industry and law enforcement to better protect themselves against cyber crime.
				</p>
				<!--<ul class="style2">
					<li><a href="#">Amet turpis, feugiat et sit amet</a></li>
					<li><a href="#">Ornare in hendrerit in lectus</a></li>
					<li><a href="#">Semper mod quis eget mi dolore</a></li>
					<li><a href="#">Quam turpis feugiat sit dolor</a></li>
					<li><a href="#">Amet ornare in hendrerit in lectus</a></li>
					<li><a href="#">Quam turpis feugiat sit dolor</a></li>
					<li><a href="#">Consequat etiam lorem phasellus</a></li>
				</ul>-->
			</div>
		</div>
	</div>
</div>
	<!--<div id="portfolio-wrapper">
		<div id="portfolio" class="container">
			<div id="column1">
				<div class="title">
					<h2>Suspendisse lacus</h2>
				</div>
				<a href="#" class="image image-full"><img src="images/pic02.jpg" alt="" /></a>
				<p>Etiam non felis. Donec ut ante. In id eros. Suspendisse lacus turpis, cursus egestas at sem. Mauris quam enim, molestie.</p>
				<a href="#" class="icon icon-arrow-right button">Read More</a> </div>
			<div id="column2">
				<div class="title">
					<h2>Fusce ultrices</h2>
				</div>
				<a href="#" class="image image-full"><img src="images/pic03.jpg" alt="" /></a>
				<p>Etiam non felis. Donec ut ante. In id eros. Suspendisse lacus turpis, cursus egestas at sem. Mauris quam enim, molestie.</p>
				<a href="#" class="icon icon-arrow-right button">Read More</a> </div>
			<div id="column3">
				<div class="title">
					<h2>Etiam posuere</h2>
				</div>
				<a href="#" class="image image-full"><img src="images/pic04.jpg" alt="" /></a>
				<p>Etiam non felis. Donec ut ante. In id eros. Suspendisse lacus turpis, cursus egestas at sem. Mauris quam enim, molestie.</p>
				<a href="#" class="icon icon-arrow-right button">Read More</a> </div>
			<div id="column4">
				<div class="title">
					<h2>Mauris vulputate</h2>
				</div>
				<a href="#" class="image image-full"><img src="images/pic05.jpg" alt="" /></a>
				<p>Etiam non felis. Donec ut ante. In id eros. Suspendisse lacus turpis, cursus egestas at sem. Mauris quam enim, molestie.</p>
				<a href="#" class="icon icon-arrow-right button">Read More</a> </div>
		</div>
	</div>-->

<?php include_once("../images/layout/footer.php"); ?>
</body>
</html>
