<!DOCTYPE html> <?php      session_start();     $name = "";     $userid = "";
if(array_key_exists('name', $_SESSION) && array_key_exists('userid',$_SESSION)){
         $name = $_SESSION['name'];         $userid =
		 $_SESSION['userid']; 
	     }
		
?>
<html lang="en">
<head>
	<?php $page_title = "Contact" ?>
	
	<?php include("includes/resources.php");?>
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
						<form method = "post" role="form">
							<div class="row">
							<!-- Name -->
								<div class="form-group-xs">
									 <label for="input-name">Name</label>
									 <input name = "input-name" id = "input-name" type="text" class="form-control" id="input-name" autofocus/>
								</div>
							</div>
							<div class="row">
							<!-- Email -->
								<div class="form-group-xs">
									 <label for="input-email">Email address</label>
									 <input name = "input-email" id = "input-email" type="email" class="form-control" id="input-email" required/>
								</div>
							</div>
							<!-- Comments -->
							<div class="row">
								<div class="form-group-xs">
									 <label for="input-comments">Comments? Suggestions?</label>
									 <textarea name = "input-comment" name = "input-comment" style="width:100%" name="comments" rows="10"  placeholder="We're listening...!" required></textarea>
								</div>
							</div>
							<!-- Submit button -->
							<div class="text-center">
								<button type="submit" class="btn btn-primary"><strong>Submit</strong></button>
							</div>
						</form>
						<?php
							if(array_key_exists('input-name', $_POST) && array_key_exists('input-email', $_POST)
								&& array_key_exists('input-comment', $_POST)){
								$field_name = $_POST['input-name'];
								$field_email = $_POST['input-email'];
								$field_message = $_POST['input-comment'];

								$mail_to = 'mshanti95@gmail.com';
								$subject = 'Message from a site visitor '.$field_name;

								$body_message = 'From: '.$field_name."\n";
								$body_message .= 'E-mail: '.$field_email."\n";
								$body_message .= 'Message: '.$field_message;

								$headers = 'From: '.$field_email."\r\n";
								$headers .= 'Reply-To: '.$field_email."\r\n";

								$mail_status = mail($mail_to, $subject, $body_message, $headers);

								if ($mail_status) { ?>
									<script language="javascript" type="text/javascript">
									alert('Thank you for the message. We will contact you shortly.');
									</script>
								<?php
									}
									else { ?>
										<script language="javascript" type="text/javascript">
											alert('Message failed. Please, send an email to gordon@template-help.com');
										</script>
									<?php
									} 
								}
								?>
					</div>
				</div>
			</div>
			
	</div>
</div>

</body>
</html>