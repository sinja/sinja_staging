<?php
	final class ipinfodb{
	protected $errors = array();
	protected $showTimezone = false;
	protected $service = 'api.ipinfodb.com';
	protected $version = 'v3';
	protected $apiKey = '1f965598a93860de49e425cf7ca875d28a3c9c7f41d785039ab0d8419a1695a3';

	public function __construct(){}

	public function __destruct(){}

	public function setKey($key){
		if(!empty($key)) $this->apiKey = $key;
	}

	public function showTimezone(){
		$this->showTimezone = true;
	}

	public function getError(){
		return implode("\n", $this->errors);
	}

	public function getGeoLocation($host){
		$ip = @gethostbyname($host);

					if(preg_match('/^(?:25[0-5]|2[0-4]\d|1\d\d|[1-9]\d|\d)(?:[.](?:25[0-5]|2[0-4]\d|1\d\d|[1-9]\d|\d)){3}$/', $ip)){
			$xml = file_get_contents('http://' . $this->service . '/' . $this->version . '/' . 'ip-city.php?key=' . $this->apiKey . '&ip=' . $ip . '&format=xml');
print ('<br />' . htmlentities($xml));
			//try{
				$response = new SimpleXMLElement($xml);

				foreach($response as $field=>$value){
					$result[(string)$field] = (string)$value;
				}
				print('<hr />Return $result:<br />');
				var_dump($result);
				return $result;
		//	}
		//	catch(Exception $e){
		//		$this->errors[] = $e->getMessage();
		//		return;
		//	}
		}

		$this->errors[] = '"' . $host . '" is not a valid IP address or hostname.';
		return;
	}
}

/*
EXAMPLE OF RESPONSE
Status : OK
CountryCode : US
CountryName : United States
RegionCode : 36
RegionName : New York
City : New York
ZipPostalCode : 10012
Latitude : 40.7267
Longitude : -73.9981
Gmtoffset : 0
Dstoffset : 0
TimezoneName :
Isdst :
Ip : 184.74.162.98
*/
$visitorGeolocation;

//Set geolocation cookie
var_dump($_COOKIE['geolocation']);
if(!$_COOKIE["geolocation"])
{
  $ipinfodb = new ipinfodb;
 
  $visitorGeolocation = $ipinfodb->getGeoLocation($_SERVER['REMOTE_ADDR']);
  if ($visitorGeolocation['statusCode'] == 'OK') 
  {
    $data = base64_encode(serialize($visitorGeolocation));
	print('<hr />' . $data . '<hr />');
    setcookie("geolocation", $data, time()+3600*24*7); //set cookie for 1 week
  }
}
else
{
  $visitorGeolocation = unserialize(base64_decode($_COOKIE["geolocation"]));
}

$detectCountry = $visitorGeolocation['countryName'];
    $detectPostalCode = $visitorGeolocation['zipCode'];
    $detectLat = $visitorGeolocation['latitude'];
    $detectLong = $visitorGeolocation['longitude'];

	var_dump($detectCountry);
	var_dump($detectLong);
var_dump($detectLat);
?>
<br />
This is geotest.php
