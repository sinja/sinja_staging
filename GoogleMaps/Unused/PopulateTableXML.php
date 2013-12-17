<?php
require("../connect1.php");

define("MAPS_HOST", "maps.google.com");
define("KEY", "ABQIAAAAP7O6asA4s-Lj9mxPSov7bBSGsIpmGxgoaT1tVfkemu-_Q469eBSG151AEsZFcAoLHcc0CjU-Hp2omg");

// Select all the rows in the markers table
$query = "SELECT * FROM jos_comprofiler WHERE RetailerStatusId =2 AND cb_storename is not NULL AND cb_storename != '' AND (cb_maplat = '' OR cb_maplat is null) AND cb_storeaddress1 != '' AND cb_storecountry != '' AND cb_storecountry != 'Australia' AND cb_storecountry != 'Canada' AND cb_storecountry != 'Ceská Republika' AND cb_storecountry != 'Sweden' order by cb_storecountry DESC";
$result = mysql_query($query);
if (!$result) {
  die("Invalid query: " . mysql_error());
}

// Initialize delay in geocode speed
$delay = 3000000;
$base_url = "http://" . MAPS_HOST . "/maps/geo?output=xml" . "&key=" . KEY;

// Iterate through the rows, geocoding each address
while ($row = @mysql_fetch_assoc($result)) {
  $geocode_pending = true;

  while ($geocode_pending) {
	$mgadd1 = $row["cb_storeaddress1"];
	$mgcity = $row["cb_storecity"];
	$mgstate = $row["cb_storeprostate"];
	$mgpostalcode = $row["cb_storepost"];
	$mgcountry = $row["cb_storecountry"];
	
	//echo($mgadd1.", ".$mgcity.", ".$mgstate.", ".$mgpostalcode.", ".$mgcountry."<br>");					  
    $address = $mgadd1.", ".$mgcity.", ".$mgstate.", ".$mgpostalcode.", ".$mgcountry;
	
    $id = $row["id"];
    $request_url = $base_url . "&q=" . urlencode($address);
    $xml = simplexml_load_file($request_url) or die("url not loading");

    $status = $xml->Response->Status->code;
    if (strcmp($status, "200") == 0) {
      // Successful geocode
      $geocode_pending = false;
      $coordinates = $xml->Response->Placemark->Point->coordinates;
      $coordinatesSplit = split(",", $coordinates);
      // Format: Longitude, Latitude, Altitude
      $lat = $coordinatesSplit[1];
      $lng = $coordinatesSplit[0];

      $query = sprintf("UPDATE jos_comprofiler " .
             " SET cb_maplat = '%s', cb_maplong = '%s' " .
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
      echo "Address " . $address . " failed to geocoded. ";
      echo "Received status " . $status . "
<br>";
    }
    usleep($delay);
  }
}
?>
