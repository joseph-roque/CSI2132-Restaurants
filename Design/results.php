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
			<?php
			require('connect.php');

			$query = $_GET['query'];
			$gQuery = $query;
			$aQuery = "
			SELECT loc.location_id
			FROM Location loc
			INNER JOIN Restaurant rest
				ON loc.restaurant_id=rest.restaurant_id
			INNER JOIN CuisineType ct
				ON ct.cuisine_id=rest.cuisine
			INNER JOIN MenuItem item
				ON rest.restaurant_id=item.restaurant_id
			WHERE ct.description ~* '%*$query%*' --Replace QUERY with actual search terms
				OR rest.name ~* '%*$query%*' --Replace QUERY with actual search terms
				OR item.name ~* '%*$query%*' --Replace QUERY with actual search terms
				OR rest.url ~* '%*$query%*' --Replace QUERY with actual search terms
			GROUP BY loc.location_id
			";
			$result = pg_query($aQuery);
			$count = pg_num_rows($result);
			

			echo "	
				<h2 class='text-center text-info' style='margin-bottom:20px'>
					<strong>$count</strong> restaurants for \"$gQuery\" 
				</h2>
				";
			while($res = pg_fetch_assoc($result)){
				$location_id = $res['location_id'];
				$q1 = pg_query("SELECT * FROM Restaurant R, Location L WHERE L.location_id = $location_id
					AND L.restaurant_id = R.restaurant_id");
				$tmp = pg_fetch_assoc($q1);
				$name = $tmp['name'];
				$url = $tmp['url'];
				$address = $tmp['street_address'];
				$open = $tmp['hour_open'];
				$open = substr_replace($open, ":", strlen($open)-2, 0);
				$close = $tmp['hour_close'];
				$close = substr_replace($close, ":", strlen($close)-2, 0);
				$cuisine = $tmp['cuisine'];

				$q1 = pg_query("SELECT description FROM CuisineType WHERE cuisine_id = $cuisine");
				$q1 = pg_fetch_assoc($q1);

				$cuisine = $q1['description'];

				echo "
					<!-- Results for all restaurants matching query -->
					<div class='well well-sm' style='line-height:1.75; font-size:16px'>
						<strong><a href='restaurant.php?id=$location_id'>$name</a></strong><br>
						<a href = 'results.php?query=$cuisine'>$cuisine</a><br>
						$address <br>
						$open - $close
					</div>";
			}
				?>	
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