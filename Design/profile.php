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
					Viewing $name's Profile
			</h2>";

			require('connect.php');
			$result = pg_query("SELECT * FROM Rater WHERE Rater.name = '$name'");
			$result = pg_fetch_assoc($result);
			$email = $result['email'];
			$join = $result['join_date'];
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
		<div class="col-md-6 column">
			
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
								WHERE RI.item_id = $id;
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
		</div>
			<?php
			$id = $_GET['id'];
				require('connect.php');
				$result = pg_query("
					SELECT * FROM Rater R WHERE R.user_id = $id;
					");
				$result = pg_fetch_assoc($result);
				$name = $result['name'];
				$email = $result['email'];
				$join_date = $result['join_date'];
				$getType = (int) $result['type_id'];

				if($getType == 1)
					$getType = "Casual";
				else if($getType == 2)
					$getType = "Blogger";
				else if($getType == 3)
					$getType = "Verified Critic";
				else if($getType == 0)
					$getType = "Other";
			?>		
		<!-- RESTAURANT REVIEWS -->
		<div class="col-md-6 column">
			<h2 class="text-info">
				Restaurant Reviews
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
						by <a href='#'>$author</a>
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