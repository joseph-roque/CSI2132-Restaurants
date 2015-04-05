<?php

//conect to database

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
