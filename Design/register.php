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
	<title>Sizzl | Register</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">

	<?php include("includes/resources.html");?>
</head>

<body>
<div class="container">
	<div class="row clearfix">
		<?php include("includes/header.php");?>
		<?php include("includes/navbar.php");?>
			<h2 class="text-center text-info">
					Register a new account with Sizzl
			</h2>
			
			<div class="register-form">
				<div class="row clearfix">
					<div class="col-md-12 column">
						<form id="formID" name="formID" method="post" action="" role="form">
							<div class="row">
								<div class="form-group-xs">
									<label for="input-name">Name</label>
									<input name ="input-name" type="name" class="form-control" id="input-name" required autofocus/>
								</div>
							</div>
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
							<div class="row">
								<div class="form-group-xs">
									 <label for="input-pw-confirm">Confirm Password</label>
									 <input name ="input-pw-confirm" type="password" class="form-control" id="input-pw-confirm" required/>
								</div>
							</div>
							<!-- DISABLED UNLESS YOU KNOW HOW TO DO THIS
							<div class="checkbox">
								 <label><input type="checkbox" /> Remember Me</label>
							</div> -->
							<div class="text-center">
								<button name="register" id="register" type="submit" class="btn btn-primary"><strong>Register!</strong></button>
							</div>
						</form>
						<?php
						if (array_key_exists('input-email', $_POST) && array_key_exists('input-pw', $_POST) && array_key_exists('input-name', $_POST) && array_key_exists('input-pw-confirm', $_POST)){
				
							//get form variables
							$getName = $_POST['input-name'];
							$getEmail = $_POST['input-email'];
							$getPass = $_POST['input-pw'];
							$getConf = $_POST['input-pw-confirm'];
							
							require("connect.php");
							
							$query = "SELECT * FROM Rater WHERE Rater.name='$getName'";
							$result = pg_query($query) or die('Query failed: ' . pg_last_error());
							
							$numRows = pg_num_rows($result);
							
							if(strpos($getName,'@')){
								echo "Your name cannot contain the @ symbol";
							}
							else if($numRows == 0){
								
								$query = "SELECT * FROM Rater WHERE Rater.email='$getEmail'";
								$result = pg_query($query) or die('Query failed: ' . pg_last_error());
							
								$numRows = pg_num_rows($result);
								
								if($numRows == 0){
									if($getPass == $getConf){
										//connect to DB
										require("connect.php");
										//Current date in YYYY-MM-DD format
										$currentDate = date('Y-m-d');
										pg_query("INSERT INTO Rater(email, name, join_date, type_id, password)
										VALUES('$getEmail', '$getName', '$currentDate', '1', '$getPass');
										");
										
										echo "<p align='center'>Welcome <b> $getName </b> you are now registered. <a href= './login.php'> Continue </a></p>";
									}
									else{
										echo "<p class='error'>Your password and confirmation do not match.</p>";
									}
								}
								else{
									echo "<p class='error'>That email is already taken please enter another</p>";

								}
							}
							else {
								echo "<p class='error'>That name is already taken please enter another</p>";
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