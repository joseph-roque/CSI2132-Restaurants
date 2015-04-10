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
			if (isset($_GET['cui'])) {
				$cui = $_GET['cui'];
			} else {
				$cui = '';
			}
			
			$gQuery = $query;
			$exQuery = explode(" ",$query);
			$aQuery = "
			SELECT loc.location_id, AVG((coalesce(rate.food,0)+coalesce(rate.price,0)+coalesce(rate.mood,0)+coalesce(rate.staff,0))/4.0) rateAvg
				FROM Location loc
				LEFT JOIN Restaurant rest
					ON loc.restaurant_id=rest.restaurant_id
				LEFT JOIN CuisineType ct
					ON ct.cuisine_id=rest.cuisine
				LEFT JOIN MenuItem item
					ON rest.restaurant_id=item.restaurant_id
				LEFT JOIN Rating rate
					ON loc.location_id=rate.location_id
				WHERE ";
			if (strlen($cui) > 0) {
				$aQuery.="ct.description='$cui' AND";
			}
			$aQuery.=" (ct.description ~* '%*$query%*'
					OR rest.name ~* '%*$query%*'
					OR item.name ~* '%*$query%*'
					OR rest.url ~* '%*$query%*'";
			foreach($exQuery as $queryTerm) {
				$aQuery.=" OR ct.description ~* '%*$queryTerm%*'";
				$aQuery.=" OR rest.name ~* '%*$queryTerm%*'";
				$aQuery.=" OR item.name ~* '%*$queryTerm%*'";
				$aQuery.=" OR rest.url ~* '%*$queryTerm%*'";
			}
			$aQuery.=") 
			GROUP BY loc.location_id
			ORDER BY rateAvg DESC
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
				$q1 = pg_query(
					"SELECT * FROM Restaurant R 
					INNER JOIN Location L 
						ON L.restaurant_id=R.restaurant_id 
					WHERE L.location_id = $location_id");
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
						<a href = 'results.php?query=$cuisine&cui=$cuisine'>$cuisine</a><br>
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