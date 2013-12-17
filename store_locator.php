<?php

include("./connect1.php");
include_once("include/ipinfodb.class.php");

$order_by = "distance";
$detectCountry = "";
$detectPostalCode = "";
if(empty($_REQUEST["cb_storecountry"]))
{
	$detectCountry = $visitorGeolocation['CountryName'];
	$detectPostalCode = $visitorGeolocation['ZipPostalCode'];
	$detectLat = $visitorGeolocation['Latitude'];
	$detectLong = $visitorGeolocation['Longitude'];
}else{
	$order_by = "cb_storename";
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

function selectCountry(){
	?>
	<select name="cb_storecountry" id="cb_storecountry" onChange="HideShowDistance(this.value);">
      <option value=""><?php e_strt('Select Your Country');?></option>
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
      <option value="<?=stripslashes($GETCountryQryRow['CountryName']);?>" <? if(stripslashes($GETCountryQryRow['CountryName'])==$_REQUEST['cb_storecountry']){echo "selected";}?>>
        <?=stripslashes($GETCountryQryRow[$nameField]);?>
        </option>
      <?	
                }
            }
        ?>
    </select>
    <?php 
}
function putGMap(){
?>
	<div id="gmap" class="gray12" style="width:782px;height:349px"></div>
	<script type="text/javascript"> 
         //Load the map
        InitGMap();
    </script>
<?php	
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
		$base_url = "http://" . MAPS_HOST . "/maps/geo?output=csv&sensor=false";
		
	    
		//what to look for
		$mgpostalcode = $_REQUEST["cb_storepost"];
		$mgcountry = $_REQUEST["cb_storecountry"];
	    $address = $mgpostalcode.", ".$mgcountry;
		
//		if($mgcountry == "United States")
	//		$base_url = $base_url."&g1=us";
		
		$request_url = $base_url . "&q=" . urlencode($address);
		$csv = file_get_contents($request_url) or die();
	
		$csvSplit = split(",", $csv);
		$Latitude=$csvSplit[2];
		$Longitude=$csvSplit[3];
		
		if(trim($_REQUEST['cb_storepost'])!="" && trim($_REQUEST['cb_storepost'])!="Zip Code or City" && trim($_REQUEST['cb_storepost'])!="Postal Code or City" )
		{
			$order_by = "distance";
			if($Latitude=="" && $Longitude=="")
			{
				$AndQry.=" and cb_storepost='".trim(mysql_real_escape_string($_REQUEST['cb_storepost']))."'";
			}	
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
		
			 $FindStoreQry="SELECT jos_comprofiler.id as jid,cb_maplat, cb_maplong, cb_storename,cb_storeaddress1,cb_storecity,cb_storeprostate,cb_storepost,CountryName as cb_storecountry,cb_storephone,cb_storewebsite,cb_sin,cb_sip
						,( 3959 * acos( cos( radians('$Latitude') ) * cos( radians( cb_maplat ) ) * cos( radians( cb_maplong ) - radians('$Longitude') ) + sin( radians('$Latitude') ) * sin( radians( cb_maplat ) ) ) ) AS distance 	
						FROM jos_comprofiler 
												INNER JOIN Countries on jos_comprofiler.CountryId = Countries.CountryId
						WHERE Approved=1 AND cb_storename is not NULL AND cb_storename != '' AND cb_maplat != '' AND cb_maplong != '' $AndQry HAVING distance < '$distance' ORDER BY $order_by";
			$FindStoreQryRs2=mysql_query($FindStoreQry);
			$FindStoreQryRs=mysql_query($FindStoreQry);
			$TotFindStore=mysql_affected_rows();			
			
		if($TotFindStore>0)
		{
			$FindStoreQryRs2=$prs_pageing->number_pageing_nodetail_ja($FindStoreQry,12,8,"Y","Y");
			$FindStoreQryRs3=$prs_pageing->number_pageing_nodetail_ja($FindStoreQry,12,8,"Y","Y");
		}
//	}
}
else if($detectCountry !="")//Automatic detection
{
	$searchzipcode="";
	$distance="2000";		

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
		
		 $FindStoreQry="SELECT jos_comprofiler.id as jid,cb_maplat, cb_maplong, cb_storename,cb_storeaddress1,cb_storecity,cb_storeprostate,cb_storepost,CountryName as cb_storecountry,cb_storephone,cb_storewebsite,cb_sin,cb_sip 
					,( 3959 * acos( cos( radians('$Latitude') ) * cos( radians( cb_maplat ) ) * cos( radians( cb_maplong ) - radians('$Longitude') ) + sin( radians('$Latitude') ) * sin( radians( cb_maplat ) ) ) ) AS distance 	
					FROM jos_comprofiler 
						INNER JOIN Countries on jos_comprofiler.CountryId = Countries.CountryId
					WHERE Approved=1 AND cb_storename is not NULL AND cb_storename != '' AND cb_maplat != '' AND cb_maplong != '' $AndQry HAVING distance < '$distance' ORDER BY $order_by";
					

		$FindStoreQryRs2=mysql_query($FindStoreQry);
		$FindStoreQryRs=mysql_query($FindStoreQry);
		$TotFindStore=mysql_affected_rows();			
			
		if($TotFindStore>0)
		{
			$FindStoreQryRs2=$prs_pageing->number_pageing_nodetail_ja($FindStoreQry,12,8,"Y","Y");
			$FindStoreQryRs3=$prs_pageing->number_pageing_nodetail_ja($FindStoreQry,12,8,"Y","Y");
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
		
		$FindStoreQry="SELECT jos_comprofiler.id as jid,cb_maplat, cb_maplong,cb_storename,cb_storeaddress1,cb_storecity,cb_storeprostate,cb_storepost,CountryName as cb_storecountry,cb_storephone,cb_storewebsite,cb_sin,cb_sip  
					   FROM jos_comprofiler 
					   INNER JOIN Countries on jos_comprofiler.CountryId = Countries.CountryId
					   WHERE Approved=1 AND cb_maplat != '' AND cb_maplong != '' $AndQry order by cb_storename asc";		
		$FindStoreQryRs=mysql_query($FindStoreQry);
		$TotFindStore=mysql_affected_rows();
		
		if($TotFindStore>0)
		{
			$FindStoreQryRs2=$prs_pageing->number_pageing_nodetail_ja($FindStoreQry,12,8,"Y","Y");
			$FindStoreQryRs3=$prs_pageing->number_pageing_nodetail_ja($FindStoreQry,12,8,"Y","Y");
		}
}
$page_title = ' | '.ucwords(strtolower(strt("Store Locator")));
?>
<? include("header.php");?>
<?php
$page_name = strt("STORE LOCATOR");
?>
<body>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script> 
<script type="text/javascript">
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
	//map.Size(300,100,'px','px');
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
			infoWindow.setContent("<div style='color:#000000;margin-left:10px;'><div><strong>"+ unescape(coname) + "</strong></div><div>"+ unescape(address) + "</div><div></div><br><div>" + miles+" <?= $uom ?></div></div>");
			infoWindow.open(map,marker);
		}
	);											
}
</script>

<?  if(trim($_REQUEST['cb_storepost'])!="" && trim($_REQUEST['cb_storepost'])!="Postal Code or City" ){
		$ZIP=trim($_REQUEST['cb_storepost']);
	}else{
		$ZIP="Postal Code or City";
		} ?>
<div id="all">
       <? include("top.php");?>
       <div id="section">
       <? include("left.php");?>
            <div id="content">
            <?php breadcrumbs(); ?>
            <div id="locationChoosers">
            <form name="FrmFilterRetailer" id="FrmFilterRetailer" enctype="multipart/form-data" method="get">
                    <div class="ddlContainer">
                       <?php selectCountry()?>
                    </div>
                    
                    <? if(trim($_REQUEST['cb_storecountry'])==""){$STYL="display:none";}else{$STYL="display:inline";}?>
                    
             <span id="postalcode_ID" style="<? echo $STYL; ?>" >
             <input type="text" id="cb_storepost" name="cb_storepost" class="txtPostalcode" onFocus="SetPostalZip(true);" onBlur="SetPostalZip(false);" value="<?=$ZIP;?>" /></span>
             
             <!-- <div id="distance_ID" class="ddlContainer" style="<? echo $STYL; ?>">
              	
                  <select  name="distance" class="short" id="distance">
                  <option value=""><?php e_strt("Distance");?></option>
                  <option value="10" <? if($_REQUEST['distance']==10){echo "selected";}?>>10 Miles</option>
                  <option value="20" <? if($_REQUEST['distance']==20){echo "selected";}?>>20 Miles</option>
                  <option value="50" <? if($_REQUEST['distance']==50){echo "selected";}?>>50 Miles</option>
                  <option value="800000000000" <? if($_REQUEST['distance']==800000000000){echo "selected";}?>>Over 50 Miles</option>
                  </select>
                
              </div>      -->                 
              <span class="tag"><?php e_strt("Collection");?>:</span>
              <div class="ddlContainer">
                <select name="collection" id="collection">
                <option value=""><?php e_strt("ALL");?></option>
                <?php if(!empty($COLLECTION_ONE)){ ?>
                <option value="cb_<?php echo $COLLECTION_ONE_CODE;?>" <? if($_REQUEST['collection']=="cb_$COLLECTION_ONE_CODE"){echo "selected";}?>><?php echo $COLLECTION_ONE;?></option>
                <?php } ?>
                <?php if(!empty($COLLECTION_TWO)){ ?>
				<option value="cb_<?php echo $COLLECTION_TWO_CODE;?>" <? if($_REQUEST['collection']=="cb_$COLLECTION_TWO_CODE"){echo "selected";}?>><?php echo $COLLECTION_TWO;?></option>
                <?php } ?>               
                </select>
              </div>
                    <input id="searchLocation" type="submit" value="<?php e_upstrt('SEARCH');?>" class="searchLocation"/>
                     <a class="gps" href="<?php echo GetSiteUrl();?>/find-a-store.php" title="<?php e_strt("click here to find the nearest store to your current location");?>"></a>
                     </form>
                </div>
                <div id="mapContainer">
                   <?php putGMap();?>
                </div>
                <h4 class="storeList"><?php e_upstrt('STORES AROUND YOUR AREA');?>:</h4>
                <?
								
				if($TotFindStore>0)
				{
				?>
                    <?php 
					$count = 0;
				  while($FindStoreQryRow =mysql_fetch_array($FindStoreQryRs3[0]))
				  {
					 // var_dump($FindStoreQryRow); die();
					//if($count%3==0 && $count!=0){echo "</tr><tr><td>&nbsp;</td></tr><tr>";}
		   ?>  
					<div id="ad<?= $count; ?>" name="ad<?= $count; ?>" class="address"  >
                    <!--<div onClick="getRetailerData('<?=$count?>','<?=$FindStoreQryRow['jid']?>')">-->
                    <div>
                    <strong><?=stripslashes($FindStoreQryRow['cb_storename']);?></strong>
					<br />
                    <div id="details<?= $count; ?>">
					  <?=stripslashes($FindStoreQryRow['cb_storeaddress1']);?> <br />
					  <? if($FindStoreQryRow['cb_storecity']!="" || $FindStoreQryRow['cb_storeprostate']!="" || $FindStoreQryRow['cb_storepost']!=""){?>
						 <? if($_SESSION['SESSION_COUNTRY']=="5"){?>
							<?=stripslashes($FindStoreQryRow['cb_storepost']);?><? if($FindStoreQryRow['cb_storecity']!=""){?>,<? } ?> <?=stripslashes($FindStoreQryRow['cb_storecity']);?><? if($FindStoreQryRow['cb_storeprostate']!=""){?>,<? } ?> <?=stripslashes($FindStoreQryRow['cb_storeprostate']);?><br />
						 <? }else{?>	 
							<?=stripslashes($FindStoreQryRow['cb_storecity']);?><? if($FindStoreQryRow['cb_storeprostate']!=""){?>,<? } ?> <?=stripslashes($FindStoreQryRow['cb_storeprostate']);?><? if($FindStoreQryRow['cb_storepost']!=""){?>,<? } ?> <?=stripslashes($FindStoreQryRow['cb_storepost']);?> <br />
						 <? } ?>
					  <? } ?>	 
					  
					  <?=stripslashes($FindStoreQryRow['cb_storecountry']);?> <br />
					 <?php /*?> DISTANCE <br /><?php */?>
					  <? if($FindStoreQryRow['cb_storephone']!="" && $FindStoreQryRow['cb_storephone']!="Phone Number"){?>T: <?=stripslashes($FindStoreQryRow['cb_storephone']);?> <br />
					  <? }?>
					  <!--<? if($FindStoreQryRow['cb_storewebsite']!=""){?><a href="<? echo WebsiteWithProperUrl(stripslashes($FindStoreQryRow['cb_storewebsite']));?>" style="color:#FFFFFF;" target="_blank"><?=stripslashes($FindStoreQryRow['cb_storewebsite']);?></a> <br /><? }?>-->
					  <? 
					  $COL="";
					  /*
					  echo "<pre>";
					  print_r($FindStoreQryRow);
					  echo "<pre>";
					  die();*/
					  if($FindStoreQryRow['cb_'.$COLLECTION_ONE_CODE]=="Yes" || $FindStoreQryRow['cb_'.$COLLECTION_TWO_CODE]=="Yes"){?>
						 <?php e_strt("Collections Carried");?> : <br />
						  <? if($FindStoreQryRow['cb_'.$COLLECTION_ONE_CODE]=="Yes"){$COL=  "$COLLECTION_ONE, ";}?>						  
						  <? if($FindStoreQryRow['cb_'.$COLLECTION_TWO_CODE]=="Yes"){$COL.="$COLLECTION_TWO, ";}?>
						  <? echo substr($COL,0,-2);?>
					<? } ?>
                    </div>
                    </div>
                     <div class="popupStore">
                  		<div class="title">
						<div class="text">
						<?=stripslashes($FindStoreQryRow['cb_storename']);?>
                        </div>
                        <div class="close"></div>
                        </div>
                  
                          <div class="addressDetails">
                      <?=stripslashes($FindStoreQryRow['cb_storeaddress1']);?> <br />
					  <? if($FindStoreQryRow['cb_storecity']!="" || $FindStoreQryRow['cb_storeprostate']!="" || $FindStoreQryRow['cb_storepost']!=""){?>
						 <? if($_SESSION['SESSION_COUNTRY']=="5"){?>
							<?=stripslashes($FindStoreQryRow['cb_storepost']);?><? if($FindStoreQryRow['cb_storecity']!=""){?>,<? } ?> <?=stripslashes($FindStoreQryRow['cb_storecity']);?><? if($FindStoreQryRow['cb_storeprostate']!=""){?>,<? } ?> <?=stripslashes($FindStoreQryRow['cb_storeprostate']);?><br />
						 <? }else{?>	 
							<?=stripslashes($FindStoreQryRow['cb_storecity']);?>
							<? if($FindStoreQryRow['cb_storeprostate']!=""){?>,
							<? } ?> 
							<?=stripslashes($FindStoreQryRow['cb_storeprostate']);?>
							<? if($FindStoreQryRow['cb_storepost']!=""){?>,<? } ?>
                             <?=stripslashes($FindStoreQryRow['cb_storepost']);?> 
                             <br />
						 <? } ?>
					  <? } ?>					  
					  <?=stripslashes($FindStoreQryRow['cb_storecountry']);?> <br />
					  <? if($FindStoreQryRow['cb_storephone']!="" && $FindStoreQryRow['cb_storephone']!="Phone Number"){?>
                      T: <?=stripslashes($FindStoreQryRow['cb_storephone']);?> <br />
					  <? }?>
                      
					  <? if($FindStoreQryRow['cb_storewebsite']!=""){?>
                      <a href="<? echo WebsiteWithProperUrl(stripslashes($FindStoreQryRow['cb_storewebsite']));?>" style="color:#000;" target="_blank">
					  <?=stripslashes($FindStoreQryRow['cb_storewebsite']);?></a> <br />
					  <? }?>
					  
                      <br/>
                      
                      <strong><?php e_strt("Store Hours");?> :</strong> <br />
                      <span class="error">store hours missing</span>
                      <br/>
                      <br />
                      <? 
					  $COL="";
					  if($FindStoreQryRow['cb_'.$COLLECTION_ONE_CODE]=="Yes" || $FindStoreQryRow['cb_'.$COLLECTION_TWO_CODE]=="Yes"){?>
						 <?php e_strt("Collections Carried");?> : <br />
						  <? if($FindStoreQryRow['cb_'.$COLLECTION_ONE_CODE]=="Yes"){$COL=  "$COLLECTION_ONE, ";}?>						  
						  <? if($FindStoreQryRow['cb_'.$COLLECTION_TWO_CODE]=="Yes"){$COL.="$COLLECTION_TWO, ";}?>
						  <? echo substr($COL,0,-2);?>
					<? } ?>
                          </div>
                          
                          <div class="addressDetails">
                              <div class="logo">
                              <span class="error">logo missing</span>
                              </div>
                              <div class="pictures">
                             <span class="error"> pictures missing</span>
                              </div>
                          </div>
                      
	                  </div> 
                  
                  
                  </div>               
   	           	     
                <script type="text/javascript">	
					//Read the content of the div. No need to use a serveside var here 
					var dv = document.getElementById("details<?= $count; ?>");
						//add the marker
						MarkAddress(<?=stripslashes($FindStoreQryRow['cb_maplat']);?>, <?=stripslashes($FindStoreQryRow['cb_maplong']);?>, escape("<?=stripslashes($FindStoreQryRow['cb_storename']);?>"), escape(dv.innerHTML), escape("<?=stripslashes($FindStoreQryRow['cb_storephone']);?>"), '<?= number_format(DistanceCalc( stripslashes($FindStoreQryRow['cb_maplat']), stripslashes($FindStoreQryRow['cb_maplong']), $Latitude, $Longitude, $uom), 2)?>');				
					</script>
				  <? $count++; } ?>
                   <div class="clr"></div> 
                  <?php if(!empty($FindStoreQryRs2[1])){ ?>
                  <div class="pagingStore">
                  <?=$FindStoreQryRs2[1];?> 
                  <div class="clr"></div> 
                  </div>
                  <?php } ?>         
            <? } else{?>
            <p class="address">
               <?php e_strt("No Retailers Found");?> 
                </p>
            <? } ?>      
            
            </div>  
        </div>
        
    </div>
    <? include("footer.php");?>
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
		//document.getElementById('distance_ID').style.display='inline';		
		document.getElementById('postalcode_ID').style.display='inline';	
		SetPostalZip(false);	
		
		ReplaceUOM();
	}
	else
	{
		//document.getElementById('distance_ID').style.display='none';	
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