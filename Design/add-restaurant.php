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
	<?php $page_title = "Add Restaurant" ?>

	<?php include("includes/resources.php");?>
</head>

<body>
<div class="container">
	<div class="row clearfix">
		<?php include("includes/header.php");?>
		<?php include("includes/navbar.php");?>
			<h2 class="text-center text-info">
					Add a new restaurant to Sizzl
			</h2>
			
			<div class="col-md-12 column">
				<form id="formID" name="formID" method="post" action="" role="form">
					<!-- Restaurant Name -->
					<div class="row">
						<div class="form-group-xs">
							<label for="input-name">Restaurant Name</label>
							<input name ="input-name" type="name" class="form-control" id="input-name" required autofocus/>
						</div>
					</div>
					<!-- Cuisine Type -->
					<div class="row">
						<div class="form-group-xs">
							<label for="input-email">Type of Cuisine</label>
							<select name = "input-type" id = "input-type" method= "post" class="form-control">
							<!-- FETCH ALL POSSIBLE CUISINE TYPES IN HERE -->
								<option>Casual</option>
								<option>Blogger</option>
								<option>Verified Critic</option>
								<option>Other</option>
							</select>
						</div>
					</div>
					<!-- URL -->
					<div class="row">
						<div class="form-group-xs">
							 <label for="input-url">Website URL</label>
							 <input name ="input-url" type="password" class="form-control" id="input-url"/>
						</div>
					</div>
					<!-- Open Date -->
					<div class="row">
						<div class="form-group-xs">
							 <label for="input-open-date">Opening Date (YYYY-MM-DD)</label>
							 <input name ="input-open-date" type="password" class="form-control" id="input-open-date" required/>
						</div>
					</div>
					<!-- Manager Name -->
					<div class="row">
						<div class="form-group-xs">
							 <label for="input-mng-name">Manager Name</label>
							 <input name ="input-mng-name" type="password" class="form-control" id="input-mng-name"/>
						</div>
					</div>
					<!-- Phone Number -->
					<div class="row">
						<div class="form-group-xs">
							 <label for="input-phone">Phone Number (e.g. 16135550123)</label>
							 <input name ="input-phone" type="password" class="form-control" id="input-phone"/>
						</div>
					</div>
					<!-- Street Address -->
					<div class="row">
						<div class="form-group-xs">
							 <label for="input-address">Street Address</label>
							 <input name ="input-address" type="password" class="form-control" id="input-address"/>
						</div>
					</div>
					<!-- Hours Open -->
					<div class="row">
						<div class="form-group-xs">
							 <label for="input-hours-open">Opening Hour (e.g. 0600)</label>
							 <input name ="input-hours-open" type="password" class="form-control" id="input-hours-open"/>
						</div>
					</div>
					<!-- Hours Closed -->
					<div class="row">
						<div class="form-group-xs">
							 <label for="input-hours-closed">Closing Hour (e.g. 2100)</label>
							 <input name ="input-hours-closed" type="password" class="form-control" id="input-hours-closed"/>
						</div>
					</div>
					<div class="row">
						<div class="form-group-xs">
							<label id = "input-type" name = "input-type" method="post" for="form-control">Type of Rater</label>
							<select name = "input-type" id = "input-type" method= "post" class="form-control">
								<option>Casual</option>
								<option>Blogger</option>
								<option>Verified Critic</option>
								<option>Other</option>
							</select>
						</div>
					</div>
					<div class="text-center">
						<button name="register" id="register" type="submit" class="btn btn-primary"><strong>Register!</strong></button>
					</div>
				</form>
			</div>
	</div>
</div>

</body>
</html>