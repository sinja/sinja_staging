<?php
require("../connect1.php");

define("MAPS_HOST", "maps.google.com");

// Select all the rows in the table needed to be geocoded
//NEW ITEMS THAT HAVENT FAILED CODING
//$query = "SELECT * FROM jos_comprofiler WHERE RetailerStatusId = 2 AND cb_storename is not NULL AND cb_storename != '' AND (cb_maplat = '' OR cb_maplat is null) AND cb_storeaddress1 != '' AND cb_storecountry != '' AND (GeocodeFailed != 1 OR GeocodeFailed is null) order by cb_storecountry ASC";
//ITEMS THAT HAVE FAILED CODING
$query = "SET NAMES 'utf8'";
mysql_query($query);

$query = "SET CHARACTER SET 'utf8'";
mysql_query($query); 

$query = "SELECT * FROM jos_comprofiler WHERE RetailerStatusId = 2 AND cb_storename is not NULL AND cb_storename != '' AND (cb_maplat = '' OR cb_maplat is null) AND cb_storeaddress1 != '' AND cb_storecountry != '' AND GeocodeFailed = 1 order by cb_storecountry ASC";
$result = mysql_query($query);
if (!$result) {
  die("Invalid query: " . mysql_error());
}

// Initialize delay in geocode speed
$delay = 1000000;
$base_url = "http://" . MAPS_HOST . "/maps/geo?output=csv";// . "&key=" . KEY;

mysql_set_charset('utf8'); 
$charset = mysql_client_encoding();
echo "The current character set is: $charset\n";

// Iterate through the rows, geocoding each address
while ($row = @mysql_fetch_assoc($result)) {
  $geocode_pending = true;

  while ($geocode_pending) {
	$mgadd1 = utf8_decode($row["cb_storeaddress1"]);
	$mgcity = utf8_decode($row["cb_storecity"]);
	$mgstate = utf8_decode($row["cb_storeprostate"]);
	$mgpostalcode = utf8_decode($row["cb_storepost"]);
	$mgcountry = utf8_decode($row["cb_storecountryEnglish"]);
		
	//echo($mgadd1.", ".$mgcity.", ".$mgstate.", ".$mgpostalcode.", ".$mgcountry."<br>");
    $address = $mgadd1.", ".$mgcity.", ".$mgstate.", ".$mgpostalcode.", ".$mgcountry;
	$addressEncode = rawurlencode(utf8_encode($address));
	
    $id = $row["id"];
    $request_url = $base_url . "&q=" . $addressEncode;
	echo("<b>Loading address</b> ".$address."<br>");
	echo("Requested url is $request_url <br>");
    $csv = file_get_contents($request_url) or die("url not loading");
    $csvSplit = split(",", $csv);
    $status = $csvSplit[0];
    $lat = $csvSplit[2];
    $lng = $csvSplit[3];
	echo("Response received of status ".$status."<br>");
		
    if (strcmp($status, "200") == 0) {
      // successful geocode
      $geocode_pending = false;
      $lat = $csvSplit[2];
      $lng = $csvSplit[3];

      $query = sprintf("UPDATE jos_comprofiler " .
             " SET cb_maplat = '%s', cb_maplong = '%s', GeocodeFailed = 0 " .
             " WHERE id = '%s' LIMIT 1;",
             mysql_real_escape_string($lat),
             mysql_real_escape_string($lng),
             mysql_real_escape_string($id));
      $update_result = mysql_query($query);
      if (!$update_result) {
        die("Invalid query: " . mysql_error());
      }
    } else if (strcmp($status, "620") == 0) {
      // sent geocodes too fast
      $delay += 100000;
    } else {
      // failure to geocode
      $geocode_pending = false;
      echo "Address " . $address . " <b>failed to be geocoded.</b> <br>";
      echo "Received status " . $status . "
<br><br>";

		$query = sprintf("UPDATE jos_comprofiler " .
             " SET GeocodeFailed = 1 " .
             " WHERE id = '%s' LIMIT 1;",
             mysql_real_escape_string($id));
      $update_result = mysql_query($query);
      if (!$update_result) {
        die("Invalid query: " . mysql_error());
      }
    } 
    usleep($delay);
  }
}
?>