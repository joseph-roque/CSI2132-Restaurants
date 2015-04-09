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
	<?php $page_title = "Profile" ?>

	<?php include("includes/resources.php");?>
</head>

<body>
<div class="container">
	<div class="row clearfix">
		<div class="col-md-12 column">
			<?php include("includes/header.php");?>
			<?php include("includes/navbar.php");?>
		
			<h2 class="text-center text-info">
					Viewing [profile name]'s Profile
			</h2>
			
			<!-- INFO -->
			<dl class="dl" style="font-size:20px">
				<dt>Username</dt> <dd>[username]</dd>
				<dt>Email</dt> <dd>[email]</dd>
				<dt>Join Date</dt> <dd>[join_date]</dd>
				<dt>Type of User</dt> <dd>[type]</dd>
				
			</dl>
		</div>
	</div>
	
	Copy over the shit from restaurant page into 2 columns for each thing they wrote
</div>

</body>
</html>