<!DOCTYPE html> <?php      session_start();     $name = "";     $userid = "";
if(array_key_exists('name', $_SESSION) && array_key_exists('userid',$_SESSION)){
         $name = $_SESSION['name'];         $userid =
		 $_SESSION['userid']; 
	     }
		
?>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Sizzl | Contact</title>
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
			<?php include("includes/header.php");?>
			<?php include("includes/navbar.php");?>
			
			<h2 class="text-center text-info">
					Contact us, we promise not to bite
			</h2>
			
			<div class="register-form">
				<div class="row clearfix">
					<div class="col-md-12 column">
						<form role="form">
							<div class="row">
							<!-- Name -->
								<div class="form-group-xs">
									 <label for="input-name">Name</label>
									 <input type="email" class="form-control" id="input-email" autofocus/>
								</div>
							</div>
							<div class="row">
							<!-- Email -->
								<div class="form-group-xs">
									 <label for="input-email">Email address</label>
									 <input type="email" class="form-control" id="input-email" required/>
								</div>
							</div>
							<!-- Comments -->
							<div class="row">
								<div class="form-group-xs">
									 <label for="input-comments">Comments? Suggestions?</label>
									 <textarea style="width:100%" name="comments" rows="10"  placeholder="We're listening...!" required></textarea>
								</div>
							</div>
							<!-- Submit button -->
							<div class="text-center">
								<button type="submit" class="btn btn-primary"><strong>Submit</strong></button>
							</div>
						</form>
					</div>
				</div>
			</div>
			
	</div>
</div>

</body>
</html>