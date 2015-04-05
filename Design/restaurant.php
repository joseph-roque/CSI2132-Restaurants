<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Sizzl | Restaurant</title>
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

<body>
<div class="container">
	<div class="row clearfix">
		<div class="col-md-12 column">
			<!-- Logo -->
			<img class="img-responsive center-block" src="logo.png" style="width:20%; padding-bottom:5px" />
			
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
						<li><a href="index.php">Home</a></li>
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
		</div>
		
		<!-- Textual description -->
		<div class="col-md-5 column" style="line-height:2">
			<h2 class="text-primary"><strong>
					Restaurant Name
			</strong></h2>
			<h3 class="text-info">
				(613) 569-1234
			</h3>
			<p><strong>
				Hours Open: [hour_open] — [hour_close]
				</strong>
				<br>
				[cuisine - clickable with search for all others alike]
				<br>
				Established: [first_open_date]
				<br>
				Currently managed by: <i>[manager_name]</i>
			</p>
			
		</div>
		<!-- Maps interface & avg. rating -->
		<div class="col-md-7 column text-center" style="padding-top: 10px">
			<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d2800.3172389220795!2d-75.683133!3d45.423106!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4cce050a6db98d73%3A0x188a59c3622fdbae!2sUniversity+of+Ottawa!5e0!3m2!1sen!2sca!4v1428243192262" width="400" height="250" frameborder="0" style="border:0"></iframe>
			<br>
			<div class="rating">
				<h2 class="text-info">
					Average Rating
				</h2>
				[avg. of all ratings for location]
			</div>
		</div>
	</div>
	<div class="row clearfix">
		<!-- List of menu items -->
		<div class="col-md-4 column">
			<div class="row clearfix">
				<!-- Item name (with link) -->
				<div class="col-md-7 column">
				<h2 class="text-info">
				Menu
				</h2>
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
				<!-- Rating for item -->
				<div class="col-md-5 column">
				</div>
			</div>
		</div>
		<!-- Reviews -->
		<div class="	col-md-8 column">
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