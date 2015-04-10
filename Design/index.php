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
	<?php $page_title = "Home" ?>
	<?php include("includes/resources.php");?>
</head>

<body background="bg.png">
<div class="container">
	<div class="row clearfix">
		<?php include("includes/header.php");?>
		<?php include("includes/navbar.php");?>
		<div class="col-md-12 column">
			<h3 class="text-center text-muted" style="margin-top:-10px">
				Your one-stop shop for dank-ass restaurant reviews
			</h3>
			<h1 class="text-center text-success">
					Most Popular Restaurants
			</h1>
		
			<!-- Frames for restaurants -->
			<?php
				require('connect.php');
				$res = pg_query("
				SELECT rest.name, loc.location_id, AVG(temp.avgRating) AS avg
				FROM Restaurant rest
				INNER JOIN Location loc
					ON rest.restaurant_id=loc.restaurant_id
				INNER JOIN
					(SELECT loc2.location_id locid2, (rate2.food+rate2.staff+rate2.price+rate2.mood)/4.0 AS avgRating
						FROM Location loc2
						INNER JOIN Rating rate2
							ON loc2.location_id=rate2.location_id) temp
					ON loc.location_id=locid2
				GROUP BY rest.name, loc.location_id
				ORDER BY avg DESC;
				");	
				//Counter for top 3 restaurant;
				$i = 0;
				//Most popular restaurants!
				//Loop to iterate through 3 top restaurants gets the queries and puts them in
				while($i < 3 && $tmp = pg_fetch_assoc($res)){
					$i++;	
					$name = $tmp['name'];
					$locationId = $tmp['location_id'];
					$res1 = pg_query("
					SELECT use.name, rate.food, rate.mood, rate.price, rate.staff, rate.comments
					FROM Rating rate
					INNER JOIN Rater use
						ON rate.user_id=use.user_id
					INNER JOIN Location loc
						ON rate.location_id=loc.location_id
					WHERE loc.location_id = $locationId -- Replace with location_id of specific location
						AND (rate.food+rate.mood+rate.price+rate.staff) >= ALL
							(SELECT rate2.food+rate2.mood+rate2.price+rate2.staff
								FROM Rating rate2
								INNER JOIN Rater use2
									ON rate2.user_id=use2.user_id
								INNER JOIN Location loc2
									ON rate2.location_id=loc2.location_id
								WHERE loc2.location_id = $locationId)
					");
					$res1 = pg_fetch_assoc($res1);
					
					$comment = $res1['comments'];
					$raterName = $res1['name'];
					
				echo "
				<div class='col-md-4'>
					<div class='thumbnail'>
					<a href='restaurant.php?id=$locationId'>";
			?>
			<!-- Pictures -->
				<div class="cropped-img" style="background-image:url('<?php
					$images = array(
					"http://www.thepaninipress.com/wp-content/themes/panini/images/bg-home-boston.jpg", 
					"http://www.indianfoodsco.com/imagesfood/BenIndianPlatter.jpg", 
					"http://www.luxurystnd.com/wp-content/uploads/2015/02/Breakfast-Food-Idea-A1.jpg");
					
					echo $images[$i - 1];
					
					?>')" /> 
				</div>
					
					
					<div class="caption">
					<?php
					$name = $GLOBALS['name'];
					echo "<h2>
							$name
						</a>
						</h2>
						<hr>";
					echo "	
						<h3>
						Highest-Rating Comment:
						</h3>
						<h5>
						by <a href='profile.php?=$raterName'>$raterName</a>
						</h5>
						<p>
							$comment
						</p>
					</div>
				</div>
				</div>";
				}
				?>
				
	</div>

	<div class="row clearfix">
		<!-- Cuisines -->
		<div class="cuisines">
			<div class="col-md-3 column">
				<h3>Cuisines
				</h3>
				<ul>
				<?php
				require('connect.php');
				$result = pg_query("
				SELECT ct.description, COUNT(rest.restaurant_id)
					FROM CuisineType ct
					LEFT JOIN Restaurant rest
						ON ct.cuisine_id=rest.cuisine
					GROUP BY ct.description
					ORDER BY ct.description
					");

				while($res = pg_fetch_assoc($result)){
				$type = $res['description'];
				$count = $res['count'];
				echo "
					<li>
						<a href='results.php?query=$type'>$type ($count)</a>
					</li>";
				}
					?>
				</ul>
			</div>
		</div>
		
		<!-- Recent Reviews -->
		<div class="recent-reviews">
			<div class="col-md-9 column">
				<h2 class="text-info text-center">
					Most Recent Review
				</h2>
				<?php
					$query = " SELECT * 
					FROM Rating R
					WHERE R.post_date IN (SELECT MAX(post_date) FROM Rating )";
							
					$result = pg_query($query) or die('Query failed: ' . pg_last_error());
					
					//Fetch the results and print them
					$result = pg_fetch_assoc($result);
					//start off with basic results an achieve actual results from queries
					$rName = $result['location_id'];
					$uName = $result['user_id'];
					$comment = $result['comments'];
					$food = $result['food'];
					$mood = $result['mood'];
					$price = $result['price'];
					$staff = $result['staff'];


					$result = pg_query("SELECT R.name, R.restaurant_id FROM Restaurant R, Location L
					 WHERE L.restaurant_id = R.restaurant_id AND L.location_id = $rName 
					 ");
					$result = pg_fetch_assoc($result);

					$rName = $result['name'];
					//restaurant ID
					$rId = $result['restaurant_id'];

					$result = pg_query("SELECT R.name, R.type_id FROM Rater R
					 WHERE R.user_id = $uName
					 ");
					$result = pg_fetch_assoc($result);
					$uName = $result['name'];
					$type = $result['type_id'];

					if($type == "1")
						$type = "Casual";
					else if($type == 2)
						$type = "Blogger";
					else if($type == 3)
						$type = "Verified Critic";
					else if($type == 0)
						$type = "Other";
					
			echo "	<h2>
					$rName
				</h2> 
				<h4>
				by <a href='profile.php?name=$uName'>$uName</a>
			    | $type
				</h4>
				<p>
					$comment
				</p>
				<strong>Price: </strong> $price | <strong>Food: </strong> $food | <strong>Mood: </strong> $mood | <strong>Staff: </strong> $staff
				<p>
					<a class='btn' href='restaurant.php?id=$rId'>Read other reviews</a>
				</p>
				";
				?>
			</div>
		</div>
		
		<!-- Popular queries -->
		<div class="col-md-12 column text-center" style="margin-top:50px;margin-bottom:10px">
		Check out these popular queries!
		
			<div class="btn-group btn-group-justified" role="group" aria-label="..." style="margin-top:10px">
				<a class="btn-group" role="group" href="#">
					<button type="button" class="btn btn-link">C</button>
				</a>
				<a class="btn-group" role="group" href="#">
					<button type="button" class="btn btn-link">D</button>
				</a>
				<a class="btn-group" role="group" href="#">
					<button type="button" class="btn btn-link">E</button>
				</a>
				<a class="btn-group" role="group" href="#">
					<button type="button" class="btn btn-link">F</button>
				</a>
				<a class="btn-group" role="group" href="#">
					<button type="button" class="btn btn-link">G</button>
				</a>
				<a class="btn-group" role="group" href="#">
					<button type="button" class="btn btn-link">H</button>
				</a>
				<a class="btn-group" role="group" href="#">
					<button type="button" class="btn btn-link">I</button>
				</a>
				<a class="btn-group" role="group" href="#">
					<button type="button" class="btn btn-link">J</button>
				</a>
				<a class="btn-group" role="group" href="#">
					<button type="button" class="btn btn-link">K</button>
				</a>
				<a class="btn-group" role="group" href="#">
					<button type="button" class="btn btn-link">L</button>
				</a>
				<a class="btn-group" role="group" href="#">
					<button type="button" class="btn btn-link">M</button>
				</a>
				<a class="btn-group" role="group" href="#">
					<button type="button" class="btn btn-link">N</button>
				</a>
				<a class="btn-group" role="group" href="#">
					<button type="button" class="btn btn-link">O</button>
				</a>

			</div>
		</div>
	</div>

</body>
</html>