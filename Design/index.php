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

<div class="container">
	<div class="row clearfix">
		<?php include("includes/header.php");?>
		<?php include("includes/navbar.php");?>
		<div class="col-md-12 column">
			<h3 class="text-center text-muted" style="margin-top:-10px">
				Your one-stop shop for restaurant info, reviews, and menus 
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
				$type1 = -1;
				$type2 = -2;
				$type3 = -3;

				while($i < 3 && $tmp = pg_fetch_assoc($res)){
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
			<?php
				//FILL WITH PICTURES WITH IN EACH ROW THE URL TO 3 IMAGES OF SAME TYPE GOES AS LISTED BELOW FOR INDEXES
				/*
				0 Unknown
				1 Mexican
				2 Indian
				3 Korean
				4 Chinese
				5 Italian
				6 Fine Dining
				7 Breakfast
				8 Middle Eastern
				9 Sandwiches
				10 Other

				*/
				$images = array(
					"http://img3.wikia.nocookie.net/__cb20140128161936/tumblr-survivor/images/0/03/Unkown.png", "http://img3.wikia.nocookie.net/__cb20140128161936/tumblr-survivor/images/0/03/Unkown.png", "http://img3.wikia.nocookie.net/__cb20140128161936/tumblr-survivor/images/0/03/Unkown.png",
					"http://foodwallpaper.info/wp-content/uploads/2014/05/mexican-restaurant-logos.jpg", "http://www.brandcrowd.com/gallery/brands/pictures/picture13899442828471.jpg", "http://www.underworldmagazines.com/wp-content/uploads/2012/08/BRLEN21.jpg",
					"http://www.magazinehive.com/wp-content/uploads/2013/01/Srivas-Restaurant.png", "https://s-media-cache-ak0.pinimg.com/236x/62/99/3f/62993f179da1ecf00394920f4f1c7438.jpg", "http://www.thelogofactory.com/daily_logo/wp-content/uploads/2010/11/indian-restaurant-logo.png",
					"http://www.tropicanacitymall.com/shop_dine/images/kimchi_logo.jpg", "http://koreanaasheville.com/templates/tyl02/images/logo.png", "http://fc08.deviantart.net/fs40/f/2009/041/9/5/Korean_Restaurant_Logo_by_deadfuze.jpg",
					"http://www.outsourcelogos.com/uploads/index/166/d/Chinese_Restaurant_Logo_jpg.jpg", "http://www.freelogohub.com/wp-content/uploads/2013/02/Free-Chinese-Food-Logo.jpg", "http://www.freevector.com/site_media/preview_images/FreeVector-Asian-Food-Vector-Logo.jpg",
					"https://m1.behance.net/rendition/modules/41568807/disp/21806f512df218df49d5b43411dc1cd9.jpg", "http://www.templatewire.com/images/screenshots/logo-templates/logo096/logo.jpg", "https://m1.behance.net/rendition/modules/52942073/disp/34e04a8eba38eb740ca679b28948db21.gif",
					);

				$name = $GLOBALS['name'];
				$image = "";
				$typeQuery = pg_query("SELECT cuisine 
				FROM Restaurant R
				WHERE R.name = '$name'");
				$typeQuery = pg_fetch_assoc($typeQuery);
				if($i == 0){
					$type1 = $typeQuery['cuisine'];
				}else if($i == 1){
					$type2 = $typeQuery['cuisine'];
				}else{
					$type3 = $typeQuery['cuisine'];
				}
				if($i == 0){
					$image = $images[$type1*3 + 0];
				}
				if($i == 1){
					if($type1 == $type2)
						$image = $images[$type2*3 + 1];
					else $image = $images[$type2*3 + 0];
				}
				if($i == 2){
					if($type3 == $type2 && $type3 == $type1)
						$image = $images[$type3*3 + 2];
					else if($type3 == $type2 || $type3 == $type1)
						$image = $images[$type3*3 + 1];
					else $image = $images[$type3*3 + 0];
				}
			?>
				<div class="cropped-img" style="background-image:url('<?php echo $image ?>')" /> 
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
						by <a href='profile.php?name=$raterName'>$raterName</a>
						</h5>
						<p>
							$comment
						</p>
					</div>
				</div>
				</div>";
				$i++;	
				}
				?>
				<!-- BUTTON TO VIEW ALL RESTAURANTS (EMPTY SEARCH QUERY -->
				<div class="text-center center-block">
					<a href="results.php?query=" class="btn btn-link" style="font-size:125%"><span class=" glyphicon glyphicon-cutlery" style="margin-right:10px"></span>View All Restaurants</a>
				</div>
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
				SELECT ct.description, COUNT(loc.location_id)
					FROM CuisineType ct
					LEFT JOIN Restaurant rest
						ON ct.cuisine_id=rest.cuisine
					LEFT JOIN Location loc
						ON rest.restaurant_id=loc.restaurant_id
					GROUP BY ct.description
					ORDER BY ct.description
					");

				while($res = pg_fetch_assoc($result)){
				$type = $res['description'];
				$count = $res['count'];
				echo "
					<li>
						<a href='results.php?query=$type&cui=$type'>$type ($count)</a>
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
					$location_id = $rName;
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

					if($type == 1)
						$type = "Casual";
					else if($type == 2)
						$type = "Blogger";
					else if($type == 3)
						$type = "Verified Critic";
					else if($type == 0)
						$type = "Other";
					else if ($type == 4)
						$type = "Admin";
					
			echo "	<h2>
					<a href='restaurant.php?id=$location_id'>$rName</a>
				</h2> 
				<h4>
				by <a href='profile.php?name=$uName'>$uName</a>
			    | $type
				</h4>
				<p>
					$comment
				</p>
				<strong>Food: </strong> $food | <strong>Mood: </strong> $mood | <strong>Price: </strong> $price | <strong>Staff: </strong> $staff
				<p>
					<a href='popular.php?query=p'>Read other recent reviews</a>
				</p>
				";
				?>
			</div>
		</div>
		
		<!-- Popular queries -->
		<div class="col-md-12 column text-center" style="margin-top:20px;margin-bottom:10px">
			<a href="popular.php">Check out these popular queries!</a>
		</div>
	</div>

</body>
</html>