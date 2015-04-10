<?php 
	if(session_id() == '') {
	session_start();
	$name = "";
	$userid = "";
	if(array_key_exists('name', $_SESSION) && array_key_exists('userid', $_SESSION)){
		$name = $_SESSION['name'];
		$userid = $_SESSION['userid'];
	}
}
		
?>


<?php
if($name == "" || $userid == ""){
echo '
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
			<li><a href="index.php">';
					if ($page_title == "Home")
						echo "<strong>";

					echo "Home";

					if ($page_title == "Home")
						echo "</strong>";
		echo '						
			</a></li>
			<li><a href="about.php">';
					if ($page_title == "About")
						echo "<strong>";
			echo "About";
					if ($page_title == "About")
						echo "</strong>";
		echo '				
			</a></li>
			<li><a href="contact.php">';
					if ($page_title == "Contact")
						echo "<strong>";
				echo '
				Contact';

					if ($page_title == "Contact")
						echo "</strong>";
			echo '</a></li>
		</ul>
		<!-- Right -->
		<ul class="nav navbar-nav navbar-right">
			<li><a href="login.php">';
					if ($page_title == "Login")
						echo "<strong>";
			echo '
				Login';
					if ($page_title == "Login")
						echo "</strong>";
			echo '	
			</a></li>
			<li><a href="register.php">';
					if ($page_title == "Register")
						echo "<strong>";
			echo '
				Register';
					if ($page_title == "Register")
						echo "</strong>";
			echo '</a></li>
		</ul>
	</div>	
</nav>
';
}
else{
echo '
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
			<li><a href="index.php">';
					if ($page_title == "Home")
						echo "<strong>";

					echo "Home";

					if ($page_title == "Home")
						echo "</strong>";
		echo '						
			</a></li>
			<li><a href="about.php">';
					if ($page_title == "About")
						echo "<strong>";
			echo "About";
					if ($page_title == "About")
						echo "</strong>";
		echo '				
			</a></li>
			<li><a href="contact.php">';
					if ($page_title == "Contact")
						echo "<strong>";
				echo '
				Contact';

					if ($page_title == "Contact")
						echo "</strong>";
			echo '</a></li>
		</ul>
		<!-- Right -->
		<ul class="nav navbar-nav navbar-right">
			<li><a href="logout.php">';
					if ($page_title == "Logout")
						echo "<strong>";
			echo '
				Logout';
					if ($page_title == "Logout")
						echo "</strong>";
			$tmp = $_SESSION['name'];
			echo "
			</a></li>
			<li><a href='profile.php?name=$tmp'>";
					if ($page_title == "Profile")
						echo "<strong>";
			echo "
				$tmp";
					if ($page_title == "Profile")
						echo "</strong>";
			echo '</a></li>
		</ul>
	</div>	
</nav>
';
}
?>
