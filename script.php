<?php
 require_once __DIR__ . '/db.php';
 echo "conncected";

 $dbhandle = mysql_connect(DB_SERVER, DB_USER, DB_PASSWORD) or die(mysql_error());
 mysql_select_db(DB_DATABASE);
 	echo 'success';
 	$name = $_GET['name'];
 	$lat = $_GET['lat'];
 	$long = $_GET['long'];
 	$loc = $_GET['loc'];
 	$sql1 = "SELECT dest_users FROM tbl_destination WHERE dest_name='$loc';";
 	$sqllong = mysql_query("SELECT dest_long FROM tbl_destination WHERE dest_name='$loc';");
 	$sqllat = mysql_query("SELECT dest_lat FROM tbl_destination WHERE dest_name='$loc';");
 	$enter = mysql_query($sql1,$dbhandle);
 	$row = mysql_fetch_array($enter, MYSQL_ASSOC);
 	$row_long = mysql_fetch_array($sqllong,MYSQL_ASSOC);
 	$row_lat = mysql_fetch_array($sqllat,MYSQL_ASSOC);
 	if($row==null)
 		{	echo 'here the';
 			//$sql2 = mysql_query('INSERT INTO tbl_destination(dest_name,dest_long,dest_lat,dest_users) VALUES('.$loc.','.$long.','.$lat.','.$name.',);');
 			$sql2 = mysql_query("INSERT INTO tbl_destination(dest_name,dest_long,dest_lat,dest_users) VALUES('$loc','$long','$lat','$name');");
 			
 		}
 		else
 		{	
 			//$row = mysql_fetch_array($enter, MYSQL_ASSOC);
 			
 			foreach ($row as $value) {
 				$value = $value.';'.$name;
 				break;
 			}
 			foreach ($row_long as $valuelo) {
 				$valuelo = $valuelo.';'.$long;
 				break;
 			}
 			foreach ($row_lat as $valuela) {
 				$valuela = $valuela.';'.$lat;
 				break;
 			}
 			$sql3 = "UPDATE tbl_destination SET dest_users = '$value',dest_lat = '$valuela',dest_long = '$valuelo' WHERE dest_name = '$loc';";
 			$fin = mysql_query($sql3,$dbhandle);
 			
 			
 		}
	mysql_close($dbhandle);
?>