<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Sizzl | Register</title>
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
						<li><a href="index.html">Home</a></li>
						<li><a href="#">About</a></li>
						<li><a href="#about">Contact</a></li>
					</ul>
					<!-- Right -->
					<ul class="nav navbar-nav navbar-right">
						<li><a href="#about">Login</a></li>
						<li><a href="register.html"><b>Register</b></a></li>
					</ul>
				</div>	
			</nav>
			
			<h2 class="text-center text-info">
					Register now with Sizzl!
				</h2>
			
			<div class="register-form">
				<div class="row clearfix">
					<div class="col-md-12 column">
						<form role="form">
							<div class="row">
								<div class="form-group-sm">
									 <label for="input-email">Email address</label>
									 <input type="email" class="form-control" id="input-email" />
								</div>
							</div>
							<div class="row">
								<div class="form-group-sm">
									 <label for="input-pw">Password</label>
									 <input type="password" class="form-control" id="input-pw" />
								</div>
							</div>
							<div class="row">
								<div class="form-group-sm">
									 <label for="input-pw-confirm">Confirm Password</label>
									 <input type="password" class="form-control" id="input-pw-confirm" />
								</div>
							</div>
							<!-- DISABLED UNLESS YOU KNOW HOW TO DO THIS
							<div class="checkbox">
								 <label><input type="checkbox" /> Remember Me</label>
							</div> -->
							<div class="text-center">
								<button type="submit" class="btn-lg btn-primary">Register!</button>
							</div>
						</form>
					</div>
				</div>
			</div>
			
			<!-- Bottom Logo -->
			<nav class="navbar-fixed-bottom">
					<img style="max-width:50px"
						 src="logo-fire.png">
			</nav>
	</div>
</div>

	

</body>
</html>