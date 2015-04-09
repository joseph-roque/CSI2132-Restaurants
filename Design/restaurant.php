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
	<?php $page_title = "Restaurant" ?>
	
	<?php include("includes/resources.php");?>
</head>

<body>
<div class="container">
	<div class="row clearfix">
		<div class="col-md-12 column">
			<?php include("includes/header.php");?>
			<?php include("includes/navbar.php");?>
		</div>
		
		<!-- Textual description -->
		<div class="col-md-5 column" style="line-height:2">
			<h2 class="text-primary"><strong>
				<?php
					require('connect.php');
					$id = $_GET['id'];
					
					$result = pg_query("
						SELECT * 
						FROM restaurant R, location L
						WHERE L.location_id = $id AND L.restaurant_id = R.restaurant_id; 
					");
					
					$row = pg_fetch_assoc($result);
					$rName = $row['name'];
					$rUrl = $row['url'];
					echo "<a href = 'http://$rUrl'>$rName</a>";
				?>
			</strong></h2>
			<?php
					require('connect.php');
					$id = $_GET['id'];
					
					$result = pg_query("
						SELECT * FROM location WHERE location_id = $id;
					");
					
					$row = pg_fetch_assoc($result);
			?>
			<h3 class="text-info" style="margin-top:-5px; margin-bottom:20px">
				<?php
					$number = $row['phone_number'];
					 $numbers_only = preg_replace("/[^\d]/", "", $number);

  					$number = preg_replace("/^1?(\d{3})(\d{3})(\d{4})$/", "$1-$2-$3", $numbers_only);
					echo "$number";
				?>
			</h3>
			<p>
			<?php 
				$open = $row['hour_open'];
				$open = substr_replace($open, ":", strlen($open)-2, 0);
				$close = $row['hour_close'];
				$close = substr_replace($close, ":", strlen($close)-2, 0);
				$first = $row['first_open_date'];
				$first = substr($first, 0, -8);
				$manager = $row['manager_name'];
				
				$result = pg_query("
					SELECT * 
					FROM cuisinetype C, restaurant R, location L
					WHERE L.location_id = $id AND L.restaurant_id = R.restaurant_id AND R.cuisine = C.cuisine_id; 
				");
				
				$row = pg_fetch_assoc($result);
				
				$cuisine = $row['description'];
				
				
			echo"<strong>
				Hours Open: $open - $close
				</strong>
				<br>
				<a href = 'http://localhost/Github/CSI2132-Restaurants/Design/restaurant.php?id=2'>$cuisine ADD CUISINE PAGE</a>
				<br>
				Established: $first
				<br>
				Currently managed by: <i>$manager</i>
				";
			?>
			</p>
			<script>
				function redirect() {
    			var link = "review-restaurant.php"
    			var currentLink = window.location.href;
    			var index = currentLink.lastIndexOf("?");
    			var tmp = currentLink.substr(index,currentLink.length);

    			link = link.concat(tmp);

    			window.location.href = link;
			}
			</script>
			<button  onclick = "redirect()" name = "write-review" method  = "post"  type="write-review" class="btn btn-primary">
				<strong><span class=" glyphicon glyphicon-pencil" style="margin-right:10px"></span>Write a Review</strong>
			</button>
			</form>
			
		</div>
		<!-- Maps interface & avg. rating -->
		<div class="col-md-7 column text-center" style="padding-top: 10px">
		
		<a href="https://www.google.com/maps/place/
		<?php
			$result = pg_query("
				SELECT * FROM location WHERE location_id = $id;
			");
					
			$row = pg_fetch_assoc($result);
			echo $row['street_address'];
		?>/"><img src="http://maps.googleapis.com/maps/api/staticmap?center=		
		<?php
			$result = pg_query("
				SELECT * FROM location WHERE location_id = $id;
			");
					
			$row = pg_fetch_assoc($result);
			echo $row['street_address'];
		?>&zoom=13&scale=1&size=400x250&maptype=roadmap&format=png&visual_refresh=true" alt="Google Map of new york city"></a>

			<!-- CANT FIX THIS HELP ME !-->
			<br>
			<div class="rating">
				<h2 class="text-info" style="margin-bottom: -10px">
					Average Rating
				</h2>
				<strong><p style="font-size:60px">
				<?php
				require('connect.php');
					$avgRating = 0;
					$query = "
						SELECT price, food, mood, staff
						FROM Rating RA, Location L
						WHERE L.location_id = $id AND RA.location_id = L.location_id
						";
					$result = pg_query($query);
					
					$total = 0;
					while($row = pg_fetch_assoc($result)){
						$total = (int) $total + 1;
						$price = (int) $row['price'];
						$food = (int) $row['food'];
						$mood = (int) $row['mood'];
						$staff = (int) $row['staff'];
						$avg = (int) ($price + $food + $mood + $staff)/4;
						$avgRating = $avgRating + $avg;
					}
					$avgRating = $avgRating/$total;
					$avgRating = round($avgRating, 1); 
				echo "$avgRating"
				?></font></strong>
			</div>
		</div>
	</div>
	<div class="row clearfix">
		<!-- Menu Table -->
		<div class="col-md-6 column">
		<h2 class="text-info" style="margin-bottom:-5px">
		Menu
		</h2>
			<table class="table table-hover" style="margin-top:20px"> <!-- match margin of H2 next to it -->
				<!-- Header -->
				<thead>
					<tr>
						<th>Item</th>
						<th>Price</th>
						<th>Type</th>
						<th>Rating</th>
					</tr>
				</thead>
				<!-- All menu items -->
				<tbody>
				<?php
					$result1 = pg_query("
						SELECT M.name, M.price, I.description, M.item_id
						FROM MenuItem M, ItemType I
						WHERE M.restaurant_id = 1 AND M.type_id = I.type_id
						ORDER BY(M.type_id)
					");
					while($res2 = pg_fetch_assoc($result1)){
						$iName = $res2['name'];
						$price = $res2['price'];
						$description = $res2['description'];
						$itemid = $res2['item_id'];
						$itemAvgRating = 0;
						$sql1 = pg_query("
								SELECT RI.rating
								FROM RatingItem RI
								WHERE RI.item_id = $itemid;
							");
						$total = 0;
						while($tmp = pg_fetch_assoc($sql1)){
							$total = $total + 1;
							$rating = $tmp['rating'];
							$itemAvgRating = $itemAvgRating + (int) $rating;
						}
						if($total != 0){
							$itemAvgRating = $itemAvgRating/$total;
							$itemAvgRating = round($itemAvgRating, 1);
						}
						else{
							$itemAvgRating = "N/A";
						}
						echo "
							<tr>
								<td>$iName</td>
								<td>$price</td>
								<td>$description</td>
								<td>$itemAvgRating</td>
							</tr>
						";
					}

				?>
					
				</tbody>
			</table>
			<!--Maybe DELETE? IF YOU DON'T LIKE? -->
			<button  onclick = "redirect()" name = "add-item" method  = "post"  type="add-item" class="btn btn-primary">
				<strong><span class=" glyphicon glyphicon-plus" style="margin-right:10px"></span>Add a Menu Item</strong>
			</button>
		</div>
		<!-- Reviews -->
		<div class="col-md-6 column">
			<!-- START OF REVIEW -->
			<h2 class="text-info">
				Reviews
			</h2>
			
			<?php
				require('connect.php');
				$result = pg_query("
					SELECT * FROM Rating R WHERE R.location_id = $id; 
				");
				
				while($row = pg_fetch_assoc($result)){
					$comment = $row['comments'];
					$price = $row['price'];
					$food = $row['food'];
					$mood = $row['mood'];
					$staff = $row['staff'];
					$author = $row['user_id'];
					$res1 = pg_query("SELECT name FROM Rater WHERE Rater.user_id = $author");
					$res1 = pg_fetch_assoc($res1);
					$author = $res1['name'];
					echo "	
					<p>
						$comment
					</p>
					<h4>
						by <a href='profile.php?name=$author'>$author</a>
					</h4>
					<strong>Price: </strong> $price | <strong>Food: </strong> $food | <strong>Mood: </strong> $mood | <strong>Staff: </strong> $staff
					<hr>
					";
				}
			?>

			<p class="demo">
				<script>
				function shorten() {
				var str= "
					[Comments of Review goes here] This is a test to see how I can shorten the things by a thing a ma jigger.
					Bacon ipsum dolor amet ribeye turducken pastrami tenderloin strip steak. Bresaola salami ham corned beef, rump pork belly kevin shankle sausage kielbasa beef brisket jerky shank turkey. Tri-tip fatback ball tip tenderloin leberkas sirloin rump landjaeger. Pork chop ham hock leberkas prosciutto. Pork loin kielbasa pork belly t-bone, porchetta beef short ribs sausage turkey prosciutto jerky landjaeger ball tip ribeye venison.

					Flank ham hock shankle pancetta hamburger salami ball tip sausage landjaeger. Short loin pork loin drumstick, capicola venison strip steak chicken meatloaf swine chuck picanha turkey spare ribs pig. Turducken salami shoulder, tri-tip jowl drumstick ball tip doner corned beef. Corned beef fatback bresaola, ham hock pork cow shankle strip steak short loin picanha chuck pork chop jowl cupim. T-bone landjaeger tri-tip porchetta chuck shoulder venison cow ham hock bresaola bacon. Turkey pork belly tail hamburger short ribs spare ribs jowl.
					";
					var res = str.substring(1, 50);
					document.getElementById("demo").innerHTML = res;

				}
			</p>
			<p>
				<a class="btn" href="#">Read review</a>
			</p>
			
			<hr> 
			<!-- END OF REVIEW -->
		</div>
	</div>
</div>

</body>
</html>