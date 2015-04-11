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
			<?php include("includes/header.php");?>
			<?php include("includes/navbar.php");?>
		<div class="col-md-12 column">
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

				$location = $row['street_address'];
				
				
			echo"<strong>
				Hours Open: $open - $close
				</strong>
				<br>
				<a href = 'results.php?query="; echo $cuisine; echo "&cui="; echo $cuisine; echo "'>$cuisine</a>
				<br>
				Established: $first
				<br>
				Address: $location
				<br>
				Currently managed by: <i>$manager</i>
				";
			?>
			</p>

			<button  onclick = "redirect('review-restaurant.php')" name = "write-review" method  = "post"  type="write-review" class="btn btn-primary">
				<strong><span class=" glyphicon glyphicon-pencil" style="margin-right:10px"></span>Write a Review</strong>
			</button>
			</form>
			
			<div class="text-danger" style="margin-top:10px">
				Want this restaurant taken down? <a href="contact.php"><strong>Contact the administrator!</a></strong>
			</div>
			
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
		?>&zoom=13&scale=1&size=400x250&maptype=roadmap&format=png&visual_refresh=true"></a>

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
					if($total!= 0)
						$avgRating = $avgRating/$total;
				$avgRating = round($avgRating, 1); 
				if($avgRating != 0)
					echo "$avgRating";
				else echo "N/A";
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
						<?php
							$id = $_GET['id'];
							echo "<th><a href='restaurant.php?id=$id&sort=item'>Item</a></th>";
							echo "<th><a href='restaurant.php?id=$id&sort=price'>Price</a></th>";
							echo "<th><a href='restaurant.php?id=$id&sort=type'>Type</a></th>";
						?>
						<th>Rating</th>
						<th>View</th>
					</tr>
				</thead>
				<!-- All menu items -->
				<tbody>
				<?php
					$rId = pg_query("SELECT restaurant_id FROM Location WHERE Location.location_id = $id");
					$rId = pg_fetch_assoc($rId);
					$rId = $rId['restaurant_id'];

					$menuQuery = "
						SELECT M.name, M.price, I.description, M.item_id
						FROM MenuItem M, ItemType I
						WHERE M.restaurant_id = $rId AND M.type_id = I.type_id
						ORDER BY ";
					if (isset($_GET['sort'])) {
						$orderBy = $_GET['sort'];
					} else {
						$orderBy = "type";
					}
					switch($orderBy) {
						case 'type': $menuQuery.="M.type_id"; break;
						case 'item': $menuQuery.="M.name"; break;
						case 'price': $menuQuery.="M.price DESC"; break;
					}

					$result1 = pg_query($menuQuery);
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
								<td>$$price</td>
								<td>$description</td>
								<td>$itemAvgRating</td>
								<td>";

								include("includes/edit-menu.php");

								echo "</td></tr>";
					}

				?>
					
				</tbody>
			</table>
			<!-- Adding new menu item -->
			
			<!-- Button trigger modal -->
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
				<strong><span class=" glyphicon glyphicon-plus" style="margin-right:10px"></span>Add Menu Item</strong>
			</button>

			<!-- MODAL BUTTON -->
			<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<!-- MODAL DIALOG -->
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="myModalLabel">Add Menu Item</h4>
						</div>
						
						<div class="modal-body">
							<form id="formID" name="formID" method="post" action="" role="form">
								<!-- ITEM NAME -->
								<div class="row">
									<div class="form-group-xs">
										<label for="input-name">Item Name</label>
										<input name ="input-name" type="name" class="form-control" id="input-name" required />
									</div>
								</div>
								<!-- ITEM PRICE -->
								<div class="row">
									<div class="input-group input-group-modal">
										<label for="input-price" style="display:table-caption">Price</label>
										<span class="input-group-addon">$</span>
										<input name ="input-price" type="price" class="form-control" placeholder="12.50" id="input-price" required />
									</div>
								</div>
								<!-- ITEM TYPE -->
								<div class="row">
									<div class="form-group-xs">
										<label id = "input-type" name = "input-type" method="post" for="form-control">Type of Food</label>
										<select name = "input-type" id = "input-type" method= "post" class="form-control">
											<option>Other</option>
											<option>Appetizer</option>
											<option>Entree</option>
											<option>Dessert</option>
											<option>Beverage</option>
											<option>Alcoholic</option>
										</select>
									</div>
								</div>
							</form>
						</div>
						
						<div class="modal-footer">
							<button type="button" onclick="redirectMenu("nolink", 0)" class="btn btn-default" data-dismiss="modal">Cancel</button>
							<button type="button" onclick="redirectMenu("nolink", 0)" class="btn btn-primary">Submit <span class="glyphicon glyphicon-ok"/></button>
						</div>
					</div>
				</div>
			</div>
			
			<?php 
								if(array_key_exists('input-name', $_POST) && array_key_exists('input-type', $_POST) && array_key_exists('input-price', $_POST)){
									echo "THEY EXISTS!!!";
									$iName = $_POST['input-name'];
									$type = $_POST['input-type'];
									if($type == "Other")
										$type = 0;
									else if($type == "Appetizer")
										$type = 1;
									else if($type == "Entree")
										$type = 2;
									else if($type == "Dessert")
										$type = 3;
									else if($type == "Beverage")
										$type = 4;
									else if($type == "Alcoholic")
										$type = 5;
									$price = $_POST['input-price'];
									$location_id = $_GET['id'];
									require('connect.php');
									$result = pg_query("SELECT * FROM Loaction L WHERE L.location_id = $location_id");
									$result = pg_fetch_assoc($result);

									$rId = $result['restaurant_id'];

									$result = pg_query("SELECT * FROM MenuItem MI WHERE MI.restaurant_id = $rId AND 
										MI.name = $iName");
									$num = pg_num_rows($result);

									if($num == 0){
										$result = pg_query("INSERT INTO MenuItem(name, type_id, description, price, restaurant_id)
											VALUES('$iName', $type, $description, $price, $rId);");
									}
									else {
										echo "That item already exists!";
									}
									
								}
							?>
			
			
			
			
			<!-- LEGACY BUTTON
			
			<button  onclick = "redirect('review-restaurant.php')" name = "add-item" method  = "post"  type="add-item" class="btn btn-primary">
				<strong><span class=" glyphicon glyphicon-plus" style="margin-right:10px"></span>Add a Menu Item</strong>
			</button> -->
		</div>
		<!-- Reviews -->
		<div class="col-md-6 column">
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
					$res1 = pg_query("SELECT type_id, name FROM Rater WHERE Rater.user_id = $author");
					$res1 = pg_fetch_assoc($res1);
					$author = $res1['name'];
					$type = $res1['type_id'];
					$res1 = pg_query("SELECT description FROM RaterType WHERE RaterType.type_id = $type");
					$res1 = pg_fetch_assoc($res1);
					$type = $res1['description'];

					echo "	
					<p>
						$comment
					</p>
					<h4>
						by <a href='profile.php?name=$author'>$author</a> | $type
					</h4>
					<strong>Price: </strong> $price | <strong>Food: </strong> $food | <strong>Mood: </strong> $mood | <strong>Staff: </strong> $staff
					<hr>
					";
				}
			?>
		</div>
	</div>
</div>

</body>
</html>