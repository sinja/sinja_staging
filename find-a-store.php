<?
include("connect1.php");
include_once("include/ipinfodb.class.php");

$order_by = "distance";
$detectCountry = "";
$detectPostalCode = "";
if (empty($_REQUEST["cb_storecountry"])) {
    $detectCountry = $visitorGeolocation['CountryName'];
    $detectPostalCode = $visitorGeolocation['ZipPostalCode'];
    $detectLat = $visitorGeolocation['Latitude'];
    $detectLong = $visitorGeolocation['Longitude'];
} else {
    $order_by = "cb_storename";
}

$FINDASTORE = "Y";
//error_reporting(E_ALL);
$query1_map = "";
$recperpg = 5;
$pgno = 0;
$uomMiles = " Miles";
$uomKms = " Kilometers";
$uom = "";

function DistanceCalc($lat1, $lon1, $lat2, $lon2, $unit) {
	global $uomKms;
    $theta = $lon1 - $lon2;
    $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
    $dist = acos($dist);
    $dist = rad2deg($dist);
    $miles = $dist * 60 * 1.1515;
    $unit = strtoupper($unit);

    if ($unit == $uomKms) {
        return ($miles * 1.609344);
    }
    /*   else if ($unit == "N") {// Nautical
      return ($miles * 0.8684);
      } */ else {
        return $miles;
    }
}

function popupDetails($FindStoreQryRow) {
    global $COLLECTION_ONE_CODE, $COLLECTION_ONE, $COLLECTION_TWO, $COLLECTION_THREE, $COLLECTION_TWO_CODE, $COLLECTION_THREE_CODE, $ALBUM_URL;
    global $detectCountry, $sindb;
    $show = false;
    if (!empty($_REQUEST["cb_storecountry"])) {
        $detectCountry = $_REQUEST["cb_storecountry"];
    }
    if (isset($_REQUEST['storeid']) && !empty($_REQUEST['storeid'])) {
        $show = true;
    }
    $aid = 5;
    $AndQry = " and concat(',',concat(websiteid,','))  like '%," . SITE_ID . ",%'";
    $AlbumQry = "SELECT id FROM gallery WHERE category='" . mysql_real_escape_string($aid) . "' $AndQry order by addeddate desc";
    $AlbumQryRs = mysql_query($AlbumQry);
    $TotAlbum = mysql_affected_rows();
    $AlbumQryRow = mysql_fetch_array($AlbumQryRs);
    global $ALBUM_URL;
    $sql = "SELECT * from galleryimages where pid='" . $AlbumQryRow['id'] . "'  order by type,displayorder ASC limit 0,4";
    $hueres = $sindb->get_results($sql);
//	print_r($hueres);
    $logo = $FindStoreQryRow['logo'];
    ?>
    <style>
        @media print {
            body * {
                visibility:hidden;
            }
            .section_to_print, .section_to_print * {
                visibility:visible;
            }
            .section_to_print {
                position:absolute;
                left:0;
                top:0;
            }



        </style>

        <script>
            var currentPosition = '<?php echo $detectCountry; ?>';
            var destanationAdd = '<?= stripslashes($FindStoreQryRow['cb_storeaddress1']); ?>,<?
    if ($FindStoreQryRow['cb_storecity'] != "" || $FindStoreQryRow['cb_storeprostate'] != "" || $FindStoreQryRow['cb_storepost'] != "") {
        if ($_SESSION['SESSION_COUNTRY'] == "5") {
            ?><?= stripslashes($FindStoreQryRow['cb_storepost']); ?><? if ($FindStoreQryRow['cb_storecity'] != "") { ?>,<? } ?> <?= stripslashes($FindStoreQryRow['cb_storecity']); ?><? if ($FindStoreQryRow['cb_storeprostate'] != "") { ?>,<? } ?> <?= stripslashes($FindStoreQryRow['cb_storeprostate']); ?>,<? } else { ?><?= stripslashes($FindStoreQryRow['cb_storecity']); ?><? if ($FindStoreQryRow['cb_storeprostate'] != "") { ?>,<? } ?><?= stripslashes($FindStoreQryRow['cb_storeprostate']); ?><? if ($FindStoreQryRow['cb_storepost'] != "") { ?>,<? } ?><?=
            stripslashes($FindStoreQryRow['cb_storepost']);
        }
    }
    ?>,<?= stripslashes($FindStoreQryRow['cb_storecountry']); ?>';
        /*
            window.setInterval(function(){
       $('#popupImage<?php echo $FindStoreQryRow['jid']; ?>').fadeOut('slow', function () {

                    $('#popupImage<?php echo $FindStoreQryRow['jid']; ?>').css({ 'background-image': 'url("<?php echo $ALBUM_URL; ?>/<?php echo stripslashes($hueres[1]['pimage']); ?>")' });

                    $('#popupImage<?php echo $FindStoreQryRow['jid']; ?>').fadeIn('slow');
                });
                                    	
      window.setTimeout(function(){
             $('#popupImage<?php echo $FindStoreQryRow['jid']; ?>').fadeOut('slow', function () {

                    $('#popupImage<?php echo $FindStoreQryRow['jid']; ?>').css({ 'background-image': 'url("<?php echo $ALBUM_URL; ?>/<?php echo stripslashes($hueres[0]['pimage']); ?>")' });

                    $('#popupImage<?php echo $FindStoreQryRow['jid']; ?>').fadeIn('slow');
                });
              }, 5*1000);
    }, 10 * 1000);
         */
        </script>
        <div class="popupStore" <?php
    if ($show) {
        echo 'style="display:block;"';
    }
    ?>>
            <div id="popupImage<?php echo $FindStoreQryRow['jid']; ?>" class="sidePopupImage" style="background-image: url('<?php echo $ALBUM_URL; ?>/<?php echo stripslashes($hueres[rand(0, count($hueres) - 1)]['pimage']); ?>')">
            </div>
            <div class="inside">
                <div class="title">
                    <div class="text">
                        <?= stripslashes($FindStoreQryRow['cb_storename']); ?>
                    </div>
                    <div class="close"></div>
                </div>

                <div class="addressDetails" style="width:285px;">
                    <?= stripslashes($FindStoreQryRow['cb_storeaddress1']); ?> <br />
                    <? if ($FindStoreQryRow['cb_storecity'] != "" || $FindStoreQryRow['cb_storeprostate'] != "" || $FindStoreQryRow['cb_storepost'] != "") { ?>
                        <? if ($_SESSION['SESSION_COUNTRY'] == "5") { ?>
                            <?= stripslashes($FindStoreQryRow['cb_storepost']); ?><? if ($FindStoreQryRow['cb_storecity'] != "") { ?>,<? } ?> <?= stripslashes($FindStoreQryRow['cb_storecity']); ?><? if ($FindStoreQryRow['cb_storeprostate'] != "") { ?>,<? } ?> <?= stripslashes($FindStoreQryRow['cb_storeprostate']); ?><br />
                        <? } else { ?>	 
                            <?= stripslashes($FindStoreQryRow['cb_storecity']); ?>
                            <? if ($FindStoreQryRow['cb_storeprostate'] != "") { ?>,
                            <? } ?> 
                            <?= stripslashes($FindStoreQryRow['cb_storeprostate']); ?>
                            <? if ($FindStoreQryRow['cb_storepost'] != "") { ?>,<? } ?>
                            <?= stripslashes($FindStoreQryRow['cb_storepost']); ?> 
                            <br />
                        <? } ?>
                    <? } ?>					  
                    <?= stripslashes($FindStoreQryRow['cb_storecountry']); ?> <br />
                    <a href="javascript:void(0)" onClick="getDirections(currentPosition,'<?= stripslashes($FindStoreQryRow['cb_storeaddress1']); ?>,<?
                if ($FindStoreQryRow['cb_storecity'] != "" || $FindStoreQryRow['cb_storeprostate'] != "" || $FindStoreQryRow['cb_storepost'] != "") {
                    if ($_SESSION['SESSION_COUNTRY'] == "5") {
                            ?><?= stripslashes($FindStoreQryRow['cb_storepost']); ?><? if ($FindStoreQryRow['cb_storecity'] != "") { ?>,<? } ?> <?= stripslashes($FindStoreQryRow['cb_storecity']); ?><? if ($FindStoreQryRow['cb_storeprostate'] != "") { ?>,<? } ?> <?= stripslashes($FindStoreQryRow['cb_storeprostate']); ?>,<? } else { ?><?= stripslashes($FindStoreQryRow['cb_storecity']); ?><? if ($FindStoreQryRow['cb_storeprostate'] != "") { ?>,<? } ?><?= stripslashes($FindStoreQryRow['cb_storeprostate']); ?><? if ($FindStoreQryRow['cb_storepost'] != "") { ?>,<? } ?><?=
                stripslashes($FindStoreQryRow['cb_storepost']);
            }
        }
                    ?>,<?= stripslashes($FindStoreQryRow['cb_storecountry']); ?>')"><?php e_strt("Directions"); ?></a><br/>
                    <br/>
                    <strong><?php e_strt("Contact"); ?>:</strong><br/>
                    <? if ($FindStoreQryRow['cb_storephone'] != "" && $FindStoreQryRow['cb_storephone'] != "Phone Number") { ?>
                        T: <?= stripslashes($FindStoreQryRow['cb_storephone']); ?> <br />
                    <? } ?>

                    <? if ($FindStoreQryRow['cb_storeemail'] != "") { ?>                     
                        <a href="mailto:<? echo stripslashes($FindStoreQryRow['cb_storeemail']); ?>" target="_blank">
                            <?= stripslashes($FindStoreQryRow['cb_storeemail']); ?></a> <br />
                    <? } ?> 

                    <br/>
                    <?
                    /* $hours = '{"Mon":"11:30am-3:00pm",
                      "Tues":"11:30am-3:00pm",
                      "Wed":"11:30am-3:00pm",
                      "Thurs":"11:30am-3:00pm",
                      "Fri":"11:30am-3:00pm",
                      "Sat":"11:30am-3:00pm",
                      "Sun":"11:30am-3:00pm"}'; */

                    $hours = json_decode($FindStoreQryRow['cb_storehours'], true);
                    if ($FindStoreQryRow['cb_storehours'] != "") {
                        ?> 
                        <strong><?php e_strt("Store Hours"); ?> :</strong> <br />
                        <div class="hours">
                            <?php
                            $c = 0;
                            echo '<div class="rows">';
                            foreach ($hours as $day => $hour) {
                                if ($c % 4 == 0 && $c != 0)
                                    echo "</div><div>";
                                echo '<div class="day">' . strt($day) . ':</div>';
                                echo '<div class="hour">' . $hour . '</div>';
                                $c++;
                            }
                            echo "</div>";
                            ?>
                            <div class="clr"></div>
                        </div> 
                        <br />
                    <? } ?> 
                    <?
                    $COL = "";
                    if ($FindStoreQryRow['cb_' . $COLLECTION_ONE_CODE] == "Yes" || $FindStoreQryRow['cb_' . $COLLECTION_TWO_CODE] == "Yes") {
                        ?>
                        <strong><?php e_strt("Collections Carried"); ?> : </strong><br />
                        <?
                        if ($FindStoreQryRow['cb_' . $COLLECTION_ONE_CODE] == "Yes") {
                            $bs = '';
                            if ($FindStoreQryRow['cb_' . $COLLECTION_ONE_CODE . '_bs'] == 1) {
                                $bs = ' (Have this big sizez)';
                            }
                            $COL = "$COLLECTION_ONE" . "$bs, ";
                        }
                        if ($FindStoreQryRow['cb_' . $COLLECTION_TWO_CODE] == "Yes") {
                            $bs = '';
                            if ($FindStoreQryRow['cb_' . $COLLECTION_TWO_CODE . '_bs'] == 1) {
                                $bs = ' (Have this big sizez)';
                            }
                            $COL.="$COLLECTION_TWO" . "$bs, ";
                        }
                        if ($FindStoreQryRow['cb_' . $COLLECTION_THREE_CODE] == "Yes") {
                            $bs = '';
                            if ($FindStoreQryRow['cb_' . $COLLECTION_THREE_CODE . '_bs'] == 1) {
                                $bs = ' (Have this big sizez)';
                            }
                            $COL.="$COLLECTION_THREE" . "$bs, ";
                        }
                        ?>                          
                        <? echo substr($COL, 0, -2); ?>
                    <? } ?>
                </div>
                <script type="text/javascript"> 
                    $('.popupStore').css("left", $("#mapContainer").offset().left);
                </script>		
                <div class="addressDetails">
                    <div id="logo<?php echo $FindStoreQryRow['jid']; ?>" class="logo" style="background:url(<?php echo $ALBUM_URL; ?>/Stores/<?php echo stripslashes($logo); ?>) no-repeat center center;">             
                    </div>
                </div>
                <div class="clr"></div>

                <div class="popupDescription">
                    <?php echo stripslashes($FindStoreQryRow['descoflocandshop']); ?>        	
                </div>
                <div class="popupFooter">         
                    <? if ($FindStoreQryRow['cb_storewebsite'] != "") { ?>
                        <a href="<? echo WebsiteWithProperUrl(stripslashes($FindStoreQryRow['cb_storewebsite'])); ?>" target="_blank">
                            <?= stripslashes($FindStoreQryRow['cb_storewebsite']); ?></a> <br />
                    <? } ?>
                </div>
            </div>
            <div class="clr"></div>
        </div>
        <?php
    }

    function selectCountry() {
    	global $detectCountry;
        ?>
        <select name="cb_storecountry" id="cb_storecountry" onChange="HideShowDistance(this.value);">
            <option value=""><?php e_strt('Select Your Country'); ?></option>
            <?
            $nameField = "";

            if ($_SESSION['SESSION_LANGUAGE'] == "ESP") {
                $nameField = "CountryName";
            } else if ($_SESSION['SESSION_LANGUAGE'] == "NED") {
                $nameField = "CountryNameDutch";
            } else if ($_SESSION['SESSION_LANGUAGE'] == "PL") {
                $nameField = "CountryNamePolish";
            } else if ($_SESSION['SESSION_LANGUAGE'] == "GER") {
                $nameField = "CountryNameGerman";
            } else {
                $nameField = "CountryName";
            }

            $GETCountryQry = "SELECT DISTINCT 
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

            $GETCountryQryRs = mysql_query($GETCountryQry);
            $TotGETCountry = mysql_affected_rows();
            if ($TotGETCountry > 0) {
                for ($CC = 0; $CC < $TotGETCountry; $CC++) {
                    $GETCountryQryRow = mysql_fetch_array($GETCountryQryRs);
                    ?>
                    <option value="<?= stripslashes($GETCountryQryRow['CountryName']); ?>" <?
            if (isset($_REQUEST['cb_storecountry']) && stripslashes($GETCountryQryRow['CountryName']) == $_REQUEST['cb_storecountry']) {
                echo "selected";
            } else if ($detectCountry === stripslashes($GETCountryQryRow['CountryName']))  {
            	print('selected');
            }
                    ?>>
                                <?= stripslashes($GETCountryQryRow[$nameField]); ?>
                    </option>
                    <?
                }
            }
            ?>
        </select>
        <?php
    }

    function putGMap() {
        ?>
        <div id="gmap" class="gray12" style="width:782px;height:349px"></div>
        <script type="text/javascript"> 
            //Load the map
            InitGMap();
        </script>
        <?php
    }

    if (isset($_REQUEST["cb_storecountry"]) && $_REQUEST["cb_storecountry"] != "") {
        global $uom;
        $uom = $_REQUEST["cb_storecountry"] == "United States" ? $uomMiles : $uomKms;
    } else if ($detectCountry != "") {
        global $uom;
        $uom = $detectCountry == "United States" ? $uomMiles : $uomKms;
    } else {
        global $uom;
        $uom = $uomKms;
    }

    if (isset($_REQUEST['cb_storecountry']) && trim($_REQUEST['cb_storecountry']) != "") {
        if (isset($_REQUEST['cb_storepost']) && trim($_REQUEST['cb_storepost']) != "" && trim($_REQUEST['cb_storepost']) != "Zip Code or City" && trim($_REQUEST['cb_storepost']) != "Postal Code or City") {
            $searchzipcode = trim($_REQUEST['cb_storepost']);
        } else {
            $searchzipcode = "";
        }
        //if($searchzipcode!="")
        //{
        if (isset($_REQUEST['distance']) && $_REQUEST['distance'] != "") {
            $distance = $_REQUEST['distance'];

            //is km? calculate it			
            if ($uom == $uomKms)
                $distance = ($distance / 1.609344);
        }
        else {
            //if($searchzipcode!="")
            //	$distance="20";	
            //else
            $distance = "800000000000";
        }

        //MG: use api to find start location 
        define("MAPS_HOST", "maps.google.com");
        $base_url = "http://" . MAPS_HOST . "/maps/geo?output=csv&sensor=false";


        //what to look for
        $mgpostalcode = $_REQUEST["cb_storepost"];
        $mgcountry = $_REQUEST["cb_storecountry"];
        $address = $mgpostalcode . ", " . $mgcountry;

//		if($mgcountry == "United States")
        //		$base_url = $base_url."&g1=us";

        $request_url = $base_url . "&q=" . urlencode($address);
        $csv = file_get_contents($request_url) or die();

        $csvSplit = explode(",", $csv);
        $Latitude = $csvSplit[2];
        $Longitude = $csvSplit[3];
		
		$AndQry = ''; // Initiating the variable

        if (isset($_REQUEST['cb_storepost']) && trim($_REQUEST['cb_storepost']) != "" && trim($_REQUEST['cb_storepost']) != "Zip Code or City" && trim($_REQUEST['cb_storepost']) != "Postal Code or City") {
            $order_by = "distance";
            if ($Latitude == "" && $Longitude == "") {
                $AndQry.=" and cb_storepost='" . trim(mysql_real_escape_string($_REQUEST['cb_storepost'])) . "'";
            }
        }
        if (trim($_REQUEST['cb_storecountry']) != "" && trim($_REQUEST['cb_storecountry']) != "NULL") {
            $AndQry.=" and Countries.CountryName='" . trim(mysql_real_escape_string($_REQUEST['cb_storecountry'])) . "'";
        }
        if (isset($_REQUEST['collection']) && trim($_REQUEST['collection']) != "") {
            $AndQry.=" and `" . mysql_real_escape_string(trim($_REQUEST['collection'])) . "`='Yes'";
        } else {
            $AndQry.=" and (cb_sin='Yes' or cb_sip='Yes')";
        }
        if (isset($_REQUEST['storeid']) && !empty($_REQUEST['storeid'])) {
            $AndQry = " AND jos_comprofiler.id='" . $_REQUEST['storeid'] . "'";
        }
        $FindStoreQry = "SELECT jos_comprofiler.id as jid,cb_maplat, cb_maplong, cb_storename,cb_storeaddress1,cb_storecity,cb_storeprostate,descoflocandshop,cb_storepost,cb_storehours,jos_comprofiler.allow_popup,logo,CountryName as cb_storecountry,cb_storephone,cb_storewebsite,cb_sin,cb_sip,cb_sin_bs,cb_sip_bs
						,( 3959 * acos( cos( radians('$Latitude') ) * cos( radians( cb_maplat ) ) * cos( radians( cb_maplong ) - radians('$Longitude') ) + sin( radians('$Latitude') ) * sin( radians( cb_maplat ) ) ) ) AS distance 	
						FROM jos_comprofiler 
												INNER JOIN Countries on jos_comprofiler.CountryId = Countries.CountryId
						WHERE Approved=1 AND cb_storename is not NULL AND cb_storename != '' AND cb_maplat != '' AND cb_maplong != '' $AndQry HAVING distance < '$distance' ORDER BY $order_by";

        $FindStoreQryRs2 = mysql_query($FindStoreQry);
        $FindStoreQryRs = mysql_query($FindStoreQry);
        $TotFindStore = mysql_affected_rows();

        if ($TotFindStore > 0) {
            $FindStoreQryRs2 = $prs_pageing->number_pageing_nodetail_ja($FindStoreQry, 12, 8, "Y", "Y");
            $FindStoreQryRs3 = $prs_pageing->number_pageing_nodetail_ja($FindStoreQry, 12, 8, "Y", "Y");
        }
//	}
    } else if ($detectCountry != "") {//Automatic detection
        $searchzipcode = "";
        $distance = "2000";

        $Latitude = $detectLat;
        $Longitude = $detectLong;
        
        $AndQry = ''; // Initiating the variable

        if (isset($_REQUEST['collection']) && trim($_REQUEST['collection']) != "") {
            $AndQry.=" and `" . mysql_real_escape_string(trim($_REQUEST['collection'])) . "`='Yes'";
        } else {
            $AndQry.=" and (cb_sin='Yes' or cb_sip='Yes')";
        }

        $FindStoreQry = "SELECT jos_comprofiler.id as jid,cb_maplat, cb_maplong, cb_storename,cb_storeaddress1,cb_storecity,cb_storeprostate,descoflocandshop,cb_storepost,cb_storehours,jos_comprofiler.allow_popup,logo,CountryName as cb_storecountry,cb_storephone,cb_storewebsite,cb_sin,cb_sip ,cb_sin_bs,cb_sip_bs
					,( 3959 * acos( cos( radians('$Latitude') ) * cos( radians( cb_maplat ) ) * cos( radians( cb_maplong ) - radians('$Longitude') ) + sin( radians('$Latitude') ) * sin( radians( cb_maplat ) ) ) ) AS distance 	
					FROM jos_comprofiler 
						INNER JOIN Countries on jos_comprofiler.CountryId = Countries.CountryId";
        $where = " WHERE Approved=1 AND cb_storename is not NULL AND cb_storename != '' AND cb_maplat != '' AND cb_maplong != '' $AndQry HAVING distance < '$distance' ORDER BY $order_by";
        if (isset($_REQUEST['storeid']) && !empty($_REQUEST['storeid'])) {
            $AndQry = " AND jos_comprofiler.id='" . $_REQUEST['storeid'] . "'";
            $where = " WHERE Approved=1 $AndQry ORDER BY $order_by";
        }
        $FindStoreQry .= $where;

        $FindStoreQryRs2 = mysql_query($FindStoreQry);
        $FindStoreQryRs = mysql_query($FindStoreQry);
        $TotFindStore = mysql_affected_rows();

        if ($TotFindStore > 0) {
            $FindStoreQryRs2 = $prs_pageing->number_pageing_nodetail_ja($FindStoreQry, 12, 8, "Y", "Y");
            $FindStoreQryRs3 = $prs_pageing->number_pageing_nodetail_ja($FindStoreQry, 12, 8, "Y", "Y");
        }
    } else {
        if (trim($_REQUEST['cb_storepost']) != "" && trim($_REQUEST['cb_storepost']) != "Zip Code or City" && trim($_REQUEST['cb_storepost']) != "Postal Code or City") {
            $AndQry.=" and cb_storepost='" . trim(mysql_real_escape_string($_REQUEST['cb_storepost'])) . "'";
        }
        if (trim($_REQUEST['cb_storecountry']) != "" && trim($_REQUEST['cb_storecountry']) != "NULL") {
            $AndQry.=" and Countries.CountryName='" . trim(mysql_real_escape_string($_REQUEST['cb_storecountry'])) . "'";
        }
        if (trim($_REQUEST['collection']) != "") {
            $AndQry.=" and `" . mysql_real_escape_string(trim($_REQUEST['collection'])) . "`='Yes'";
        } else {
            $AndQry.=" and (cb_sin='Yes' or cb_sip='Yes')";
        }
        if (isset($_REQUEST['storeid']) && !empty($_REQUEST['storeid'])) {
            $AndQry = " AND jos_comprofiler.id='" . $_REQUEST['storeid'] . "'";
        }
        $FindStoreQry = "SELECT jos_comprofiler.id as jid,cb_maplat, cb_maplong,cb_storename,cb_storeaddress1,cb_storecity,cb_storeprostate,descoflocandshop,cb_storepost,cb_storehours,jos_comprofiler.allow_popup,logo,CountryName as cb_storecountry,cb_storephone,cb_storewebsite,cb_sin,cb_sip,cb_sin_bs,cb_sip_bs
					   FROM jos_comprofiler 
					   INNER JOIN Countries on jos_comprofiler.CountryId = Countries.CountryId
					   WHERE Approved=1 AND cb_maplat != '' AND cb_maplong != '' $AndQry order by cb_storename asc";
        $FindStoreQryRs = mysql_query($FindStoreQry);
        $TotFindStore = mysql_affected_rows();

        if ($TotFindStore > 0) {
            $FindStoreQryRs2 = $prs_pageing->number_pageing_nodetail_ja($FindStoreQry, 12, 8, "Y", "Y");
            $FindStoreQryRs3 = $prs_pageing->number_pageing_nodetail_ja($FindStoreQry, 12, 8, "Y", "Y");
        }
    }
    $page_title = ' | ' . ucwords(strtolower(strt("Store Locator")));
    ?>
    <? include("header.php"); ?>
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
                $('.popupStore').css("left", $("#mapContainer").offset().left);

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

        <?
        if (isset($_REQUEST['cb_storepost']) && trim($_REQUEST['cb_storepost']) != "" && trim($_REQUEST['cb_storepost']) != "Postal Code or City") {
            $ZIP = trim($_REQUEST['cb_storepost']);
        } else {
            $ZIP = "Postal Code or City";
        }
        ?>
        <div id="all">
            <? include("top.php"); ?>
            <div id="section">
                <? include("left.php"); ?>
                <div id="content">
                    <?php breadcrumbs(); ?>
                    <div id="locationChoosers">
                        <form name="FrmFilterRetailer" id="FrmFilterRetailer" enctype="multipart/form-data" method="get">
                            <div class="ddlContainer">
                                <?php selectCountry() ?>
                            </div>

                            <?
                            if (isset($_REQUEST['cb_storecountry']) && trim($_REQUEST['cb_storecountry']) == "") {
                                $STYL = "display:none";
                            } else {
                                $STYL = "display:inline";
                            }
                            ?>

                            <span id="postalcode_ID" style="<? echo $STYL; ?>" >
                                <input type="text" id="cb_storepost" name="cb_storepost" class="txtPostalcode" onFocus="SetPostalZip(true);" onBlur="SetPostalZip(false);" value="<?= $ZIP; ?>" /></span>

<!-- <div id="distance_ID" class="ddlContainer" style="<? echo $STYL; ?>">
   
     <select  name="distance" class="short" id="distance">
     <option value=""><?php e_strt("Distance"); ?></option>
     <option value="10" <?
                            if (isset($_REQUEST['distance']) && $_REQUEST['distance'] == 10) {
                                echo "selected";
                            }
                            ?>>10 Miles</option>
     <option value="20" <?
                            if (isset($_REQUEST['distance']) && $_REQUEST['distance'] == 20) {
                                echo "selected";
                            }
                            ?>>20 Miles</option>
     <option value="50" <?
                            if (isset($_REQUEST['distance']) && $_REQUEST['distance'] == 50) {
                                echo "selected";
                            }
                            ?>>50 Miles</option>
     <option value="800000000000" <?
                            if (isset($_REQUEST['distance']) && $_REQUEST['distance'] == 800000000000) {
                                echo "selected";
                            }
                            ?>>Over 50 Miles</option>
     </select>
   
 </div>      -->                 
                            <span class="tag"><?php e_strt("Collection"); ?>:</span>
                            <div class="ddlContainer">
                                <select name="collection" id="collection">
                                    <option value=""><?php e_strt("ALL"); ?></option>
                                    <?php if (!empty($COLLECTION_ONE)) { ?>
                                        <option value="cb_<?php echo $COLLECTION_ONE_CODE; ?>" <?
                                    if (isset($_REQUEST['collection']) && $_REQUEST['collection'] == "cb_$COLLECTION_ONE_CODE") {
                                        echo "selected";
                                    }
                                        ?>><?php echo $COLLECTION_ONE; ?></option>
                                            <?php } ?>
                                            <?php if (!empty($COLLECTION_TWO)) { ?>
                                        <option value="cb_<?php echo $COLLECTION_TWO_CODE; ?>" <?
                                            if (isset($_REQUEST['collection']) && $_REQUEST['collection'] == "cb_$COLLECTION_TWO_CODE") {
                                                echo "selected";
                                            }
                                                ?>><?php echo $COLLECTION_TWO; ?></option>
                                            <?php } ?>               
                                </select>
                            </div>
                            <input id="searchLocation" type="submit" value="<?php e_upstrt('SEARCH'); ?>" class="searchLocation"/>
                            <a class="gps" href="<?php echo GetSiteUrl(); ?>/store_locator.php" title="<?php e_strt("click here to find the nearest store to your current location"); ?>"></a>
                        </form>
                    </div>
                    <div id="mapContainer">
                        <?php putGMap(); ?>
                    </div>
                    <div id="resultsDiv">
                        <h4 class="storeList"><?php e_upstrt('STORES AROUND YOUR AREA'); ?>:</h4>
                        <?
                        if ($TotFindStore > 0) {
                            ?>
                            <?php
                            $count = 0;
                            while ($FindStoreQryRow = mysql_fetch_array($FindStoreQryRs3[0])) {
                                // var_dump($FindStoreQryRow); die();
                                //if($count%3==0 && $count!=0){echo "</tr><tr><td>&nbsp;</td></tr><tr>";}
                                ?>  
                                <div id="ad<?= $count; ?>" class="address" <?php
                        if ($FindStoreQryRow['allow_popup']) {
                            echo "style=\"cursor:pointer;\"";
                        }
                                ?>>
                                    <div onClick="getRetailerData('<?= $count ?>','<?= $FindStoreQryRow['jid'] ?>')">
                                        <div>
                                            <strong><?= stripslashes($FindStoreQryRow['cb_storename']); ?></strong>
                                            <br />
                                            <div id="details<?= $count; ?>">
                                                <?= stripslashes($FindStoreQryRow['cb_storeaddress1']); ?> <br />
                                                <? if ($FindStoreQryRow['cb_storecity'] != "" || $FindStoreQryRow['cb_storeprostate'] != "" || $FindStoreQryRow['cb_storepost'] != "") { ?>
                                                    <? if (isset($_SESSION['SESSION_COUNTRY']) && $_SESSION['SESSION_COUNTRY'] == "5") { ?>
                                                        <?= stripslashes($FindStoreQryRow['cb_storepost']); ?><? if ($FindStoreQryRow['cb_storecity'] != "") { ?>,<? } ?> <?= stripslashes($FindStoreQryRow['cb_storecity']); ?><? if ($FindStoreQryRow['cb_storeprostate'] != "") { ?>,<? } ?> <?= stripslashes($FindStoreQryRow['cb_storeprostate']); ?><br />
                                                    <? } else { ?>	 
                                                        <?= stripslashes($FindStoreQryRow['cb_storecity']); ?><? if ($FindStoreQryRow['cb_storeprostate'] != "") { ?>,<? } ?> <?= stripslashes($FindStoreQryRow['cb_storeprostate']); ?><? if ($FindStoreQryRow['cb_storepost'] != "") { ?>,<? } ?> <?= stripslashes($FindStoreQryRow['cb_storepost']); ?> <br />
                                                    <? } ?>
                                                <? } ?>	 

                                                <?= stripslashes($FindStoreQryRow['cb_storecountry']); ?> <br />
                                                <?php /* ?> DISTANCE <br /><?php */ ?>
                                                <? if ($FindStoreQryRow['cb_storephone'] != "" && $FindStoreQryRow['cb_storephone'] != "Phone Number") { ?>T: <?= stripslashes($FindStoreQryRow['cb_storephone']); ?> <br />
                                                <? } ?>
                                                                        <!--<? if ($FindStoreQryRow['cb_storewebsite'] != "") { ?><a href="<? echo WebsiteWithProperUrl(stripslashes($FindStoreQryRow['cb_storewebsite'])); ?>" style="color:#FFFFFF;" target="_blank"><?= stripslashes($FindStoreQryRow['cb_storewebsite']); ?></a> <br /><? } ?>-->
                                                <?
                                                $COL = "";
                                                /*
                                                  echo "<pre>";
                                                  print_r($FindStoreQryRow);
                                                  echo "<pre>";
                                                  die(); */
                                                if ((isset($FindStoreQryRow['cb_' . $COLLECTION_ONE_CODE]) && $FindStoreQryRow['cb_' . $COLLECTION_ONE_CODE] == "Yes") || (isset($COLLECTION_TWO_CODE) && isset($FindStoreQryRow['cb_' . $COLLECTION_TWO_CODE]) && $FindStoreQryRow['cb_' . $COLLECTION_TWO_CODE] == "Yes")) {
                                                    ?>
                                                    <?php e_strt("Collections Carried"); ?> : <br />
                                                    <?
                                                    if ($FindStoreQryRow['cb_' . $COLLECTION_ONE_CODE] == "Yes") {
                                                        $bs = '';
                                                        if ($FindStoreQryRow['cb_' . $COLLECTION_ONE_CODE . '_bs'] == 1) {
                                                            $bs = ' (Have this big sizez)';
                                                        }
                                                        $COL = "$COLLECTION_ONE" . "$bs, ";
                                                    }
                                                    if (isset($COLLECTION_TWO_CODE) && $FindStoreQryRow['cb_' . $COLLECTION_TWO_CODE] == "Yes") {
                                                        $bs = '';
                                                        if ($FindStoreQryRow['cb_' . $COLLECTION_TWO_CODE . '_bs'] == 1) {
                                                            $bs = ' (Have this big sizez)';
                                                        }
                                                        $COL.="$COLLECTION_TWO" . "$bs, ";
                                                    }
                                                    if (isset($COLLECTION_THREE_CODE) && $FindStoreQryRow['cb_' . $COLLECTION_THREE_CODE] == "Yes") {
                                                        $bs = '';
                                                        if ($FindStoreQryRow['cb_' . $COLLECTION_THREE_CODE . '_bs'] == 1) {
                                                            $bs = ' (Have this big sizez)';
                                                        }
                                                        $COL.="$COLLECTION_THREE" . "$bs, ";
                                                    }
                                                    ?>
                                                    <? echo substr($COL, 0, -2); ?>
                                                <? } ?>
                                                <?php if ($FindStoreQryRow['allow_popup']) { ?>
                                                    <br/>
                                                    <a href="javascript:void(0)" style=" text-decoration:underline;">
                                                        <?php e_strt("Click here for more information"); ?>
                                                    </a>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    if ($FindStoreQryRow['allow_popup']) {
                                        popupDetails($FindStoreQryRow);
                                    }
                                    ?>

                                </div>               

                                <script type="text/javascript">	
                                    //Read the content of the div. No need to use a serveside var here 
                                    var dv = document.getElementById("details<?= $count; ?>");
                                    //add the marker
                                    MarkAddress(<?= stripslashes($FindStoreQryRow['cb_maplat']); ?>, <?= stripslashes($FindStoreQryRow['cb_maplong']); ?>, escape("<?= stripslashes($FindStoreQryRow['cb_storename']); ?>"), escape(dv.innerHTML), escape("<?= stripslashes($FindStoreQryRow['cb_storephone']); ?>"), '<?= number_format(DistanceCalc((float) stripslashes($FindStoreQryRow['cb_maplat']), (float) stripslashes($FindStoreQryRow['cb_maplong']), (float) $Latitude, (float) $Longitude, $uom), 2) ?>');				
                                </script>
                                <?
                                $count++;
                            }
                            ?>
                            <div class="clr"></div> 
                            <?php if (!empty($FindStoreQryRs2[1])) { ?>
                                <div class="pagingStore">
                                    <?= $FindStoreQryRs2[1]; ?> 
                                    <div class="clr"></div> 
                                </div>
                            <?php } ?>         
                        <? } else { ?>
                            <p class="address">
                                <?php e_strt("No Retailers Found"); ?> 
                            </p>
                        <? } ?>      

                    </div>  

                    <div id="directionsPanel" class="section_to_print">
                        <div class="dpRow">
                            <img src="/images/from_icn.png" alt="from icon"  class="dirIcons"/>
                            <input type="text" onKeyPress="return handleEnter(this, event)" onBlur="if(this.value==''){this.value='<?php e_strt("Starting Address"); ?>';}" onFocus="if(this.value=='<?php e_strt("Starting Address"); ?>'){this.value='';}" value="<?php e_strt("Starting Address"); ?>" id="fromAddress" class="dirInputField" name="fromAddress" /> 
                            <a class="button" href="javascript:getDirectionsGo();"><?php e_strt("Get directions"); ?></a>
                        </div>

                        <div class="dpRow">
                            <img src="/images/to_icn.png" alt="to_icon" class="dirIcons" />
                            <input id="toAddress" class="dirInputField" type="text" readonly />
                            <a href="javascript:printDirections();"><img src="/images/printdirections.png" alt="Print directions to store" /></a>
                        </div>


                        <div id="directionsTextPanel">
                        </div>	


                    </div>




                </div>  
            </div>

        </div>
        <? include("footer.php"); ?>
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

            function getDirections(currentPosition,destanationAdd){
                jQuery("#resultsDiv").hide();
                jQuery("#directionsPanel").show();
                document.getElementById("toAddress").value = destanationAdd;

            }
            function getDirectionsGo() {

 		
				
                jQuery("#directionsTextPanel").html('');
                var directionsService = new google.maps.DirectionsService();
                var directionsDisplay = new google.maps.DirectionsRenderer();
                directionsDisplay.setMap(map);
                directionsDisplay.setPanel(document.getElementById('directionsTextPanel'));
	

                var request = {
                    origin: document.getElementById("fromAddress").value,
                    destination: document.getElementById("toAddress").value,
                    travelMode: google.maps.DirectionsTravelMode.DRIVING
                };
                directionsService.route(request, function(response, status) {
                    if (status == google.maps.DirectionsStatus.OK) {

                        directionsDisplay.setDirections(response);
                    } else {
                        alert('Directions cannot be found');
                    }
                });
		      


            }
            function printDirections() {

                window.print();


            }
            function handleEnter (field, event) {
                var keyCode = event.keyCode ? event.keyCode : event.which ? event.which : event.charCode;
                if (keyCode == 13) {
                    getDirectionsGo();
                }
                else		return true;
            } 

        </script>
        <script>ReplaceUOM();</script>
        <? include("googleanalytic.php"); ?>
    </body>
</html>
