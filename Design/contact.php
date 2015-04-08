<!DOCTYPE html> <?php      session_start();     $name = "";     $userid = "";
if(array_key_exists('name', $_SESSION) && array_key_exists('userid',$_SESSION)){
         $name = $_SESSION['name'];         $userid =
		 $_SESSION['userid']; 
	     }
		
?>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Sizzl | Contact</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">

	<?php include("includes/resources.html");?>
</head>

<body>
<div class="container">
	<div class="row clearfix">
			<?php include("includes/header.php");?>
			<?php include("includes/navbar.php");?>
			
			<h2 class="text-center text-info">
					Contact us, we promise not to bite
			</h2>
			
			<div class="register-form">
				<div class="row clearfix">
					<div class="col-md-12 column">
						<form role="form">
							<div class="row">
							<!-- Name -->
								<div class="form-group-xs">
									 <label for="input-name">Name</label>
									 <input type="email" class="form-control" id="input-email" autofocus/>
								</div>
							</div>
							<div class="row">
							<!-- Email -->
								<div class="form-group-xs">
									 <label for="input-email">Email address</label>
									 <input type="email" class="form-control" id="input-email" required/>
								</div>
							</div>
							<!-- Comments -->
							<div class="row">
								<div class="form-group-xs">
									 <label for="input-comments">Comments? Suggestions?</label>
									 <textarea style="width:100%" name="comments" rows="10"  placeholder="We're listening...!" required></textarea>
								</div>
							</div>
							<!-- Submit button -->
							<div class="text-center">
								<button type="submit" class="btn btn-primary"><strong>Submit</strong></button>
							</div>
						</form>
					</div>
				</div>
			</div>
			
	</div>
</div>

</body>
</html>