<!DOCTYPE html> <?php      session_start();     $name = "";     $userid = "";
if(array_key_exists('name', $_SESSION) && array_key_exists('userid',$_SESSION)){
         $name = $_SESSION['name'];         $userid =
		 $_SESSION['userid']; 
	     }
		
?>
<html lang="en">
<head>
	<?php $page_title = "Results" ?>
	
	<?php include("includes/resources.php");?>
</head>

<body>
<div class="container">
	<div class="row clearfix">
		<?php include("includes/header.php");?>
		<?php include("includes/navbar.php");?>
		<div class="col-md-12 column">
				<h2 class="text-center text-info" style="margin-bottom:20px">
					[count] restaurants for "[given query]"
				</h2>
				NOTE: SHOW THE QUERY IN THE SEARCH BAR!!!
				<!-- Results for all restaurants matching query -->
				<div class="well well-sm" style="line-height:1.75; font-size:16px">
					<strong>[Restaurant Name w/ link]</strong> ([avg. rating]/5 with [count] reviews) <br>
					[cuisine w/ link] <br>
					[address] <br>
					[hours open] - [hours close]
				</div>			
				<!-- ADD RESTAURANT bottom right -->
			<div class="pull-right">
				<strong>Can't find the restaurant you're looking for?
				<a href="add-restaurant.php">
				<button  name = "add-item" method  = "post"  type="add-item" class="btn btn-primary" style="margin-left:10px">
					<span class="glyphicon glyphicon-plus" style="margin-right:10px"></span>Add a Restaurant</strong>
				</button></a>
			</div>
		</div>
	</div>
</div>

</body>
</html>