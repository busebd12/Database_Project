<?php
	$host=" "; // Host name
	$username=" "; // Mysql username
	$password=''; // Mysql password
	$db_name=" "; // Database name

	//connects to the database
	$connect=mysql_connect($host,$username,$password) or die("Cannot Connect to database");
	mysql_select_db($db_name,$connect) or die ("Cannot find database");

	//checks the connection to the database
	if($connect == TRUE)
	{
	echo 'Connected to the database';
	}

	//chooses the database that you want to add the table to
	mysql_select_db(/*Database name here""*/) or die(mysql_error());


	mysql_query("INSERT INTO /*Database name here*/ /*(Database columns here)*/ VALUES(/*Values we want to put in the columns here', ', ', '*/)") or die(mysql_error());
	echo "Data Inserted!";
?>