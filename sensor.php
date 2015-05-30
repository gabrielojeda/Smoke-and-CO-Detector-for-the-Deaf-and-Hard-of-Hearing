 <?php
 //This file stores the data posted from the CC3000 in your MySQL database
function db_connect()
{
   $result = mysql_connect("localhost", "energy_user", "root"); 
   if (!$result)
      return false;
   return $result;
}
db_connect();
mysql_select_db("energy_project");
	// Store data
    if ($_GET["temp"]){
    $temp = $_GET["temp"];
    $sqlt = "UPDATE readings SET value = '$temp' where id=1";
    //$sqlt = "insert into readings (sensor, time_stamp, value) values ('pool_temp',unix_timestamp(),$temp)";
    mysql_query($sqlt);
    }
    
    if ($_GET["hum"]) {
    $hum  = $_GET["hum"];
    $sqlh = "UPDATE readings SET value = '$hum' where id=1";
    //$sqlh = "insert into readings (sensor, time_stamp, value) values ('pool_hum',unix_timestamp(),$hum)";
    mysql_query($sqlh);
    }
    
    if ($_GET["both"]) {
    $both  = $_GET["both"];
    $sqlb = "UPDATE readings SET value = '$both' where id=1";
    mysql_query($sqlb);
    }
?>

