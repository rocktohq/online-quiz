<?php
	
	/*
	#	Application by 
	#	Design & Developed by 
	#	Contact: 
	*/
	
	// Database Information
	$host = "localhost";
	$dbname = "equiz";
	$dbuser = "equiz";
	$dbpass = "equiz";
	
	
	// Let's try to Connect
	$con = new mysqli($host, $dbuser, $dbpass, $dbname);

	// If there is any Error
	if($con -> connect_errno) {
	  echo "Failed to connect to MySQL: " . $con -> connect_error;
	  exit();
	}