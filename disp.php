<?php
	require_once __DIR__ . '/db.php';

  $dbhandle = mysql_connect(DB_SERVER, DB_USER, DB_PASSWORD) or die(mysql_error());
 mysql_select_db(DB_DATABASE);

// check for post data
if (isset($_GET["dest"])) {
    $dest = $_GET['dest'];
 	
    // get a dest from destination table
    $result = mysql_query("SELECT * FROM tbl_destination WHERE dest_name = '$dest';");
	if (!empty($result)) {
		
        // check for empty result
        if (mysql_num_rows($result) > 0) {
 
            $result = mysql_fetch_array($result);
            $product = array();
            $product["dest_name"] = $result["dest_name"];
            $product["dest_long"] = $result["dest_long"];
            $product["dest_lat"] = $result["dest_lat"];
            $product["dest_users"] = $result["dest_users"];
            // success
             $arr[] = array('dest_name' => $result["dest_name"],'dest_long' => $result["dest_long"],
             'dest_lat' => $result["dest_lat"],'dest_users' => $result["dest_users"],    );
        
 
            
            
            // echoing JSON response
            echo json_encode($arr);
        }
    }
}


?>