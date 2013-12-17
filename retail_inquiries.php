<? include("connect1.php");
$RETAILINQ="Y";
if($_POST['HidSubmit']=="1")
{
	$UserQry="INSERT INTO jos_users SET name='".addslashes($_POST['bridalshop'])."',usertype='".addslashes($_POST['continent'])."',registerDate=now()";
	$UserQryRs=mysql_query($UserQry);
	$InsertedId=mysql_insert_id();
	
	if(stripslashes($_POST['phonenumber'])!="" && stripslashes($_POST['phonenumber'])!="Phone Number"){$phonenumber=($_POST['phonenumber']);}else{$phonenumber="";}
	if(stripslashes($_POST['mobilenumber'])!="" && stripslashes($_POST['mobilenumber'])!="Mobile Number"){$mobilenumber=($_POST['mobilenumber']);}else{$mobilenumber="";}
	if(stripslashes($_POST['dateopened'])!="" && stripslashes($_POST['dateopened'])!="Date Opened"){$dateopened=($_POST['dateopened']);}else{$dateopened="";}
	if(stripslashes($_POST['noofsalestaff'])!="" && stripslashes($_POST['noofsalestaff'])!="Number of Sales Staff"){$noofsalestaff=($_POST['noofsalestaff']);}else{$noofsalestaff="";}
	if(stripslashes($_POST['sizeofstaff'])!="" && stripslashes($_POST['sizeofstaff'])!="Size of Shop"){$sizeofstaff=($_POST['sizeofstaff']);}else{$sizeofstaff="";}
	if(stripslashes($_POST['descoflocandshop'])!="" && stripslashes($_POST['descoflocandshop'])!="Description of location and shop"){$descoflocandshop=nl2br(($_POST['descoflocandshop']));}else{$descoflocandshop="";}
	if(stripslashes($_POST['currentbrand_sold'])!="" && stripslashes($_POST['currentbrand_sold'])!="Current brands sold"){$currentbrand_sold=($_POST['currentbrand_sold']);}else{$currentbrand_sold="";}
	if(stripslashes($_POST['mainsupplier'])!="" && stripslashes($_POST['mainsupplier'])!="Main Supplier"){$mainsupplier=($_POST['mainsupplier']);}else{$mainsupplier="";}
	if(stripslashes($_POST['doumanufacturer'])!="" && stripslashes($_POST['doumanufacturer'])!="Do you manufacture your own dresses?"){$doumanufacturer=nl2br(($_POST['doumanufacturer']));}else{$doumanufacturer="";}
	if(stripslashes($_POST['avgretailprice'])!="" && stripslashes($_POST['avgretailprice'])!="Average retail dress price"){$avgretailprice=($_POST['avgretailprice']);}else{$avgretailprice="";}
	if(stripslashes($_POST['soldperyear'])!="" && stripslashes($_POST['soldperyear'])!="Approximate number of bridal units sold per year"){$soldperyear=nl2br(($_POST['soldperyear']));}else{$soldperyear="";}
	if(stripslashes($_POST['cb_storecity'])!="" && stripslashes($_POST['cb_storecity'])!="City"){$cb_storecity=($_POST['cb_storecity']);}else{$cb_storecity="";}
	if(stripslashes($_POST['cb_storeprostate'])!="" && stripslashes($_POST['cb_storeprostate'])!="State"){$cb_storeprostate=($_POST['cb_storeprostate']);}else{$cb_storeprostate="";}
	if(stripslashes($_POST['cb_storepost'])!="" && stripslashes($_POST['cb_storepost'])!="Postal Code"){$cb_storepost=($_POST['cb_storepost']);}else{$cb_storepost="";}
	
	if($cb_storepost!="")
	{
		//Attempt to geocode the store and save the lat/long
		define("MAPS_HOST", "maps.google.com");
		$base_url = "http://" . MAPS_HOST . "/maps/geo?output=csv";
		
		$addadd1 = addslashes($_POST['cb_storeaddress1']);
		$addcity = addslashes($_POST['cb_storecity']);
		$addstate = addslashes($_POST['cb_storeprostate']);
		$addpostalcode = addslashes($_POST['cb_storepost']);
			
		//get the countryname
		$countryname = "";
		$countryQry2="select CountryName from Countries where CountryId='".addslashes($_POST['country'])."'";
		$countryQryRs2=mysql_query($countryQry2);
		$totcountry=mysql_affected_rows();
		if($totcountry>0)
		{
			$countryRow=mysql_fetch_array($countryQryRs2);
			$countryname=trim($countryRow['CountryName']);
		}
		
		//form the address
		$address = $addadd1.", ".$addcity.", ".$addstate.", ".$addpostalcode.", ".$countryname;
		$addressEncode = rawurlencode(utf8_encode($address));
		
		//call google
	    $request_url = $base_url . "&q=" . $addressEncode;
	    $csv = file_get_contents($request_url) or die();
		$csvSplit = split(",", $csv);
		$status = $csvSplit[0];
		
		if (strcmp($status, "200") == 0) 
		{
		  $lat = $csvSplit[2];
		  $lng = $csvSplit[3];
			$andddd=",cb_maplat='$lat',cb_maplong='$lng', GeocodeFailed = 0";
		}
		else
		{
			$andddd=",cb_maplat=null,cb_maplong=null, GeocodeFailed = 1";
		}
	}
	
	$UserQry2="INSERT INTO jos_comprofiler SET 
	 										  id='".addslashes($InsertedId)."',
											  user_id='".addslashes($InsertedId)."',
											  cb_contactname='".addslashes($_POST['contact'])."',
											  cb_storeemail='".addslashes($_POST['email'])."',
												  RetailerStatusId=1,
											  cb_storename='".addslashes($_POST['bridalshop'])."',
											  cb_geolisting='".addslashes($_POST['continent'])."',
											  cb_storeaddress1='".addslashes($_POST['address'])."',
											  CountryId='".addslashes($_POST['country'])."',
											  cb_storephone='".addslashes($phonenumber)."',
											  cb_storecity='".addslashes($cb_storecity)."',
											  cb_storeprostate='".addslashes($cb_storeprostate)."',
											  cb_storepost='".addslashes($cb_storepost)."',
											  mobilenumber='".addslashes($mobilenumber)."',
											  dateopened='".addslashes($dateopened)."',
											  noofsalestaff='".addslashes($noofsalestaff)."',
											  sizeofstaff='".addslashes($sizeofstaff)."',
											  descoflocandshop='".addslashes($descoflocandshop)."',
											  currentbrand_sold='".addslashes($currentbrand_sold)."',
											  mainsupplier='".addslashes($mainsupplier)."',
											  doumanufacturer='".addslashes($doumanufacturer)."',
											  avgretailprice='".addslashes($avgretailprice)."',
											  soldperyear='".addslashes($soldperyear)."' $andddd";
	$UserQryRs2=mysql_query($UserQry2);
	
	if(stripslashes($_POST['phonenumber'])!="" && stripslashes($_POST['phonenumber'])!="Phone Number"){$phonenumber=stripslashes($_POST['phonenumber']);}else{$phonenumber="";}
	if(stripslashes($_POST['mobilenumber'])!="" && stripslashes($_POST['mobilenumber'])!="Mobile Number"){$mobilenumber=stripslashes($_POST['mobilenumber']);}else{$mobilenumber="";}
	if(stripslashes($_POST['dateopened'])!="" && stripslashes($_POST['dateopened'])!="Date Opened"){$dateopened=stripslashes($_POST['dateopened']);}else{$dateopened="";}
	if(stripslashes($_POST['noofsalestaff'])!="" && stripslashes($_POST['noofsalestaff'])!="Number of Sales Staff"){$noofsalestaff=stripslashes($_POST['noofsalestaff']);}else{$noofsalestaff="";}
	if(stripslashes($_POST['sizeofstaff'])!="" && stripslashes($_POST['sizeofstaff'])!="Size of Shop"){$sizeofstaff=stripslashes($_POST['sizeofstaff']);}else{$sizeofstaff="";}
	if(stripslashes($_POST['descoflocandshop'])!="" && stripslashes($_POST['descoflocandshop'])!="Description of location and shop"){$descoflocandshop=nl2br(stripslashes($_POST['descoflocandshop']));}else{$descoflocandshop="";}
	if(stripslashes($_POST['currentbrand_sold'])!="" && stripslashes($_POST['currentbrand_sold'])!="Current brands sold"){$currentbrand_sold=stripslashes($_POST['currentbrand_sold']);}else{$currentbrand_sold="";}
	if(stripslashes($_POST['mainsupplier'])!="" && stripslashes($_POST['mainsupplier'])!="Main Supplier"){$mainsupplier=stripslashes($_POST['mainsupplier']);}else{$mainsupplier="";}
	if(stripslashes($_POST['doumanufacturer'])!="" && stripslashes($_POST['doumanufacturer'])!="Do you manufacture your own dresses?"){$doumanufacturer=nl2br(stripslashes($_POST['doumanufacturer']));}else{$doumanufacturer="";}
	if(stripslashes($_POST['avgretailprice'])!="" && stripslashes($_POST['avgretailprice'])!="Average retail dress price"){$avgretailprice=stripslashes($_POST['avgretailprice']);}else{$avgretailprice="";}
	if(stripslashes($_POST['soldperyear'])!="" && stripslashes($_POST['soldperyear'])!="Approximate number of bridal units sold per year"){$soldperyear=nl2br(stripslashes($_POST['soldperyear']));}else{$soldperyear="";}
	if(stripslashes($_POST['cb_storecity'])!="" && stripslashes($_POST['cb_storecity'])!="City"){$cb_storecity=stripslashes($_POST['cb_storecity']);}else{$cb_storecity="";}
	if(stripslashes($_POST['cb_storeprostate'])!="" && stripslashes($_POST['cb_storeprostate'])!="State"){$cb_storeprostate=stripslashes($_POST['cb_storeprostate']);}else{$cb_storeprostate="";}
	if(stripslashes($_POST['cb_storepost'])!="" && stripslashes($_POST['cb_storepost'])!="Postal Code"){$cb_storepost=stripslashes($_POST['cb_storepost']);}else{$cb_storepost="";}
	
	//get the countryname
		$countryname = "";
	$countryQry2="select CountryName from Countries where CountryId='".addslashes($_POST['country'])."'";
		$countryQryRs2=mysql_query($countryQry2);
		$totcountry=mysql_affected_rows();
		if($totcountry>0)
		{
			$countryRow=mysql_fetch_array($countryQryRs2);
			$countryname=trim($countryRow['CountryName']);
		}
		
	/////EMAIL TO CLIENT
	$subject1="Retailer Request, ".$countryname;
	$from1='live@justinalexanderbridal.co'; //$ADMIN_MAIL;
	$mailcontent1="
	<html>
		<link href=\"$SITE_URL/css/$CSS_FILE\" rel=\"stylesheet\" type=\"text/css\" />
		<body>
			<table cellpadding=\"3\" cellspacing=\"3\">
				<tr>
					<Td align=\"left\" colspan=\"2\"><img src='$SITE_URL/images/logo.gif' /></td>
				</tr>
				<tr>
					<Td align=\"left\" colspan=\"2\"></td>
				</tr>
				<tr>
					<Td align=\"left\" colspan=\"2\">Hello,</td>
				</tr>
				<tr>
					<Td align=\"left\" colspan=\"2\"></td>
				</tr>
				<tr>
					<Td align=\"left\" colspan=\"2\">Retailer request has been submited with the below details.</td>
				</tr>
				<tr>
					<Td align=\"left\" colspan=\"2\"></td>
				</tr>
				<tr>
					<Td align=\"left\" colspan=2><strong>Contact Information</strong></td>
				</tr>
				<tr>
					<Td align=\"left\" width=\"250\"><strong>Contact:</strong></td>
					<Td align=\"left\">".stripslashes($_POST['contact'])."</td>
				</tr>
				<tr>
					<Td align=\"left\" width=\"250\"><strong>Bridal Shop:</strong></td>
					<Td align=\"left\">".stripslashes($_POST['bridalshop'])."</td>
				</tr>
				<tr>
					<Td align=\"left\" width=\"250\"><strong>Address:</strong></td>
					<Td align=\"left\">".stripslashes($_POST['address'])."</td>
				</tr>
				<tr>
					<Td align=\"left\" width=\"250\"><strong>Country:</strong></td>
					<Td align=\"left\">".$countryname."</td>
				</tr>
				<tr>
					<Td align=\"left\" width=\"250\"><strong>Email:</strong></td>
					<Td align=\"left\">".stripslashes($_POST['email'])."</td>
				</tr>
				<tr>
					<Td align=\"left\" width=\"250\"><strong>Continent:</strong></td>
					<Td align=\"left\">".stripslashes($_POST['continent'])."</td>
				</tr>
				<tr>
					<Td align=\"left\" width=\"250\"><strong>City:</strong></td>
					<Td align=\"left\">".stripslashes($cb_storecity)."</td>
				</tr>
				<tr>
					<Td align=\"left\" width=\"250\"><strong>State:</strong></td>
					<Td align=\"left\">".stripslashes($cb_storeprostate)."</td>
				</tr>
				<tr>
					<Td align=\"left\" width=\"250\"><strong>Postal Code:</strong></td>
					<Td align=\"left\">".stripslashes($cb_storepost)."</td>
				</tr>
				<tr>
					<Td align=\"left\" width=\"250\"><strong>Phone Number:</strong></td>
					<Td align=\"left\">".$phonenumber."</td>
				</tr>
				<tr>
					<Td align=\"left\" width=\"250\"><strong>Mobile Number:</strong></td>
					<Td align=\"left\">".$mobilenumber."</td>
				</tr>
				<tr>
					<Td align=\"left\" colspan=\"2\"><hr></td>
				</tr>
				<tr>
					<Td align=\"left\" colspan=2><strong>Shop Information</strong></td>
				</tr>
				<tr>
					<Td align=\"left\" width=\"250\"><strong>Date Opened:</strong></td>
					<Td align=\"left\">".$dateopened."</td>
				</tr>
				<tr>
					<Td align=\"left\" width=\"250\"><strong>Number of Sales Staff:</strong></td>
					<Td align=\"left\">".$noofsalestaff."</td>
				</tr>
				<tr>
					<Td align=\"left\" width=\"250\"><strong>Size of Shop:</strong></td>
					<Td align=\"left\">".$sizeofstaff."</td>
				</tr>
				<tr>
					<Td align=\"left\" width=\"250\" valign=\"top\"><strong>Description of Location & shop:</strong></td>
					<Td align=\"left\" valign=\"top\">".$descoflocandshop."</td>
				</tr>
				<tr>
					<Td align=\"left\" colspan=\"2\"><hr></td>
				</tr>
				<tr>
					<Td align=\"left\" colspan=2><strong>Commercial Information</strong></td>
				</tr>
				<tr>
					<Td align=\"left\" width=\"250\"><strong>Current brands sold:</strong></td>
					<Td align=\"left\">".$currentbrand_sold."</td>
				</tr>
				<tr>
					<Td align=\"left\" width=\"250\"><strong>Main Supplier:</strong></td>
					<Td align=\"left\">".$mainsupplier."</td>
				</tr>
				<tr>
					<Td align=\"left\" width=\"250\" valign=\"top\"><strong>Do you manufacture your own dresses?</strong></td>
					<Td align=\"left\" valign=\"top\">".$doumanufacturer."</td>
				</tr>
				<tr>
					<Td align=\"left\" width=\"250\"><strong>Average retail dress price:</strong></td>
					<Td align=\"left\">".$avgretailprice."</td>
				</tr>
				<tr>
					<Td align=\"left\" width=\"250\" valign=\"top\"><strong>Approximate number of bridal units sold per year:</strong></td>
					<Td align=\"left\" valign=\"top\">".$soldperyear."</td>
				</tr>
				<tr>
					<Td align=\"left\" colspan=\"2\"></td>
				</tr>
				<tr>
					<Td align=\"left\" colspan=\"2\"><a href='$SITE_URL' target='_blank'>$SITE_URL</a></td>
				</tr>
				<tr>
					<Td align=\"left\" colspan=\"2\"></td>
				</tr>
				<tr>
					<Td align=\"left\" colspan=\"2\">Thanks</td>
				</tr>
		</table>
		</body>
	</html>";
	//echo $mailcontent1;
	
	
	$SelQry2="SELECT  email1 FROM continent_retailer WHERE name='".addslashes($_POST['continent'])."'";
	$SelQryRs2=mysql_query($SelQry2);
	$SelQryRow2=mysql_fetch_array($SelQryRs2);
	$to1=stripslashes($SelQryRow2['email1']);
	if($_SERVER['HTTP_HOST']!="plus")
	{
		HtmlMailSend($to1,$subject1,$mailcontent1,$from1);
	}
	/////END OF EMAIL TO CLIENT
	
	header("location:retail_inquiries.php?msg=1");
	exit;
}

$page_title = ' | '.ucwords(strtolower(strt("Retail Inquiries")));
?>
<? include("header.php");?>
<body>
 <div id="all">
       <? include("top.php");?>
       <div id="section">
       <? include("left.php");?>
            <div id="content">
               <?php breadcrumbs(); ?> 
                <table width="780" border="0" align="center" cellpadding="0" cellspacing="0" class="retailerTable">
                    
                    <tr>
                      <td align="center" valign="top"><table width="780" border="0" align="center" cellpadding="0" cellspacing="0">
                          <tr>
                            <td width="645" align="left" valign="top">
							<form name="FrmInquiry" id="FrmInquiry" enctype="multipart/form-data" method="post">
							<table width="600" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                      <tr>
                                        <td align="left" valign="top">
                                        <div class="pageTitle" style="width:780px;">
                                            <h2><?php e_upstrt('Retail Inquiries');?></h2>
                                        </div>
                                        <div id="retailInHeading" class="inqueriesBG">
                                        <div class="font-48-gra-bold floatHeading">
										 
                                         </div>                                        
                                         </div> 
                                         </td>
                                      </tr>
                                      <tr>
                                        <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                              <td width="85%" height="40" align="left" valign="middle" class="font-16-wit" style="padding-left:5px;">
											  <?php e_upstrt('Interested in becoming a '.$SITE_NAME.' retailer?');?></td>
                                              <td width="15%" align="left" valign="middle" class="font-11-blk">
                                              <em>* <?php e_strt('required fields');?></em></td>
                                            </tr>
                                          </table></td>
                                      </tr>
									  <? if($_REQUEST['msg']=="1"){?><tr><td align="center" style="color:#F8FBF9;">
									  <?php e_strt('Your retail inquiry has been sent successfully. We will get back to you soon');?>.<br /><br /></td></tr><? } ?>
                                      <tr>
                                        <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                              <td width="35%" align="left" valign="top"><table border="0" cellspacing="0" cellpadding="3">
                                                  <tr>
                                                    <td align="right" valign="top">&nbsp;</td>
                                                    <td height="30" align="left" valign="middle" class="font-12-gold"><strong>
													<?php e_strt('Contact Information');?></strong></td>
                                                  </tr>
                                                  <tr>
                                                    <td width="5" align="right" valign="top" class="font-12-gra">* </td>
                                                    <td align="left" valign="top" class="font-12-gra"><input name="contact" type="text" class="text_field1" id="contact" value="<?php e_strt('Contact');?>" onFocus="if(this.value=='<?php e_strt('Contact');?>'){this.value='';}" onBlur="if(this.value==''){this.value='<?php e_strt('Contact');?>';}"/></td>
                                                  </tr>
                                                  <tr>
                                                    <td align="right" valign="top" class="font-12-gra">*</td>
                                                    <td align="left" valign="top" class="font-12-gra"><input name="bridalshop" type="text" class="text_field1" id="bridalshop" value="<?php e_strt('Bridal Shop');?>" onFocus="if(this.value=='<?php e_strt('Bridal Shop');?>'){this.value='';}" onBlur="if(this.value==''){this.value='<?php e_strt('Bridal Shop');?>';}"/></td>
                                                  </tr>
                                                  <tr>
                                                    <td align="right" valign="top" class="font-12-gra">*</td>
                                                    <td align="left" valign="top" class="font-12-gra"><input name="address" type="text" class="text_field1" id="address" value="<?php e_strt('Address');?>" onFocus="if(this.value=='<?php e_strt('Address');?>'){this.value='';}" onBlur="if(this.value==''){this.value='<?php e_strt('Address');?>';}"/></td>
                                                  </tr>
                                                  <tr>
                                                    <td align="right" valign="top" class="font-12-gra">*</td>
                                                    <td align="left" valign="top" class="font-12-gra">
													<select name="country" class="text_field7" id="country"><option value="">
													<?php e_strt('Country');?></option><?=GetDropdown(CountryId,CountryName,Countries,' order by CountryName asc',$country);?></select>
													<?php /*?><input name="country" type="text" class="text_field1" id="country" value="Country" onfocus="if(this.value=='Country'){this.value='';}" onblur="if(this.value==''){this.value='Country';}"/><?php */?></td>
                                                  </tr>
                                                  <tr>
                                                    <td align="right" valign="top" class="font-12-gra">*</td>
                                                    <td align="left" valign="top" class="font-12-gra"><input name="email" type="text" class="text_field1" id="email" value="<?php e_strt('Email');?>" onFocus="if(this.value=='<?php e_strt('Email');?>'){this.value='';}" onBlur="if(this.value==''){this.value='<?php e_strt('Email');?>';}"/></td>
                                                  </tr>
                                                  <tr>
                                                    <td align="right" valign="top" class="font-12-gra">*</td>
                                                    <td align="left" valign="top" class="font-12-gra"><select name="continent" class="text_field7" id="continent"><option value=""><?php e_strt("Continent");?></option><?=GetDropdown(name,name,continent_retailer,' order by name asc',"");?></select></td>
                                                  </tr>
                                                  <tr>
                                                    <td align="right" valign="top" class="font-12-gra">*</td>
                                                    <td align="left" valign="top" class="font-12-gra"><input name="cb_storecity" type="text" class="text_field1" id="cb_storecity" value="<?php e_strt('City');?>" onFocus="if(this.value=='<?php e_strt('City');?>'){this.value='';}" onBlur="if(this.value==''){this.value='<?php e_strt('City');?>';}"/></td>
                                                  </tr>
												  <tr>
                                                    <td align="right" valign="top" class="font-12-gra"></td>
                                                    <td align="left" valign="top" class="font-12-gra"><input name="cb_storeprostate" type="text" class="text_field1" id="cb_storeprostate" value="<?php e_strt('State');?>" onFocus="if(this.value=='<?php e_strt('State');?>'){this.value='';}" onBlur="if(this.value==''){this.value='<?php e_strt('State');?>';}"/></td>
                                                  </tr>
												  <tr>
                                                    <td align="right" valign="top" class="font-12-gra">*</td>
                                                    <td align="left" valign="top" class="font-12-gra"><input name="cb_storepost" type="text" class="text_field1" id="cb_storepost" value="<?php e_strt('Postal Code');?>" onFocus="if(this.value=='<?php e_strt('Postal Code');?>'){this.value='';}" onBlur="if(this.value==''){this.value='<?php e_strt('Postal Code');?>';}"/></td>
                                                  </tr>
												  <tr>
                                                    <td align="right" valign="top" class="font-12-gra">&nbsp;</td>
                                                    <td align="left" valign="top" class="font-12-gra"><input name="phonenumber" type="text" class="text_field1" id="phonenumber" value="<?php e_strt('Phone Number');?>" onFocus="if(this.value=='<?php e_strt('Phone Number');?>'){this.value='';}" onBlur="if(this.value==''){this.value='<?php e_strt('Phone Number');?>';}"/></td>
                                                  </tr>
												  <tr>
                                                    <td align="right" valign="top" class="font-12-gra">&nbsp;</td>
                                                    <td align="left" valign="top" class="font-12-gra"><input name="mobilenumber" type="text" class="text_field1" id="mobilenumber" value="<?php e_strt('Mobile Number');?>" onFocus="if(this.value=='<?php e_strt('Mobile Number');?>'){this.value='';}" onBlur="if(this.value==''){this.value='<?php e_strt('Mobile Number');?>';}"/></td>
                                                  </tr>
                                                  <tr>
                                                    <td align="right" valign="top" class="font-12-gra">&nbsp;</td>
                                                    <td align="left" valign="top" class="font-12-gra">&nbsp;</td>
                                                  </tr>
                                                </table></td>
                                              <td width="33%" align="left" valign="top"><table border="0" cellspacing="0" cellpadding="3">
                                                  <tr>
                                                    <td height="30" align="left" valign="middle" class="font-12-gold"><strong>
													<?php e_strt('Shop Information');?></strong></td>
                                                  </tr>
                                                  <tr>
                                                    <td align="left" valign="top" class="font-12-gra"><input name="dateopened" type="text" class="text_field1" id="dateopened" value="<?php e_strt('Date Opened');?>" onFocus="if(this.value=='<?php e_strt('Date Opened');?>'){this.value='';}" onBlur="if(this.value==''){this.value='<?php e_strt('Date Opened');?>';}"/></td>
                                                  </tr>
                                                  <tr>
                                                    <td align="left" valign="top" class="font-12-gra"><input name="noofsalestaff" type="text" class="text_field1" id="noofsalestaff" value="<?php e_strt('Number of Sales Staff');?>" onFocus="if(this.value=='<?php e_strt('Number of Sales Staff');?>'){this.value='';}" onBlur="if(this.value==''){this.value='<?php e_strt('Number of Sales Staff');?>';}"/></td>
                                                  </tr>
                                                  <tr>
                                                    <td align="left" valign="top" class="font-12-gra"><input name="sizeofstaff" type="text" class="text_field1" id="sizeofstaff" value="<?php e_strt('Size of Shop');?>" onFocus="if(this.value=='<?php e_strt('Size of Shop');?>'){this.value='';}" onBlur="if(this.value==''){this.value='<?php e_strt('Size of Shop');?>';}"/></td>
                                                  </tr>
                                                  <tr>
                                                    <td align="left" valign="top" class="font-12-gra"><textarea name="descoflocandshop" rows="3" class="text_field1" id="descoflocandshop" onFocus="if(this.value=='<?php e_strt('Description of location and shop');?>'){this.value='';}" onBlur="if(this.value==''){this.value='<?php e_strt('Description of location and shop');?>';}" style="font-family: Arial, Helvetica, sans-serif;"><?php e_strt('Description of location and shop');?></textarea></td>
                                                  </tr>
                                                </table></td>
                                              <td width="31%" align="left" valign="top"><table border="0" cellspacing="0" cellpadding="3">
                                                  <tr>
                                                    <td height="30" align="left" valign="middle" class="font-12-gold"><strong>
													<?php e_strt('Commercial Information');?></strong></td>
                                                  </tr>
                                                  <tr>
                                                    <td align="left" valign="top" class="font-12-gra"><input name="currentbrand_sold" type="text" class="text_field1" id="currentbrand_sold" value="<?php e_strt('Current brands sold');?>" onFocus="if(this.value=='<?php e_strt('Current brands sold');?>'){this.value='';}" onBlur="if(this.value==''){this.value='<?php e_strt('Current brands sold');?>';}"/></td>
                                                  </tr>
                                                  <tr>
                                                    <td align="left" valign="top" class="font-12-gra"><input name="mainsupplier" type="text" class="text_field1" id="mainsupplier" value="<?php e_strt('Main Supplier');?>" onFocus="if(this.value=='<?php e_strt('Main Supplier');?>'){this.value='';}" onBlur="if(this.value==''){this.value='<?php e_strt('Main Supplier');?>';}"/></td>
                                                  </tr>
                                                  <tr>
                                                    <td align="left" valign="top" class="font-12-gra"><textarea name="doumanufacturer" rows="3" class="text_field1"  id="doumanufacturer" onFocus="if(this.value=='<?php e_strt('Do you manufacture your own dresses?');?>'){this.value='';}" onBlur="if(this.value==''){this.value='<?php e_strt('Do you manufacture your own dresses?');?>';}" style="font-family: Arial, Helvetica, sans-serif;"><?php e_strt('Do you manufacture your own dresses?');?></textarea></td>
                                                  </tr>
                                                  <tr>
                                                    <td align="left" valign="top" class="font-12-gra"><input name="avgretailprice" type="text" class="text_field1" id="avgretailprice" value="<?php e_strt('Average retail dress price');?>" onFocus="if(this.value=='<?php e_strt('Average retail dress price');?>'){this.value='';}" onBlur="if(this.value==''){this.value='<?php e_strt('Average retail dress price');?>';}"/></td>
                                                  </tr>
                                                  <tr>
                                                    <td align="left" valign="top" class="font-12-gra"><textarea name="soldperyear" rows="3" class="text_field1" id="soldperyear" onFocus="if(this.value=='<?php e_strt('Approximate number of bridal units sold per year');?>'){this.value='';}" onBlur="if(this.value==''){this.value='<?php e_strt('Approximate number of bridal units sold per year');?>';}" style="font-family: Arial, Helvetica, sans-serif;"><?php e_strt('Approximate number of bridal units sold per year');?></textarea></td>
                                                  </tr>
                                                </table></td>
                                            </tr>
                                          </table></td>
                                      </tr>
                                      <tr>
                                        <td height="50" align="left" valign="middle">
										<input type="hidden" name="HidSubmit" id="HidSubmit" value="0" />
										<input type="button" value="<?php e_upstrt('SUBMIT');?>" onClick="return FrmCheck();" class="JAbutton"/>
                                        </td>
                                      </tr>
                                    </table></td>
                                </tr>
                              </table>
							</form>
							</td>
                            <td align="left" valign="top"><? //include("right_facebook.php");?></td>
                          </tr>
                        </table></td>
                    </tr>
                  </table>
                   </div>  
        </div>
        
    </div>
    <? include("footer.php");?>
<script language="javascript" type="text/javascript">
function FrmCheck()
{
	var frm=document.FrmInquiry;
	if(frm.contact.value.split(" ").join("")=="" || frm.contact.value.split(" ").join("")=="<?php e_strt('Contact');?>")
	{
		alert("<?php e_strt('Please enter your contact name.');?>");
		frm.contact.focus();
		return false;
	}
	if(frm.bridalshop.value.split(" ").join("")=="" || frm.bridalshop.value=="<?php e_strt('Bridal Shop');?>")
	{
		alert("<?php e_strt('Please enter your bridal shop name.');?>");
		frm.bridalshop.focus();
		return false;
	}
	if(frm.address.value.split(" ").join("")=="" || frm.address.value.split(" ").join("")=="<?php e_strt('Address');?>")
	{
		alert("<?php e_strt('Please enter address.');?>");
		frm.address.focus();
		return false;
	}
	if(frm.country.value.split(" ").join("")=="" || frm.country.value.split(" ").join("")=="<?php e_strt('Country');?>")
	{
		alert("<?php e_strt('Please enter Country.');?>");
		frm.country.focus();
		return false;
	}
	if(frm.email.value.split(" ").join("")=="" || frm.email.value.split(" ").join("")=="<?php e_strt('Email');?>")
	{
		alert("<?php e_strt('Please enter your email address.');?>");
		frm.email.focus();
		return false;
	}
	/*if(frm.email.value!="")
	{
		if (!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(frm.email.value)))
		{
				alert("Please enter a proper email address.");
				frm.email.focus();
				return false;
		}
	}*/
	if(frm.continent.value.split(" ").join("")=="")
	{
		alert("<?php e_strt('Please select continent.');?>");
		frm.continent.focus();
		return false;
	}
	if(frm.cb_storecity.value.split(" ").join("")=="" || frm.cb_storecity.value.split(" ").join("")=="<?php e_strt('City');?>")
	{
		alert("<?php e_strt('Please enter city.');?>");
		frm.cb_storecity.focus();
		return false;
	}
	if(frm.cb_storepost.value.split(" ").join("")=="" || frm.cb_storepost.value=="<?php e_strt('Postal Code');?>")
	{
		alert("<?php e_strt('Please enter Postal Code.');?>");
		frm.cb_storepost.focus();
		return false;
	}
	/*if(frm.mobilenumber.value.split(" ").join("")=="" || frm.mobilenumber.value=="Mobile Number")
	{
		alert("Please enter your mobile number.");
		frm.mobilenumber.focus();
		return false;
	}*/
	frm.HidSubmit.value=1;
	frm.submit();
	return true;
}
</script>
<? include("googleanalytic.php");?>
</body>
</html>
