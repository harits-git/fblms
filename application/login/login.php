<?php

/**
 * @author Trial Mode (Remaining 23 day(s))
 * @copyright 2008
 */
session_start(); 


	include_once '../../config.php';
	
	//pilih user dari db;
	$user_valid =  false;
	$result=$db->execute("SELECT 
									*
									
							FROM
									mhs
							WHERE
									nim='".$_POST["username"]."'
									
						");
	while(!$result->EOF){
		
		$username = $result->fields["nim"]; // username=nip
		$namamhs= $result->fields["nama"];
        
		
		$user_valid = true;
		
		$result->MoveNext();
	}
	
	
	if($user_valid){
		
		//echo 'user valid';
		
		$_SESSION["username"] = $username;
		$_SESSION["namamhs"] = $namamhs;
		
		header("location:../../index.php");
		
		
	} else {
		
		header("location:../../index.php?msg=<h3>Incorrect Username or Password..</h3>");
	}

?>