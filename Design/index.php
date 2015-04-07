<!DOCTYPE html>
<?php 
	session_start();
	$name = "";
	$userid = "";
	if(array_key_exists('name', $_SESSION) && array_key_exists('userid', $_SESSION)){
		$name = $_SESSION['name'];
		$userid = $_SESSION['userid'];
	}
		
?>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Sizzl | Index</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">

	<!--link rel="stylesheet/less" href="less/bootstrap.less" type="text/css" /-->
	<!--link rel="stylesheet/less" href="less/responsive.less" type="text/css" /-->
	<!--append ‘#!watch’ to the browser URL, then refresh the page. -->
	
<!-- SWITCH TO MIN EVENTUALLY? -->
	<link href="css/bootstrap.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">

	<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<![endif]-->

	<!-- Fav and touch icons -->
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="img/apple-touch-icon-144-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="img/apple-touch-icon-114-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="img/apple-touch-icon-72-precomposed.png">
	<link rel="apple-touch-icon-precomposed" href="img/apple-touch-icon-57-precomposed.png">
	<link rel="shortcut icon" href="img/favicon.png">
	
	<!--<script src="js/jquery-2.1.3.js"></script>-->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/scripts.js"></script>
</head>

<body background="bg.png">
<div class="container">
	<div class="row clearfix">
		<div class="col-md-12 column">
		
			<!-- Logo & subtitle text -->
			<div class="logo">
				<img class="img-responsive center-block" src="logo.png" style="width:40%">
				<h3 class="text-center text-muted">
					Your one-stop shop for dank-ass restaurant reviews
				</h3>
			</div>
			
			<!-- Navigation Bar -->
			<nav class="navbar navbar-default" role="navigation">
				<div class="navbar-collapse collapse">
					<!-- Search Bar -->
					<ul class="navbar-brand">
						<form class="navbar-form" role="search" method="get" id="search-form" name="search-form">
							<div class="input-group">
								<input type="text" class="form-control" placeholder="Restaurants, Cuisines..."
								id="query" name="query" value="">
								<div class="input-group-btn">
									<button type="submit" class="btn btn-warning"><span class="glyphicon glyphicon-search"></span></button>
								</div>
							</div>
						</form>
					</ul>
					<!-- Left -->
					<ul class="nav navbar-nav navbar-left">
						<li><a href="index.php"><b>Home</b></a></li>
						<li><a href="about.php">About</a></li>
						<li><a href="contact.php">Contact</a></li>
					</ul>
					<!-- Right -->
					<ul class="nav navbar-nav navbar-right">
						<li><a href="login.php">Login</a></li>
						<li><a href="register.php">Register</a></li>
					</ul>
				</div>	
			</nav>
			
						
			<!-- Most Popular Restaurants -->
			<div class="most-popular">
				<h1 class="text-center text-success">
					Most Popular Restaurants
				</h1>
				
				<!-- One -->
				<div class="col-md-4">
					<div class="thumbnail">
					
					<?php
						require('connect.php');
						$query = "SELECT *
								FROM project.Restaurant R
								WHERE R.restaurant_id = 1";
						$result = pg_query($query) or die('Query failed: ' . pg_last_error());
						
						$row = pg_fetch_assoc($result);
						
						$name = $row['name'];
						$id = $row['restaurant_id'];
						
						echo "
							<a href='http://localhost/Github/CSI2132-Restaurants/Design/restaurant.php?id=$id'>
							<div class='cropped-img' style='background-image:url('http://afghanchopan.com/wp-content/uploads/2013/08/garden-salad.jpg')' /> </div>

							<div class='caption'>
							<h2>$name</a></h2>
						";
					?>
					
						<p>
							<?php
								//Query to be ran will be changed when we implement ratings
								//The DB should already be connected at this point
								$query = 'SELECT R.name FROM project.restaurant R WHERE restaurant_id=8';
								$result = pg_query($query) or die('Query failed: ' . pg_last_error());
								//Fetch the results and print them
								while ($row = pg_fetch_row($result)) {
									echo "$row[0]";
									echo "<br/>\n";
								}	
							?>
						</p>
					</div>
				</div>
			</div>
				<!-- Two -->
				<div class="col-md-4">
					<div class="thumbnail">
					<a href="#">
					<div class="cropped-img" style="background-image:url('http://i.telegraph.co.uk/multimedia/archive/01718/steak_1718547b.jpg')" /> </div>

					<div class="caption">
					<h2>
					<?php
								//Query to be ran will be changed when we implement ratings
								//The DB should already be connected at this point
								$query = "SELECT R.name
									FROM project.Restaurant R
									WHERE R.restaurant_id = 2";
								$result = pg_query($query) or die('Query failed: ' . pg_last_error());
								//Fetch the results and print them
								while ($row = pg_fetch_row($result)) {
									echo "$row[0]";
									echo "<br/>\n";
								}
					?>
						</a>
						</h2>
						<p>
							Better known locally as "Pho Ling Do Bang Do Ding Da Do 2", this hole-in-the-wall eatery features some of the grimiest pho known to Ottawa.
						</p>
					</div>
				</div>
				</div>
				<!-- Three -->
				<div class="col-md-4">
					<div class="thumbnail">
					<a href="#">
					<div class="cropped-img" style="background-image:url('http://upload.wikimedia.org/wikipedia/commons/a/a2/Asian_Style_Italian_Pasta.jpg')" /> </div>
						
					<div class="caption">
						<h2>
							<?php
								//Query to be ran will be changed when we implement ratings
								//The DB should already be connected at this point
								$query = "SELECT R.name
									FROM project.Restaurant R
									WHERE R.restaurant_id = 3";
								$result = pg_query($query) or die('Query failed: ' . pg_last_error());
								//Fetch the results and print them
								while ($row = pg_fetch_row($result)) {
									echo "$row[0]";
									echo "<br/>\n";
								}
					?>
							</a>
						</h2>
						<p>
							You haven't been to a sports bar until you've been to Restaurant 3. A new addition to the downtown nightlife, this sports bar is praised for
							its super hot waitresses with unreasonably-sized jugs. No comment on the food.
						</p>

					</div>
				</div>
	</div>

	<div class="row clearfix">
		<!-- Cuisines -->
		<div class="cuisines">
			<div class="col-md-3 column">
				<h3>Cuisines
				</h3>
				<ul>
					<li>
						Amurrican (25)
					</li>
					<li>
						Asian (5)
					</li>
					<li>
						Coffee (18)
					</li>
					<li>
						Italian (14)
					</li>
					<li>
						Middle Eastern (4)
					</li>
					<li>
						Sandwiches (11)
					</li>
					<li>
						Vegetarian (0)
					</li>
				</ul>
			</div>
		</div>
		
		<!-- Recent Reviews -->
		<div class="recent-reviews">
			<div class="col-md-9 column">
				<h2 class="text-info text-center">
					Most Recent Reviews
				</h2>
				<h2>
					I LOVE BACON add title query
				</h2>
				<h4>
				by <a href="#">
				<?php
					$query = " SELECT Rater.name
							FROM project.Rater Rater, project.Rating Rating
							WHERE Rater.user_id = Rating.user_id AND Rating.post_date IN 
							(SELECT MIN(Rating2.post_date) FROM project.Rating Rating2)";
							
					$result = pg_query($query) or die('Query failed: ' . pg_last_error());
					//Fetch the results and print them
					while ($row = pg_fetch_row($result)) {
						echo "$row[0]";
						echo "<br/>\n";
					}
					
				?>
				</a>
				</h4>
				<p>
									<?php
					$query = " SELECT Rating.comments
FROM project.Rater Rater, project.Rating Rating
WHERE Rater.user_id = Rating.user_id AND Rating.post_date IN 
(SELECT MIN(Rating2.post_date) FROM project.Rating Rating2)";
							
					$result = pg_query($query) or die('Query failed: ' . pg_last_error());
					//Fetch the results and print them
					while ($row = pg_fetch_row($result)) {
						echo "$row[0]";
						echo "<br/>\n";
					}
					
				?>
				</p>
				<p>
					<a class="btn" href="#">Read review »</a>
				</p>
			</div>
		</div>

	</div>
	
<!-- Bottom Logo
<footer class="footer">
	<div class="container text-center">
		<img style="max-width: 50px"
			 src="logo-fire.png">
	</div>
</footer> -->

</body>
</html>