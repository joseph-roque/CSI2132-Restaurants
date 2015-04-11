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
		<?php
			$name = $_GET['name'];
			echo "
			<!-- USER INFO -->
			<h2 class='text-center text-info'>
					Viewing <strong>$name</strong>'s Profile
			</h2>";

			require('connect.php');
			$result = pg_query("SELECT * FROM Rater WHERE Rater.name = '$name'");
			$result = pg_fetch_assoc($result);
			$email = $result['email'];
			$join = $result['join_date'];
			$join = substr($join, 0, -8);
			$type = $result['type_id'];
			$result = pg_query("SELECT description FROM RaterType WHERE RaterType.type_id = $type");
			$result = pg_fetch_assoc($result);
			$type = $result['description'];

			echo "
			<dl class='dl' style='font-size:20px'>
				<dt>Username</dt> <dd>$name</dd>
				<dt>Email</dt> <dd>$email</dd>
				<dt>Join Date</dt> <dd>$join</dd>
				<dt>Type of User</dt> <dd>$type</dd>
			";
		?>
				
			</dl>
		</div>
		<!-- MENU ITEM REVIEWS -->
		<div class="col-md-12 column">
			
			<h2 class="text-info">
				Menu Item Reviews
			</h2>
			
			<table class="table table-hover" style="margin-top:20px"> <!-- match margin of H2 next to it -->
				<!-- Header -->
				<thead>
					<tr>
						<th>Item</th>
						<th>Price</th>
						<th>Type</th>
						<th>Rating</th>
						<th>Comments</th>
					</tr>
				</thead>
				<!-- All MENU ITEMS -->
				<tbody>
				<?php
					$name = $_GET['name'];
					$result = pg_query("SELECT * FROM Rater WHERE Rater.name = '$name'");
					$result = pg_fetch_assoc($result);
					
					$id = $result['user_id'];
					
					$res = pg_query("SELECT * FROM RatingItem RI WHERE RI.user_id = $id");
					
					while($result = pg_fetch_assoc($res)){
					
						$rating = $result['rating'];
						$comment = $result['comments'];
						$iName = $result['item_id'];

						$result = pg_query("SELECT * FROM MenuItem MI WHERE MI.item_id = $iName");
						$result = pg_fetch_assoc($result);

						$iName = $result['name'];
						$price = $result['price'];
						$type = $result['type_id'];	

						$result = pg_query("SELECT description FROM CuisineType WHERE cuisine_id = $type");
						$result = pg_fetch_assoc($result);

						$type = $result['description'];

						echo "
								<tr>
									<td>$iName</td>
									<td>$$price</td>
									<td>$type</td>
									<td>$rating</td>
									<td>$comment</td>
								</tr
								";
					}
				?>
				</tbody>
			</table>
		<hr>
		<!-- RESTAURANT REVIEWS -->
			<h2 class="text-info">
				Restaurant Reviews
			</h2>

			<table class="table table-hover" style="margin-top:20px"> <!-- match margin of H2 next to it -->
				<!-- Header -->
				<thead>
					<tr>
						<th>Name</th>
						<th>Food</th>
						<th>Mood</th>
						<th>Staff</th>
						<th>Price</th>
						<th>Comments</th>
					</tr>
				</thead>
				<!-- All restaurant reviews -->
				<tbody>
				<?php
					$name = $_GET['name'];
					$result = pg_query("SELECT * FROM Rater WHERE Rater.name = '$name'");
					$result = pg_fetch_assoc($result);
					
					$id = $result['user_id'];
					
					$res = pg_query("SELECT * FROM Rating R WHERE R.user_id = $id");
					
					while($result = pg_fetch_assoc($res)){
					
						$comment = $result['comments'];
						$rName = $result['location_id'];
						$food = $result['food'];
						$mood = $result['mood'];
						$staff = $result['staff'];
						$price = $result['price'];

						$result = pg_query("SELECT * FROM Restaurant R, Location L WHERE L.location_id = $rName AND L.restaurant_id = R.restaurant_id");
						$result = pg_fetch_assoc($result);

						$rName = $result['name'];

						echo "
								<tr>
									<td>$rName</td>
									<td>$food</td>
									<td>$mood</td>
									<td>$staff</td>
									<td>$price</td>
									<td>$comment</td>
								</tr
								";
					}
				?>
				</tbody>
			
		</div>
	</div>
	
</div>

</body>
</html>