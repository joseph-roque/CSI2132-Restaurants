<?php

	//conect to database
	$link = pg_connect("host=web0.site.uottawa.ca port=15432 dbname=mshan072 user=mshan072 password=\$Hanti1095");

	if(!$link){
	  die('Could not connect: ' . pg_last_error());
	}

	//select database
	//$db_selected = mysql_select_db("project", $link);

	/*
	if(!$db_selected){
	  die('Can not use ' . "project" . ':'. mysql_error());
	}
	*/

?> 