<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Sizzl | Write a Review</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">

	<!--link rel="stylesheet/less" href="less/bootstrap.less" type="text/css" /-->
	<!--link rel="stylesheet/less" href="less/responsive.less" type="text/css" /-->
	<!--append ‘#!watch’ to the browser URL, then refresh the page. -->
	
	<!-- SWITCH TO MIN EVENTUALLY? -->
	<link href="css/style.css" rel="stylesheet">
	<link href="css/bootstrap.css" rel="stylesheet">
	<link href="css/star-rating.min.css" media="all" rel="stylesheet" type="text/css" />
	
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script src="js/star-rating.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="js/scripts.js"></script>
	
	<!-- JQUERY and STAR RATINGS -->

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
			<h2 class="text-info text-center">
			Writing a review for <strong>[restaurant name]</strong>
			</h2>
		</div>
		
		

		<div class="col-md-4 column ">
				<div class="row">
				<h4>Food</h4>

					<input id="input-id" type="number" class="rating" data-size="xs" data-showClear="false" data-showCaption="false"/>
				

					<div class="form-group-xs">
						 <label for="input-name">Name</label>
						 <input type="email" class="form-control" id="input-email" autofocus/>
					</div>
				</div>
			</div>
				
				<div class="col-md-8 column">
				sadasdsad
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