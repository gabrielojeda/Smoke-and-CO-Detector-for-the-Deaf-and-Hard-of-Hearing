<?php
$flag = 1;
while($flag == '1')
{
	header("refresh: 5;");
	
	$con = mysql_connect("localhost", "energy_user","root");
		
	if(!$con)
	{
		die('MySQL connection failed');
	}
 
	$db = mysql_select_db("energy_project");
	
	if(!$db)
	{
		die('Database selection failed');
	}
 
	$registatoin_ids = array();
	$sql = "SELECT *FROM tblregistration";
	$result = mysql_query($sql, $con);
	
	while($row0 = mysql_fetch_assoc($result))
	{
		array_push($registatoin_ids, $row0['registration_id']);
	}
 
	$reads = array();
	$sqd = "SELECT *FROM readings";
	$rresult = mysql_query($sqd, $con);
	
	while($row1 = mysql_fetch_assoc($rresult))
	{
		array_push($reads, $row1['value']);
	}
	
	/* Set POST Variables */
	$url = 'https://android.googleapis.com/gcm/send';
	
	if($reads[0] != "0.00")
	{
		$message = array("Notice" => $reads[0]);
		$fields = array('registration_ids' => $registatoin_ids, 'data' => $message);
		$flag = 0;
		
		$headers = array('Authorization: key=AIzaSyAi1PKb1ZurixBQHZSUoqow4n2iEX1IJnU','Content-Type: application/json');
		
		/* Open Connection */
		$ch = curl_init();
		
		/* Set the url, Number of POST variables, POST Data */
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		
		/* Disable SSL Certificate Support Temporarly */
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
		
		/* Execute Post */
		$result = curl_exec($ch);
		
		if($result === FALSE) 
		{
			die('Curl failed: ' . curl_error($ch));
		}
		
		/* Close connection */
		curl_close($ch);
		echo $result;
	}
}
