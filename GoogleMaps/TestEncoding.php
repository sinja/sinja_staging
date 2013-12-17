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

$query = "SELECT * FROM jos_comprofiler WHERE RetailerStatusId = 2 AND cb_storename is not NULL AND cb_storename != '' AND (cb_maplat = '' OR cb_maplat is null) AND cb_storeaddress1 != '' AND cb_storecountry != '' AND GeocodeFailed = 1 and cb_storeaddress1 like '%Hinderstorps%' order by cb_storecountry ASC";
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

    $address = $mgadd1.", ".$mgcity.", ".$mgstate.", ".$mgpostalcode.", ".$mgcountry;
	$addressEncode = rawurlencode(utf8_encode($address));
	//$myencode = urlencode("Hinderstorps Gränd 20 B, Spaanga, , 16372, Sweden");
	$myencode = rawurlencode(utf8_encode("Hinderstorps Gränd 20 B, Spaanga, , 16372, Sweden"));

	$request_url = $base_url . "&q=" . $addressEncode;
	
	echo("<p>
		 <b>Request URL:</b> $request_url <br>
		 <b>Read address is:</b> $address <br> 
		 <b>Encoded address is:</b> $addressEncode<br>
		 <b> My Address is:</b> Hinderstorps Gränd 20 B, Spaanga, , 16372, Sweden<br>
		 <b>Raw my encode is:</b> $myencode<br>
		 <b>This works:</b> Hinderstorps%20Gr%C3%A4nd%2020%20B%2C%20Spaanga%2C%20%2C%2016372%2C%20Sweden <br>
		 <b>Expected code is:</b> Hinderstorps+Gr%c3%a4nd+20+B%2c+Spaanga%2c+%2c+16372%2c+Sweden
		 </p>");
	
	$geocode_pending = false;
  }
}
?>