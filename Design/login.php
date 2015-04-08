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
	<title>Sizzl | Login</title>
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
						<li><a href="about.php">About</a></li>
						<li><a href="contact.php">Contact</a></li>
					</ul>
					<!-- Right -->
					<ul class="nav navbar-nav navbar-right">
						<li><a href="login.php"><b>Login</b></a></li>
						<li><a href="register.php">Register</a></li>
					</ul>
				</div>	
			</nav>
			
			<h2 class="text-center text-info">
					Log into your Sizzl account
			</h2>
			
			<div class="register-form">
				<div class="row clearfix">
					<div class="col-md-12 column">
						<form id="formID" name="formID" method="post" action="" role="form">
							<div class="row">
								<div class="form-group-xs">
									 <label for="input-email">Email address</label>
									 <input name ="input-email" type="email" class="form-control" id="input-email" required autofocus/>
								</div>
							</div>
							<div class="row">
								<div class="form-group-xs">
									 <label for="input-pw">Password</label>
									 <input name ="input-pw" type="password" class="form-control" id="input-pw" required/>
								</div>
							</div>
							<!-- DISABLED UNLESS YOU KNOW HOW TO DO THIS
							<div class="checkbox">
								 <label><input type="checkbox" /> Remember Me</label>
							</div> -->
							<div class="text-center">
								<button type="submit" class="btn btn-primary"><strong>Login!</strong></button>
							</div>
						</form>
						
						<?php
							if (array_key_exists('input-email', $_POST) && array_key_exists('input-pw', $_POST)){
								
								$getEmail = $_POST['input-email'];
								$getPass = $_POST['input-pw'];
								
								require('connect.php');
								
								$result = pg_query("SELECT * FROM project.Rater WHERE Rater.email = '$getEmail';") or die('Query failed: ' . pg_last_error());
								
								$numRows = pg_num_rows($result);
								
								if($numRows != 0){
									$res = pg_query("SELECT * FROM project.Rater WHERE Rater.email = '$getEmail';") or die('Query failed: ' . pg_last_error());
									$row = pg_fetch_assoc($res);
									
									$dbPass = $row['password'];
									$dbName = $row['name'];
									$dbUserid = $row['user_id'];
									
									if($dbPass == $getPass){
										echo "<p align='center'>You have been logged in as <b> $dbName</b>. <a href= './index.php'> Continue </a></p>";
										$_SESSION['name'] = $dbName;
										$_SESSION['userid'] = $dbUserid;
									}
									else{
										echo "<p class = 'error'>The password for that email does not match. Please try again</p>";
									}
								}
								else{
									echo "<p class 'error'>The email you have entered is not in our system</p>";
								}
								
							}
						?>
						
					</div>
				</div>
			</div>
			
	</div>
</div>

</body>
</html>