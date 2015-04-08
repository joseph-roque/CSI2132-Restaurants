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
	<?php $page_title = "About" ?>

	<?php include("includes/resources.php");?>
</head>

<body>
<div class="container">
	<div class="row clearfix">
		<div class="col-md-12 column">
			<?php include("includes/header.php");?>
			<?php include("includes/navbar.php");?>
		
			<h2 class="text-center text-info">
					About the team
			</h2>
			
			<div class="the-team">
				
				<!-- James -->
				<div class="col-md-4">
					<div class="thumbnail" style="height:500px">
					<a href="https://github.com/jreinlein">
					<div class="cropped-img" style="background-image:url('james.png'); min-height:300px" /> </div>

					<div class="caption">
						<h2>
							James Reinlein</a>
						</h2>
						<p>
							Specialized in dank memes and surfing (the internet, not waves), James likes to waste a lot of his time on Reddit or raging at teammates in online MOBAs.
						</p>
					</div>
				</div>
			</div>
				<!-- Joseph -->
				<div class="col-md-4">
					<div class="thumbnail" style="height:500px">
					<a href="https://github.com/joseph-roque">
					<div class="cropped-img" style="background-image:url('joseph.png'); min-height:300px" /> </div>

					<div class="caption">
						<h2>
							Joseph Roque</a>
						</h2>
						<p>
							In his free time, Joseph likes to bowl (5-pins only, none of that 10-pin garbage) and recite an unreasonable amount of digits of pi.
						</p>
					</div>
				</div>
				</div>
				<!-- Mohammed -->
				<div class="col-md-4">
					<div class="thumbnail" style="height:500px">
					<a href="https://github.com/mshanti">
					<div class="cropped-img" style="background-image:url('mohammed.png'); min-height:300px"/> </div>
						
					<div class="caption">
						<h2>
							Mohammed Shanti</a>
						</h2>
						<p>
							Also known as <i>Habibi</i>, Moe spends his leisure time brushing up on his knowledge of the Qur'an and refraining from unlawful drugs.
							His mother is quite proud.
						</p>

					</div>
				</div>
	</div>
</div>

</body>
</html>