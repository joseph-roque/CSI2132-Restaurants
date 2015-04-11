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
			document.location.href="popular.php?query=c&extrao=" + cName;
		}

		function changeCuisine_query_e() {
			var cName = document.getElementById('cuisineDrop').value;
			document.location.href="popular.php?query=e&extrao=" + cName;
		}

		function changeDate() {
			var month = document.getElementById('monthDrop').value;
			var year = document.getElementById('yearDrop').value;
			document.location.href="popular.php?query=g&extrao=" + month + "&extrat=" + year;
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
			$queryName = "c";
			if (isset($_GET['query'])) {
				$queryName = $_GET['query'];
			}

			$query = file_get_contents("sql/query_".$queryName.".sql");
						
			switch($queryName) {
				case "c": default:
					$extraOne = 'Breakfast';
					if (isset($_GET['extrao'])) {
						$extraOne = $_GET['extrao'];
					}

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
				case "d":
					echo "<h2>Not finished</h2>";
					//See restaurant page - order by "price"
					break;
				case "e":
					$extraOne = 'Breakfast';
					if (isset($_GET['extrao'])) {
						$extraOne = $_GET['extrao'];
					}

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
				case "f":
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
				case "g":
					$extraOne = strval(date("m"));
					if (isset($_GET['extrao'])) {
						$extraOne = $_GET['extrao'];
					}
					$extraTwo = strval(date("Y"));
					if (isset($_GET['extrat'])) {
						$extraTwo = $_GET['extrat'];
					}

					switch($extraOne) {
						case 1: $monthName = "January"; break;
						case 2: $monthName = "Febraury"; break;
						case 3: $monthName = "March"; break;
						case 4: $monthName = "April"; break;
						case 5: $monthName = "May"; break;
						case 6: $monthName = "June"; break;
						case 7: $monthName = "July"; break;
						case 8: $monthName = "August"; break;
						case 9: $monthName = "September"; break;
						case 10: $monthName = "October"; break;
						case 11: $monthName = "November"; break;
						case 12: $monthName = "December"; break;
					}
					echo "
						<h2 class='text-center text-info' style='margin-bottom:20px'>
							Restaurants not rated in <strong>$monthName $extraTwo</strong>
						</h2>
						";

					echo "<select class='center-block' id='monthDrop' name='monthDrop' onchange='changeDate()'>";
					$month = 1;
					while($month <= 12) {
						switch($month) {
							case 1: $monthName = "January"; break;
							case 2: $monthName = "Febraury"; break;
							case 3: $monthName = "March"; break;
							case 4: $monthName = "April"; break;
							case 5: $monthName = "May"; break;
							case 6: $monthName = "June"; break;
							case 7: $monthName = "July"; break;
							case 8: $monthName = "August"; break;
							case 9: $monthName = "September"; break;
							case 10: $monthName = "October"; break;
							case 11: $monthName = "November"; break;
							case 12: $monthName = "December"; break;
						}

						echo "<option value='$month'";
						if (strcmp($extraOne, strval($month)) == 0) {
							echo " selected";
						}
						echo ">$monthName</option>";
						$month += 1;
					}
					echo "</select>";

					echo "<select class='center-block' id='yearDrop' name='yearDrop' onchange='changeDate()'>";
					$year = date("Y");
					while($year >= 1900) {
						echo "<option value='$year'";
						if (strcmp($extraTwo, strval($year)) == 0) {
							echo " selected";
						}
						echo ">$year</option>";
						$year -= 1;
					}
					echo "</select><br>";

					$query = str_replace("MONTH", strval($month), $query);
					$query = str_replace("YEAR", strval($year), $query);
					$result = pg_query($query);
					while($res = pg_fetch_array($result)) {
						$restName = $res[0];
						$cuisine = $res[1];
						$number = $res[2];
						$numbers_only = preg_replace("/[^\d]/", "", $number);
						$number = preg_replace("/^1?(\d{3})(\d{3})(\d{4})$/", "$1-$2-$3", $numbers_only);
						$address = $res[3];
						$open = $res[4];
						$open = substr_replace($open, ":", strlen($open)-2, 0);
						$close = $res[5];
						$close = substr_replace($close, ":", strlen($close)-2, 0);
						$id = $res[6];

						echo "
						<div class='well well-sm' style='line-height:1.75; font-size:16px'>
							<strong><a href='restaurant.php?id=$id'>$restName</a></strong><br>
							<a href = 'results.php?query=$cuisine&cui=$cuisine'>$cuisine</a><br>
							$number <br>
							$address <br>
							$open - $close
						</div>
						";
					}
					break;
				case "h":
					//TODO
					break;
				case "i":
					echo "	
						<h2 class='text-center text-info' style='margin-bottom:20px'>
							Top rated restaurants by category
						</h2>
						";

					$result = pg_query($query);
					$lastRestaurant = "";
					$restCount = 0;
					$userCount = 0;
					while($res = pg_fetch_array($result)) {
						$restCount += 1;
						$description = $res[0];
						$locationId = $res[1];
						$restName = $res[2];
						$userId = $res[3];
						$userName = $res[4];
						$avgRate = round($res[5], 1);

						$isNotLast = (strcmp($restName, $lastRestaurant) !== 0);
						$lastRestaurant = $restName;
						if ($isNotLast) {
							$userCount = 0;
							if ($restCount > 1) {
								echo "</div>";
							}
							echo "
								<div class='well well-sm' style='line-height:1.75; font-size:16px'>
									<strong><a href='restaurant.php?id=$locationId'>$restName</a></strong><br>
									<a href = 'results.php?query=$description&cui=$description'>$description</a><br>
									Average Rating: $avgRate <br>
									Raters:
								";
						}
						$userCount += 1;
						if ($userCount > 1) {
							echo ",";
						}
						echo "<a href='profile?id=$userId'> $userName</a>";

					}
					break;
				case "j":
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
				case "k":
					echo "<h2>Not finished</h2>";
					break;
				case "l":
					echo "<h2>Not finished</h2>";
					break;
				case "m":
					echo "<h2>Not finished</h2>";
					break;
				case "n":
					echo "<h2>Not finished</h2>";
					break;
				case "o":
					echo "	
						<h2 class='text-center text-info' style='margin-bottom:20px'>
							Raters with the most diverse ratings
						</h2>
						";
					$result = pg_query($query);
					while ($res = pg_fetch_array($result)) {
						$userName = $res[0];
						$userId = $res[1];
						$userDescription = $res[2];
						$userEmail = $res[3];
						$locationId = $res[4];
						$restName = $res[5];
						$highRate = round($res[6], 2);
						$lowRate = round($res[7], 2);
						echo "
							<div class='well well-sm' style='line-height:1.75; font-size:16px'>
								<strong><a href='restaurant.php?id=$locationId'>$restName</a></strong><br>
								<a href='results.php?query=$description&cui=$description'>$description</a><br>
								Rater:<a href='profile.php?id=$userId'>$userName</a><br>
								Low rating: $lowRate <br>
								High rating: $highRate
							</div>
							";
					}
					break;
			} 
		?>
	</div>
</div>

</body>
</html>