<!DOCTYPE html> <?php      session_start();     $name = "";     $userid = "";
if(array_key_exists('name', $_SESSION) && array_key_exists('userid',$_SESSION)){
         $name = $_SESSION['name'];         $userid =
		 $_SESSION['userid']; 
	     }
		
?>
<html lang="en">
<head>
	<?php $page_title = "Popular Queries" ?>
	
	<?php include("includes/resources.php");?>

	<script type="text/javascript">
		function changeCuisine_query_c() {
			var cName = document.getElementById('cuisineDrop').value;
			document.location.href="popular.php?query=query_c&extrao=" + cName;
		}

		function changeCuisine_query_e() {
			var cName = document.getElementById('cuisineDrop').value;
			document.location.href="popular.php?query=query_e&extrao=" + cName;
		}
	</script>
</head>

<body>
<div class="container">
	<div class="row clearfix">
		<?php include("includes/header.php");?>
		<?php include("includes/navbar.php");?>
		
		<?php
			require('connect.php');
			$queryName = $_GET['query'];

			$query = file_get_contents("sql/".$queryName.".sql");
			$extraOne = '';
			if (isset($_GET['extrao'])) {
				$extraOne = $_GET['extrao'];
			}
			$extraTwo = '';
			if (isset($_GET['extrat'])) {
				$extraTwo = $_GET['extrat'];
			}
			
			switch($queryName) {
				case "query_c":
					//FINISHED
					echo "	
						<h2 class='text-center text-info' style='margin-bottom:20px'>
							Managers &amp; opening dates for <strong>$extraOne</strong> restaurants
						</h2>
						";
					$result = pg_query("SELECT ct.description FROM CuisineType ct ORDER BY ct.description");
					echo "<select id='cuisineDrop' name='cuisineDrop' onchange='changeCuisine_query_c()' class='center-block'>";
					while($res = pg_fetch_array($result)) {
						$description = $res[0];
						echo "<option value='$description'";
						if (strcmp($extraOne, $description) == 0) {
							echo " selected";
						}
						echo ">$description</option>";
					}
					echo "</select><br>";

					$query = str_replace("CUISINE_DESCRIPTION", $extraOne, $query);
					$result = pg_query($query);
					
					while ($res = pg_fetch_array($result)) {
						$id = $res[0];
						$restName = $res[1];
						$address = $res[2];
						$manager = $res[3];
						$openDate = substr($res[4], 0, -8);

						echo "
						<div class='well well-sm' style='line-height:1.75; font-size:16px'>
							<strong><a href='restaurant.php?id=$id'>$restName</a></strong><br>
							$address<br>
							Managed by: $manager<br>
							First Opened: $openDate
						</div>
						";
					}
					break;
				case "query_d":
					//See restaurant page - order by "price"
					break;
				case "query_e":
					//FINISHED
					echo "	
						<h2 class='text-center text-info' style='margin-bottom:20px'>
							Average <strong>$extraOne</strong> restaurant menu prices
						</h2>
						";
					$result = pg_query("SELECT ct.description FROM CuisineType ct ORDER BY ct.description");
					echo "<select id='cuisineDrop' name='cuisineDrop' onchange='changeCuisine_query_e()' class='center-block'>";
					while($res = pg_fetch_array($result)) {
						$description = $res[0];
						echo "<option value='$description'";
						if (strcmp($extraOne, $description) == 0) {
							echo " selected";
						}
						echo ">$description</option>";
					}
					echo "</select><br>";

					$query = str_replace("CUISINE_DESCRIPTION", $extraOne, $query);
					$result = pg_query($query);
					
					while ($res = pg_fetch_array($result)) {
						$itemDesc = $res[0];
						$price = round($res[1], 2);

						echo "
						<div class='well well-sm' style='line-height:1.75; font-size:16px'>
							<strong>$itemDesc: </strong>\$$price<br>
						</div>
						";
					}
					break;
				case "query_f":
					//FINISHED
					echo "	
						<h2 class='text-center text-info' style='margin-bottom:20px'>
							Total number of ratings by each rater, for each restaurant
						</h2>
						";

					$result = pg_query($query);
					while($res = pg_fetch_array($result)) {
						$userId = $res[0];
						$restId = $res[1];
						$userName = $res[2];
						$restName = $res[3];
						$ratingCount = $res[4];
						$avgRating = round($res[5], 1);

						echo "
						<div class='well well-sm' style='line-height:1.75; font-size:16px'>
							<strong><a href='profile?id=$userId'>$userName</a></strong><br>
							<a href='restaurant.php?id=$restId'>$restName</a><br>
							# of ratings: $ratingCount<br>
							Average Rating: $avgRating
						</div>
						";
					}
					break;
				case "query_g":
					break;
				case "query_h":
					break;
				case "query_i":
					break;
				case "query_j":
					//FINISHED
					echo "	
						<h2 class='text-center text-info' style='margin-bottom:20px'>
							Average restaurant ratings by <strong>cuisine</strong> 
						</h2>
						";
					$result = pg_query($query);
					while($res = pg_fetch_array($result)) {
						$cuisine = $res[0];
						$avgRate = round($res[1], 1);
						echo "
						<div class='well well-sm' style='line-height:1.75; font-size:16px'>
							<strong><a href='results.php?query=$cuisine&cui=$cuisine'>$cuisine: </a></strong>$avgRate<br>
						</div>
						";
					}
					break;
				case "query_k":
					break;
				case "query_l":
					break;
				case "query_m":
					break;
				case "query_n":
					break;
				case "query_o":
					break;
			} 
		?>
	</div>
</div>

</body>
</html>