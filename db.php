<?php
	// $svr 	= "BEDEGONG\SQLSERVER";
	// $user 	= "sa";
	// $pass 	= "123!";
	// $db2	= "V@LID49V6_2020";

	$svr 	= "10.110.10.200\SIPKD";
	$user 	= "sa";
	$pass 	= "Valid49123";
	$db2	= "V@LID49V6_2022";

	$connectionoptions = array("Database" => $db2, "UID" => $user, "PWD" => $pass, "MultipleActiveResultSets" => '1');
	$conn2 = sqlsrv_connect($svr, $connectionoptions);
		
		if($conn2){
			// echo "Terkoneksi ke $svr - $db2 <br/>";
			print ("</hr>");
		}else{
			echo "<h1>No Connect to DB</br></br></h1>";
     		die( print_r(sqlsrv_errors(), true));
		}