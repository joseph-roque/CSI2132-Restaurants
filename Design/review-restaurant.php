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
			<?php
				require('connect.php');
				$id = $_GET['id'];
				$query = "
				SELECT R.name FROM Restaurant R, Location L
				WHERE L.restaurant_id = R.restaurant_id AND L.location_id = $id;
				";
				$result = pg_query($query);
				$row = pg_fetch_assoc($result);
				$rName = $row['name'];
				echo "Writing a review for <strong>$rName</strong>";
			?>
			</h2>
		</div>
	</div>
	<form id="formID" name="formID" method="post" action="" role="form">
		<div class="row clearfix">
			<div class="col-md-3 column">
				<!-- STAR Ratings (1-5) -->
				<!-- See http://plugins.krajee.com/star-rating/demo for more info -->
				<h4>Food</h4>
				<input id="food" name = "food" method = "post" type="number" class="rating" data-min="0" data-max="5" data-step="1" data-size="md" data-show-clear="false" data-show-caption="false" required/>
				<h4>Price</h4>
				<input id="price" name = "price" method = "post" type="number" class="rating" data-min="0" data-max="5" data-step="1" data-size="md" data-show-clear="false" data-show-caption="false" required/>
				<h4>Mood</h4>
				<input id="mood" name = "mood" method = "post" type="number" class="rating" data-min="0" data-max="5" data-step="1" data-size="md" data-show-clear="false" data-show-caption="false" required/>
				<h4>Staff</h4>
				<input id="staff" name = "staff" method = "post" type="number" class="rating" data-min="0" data-max="5" data-step="1" data-size="md" data-show-clear="false" data-show-caption="false" required/>
			</div>


					
			<div class="col-md-9 column">
				<label for="input-comments">Leave your review below</label>
				<textarea style="width:100%" method = "post" name="comments" id = "comments" rows="16"  placeholder="Review must be 50 characters minimum!" required></textarea>
				<div class="pull-right" style="margin-top:15px">
					<button type="submit" name = "submit" action = "post" class="btn btn-primary"><strong>Submit Review</strong></button>
				</div>
			</div>
		</form>

		<?php
		if($userid && $name){
			$userid = $_SESSION['userid'];
			$id = $_GET['id'];
			if(array_key_exists('food', $_POST) && array_key_exists('price', $_POST) && array_key_exists('mood', $_POST)
				&& array_key_exists('staff', $_POST) && array_key_exists('comments', $_POST)){
				require('connect.php');

				$food = $_POST['food'];
				$price = $_POST['price'];
				$mood = $_POST['mood'];
				$staff = $_POST['staff'];
				$comments = $_POST['comments'];
				$query = "
					SELECT restaurant_id FROM Location L WHERE L.location_id = $id;
				";
				$result = pg_query($query);
				$row = pg_fetch_assoc($result);

				$restaurant_id = $row['restaurant_id'];

				//Current date in YYYY-MM-DD format
				$currentDate = date('m-d-Y H:i:s', time());

				$query = "
					INSERT INTO Rating(user_id, post_date, price, food, mood, staff, comments, restaurant_id)
					VALUES($userid, '$currentDate', $price, $food, $mood, $staff, '$comments', $restaurant_id);
				";

				$result = pg_query($query);

				$row = pg_fetch_assoc($result);
				$name = $row['name'];

			}
		}
		?>

		
	</div>

					<div class="alert alert-dismissable alert-success">
				 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h4>
					Alert!
				</h4> <strong>Warning!</strong> Best check yo self, you're not looking too good. <a href="#" class="alert-link">alert link</a>
			</div>


</div>

</body>
</html>