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
	<link href="css/style.css" rel="stylesheet">
	<link href="css/bootstrap.css" rel="stylesheet">

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
					[Restaurant Name]
			</strong></h2>
			<h3 class="text-info" style="margin-top:-5px; margin-bottom:20px">
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
			
			<button type="write-review" class="btn btn-primary">
				<strong><span class="glyphicon glyphicon-pencil" style="margin-right:10px"></span>Write a Review</strong>
			</button>

			
		</div>
		<!-- Maps interface & avg. rating -->
		<div class="col-md-7 column text-center" style="padding-top: 10px">
			<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d2800.3172389220795!2d-75.683133!3d45.423106!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4cce050a6db98d73%3A0x188a59c3622fdbae!2sUniversity+of+Ottawa!5e0!3m2!1sen!2sca!4v1428243192262" width="400" height="250" frameborder="0" style="border:0"></iframe>
			<br>
			<div class="rating">
				<h2 class="text-info" style="margin-bottom: -10px">
					Average Rating
				</h2>
				<strong><p style="font-size:48px">[avg. of ratings]</font></strong>
			</div>
		</div>
	</div>
	<div class="row clearfix">
		<!-- Menu Table -->
		<div class="col-md-5 column">
		<h2 class="text-info" style="margin-bottom:-5px">
		Menu
		</h2>
			<table class="table table-hover" style="margin-top:20px"> <!-- match margin of H2 next to it -->
				<!-- Header -->
				<thead>
					<tr>
						<th>Item</th>
						<th>Type</th>
						<th>Rating</th>
					</tr>
				</thead>
				<!-- All menu items -->
				<tbody>
					<tr>
						<td>California Roll</td>
						<td>Entree</td>
						<td>4/5</td>
					</tr>
					<tr>
						<td>[name]</td>
						<td>[type_id -> description]</td>
						<td>[avg. of ratings for MenuItem]</td>
					</tr>
				</tbody>
			</table>
		</div>
		<!-- Reviews -->
		<div class="col-md-7 column">
			<!-- START OF REVIEW -->
			<h2 class="text-info">
				Reviews
			</h2>
			<h3>
				[Title]
			</h3>
			<h4>
				by <a href="#">[Author]</a>
			</h4>
			<strong>Price: </strong>[price] | <strong>Food: </strong> [food] | <strong>Mood: </strong> [mood] | <strong>Staff: </strong> [staff]
			<p>
				[Comments of Review goes here]
			</p>
			<p>
				<a class="btn" href="#">Read review »</a>
			</p>
			
			<hr> 
			<!-- END OF REVIEW -->
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