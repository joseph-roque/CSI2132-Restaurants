<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Sizzl | About</title>
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
		<!-- Logo & subtitle text -->
		<div class="col-md-12 column">
				<img class="img-responsive center-block" src="logo.png" style="width:20%; padding-bottom:5px" />
		</div>
		
		<div class="col-md-12 column">
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
						<li><a href="about.php"><b>About</b></a></li>
						<li><a href="contact.php">Contact</a></li>
					</ul>
					<!-- Right -->
					<ul class="nav navbar-nav navbar-right">
						<li><a href="login.php">Login</a></li>
						<li><a href="register.php">Register</a></li>
					</ul>
				</div>	
			</nav>
			
			<h2 class="text-center text-info">
					About the team
			</h2>
			
			<div class="the-team">
				
				<!-- James -->
				<div class="col-md-4">
					<div class="thumbnail" style="height:500px">
					<a href="https://github.com/jreinlein">
					<div class="cropped-img" style="background-image:url('james.png'); min-height:300px" /> </div>

					<div class="caption">
						<h2>
							James Reinlein</a>
						</h2>
						<p>
							Specialized in dank memes and surfing (the internet, not waves), James likes to waste a lot of his time on Reddit or raging at teammates in online MOBAs.
						</p>
					</div>
				</div>
			</div>
				<!-- Joseph -->
				<div class="col-md-4">
					<div class="thumbnail" style="height:500px">
					<a href="https://github.com/joseph-roque">
					<div class="cropped-img" style="background-image:url('joseph.png'); min-height:300px" /> </div>

					<div class="caption">
						<h2>
							Joseph Roque</a>
						</h2>
						<p>
							In his free time, Joseph likes to bowl (5-pins only, none of that 10-pin garbage) and recite an unreasonable amount of digits of pi.
						</p>
					</div>
				</div>
				</div>
				<!-- Mohammed -->
				<div class="col-md-4">
					<div class="thumbnail" style="height:500px">
					<a href="https://github.com/mshanti">
					<div class="cropped-img" style="background-image:url('mohammed.png'); min-height:300px"/> </div>
						
					<div class="caption">
						<h2>
							Mohammed Shanti</a>
						</h2>
						<p>
							Also known as <i>Habibi</i>, Moe spends his leisure time brushing up on his knowledge of the Qur'an and refraining from unlawful drugs.
							His mother is quite proud.
						</p>

					</div>
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