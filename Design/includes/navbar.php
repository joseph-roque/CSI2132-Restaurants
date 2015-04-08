<!-- Navigation Bar -->
<nav class="navbar navbar-default" role="navigation">
	<div class="navbar-collapse collapse">
		<!-- Search Bar -->
		<ul class="navbar-brand">
			<form class="navbar-form" role="search" method="get" id="search-form" name="search-form">
				<div class="input-group">
					<input type="text" class="form-control" placeholder="Restaurants, Cuisines..."
					id="query" name="query" value="">
						<div class="input-group-btn">
					<button type="submit" class="btn btn-warning"><span class="glyphicon glyphicon-search"></span></button>
					</div>
				</div>
			</form>
		</ul>
		<!-- Left -->
		<ul class="nav navbar-nav navbar-left">
			<li><a href="index.php">
				<?php
					if ($page_title == "Home")
						echo "<strong>"
				?>					
				Home
				<?php
					if ($page_title == "Home")
						echo "</strong>"
				?>						
			</a></li>
			<li><a href="about.php">
				<?php
					if ($page_title == "About")
						echo "<strong>"
				?>					
				About
				<?php
					if ($page_title == "About")
						echo "</strong>"
				?>						
			</a></li>
			<li><a href="contact.php">
				<?php
					if ($page_title == "Contact")
						echo "<strong>"
				?>					
				Contact
				<?php
					if ($page_title == "Contact")
						echo "</strong>"
				?>						
			</a></li>
		</ul>
		<!-- Right -->
		<ul class="nav navbar-nav navbar-right">
			<li><a href="login.php">
				<?php
					if ($page_title == "Login")
						echo "<strong>"
				?>			
				Login
				<?php
					if ($page_title == "Login")
						echo "</strong>"
				?>			
			</a></li>
			<li><a href="register.php">
				<?php
					if ($page_title == "Register")
						echo "<strong>"
				?>
				Register
				<?php
					if ($page_title == "Register")
						echo "</strong>"
				?>
			</a></li>
		</ul>
	</div>	
</nav>
