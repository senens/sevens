<?php
include './sphinxapi.php';	
	$sphinx = new SphinxClient();
	$sphinx->SetServer("127.0.0.1",9312);
	$result=$sphinx->query('1000',"*");
	var_dump($result);	
?>