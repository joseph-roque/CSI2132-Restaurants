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
	<?php $page_title = "Add Menu Item" ?>

	<?php include("includes/resources.php");?>
</head>

<body>
<div class="container">
	<div class="row clearfix">
		<?php include("includes/header.php");?>
		<?php include("includes/navbar.php");?>
			<h2 class="text-center text-info" style="margin-bottom:20px">
					Add a new menu item for <strong>[restaurant name]</strong>
			</h2>
			
			<div class="col-md-12 column">
				<form id="formID" name="formID" method="post" action="" role="form">
					<!-- ITEM NAME -->
					<div class="row">
						<div class="form-group-xs">
							<label for="input-name">Item Name</label>
							<input name ="input-name" type="name" class="form-control" id="input-name" required autofocus/>
						</div>
					</div>
					<!-- PRICE -->
					<div class="row">
						<div class="form-group-xs">
							<label for="input-price">Price</label>
							<input name ="input-price" type="name" class="form-control" id="input-price" required />
						</div>
					</div>
					<!-- FOOD TYPE -->
					<div class="row">
						<div class="form-group-xs">
							<label for="input-type">Type of Food</label>
							<!-- FETCH ALL POSSIBLE CUISINE TYPES IN HERE -->
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
					
					<div class="text-center" style="margin-top:20px">
						<button name="add-item" id="add-item" type="submit" class="btn btn-primary"><strong>Add Menu Item</strong></button>
					</div>
				</form>
				
			</div>
	</div>
</div>
</body>
</html>