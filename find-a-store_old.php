<? include("connect1.php");
include_once("include/ipinfodb.class.php");

$detectCountry = "";
$detectPostalCode = "";
if($_REQUEST["cb_storecountry"] == "")
{
	$detectCountry = $visitorGeolocation['CountryName'];
	$detectPostalCode = $visitorGeolocation['ZipPostalCode'];
	$detectLat = $visitorGeolocation['Latitude'];
	$detectLong = $visitorGeolocation['Longitude'];
}

$FINDASTORE="Y";
//error_reporting(E_ALL);
$query1_map="";
$recperpg=5;
$pgno=0;
$uomMiles = " Miles";
$uomKms = " Kilometers";
$uom = "";

function DistanceCalc($lat1, $lon1, $lat2, $lon2, $unit)
{ 
  $theta = $lon1 - $lon2; 
  $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)); 
  $dist = acos($dist); 
  $dist = rad2deg($dist); 
  $miles = $dist * 60 * 1.1515;
  $unit = strtoupper($unit);

  if ($unit == $uomKms) {
	return ($miles * 1.609344); 
  } 
/*   else if ($unit == "N") {// Nautical
	  return ($miles * 0.8684);
	}  */
	else {
		return $miles;
	  }
}	
if($_REQUEST["cb_storecountry"] != "")
{
	global $uom;
	$uom = $_REQUEST["cb_storecountry"] == "United States"?$uomMiles:$uomKms;
}
else if($detectCountry != "")
{
	global $uom;
	$uom = $detectCountry == "United States"?$uomMiles:$uomKms;
}
else
{
	global $uom;
	$uom = $uomKms;
}

if(trim($_REQUEST['cb_storecountry'])!="")
{
	if(trim($_REQUEST['cb_storepost'])!="" && trim($_REQUEST['cb_storepost'])!="Zip Code or City" && trim($_REQUEST['cb_storepost'])!="Postal Code or City")	
	{
		$searchzipcode=trim($_REQUEST['cb_storepost']);
	}
	else
	{
		$searchzipcode="";
	}
	//if($searchzipcode!="")
	//{
		if($_REQUEST['distance']!="")
		{
			$distance=$_REQUEST['distance'];
				
			//is km? calculate it			
			if($uom == $uomKms)
				$distance = ($distance / 1.609344);
		}	
		else
		{
			//if($searchzipcode!="")
			//	$distance="20";	
			//else
				$distance="800000000000";		
		}

		//MG: use api to find start location 
		define("MAPS_HOST", "maps.google.com");
		$base_url = "http://" . MAPS_HOST . "/maps/geo?output=csv";
	    
		//what to look for
		$mgpostalcode = $_REQUEST["cb_storepost"];
		$mgcountry = $_REQUEST["cb_storecountry"];
	    $address = $mgpostalcode.", ".$mgcountry;
		
		$request_url = $base_url . "&q=" . urlencode($address);
		$csv = file_get_contents($request_url) or die();
	
		$csvSplit = split(",", $csv);
		$Latitude=$csvSplit[2];
		$Longitude=$csvSplit[3];
		
		if(trim($_REQUEST['cb_storepost'])!="" && trim($_REQUEST['cb_storepost'])!="Zip Code or City" && trim($_REQUEST['cb_storepost'])!="Postal Code or City" )
		{
			if($Latitude=="" && $Longitude=="")
			{
				$AndQry.=" and cb_storepost='".trim(mysql_real_escape_string($_REQUEST['cb_storepost']))."'";
			}	
		}
		if(trim($_REQUEST['cb_storecountry'])!="" && trim($_REQUEST['cb_storecountry'])!="NULL" )
		{
				$AndQry.=" and Countries.CountryName ='".trim(mysql_real_escape_string($_REQUEST['cb_storecountry']))."'";				
		}
		if(trim($_REQUEST['collection'])!="")
		{
			$AndQry.=" and `".mysql_real_escape_string(trim($_REQUEST['collection']))."`='Yes'";
		}
		else
		{
			$AndQry.=" and (cb_sin='Yes' or cb_sip='Yes')";
		}
		
			 $FindStoreQry="SELECT cb_maplat, cb_maplong, cb_storename,cb_storeaddress1,cb_storecity,cb_storeprostate,cb_storepost, CountryName as cb_storecountry,cb_storephone,cb_storewebsite,cb_sin,cb_sip 
						,( 3959 * acos( cos( radians('$Latitude') ) * cos( radians( cb_maplat ) ) * cos( radians( cb_maplong ) - radians('$Longitude') ) + sin( radians('$Latitude') ) * sin( radians( cb_maplat ) ) ) ) AS distance 	
						FROM jos_comprofiler 
						INNER JOIN Countries on jos_comprofiler.CountryId = Countries.CountryId
						WHERE Approved=1 AND cb_storename is not NULL AND cb_storename != '' AND cb_maplat != '' AND cb_maplong != '' $AndQry HAVING distance < '$distance' ORDER BY distance";
						
			$FindStoreQryRs2=mysql_query($FindStoreQry);
			$FindStoreQryRs=mysql_query($FindStoreQry);
			$TotFindStore=mysql_affected_rows();			
			
		if($TotFindStore>0)
		{
			$FindStoreQryRs2=$prs_pageing->number_pageing_nodetail_ja($FindStoreQry,12,10,"Y","Y");
			$FindStoreQryRs3=$prs_pageing->number_pageing_nodetail_ja($FindStoreQry,12,10,"Y","Y");
		}
//	}
}
else if($detectCountry !="")//Automatic detection
{
	$searchzipcode="";
	$distance="20";	

		$Latitude=$detectLat;
		$Longitude=$detectLong;

		if(trim($_REQUEST['collection'])!="")
		{
			$AndQry.=" and `".mysql_real_escape_string(trim($_REQUEST['collection']))."`='Yes'";
		}
		else
		{
			$AndQry.=" and (cb_sin='Yes' or cb_sip='Yes')";
		}
		
		 $FindStoreQry="SELECT cb_maplat, cb_maplong, cb_storename,cb_storeaddress1,cb_storecity,cb_storeprostate,cb_storepost,CountryName as cb_storecountry,cb_storephone,cb_storewebsite,cb_jab,cb_jap,cb_jas 
					,( 3959 * acos( cos( radians('$Latitude') ) * cos( radians( cb_maplat ) ) * cos( radians( cb_maplong ) - radians('$Longitude') ) + sin( radians('$Latitude') ) * sin( radians( cb_maplat ) ) ) ) AS distance 	
					FROM jos_comprofiler 
						INNER JOIN Countries on jos_comprofiler.CountryId = Countries.CountryId
					WHERE Approved=1 AND cb_storename is not NULL AND cb_storename != '' AND cb_maplat != '' AND cb_maplong != '' $AndQry HAVING distance < '$distance' ORDER BY distance";
					

		$FindStoreQryRs2=mysql_query($FindStoreQry);
		$FindStoreQryRs=mysql_query($FindStoreQry);
		$TotFindStore=mysql_affected_rows();			
			
		if($TotFindStore>0)
		{
			$FindStoreQryRs2=$prs_pageing->number_pageing_nodetail_ja($FindStoreQry,12,10,"Y","Y");
			$FindStoreQryRs3=$prs_pageing->number_pageing_nodetail_ja($FindStoreQry,12,10,"Y","Y");
		}
}
else
{
		if(trim($_REQUEST['cb_storepost'])!="" && trim($_REQUEST['cb_storepost'])!="Zip Code or City" && trim($_REQUEST['cb_storepost'])!="Postal Code or City" )
		{
			$AndQry.=" and cb_storepost='".trim(mysql_real_escape_string($_REQUEST['cb_storepost']))."'";
		}
		if(trim($_REQUEST['cb_storecountry'])!="" && trim($_REQUEST['cb_storecountry'])!="NULL" )
		{
			$AndQry.=" and Countries.CountryName='".trim(mysql_real_escape_string($_REQUEST['cb_storecountry']))."'";
		}
		if(trim($_REQUEST['collection'])!="")
		{
			$AndQry.=" and `".mysql_real_escape_string(trim($_REQUEST['collection']))."`='Yes'";
		}
		else
		{
			$AndQry.=" and (cb_sin='Yes' or cb_sip='Yes')";
		}

		$FindStoreQry="SELECT cb_maplat, cb_maplong,cb_storename,cb_storeaddress1,cb_storecity,cb_storeprostate,cb_storepost,CountryName as cb_storecountry,cb_storephone,cb_storewebsite,cb_sin,cb_sip
					   FROM jos_comprofiler 
					   						INNER JOIN Countries on jos_comprofiler.CountryId = Countries.CountryId
					   WHERE Approved=1 AND cb_maplat != '' AND cb_maplong != '' $AndQry order by cb_storename asc";		
		$FindStoreQryRs=mysql_query($FindStoreQry);
		$TotFindStore=mysql_affected_rows();
		
		if($TotFindStore>0)
		{
			$FindStoreQryRs2=$prs_pageing->number_pageing_nodetail_ja($FindStoreQry,12,10,"Y","Y");
			$FindStoreQryRs3=$prs_pageing->number_pageing_nodetail_ja($FindStoreQry,12,10,"Y","Y");
		}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?=$SITE_TITLE;?></title>
<meta name="description" content="<?=$META_KEYWORD;?>" />
<meta name="keywords" content="<?=$META_DESC;?>" />
<meta name="robots" content="INDEX,FOLLOW" />
<link href="css/sincerity.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/iepngfix_tilebg.js"></script>
<style type="text/css">
img, div, input ,td{ behavior: url("iepngfix.htc") }
</style>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script> 
<script type="application/javascript">
var geocoder = new google.maps.Geocoder();			
var map;
var latlng;
var infoWindow = new google.maps.InfoWindow();
var markerBounds = new google.maps.LatLngBounds();

//Load the map. 
function InitGMap()
{
	 //Load the map
	var myOptions = {
					zoom: 1,
					mapTypeId: google.maps.MapTypeId.ROADMAP
				};
				
	map = new google.maps.Map(document.getElementById("gmap"), myOptions);
	map.setCenter(new google.maps.LatLng(37.4419, -122.1419));
}
//Add marker, also load an infowindow
function MarkAddress(lat, lang, coname, address, phone, miles) 
{
	latlng = new google.maps.LatLng(lat, lang);
	
	//map.setCenter(latlng);
	var marker = new google.maps.Marker
	(
		{
			map: map, 
			title: unescape(coname),
			position: latlng
		}
	);
	
	//add to the marker bound. Ensuring that we show as many markers as possible when done.
	markerBounds.extend(latlng);
	
	google.maps.event.addListener(marker, 'click', function()
																{
																	infoWindow.setContent("<div style='width:200px;height:100px;color:#000000;'><div><strong>"+ unescape(coname) + "</strong></div><div>"+ unescape(address) + "</div><div>" +unescape(phone)+ "</div><br><div>" + miles+" <?= $uom ?></div></div>");
																 	infoWindow.open(map,marker);
																}
															);											
}
</script>
</head>
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left" valign="top"><? include("top.php");?></td>
  </tr>
  <tr>
    <td align="left" valign="top"><table width="1164" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="221" align="left" valign="top"><? include("left.php");?></td>
                <td align="left" valign="top"><table width="850" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                      <td align="center" valign="top" class="gra_border1"><table width="840" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td align="left" valign="top" class="font-12-gra"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td height="50" align="left" valign="middle">
								  <form name="FrmFilterRetailer" id="FrmFilterRetailer" enctype="multipart/form-data" method="get">
								  <?  if(trim($_REQUEST['cb_storepost'])!="" && trim($_REQUEST['cb_storepost'])!="Postal Code or City" ){$ZIP=trim($_REQUEST['cb_storepost']);}else{$ZIP="Postal Code or City";} ?>
                                 <?  
								 if($_REQUEST["cb_storecountry"] == "")
								 {
									 ?>
                                     <div class="font-12-gra">
                                     <p>
                                     <b>Find a Store Near You</b>
                                     <br />
Narrow your search results by selecting a Country, Postal Code, Distance, and Collection from the filters below.
									</p>
									</div>
                                     <?
									 }
									 ?>
								  <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                      <tr>
                                        <td width="50" align="left" valign="middle" class="font-12-gra">Filter by:&nbsp;</td>
                                        <td align="left" valign="middle">
										<select name="cb_storecountry" class="text_field1" id="cb_storecountry" onchange="HideShowDistance(this.value);">
											<option value="">Country</option>
											<? 
											$nameField = "";
											
											if($_SESSION['SESSION_LANGUAGE']=="ESP")
											{$nameField = "CountryName"; }
					  else if($_SESSION['SESSION_LANGUAGE']=="NED")
											{$nameField = "CountryNameDutch"; }
					  else if($_SESSION['SESSION_LANGUAGE']=="PL")
											{$nameField = "CountryNamePolish"; }
					  else if($_SESSION['SESSION_LANGUAGE']=="GER")
											{$nameField = "CountryNameGerman"; }
						  else
											{$nameField = "CountryName"; }
                      
												$GETCountryQry="SELECT DISTINCT 
    Countries.$nameField,Countries.CountryName 
FROM 
    Countries
INNER JOIN jos_comprofiler on jos_comprofiler.CountryId = Countries.CountryId
WHERE  
    jos_comprofiler.Approved=1
	and (cb_sin='Yes' or cb_sip='Yes') 
	and (GeocodeFailed != 1 OR GeocodeFailed is null)
	order by 
    Countries.$nameField asc";

												$GETCountryQryRs=mysql_query($GETCountryQry);
												$TotGETCountry=mysql_affected_rows();
												
												if($TotGETCountry>0)
												{
													for($CC=0;$CC<$TotGETCountry;$CC++)
													{
														$GETCountryQryRow=mysql_fetch_array($GETCountryQryRs);
														?>
														<option value="<?=stripslashes($GETCountryQryRow['CountryName']);?>" <? if(stripslashes($GETCountryQryRow['CountryName'])==$_REQUEST['cb_storecountry']){echo "selected";}?>><?=stripslashes($GETCountryQryRow[$nameField]);?></option>
														<?	
													}
												}
											?>
											
										</select></td>
										<? if(trim($_REQUEST['cb_storecountry'])==""){$STYL="display:none";}else{$STYL="display:inline";}?>
                                        <td align="left" valign="middle" ><span id="postalcode_ID" style="<? echo $STYL; ?>" ><input type="text" id="cb_storepost" name="cb_storepost" class="text_field3" onfocus="SetPostalZip(true);" onblur="SetPostalZip(false);" value="<?=$ZIP;?>" /></span>&nbsp;</td>
                                        <td align="left" valign="middle" ><span id="distance_ID" style="<? echo $STYL; ?>" ><select  name="distance" class="text_field3" id="distance"><option value="">Distance</option><option value="10" <? if($_REQUEST['distance']==10){echo "selected";}?>>10 Miles</option><option value="20" <? if($_REQUEST['distance']==20){echo "selected";}?>>20 Miles</option><option value="50" <? if($_REQUEST['distance']==50){echo "selected";}?>>50 Miles</option><option value="800000000000" <? if($_REQUEST['distance']==800000000000){echo "selected";}?>>Over 50 Miles</option></select></span>&nbsp;</td>
                                        <td width="40" align="left" valign="middle">&nbsp;</td>
                                        <td align="right" valign="middle" class="font-12-gra">Collection:&nbsp;</td>
                                        <td align="right" valign="middle" width="175"><select name="collection" class="text_field1" id="collection"><option value="">ALL</option><option value="cb_sin" <? if($_REQUEST['collection']=="cb_sin"){echo "selected";}?>>SINCERITY</option><option value="cb_sip" <? if($_REQUEST['collection']=="cb_sip"){echo "selected";}?>>SINCERITY+</option></select></td>
                                        <td align="right" valign="middle"><input name="Srchbtn" type="image" id="Srchbtn" value="Submit" src="images/search_btn.gif" /></td>
                                      </tr>
                                    </table>
								  </form>
                                  <br />
								  </td>
                                </tr>
                                <tr>
                                  <td align="left" valign="top" class="bor_top_botm">
								  <div id="gmap" class="gray12" style="width: 840px; height: 349px"></div>
                                  <script type="text/javascript"> 
									 //Load the map
									InitGMap();
								</script>
                                  </td>
                                </tr>
                                <tr>
                                  <td align="left" valign="top">&nbsp;</td>
                                </tr>
                              </table></td>
                          </tr>
                          <tr>
                            <td align="left" valign="top" class="font-12-gra"><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
                                <tr>
                                  <td height="35" align="left" valign="top" class="font-14"><strong>STORES AROUND YOUR AREA:</strong></td>
                                </tr>
								<?
								
								if($TotFindStore>0)
								{
								?>
                                <tr>
                                  <td align="left" valign="top"><table width="100%" border="0" cellpadding="3" cellspacing="0">
                                      <?
									  //$FindStoreQryRs2=$prs_pageing->number_pageing_nodetail_ja($FindStoreQry,6,5,"Y","Y");
									  $count = 0;
									  while($FindStoreQryRow =mysql_fetch_array($FindStoreQryRs3[0]))
									  {
										if($count%3==0 && $count!=0){echo "</tr><tr><td>&nbsp;</td></tr><tr>";}
							   ?>  
                                        <td width="33%" align="left" valign="top" class="font-12-gra" ><?=stripslashes($FindStoreQryRow['cb_storename']);?> 
                                        <div id="ad<?= $count; ?>" name="ad<?= $count; ?>">
                                          <?=stripslashes($FindStoreQryRow['cb_storeaddress1']);?> <br />
                                          <? if($FindStoreQryRow['cb_storecity']!="" || $FindStoreQryRow['cb_storeprostate']!="" || $FindStoreQryRow['cb_storepost']!=""){?>
										 	 <? if($_SESSION['SESSION_COUNTRY']=="5"){?>
												<?=stripslashes($FindStoreQryRow['cb_storepost']);?><? if($FindStoreQryRow['cb_storecity']!=""){?>,<? } ?> <?=stripslashes($FindStoreQryRow['cb_storecity']);?><? if($FindStoreQryRow['cb_storeprostate']!=""){?>,<? } ?> <?=stripslashes($FindStoreQryRow['cb_storeprostate']);?><br />
											 <? }else{?>	 
											 	<?=stripslashes($FindStoreQryRow['cb_storecity']);?><? if($FindStoreQryRow['cb_storeprostate']!=""){?>,<? } ?> <?=stripslashes($FindStoreQryRow['cb_storeprostate']);?><? if($FindStoreQryRow['cb_storepost']!=""){?>,<? } ?> <?=stripslashes($FindStoreQryRow['cb_storepost']);?> <br />
											 <? } ?>
										  <? } ?>	 
                                          </div>
                                          <?=stripslashes($FindStoreQryRow['cb_storecountry']);?> <br />
                                         <?php /*?> DISTANCE <br /><?php */?>
                                          <? if($FindStoreQryRow['cb_storephone']!="" && $FindStoreQryRow['cb_storephone']!="Phone Number"){?>T: <?=stripslashes($FindStoreQryRow['cb_storephone']);?> <br />
                                          <? }?>
                                          <? if($FindStoreQryRow['cb_storewebsite']!=""){?><a href="<? echo WebsiteWithProperUrl(stripslashes($FindStoreQryRow['cb_storewebsite']));?>" style="color:#FFFFFF;" target="_blank"><?=stripslashes($FindStoreQryRow['cb_storewebsite']);?></a> <br /><? }?>
										  <? 
										  $COL="";
										  if($FindStoreQryRow['cb_sin']=="Yes" || $FindStoreQryRow['cb_sip']=="Yes"){?>
											  Collections Carried: <br />
											  <? if($FindStoreQryRow['cb_sin']=="Yes"){$COL.= "Sincerity, ";}?>
											  <? if($FindStoreQryRow['cb_sip']=="Yes"){$COL.="Sincerity+, ";}?>
											  <? echo substr($COL,0,-2);?>
										  <? } ?>
										</td>
                                        <script type="text/javascript">	
										//Read the content of the div. No need to use a serveside var here 
										var dv = document.getElementById("ad<?= $count; ?>");
	
											//add the marker
											MarkAddress(<?=stripslashes($FindStoreQryRow['cb_maplat']);?>, <?=stripslashes($FindStoreQryRow['cb_maplong']);?>, escape("<?=stripslashes($FindStoreQryRow['cb_storename']);?>"), escape(dv.innerHTML), escape("<?=stripslashes($FindStoreQryRow['cb_storephone']);?>"), '<?= number_format(DistanceCalc( stripslashes($FindStoreQryRow['cb_maplat']), stripslashes($FindStoreQryRow['cb_maplong']), $Latitude, $Longitude, $uom), 2)?>');						
                                        </script>
                                      <? $count++; } ?>
									 </table></td>
                                </tr>
								<tr><td>&nbsp;</td></tr>
								<tr>
									<td align="left" valign="top" class="gra_border1" ><?=$FindStoreQryRs2[1];?></td>
								</tr>
								<? } else{?>
									<tr><td height="150" valign="middle" align="center" class="font-12-gra">No Retailers Found</td></tr>
								<? } ?>
                                <tr>
                                  <td align="left" valign="top">&nbsp;</td>
                                </tr>
                              </table></td>
                          </tr>
                        </table></td>
                    </tr>
                  </table></td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td height="35" align="center" valign="top">&nbsp;</td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td align="center" valign="top"><? include("footer.php");?></td>
  </tr>
</table>
<script type="application/javascript">
if(map && markerBounds && !markerBounds.isEmpty())
{
	map.fitBounds(markerBounds);
}
</script>
<script language="javascript" type="text/javascript">
function ReplaceUOM()
{
	var ctry = document.getElementById("cb_storecountry");
	var ddlUom = document.getElementById("distance");
	var uomMiles = " Miles";
	var uomKms = " Kilometers"; 
	var originalText;
	var replaceText;
	
	if(ctry.value == 'United States')
	{
		originalText = uomKms;
		replaceText = uomMiles;
	}
	else
	{
		originalText = uomMiles;
		replaceText = uomKms;
	}
	
	if(ddlUom != null)
	{
		for (var i=0; i < ddlUom.length; i++)
		{
			ddlUom.options[i].text = ddlUom.options[i].text.replace(originalText, replaceText);
		}
	}
}
function HideShowDistance(cname)
{
	var ctry = document.getElementById("cb_storecountry");
	var zipField = document.getElementById("cb_storepost");
	
	if(zipField != null)
	{
		zipField.value='';
	}
//	if(cname=="United States" || cname=="USA" || cname=="United State" || cname=="usa")

	if(ctry.selectedIndex != 0)
	{
		document.getElementById('distance_ID').style.display='inline';		
		document.getElementById('postalcode_ID').style.display='inline';	
		SetPostalZip(false);	
		
		ReplaceUOM();
	}
	else
	{
		document.getElementById('distance_ID').style.display='none';	
		document.getElementById('postalcode_ID').style.display='none';		
		
		ResetPostalZip();
		//document.getElementById('distance').value='';		
		//document.getElementById('cb_storepost').value='';		
	}
	
	//post the form
	var frm = document.getElementById('FrmFilterRetailer');
	if(frm != null)
	{
		frm.submit();
	}
}
function ResetPostalZip()
{
	var ctry = document.getElementById("cb_storecountry");
	var zipField = document.getElementById("cb_storepost");

	if(zipField != null && ctry != null)
	{
		if(ctry.value == 'United States')
			zipField.value='Zip Code or City';
		else
			zipField.value='Postal Code or City';
	}
}
function SetPostalZip(isFocus)
{
	var ctry = document.getElementById("cb_storecountry");
	var zipField = document.getElementById("cb_storepost");

	if(zipField != null && ctry != null)
	{
		if(isFocus)
		{
			if(zipField.value=='Postal Code or City' | zipField.value=='Zip Code or City')
			{
				zipField.value='';
			}
		}
		else
		{
			if(zipField.value == '' | zipField.value=='Postal Code or City' | zipField.value=='Zip Code or City')
			{
				if(ctry.value == 'United States')
					zipField.value='Zip Code or City';
				else
					zipField.value='Postal Code or City';
			}
		}
	}
}
</script>
<script>ReplaceUOM();</script>
<? include("googleanalytic.php");?>
</body>
</html>