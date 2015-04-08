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
	<title>Sizzl | Restaurant</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">

	<!--link rel="stylesheet/less" href="less/bootstrap.less" type="text/css" /-->
	<!--link rel="stylesheet/less" href="less/responsive.less" type="text/css" /-->
	<!--append '#!watch' to the browser URL, then refresh the page. -->
	
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
				<?php
					require('connect.php');
					$id = $_GET['id'];
					
					$result = pg_query("
						SELECT * 
						FROM project.restaurant R, project.location L
						WHERE L.location_id = $id AND L.restaurant_id = R.restaurant_id; 
					");
					
					$row = pg_fetch_assoc($result);
					
					echo $row['name'];
				?>
			</strong></h2>
			<?php
					require('connect.php');
					$id = $_GET['id'];
					
					$result = pg_query("
						SELECT * FROM project.location WHERE location_id = $id;
					");
					
					$row = pg_fetch_assoc($result);
			?>
			<h3 class="text-info" style="margin-top:-5px; margin-bottom:20px">
				<?php
					echo $row['phone_number'];
				?>
			</h3>
			<p>
			<?php 
				$open = $row['hour_open'];
				$close = $row['hour_close'];
				$first = $row['first_open_date'];
				$manager = $row['manager_name'];
				
				$result = pg_query("
					SELECT * 
					FROM project.cuisinetype C, project.restaurant R, project.location L
					WHERE L.location_id = $id AND L.restaurant_id = R.restaurant_id AND R.cuisine = C.cuisine_id; 
				");
				
				$row = pg_fetch_assoc($result);
				
				$cuisine = $row['description'];
				
				
			echo"<strong>
				Hours Open: $open - $close
				</strong>
				<br>
				<a href = 'http://localhost/Github/CSI2132-Restaurants/Design/restaurant.php?id=2'>$cuisine</a>
				<br>
				Established: $first
				<br>
				Currently managed by: <i>$manager</i>
				";
			?>
			</p>
			
			<form action="review-restaurant.php">
			<button type="write-review" class="btn btn-primary">
				<strong><span class="glyphicon glyphicon-pencil" style="margin-right:10px"></span>Write a Review</strong>
			</button>
			</form>

			
		</div>
		<!-- Maps interface & avg. rating -->
		<div class="col-md-7 column text-center" style="padding-top: 10px">
		<?php
								$result = pg_query("
						SELECT * FROM project.location WHERE location_id = $id;
					");
					
					$row = pg_fetch_assoc($result);
		
			
		
			$gmapLink = "http://maps.google.com/?q=".$row['street_address'];
			
			echo "
			<iframe src='https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d2800.3172389220795!2d-75.683133!3d45.423106!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4cce050a6db98d73%3A0x188a59c3622fdbae!2sUniversity+of+Ottawa!5e0!3m2!1sen!2sca!4v1428243192262' width='400' height='250' frameborder='0' style=border:0'></iframe>				
			";
		?>
			<!-- CANT FIX THIS HELP ME !-->
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
			<?php
				require('connect.php');
				$result = pg_query("
					SELECT *
					FROM project.RatingItem RI, project.MenuItem M, project.Location L, project.Restaurant R, project.Rater RA
					WHERE RI.item_id = M.item_id AND M.restaurant_id = L.restaurant_id AND L.restaurant_id = R.restaurant_id
					AND L.location_id = 1 AND RI.user_id = RA.user_id
				");
				
				while($row = pg_fetch_assoc($result)){
					
				}
				
			?>
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
			<p class="demo">
				<script>
				function shorten() {
				var str= "
					[Comments of Review goes here] This is a test to see how I can shorten the things by a thing a ma jigger.
					Bacon ipsum dolor amet ribeye turducken pastrami tenderloin strip steak. Bresaola salami ham corned beef, rump pork belly kevin shankle sausage kielbasa beef brisket jerky shank turkey. Tri-tip fatback ball tip tenderloin leberkas sirloin rump landjaeger. Pork chop ham hock leberkas prosciutto. Pork loin kielbasa pork belly t-bone, porchetta beef short ribs sausage turkey prosciutto jerky landjaeger ball tip ribeye venison.

					Flank ham hock shankle pancetta hamburger salami ball tip sausage landjaeger. Short loin pork loin drumstick, capicola venison strip steak chicken meatloaf swine chuck picanha turkey spare ribs pig. Turducken salami shoulder, tri-tip jowl drumstick ball tip doner corned beef. Corned beef fatback bresaola, ham hock pork cow shankle strip steak short loin picanha chuck pork chop jowl cupim. T-bone landjaeger tri-tip porchetta chuck shoulder venison cow ham hock bresaola bacon. Turkey pork belly tail hamburger short ribs spare ribs jowl.
					";
					var res = str.substring(1, 50);
					document.getElementById("demo").innerHTML = res;

				}
			</p>
			<p>
				<a class="btn" href="#">Read review</a>
			</p>
			
			<hr> 
			<!-- END OF REVIEW -->
		</div>
	</div>
</div>

</body>
</html>