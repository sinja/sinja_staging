<?php
include("admin.config.inc.php"); 
include("connect1.php");
include("admin.cookie.php");
if($ADMIN_TOP_retailers_E=="N" && $ADMIN_TOP_retailers_A=="N" ){header("location:inner.php");}
$mlevel=9;
include("fckeditor/fckeditor.php") ;
$Message="";
$Message="";
if(isset($_POST['Submit']))
{
	if(stripslashes($_POST['cb_storepost'])!="" && stripslashes($_POST['cb_storepost'])!="Postal Code"){$cb_storepost=($_POST['cb_storepost']);}else{$cb_storepost="";}
	
		//Attempt to geocode the store and save the lat/long
		define("MAPS_HOST", "maps.google.com");
		$base_url = "http://" . MAPS_HOST . "/maps/geo?output=csv";
		
		$addadd1 = addslashes($_POST['cb_storeaddress1']);
		$addcity = addslashes($_POST['cb_storecity']);
		$addstate = addslashes($_POST['cb_storeprostate']);
		$addpostalcode = addslashes($_POST['cb_storepost']);
			
		//get the countryname
		$countryname = "";
		$countryQry2="select CountryName from Countries where CountryId='".addslashes($_POST['cb_storecountry'])."'";
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
		
	
	if($_GET['id'])
	{
		//define the reatiler status
		$retailerstatusid = addslashes($_POST['retailerstatus']);
		//now define whether or not the user will be blocked.
		$userblocked = ($retailerstatusid == "2")?"0":"1";
		
		$UserQry="UPDATE jos_users SET name='".addslashes($_POST['cb_storename'])."',username='".addslashes($_POST['username'])."',password='".addslashes($_POST['password'])."',email='".addslashes($_POST['cb_storeemail'])."', block='".$userblocked."' where id='".trim($_REQUEST['id'])."'";
		$UserQryRs=mysql_query($UserQry);
		
		$UserQry2="UPDATE jos_comprofiler SET 
											  RetailerStatusId='".$retailerstatusid."',
											  cb_storename='".addslashes($_POST['cb_storename'])."',
											  cb_storeemail='".addslashes($_POST['cb_storeemail'])."',
											  cb_ecomacct='".addslashes($_POST['cb_ecomacct'])."',
											  cb_contactname='".addslashes($_POST['cb_contactname'])."',
											  cb_storeaddress1='".addslashes($_POST['cb_storeaddress1'])."',
											  CountryId='".addslashes($_POST['cb_storecountry'])."',
											  cb_storephone='".addslashes($_POST['cb_storephone'])."',
											  cb_storecity='".addslashes($_POST['cb_storecity'])."',
											  cb_storeprostate='".addslashes($_POST['cb_storeprostate'])."',
											  cb_storepost='".addslashes($_POST['cb_storepost'])."',
											  mobilenumber='".addslashes($_POST['mobilenumber'])."',
												cb_storewebsite='".addslashes($_POST['website'])."',
											  dateopened='".addslashes($_POST['dateopened'])."',
											  noofsalestaff='".addslashes($_POST['noofsalestaff'])."',
											  sizeofstaff='".addslashes($_POST['sizeofstaff'])."',
											  descoflocandshop='".addslashes($_POST['descoflocandshop'])."',
											  currentbrand_sold='".addslashes($_POST['currentbrand_sold'])."',
											  mainsupplier='".addslashes($_POST['mainsupplier'])."',
											  doumanufacturer='".addslashes($_POST['doumanufacturer'])."',
											  avgretailprice='".addslashes($_POST['avgretailprice'])."',
											  soldperyear='".addslashes($_POST['soldperyear'])."',
											  cb_jab='".addslashes($_POST['cb_jab'])."',
											  cb_jap='".addslashes($_POST['cb_jap'])."',
											  cb_jas='".addslashes($_POST['cb_jas'])."',
											  cb_sin='".addslashes($_POST['cb_sin'])."',
											  cb_sip='".addslashes($_POST['cb_sip'])."',
											  cb_sde='".addslashes($_POST['cb_sde'])."',
											  cb_swh='".addslashes($_POST['cb_swh'])."'	$andddd										  
											  WHERE user_id='".trim($_REQUEST['id'])."'";
		$UserQryRs2=mysql_query($UserQry2);
		header("location:manage_users_retailers.php?msgs=3");
		exit;
	}
	else
	{
		//define the reatiler status
		$retailerstatusid = addslashes($_POST['retailerstatus']);
		//now define whether or not the user will be blocked.
		$userblocked = ($retailerstatusid == "2")?"0":"1";
		
		$UserQry="INSERT INTO jos_users SET name='".addslashes($_POST['cb_storename'])."',username='".addslashes($_POST['username'])."',password='".addslashes($_POST['password'])."',email='".addslashes($_POST['cb_storeemail'])."', block='".$userblocked."',registerDate=now()";
		$UserQryRs=mysql_query($UserQry);
		$insertedid=mysql_insert_id();
		$UserQry2="INSERT INTO  jos_comprofiler SET 
											  id='".$insertedid."',
											  RetailerStatusId='".$retailerstatusid."',
											  user_id='".$insertedid."',
											  cb_storename='".addslashes($_POST['cb_storename'])."',
											  cb_storeemail='".addslashes($_POST['cb_storeemail'])."',
											  cb_ecomacct='".addslashes($_POST['cb_ecomacct'])."',
											  cb_contactname='".addslashes($_POST['cb_contactname'])."',
											  cb_storeaddress1='".addslashes($_POST['cb_storeaddress1'])."',
											  CountryId='".addslashes($_POST['cb_storecountry'])."',
											  cb_storephone='".addslashes($_POST['cb_storephone'])."',
											  cb_storecity='".addslashes($_POST['cb_storecity'])."',
											  cb_storeprostate='".addslashes($_POST['cb_storeprostate'])."',
											  cb_storepost='".addslashes($_POST['cb_storepost'])."',
											  mobilenumber='".addslashes($_POST['mobilenumber'])."',
 												cb_storewebsite='".addslashes($_POST['website'])."',
											  dateopened='".addslashes($_POST['dateopened'])."',
											  noofsalestaff='".addslashes($_POST['noofsalestaff'])."',
											  sizeofstaff='".addslashes($_POST['sizeofstaff'])."',
											  descoflocandshop='".addslashes($_POST['descoflocandshop'])."',
											  currentbrand_sold='".addslashes($_POST['currentbrand_sold'])."',
											  mainsupplier='".addslashes($_POST['mainsupplier'])."',
											  doumanufacturer='".addslashes($_POST['doumanufacturer'])."',
											  avgretailprice='".addslashes($_POST['avgretailprice'])."',
											  soldperyear='".addslashes($_POST['soldperyear'])."',
											  cb_jab='".addslashes($_POST['cb_jab'])."',
											  cb_jap='".addslashes($_POST['cb_jap'])."',
											  cb_jas='".addslashes($_POST['cb_jas'])."',
											  cb_sin='".addslashes($_POST['cb_sin'])."',
											  cb_sip='".addslashes($_POST['cb_sip'])."',
											  cb_sde='".addslashes($_POST['cb_sde'])."',
											  cb_swh='".addslashes($_POST['cb_swh'])."' $andddd";
		$UserQryRs2=mysql_query($UserQry2);
		header("location:manage_users_retailers.php?msgs=1");
		exit;
	}		
}

if($_GET['id'])
{
	$Buttitle="Save changes";
	$SEL="select jos_users.*,CountryId,jos_comprofiler.cb_storepost
	      ,jos_comprofiler.cb_storename,jos_comprofiler.cb_storeaddress1,jos_comprofiler.cb_storephone,jos_comprofiler.cb_storewebsite,jos_comprofiler.cb_storeemail,jos_comprofiler.cb_contactname
		  ,jos_comprofiler.cb_ecomacct,jos_comprofiler.mobilenumber,jos_comprofiler.dateopened,jos_comprofiler.noofsalestaff
		  ,jos_comprofiler.sizeofstaff,jos_comprofiler.descoflocandshop,jos_comprofiler.currentbrand_sold,jos_comprofiler.mainsupplier,jos_comprofiler.doumanufacturer,jos_comprofiler.avgretailprice,jos_comprofiler.soldperyear
		  ,jos_comprofiler.cb_jab,jos_comprofiler.cb_jap,jos_comprofiler.cb_jas,jos_comprofiler.cb_sin,jos_comprofiler.cb_sip,jos_comprofiler.cb_sde,jos_comprofiler.cb_swh
		  ,jos_comprofiler.cb_storecity,jos_comprofiler.cb_storeprostate,jos_comprofiler.cb_storepost, jos_comprofiler.RetailerStatusId
		  from jos_users,jos_comprofiler 
		  where 1=1 
		  and  jos_comprofiler.user_id=jos_users.id
		  and jos_users.id=".trim($_REQUEST['id'])."";

	$SELRs=mysql_query($SEL);
	$ROW=mysql_fetch_object($SELRs);
}
else
{
	$Buttitle="Add";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD html 4.0 Transitional//EN">
<html>
<head>
<title><?php echo $ADMIN_MAIN_SITE_NAME ?></title>
<link href="main.css" type=text/css rel=stylesheet />
</head>
<body leftMargin="0" topMargin="0" marginheight="0" marginwidth="0">
<script language=javascript src="body.js"></script>
<script language="Javascript" type="text/JavaScript" src="calendar.js"></script>
<script language="javascript" type="text/javascript">
function valid()
{
	form=document.addprod;
	
	if(form.cb_storename.value.split(" ").join("")=="")
	{
		alert("Please enter Bridal Shop Name.");
		form.cb_storename.focus();
		return false;
	}	
	if(form.cb_storeemail.value.split(" ").join("")=="")
	{
		alert("Please enter email address.");
		form.email.focus();
		return false;
	}
	if(form.username.value.split(" ").join("")=="")
	{
		alert("Please enter username.");
		form.username.focus();
		return false;
	}
	if(form.password.value.split(" ").join("")=="")
	{
		alert("Please enter password.");
		form.password.focus();
		return false;
	}
	if(form.conpassword.value.split(" ").join("")=="")
	{
		alert("Please enter confirm password.");
		form.conpassword.focus();
		return false;
	}
	if(form.password.value!=form.conpassword.value)
	{
		alert("Confirm password does not match.");
		form.conpassword.focus();
		return false;
	}
	if(form.cb_storecountry.value.split(" ").join("")=="")
	{
		alert("Please select a Shop Country.");
		form.cb_storecountry.focus();
		return false;
	}	
	return  true;	
}
</script>
<table align="left" width="100%" cellpadding="0" cellspacing="0" >
  <tr>
    <td><table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td height="75"><? include ("top.php"); ?></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td><table cellspacing="0" cellpadding="0" width="100%" border=0>
        <tbody >
          <tr>
            <td width="20%"  valign="top" class="rightbdr" ><? include("inner_left_admin.php"); ?>
            </td>
            <td width="80%" valign="top" align="center"><table width="100%"  border=0 cellpadding="2" cellspacing="2">
                <tr>
                  <td height="35" class="form111"><? if($_GET['id']){?>
                    Edit
                    <? } else {?>
                    Add
                    <? } ?>
                    Retailer User </td>
                </tr>
                <tr>
                  <td height="222" class="formbg" valign="top"><form name="addprod" id="addprod"  method="post" enctype="multipart/form-data" action="#">
                      <table cellspacing="2" cellpadding="2" width=98% border="0" class="t-b">
                        <tr>
                          <td class="a" align="right" colspan="4">*= Required Information</td>
                        </tr>
                        <? if($Message){?>
                        <tr>
                          <td class="a" align="center" colspan="4"><?=$Message;?>
                            &nbsp;</td>
                        </tr>
                        <? }?>
                        						<tr>
                          <td width="24%" height="25" align="right" valign="top"><strong>Retailer Status:&nbsp;</strong></td>
                          <td height="25" colspan="3" valign="top"><select name="retailerstatus"  id="retailerstatus">                                    
                                    <?
									$selBlogQry="SELECT RetailerStatusId,StatusName from retailerstatus order by SortOrder asc"; 	
									$selBlogQryRs=mysql_query($selBlogQry);
									$TotselBlog=mysql_affected_rows();
									if($TotselBlog>0)
									{
										for($BC=0;$BC<$TotselBlog;$BC++)
										{
											$selBlogQryRow=mysql_fetch_array($selBlogQryRs);
											?>
												<option value="<? echo stripslashes($selBlogQryRow['RetailerStatusId']);?>" <?= stripslashes($ROW->RetailerStatusId)== stripslashes($selBlogQryRow['RetailerStatusId'])?"selected":"";?>><? echo stripslashes($selBlogQryRow['StatusName']);?></option>
											<?
										}
									}
									?>
								</select></td>
                        </tr>
						<tr>
                          <td width="24%" height="25" align="right" valign="top"><strong><span class="a">*</span> Bridal shop:&nbsp;</strong></td>
                          <td height="25" colspan="3" valign="top"><input name="cb_storename" id="cb_storename" style="width:370px;"  value="<? echo htmlentities(stripslashes($ROW->cb_storename));?>" type="text"  class="solidinput"></td>
                        </tr>
						 <tr>
                          <td width="24%" height="25" align="right" valign="top"><strong><span class="a">*</span> Email:&nbsp;</strong></td>
                          <td height="25" colspan="3" valign="top"><input name="cb_storeemail" id="cb_storeemail" style="width:370px;"  value="<? echo htmlentities(stripslashes($ROW->cb_storeemail));?>" type="text"  class="solidinput"></td>
                        </tr>
                        <tr>
                          <td width="24%" height="25" align="right" valign="top"><strong><span class="a">*</span> User Name:&nbsp;</strong></td>
                          <td height="25" colspan="3" valign="top"><input name="username" id="username" style="width:370px;"  value="<? echo htmlentities(stripslashes($ROW->username));?>" type="text"  class="solidinput"></td>
                        </tr>
                        <tr>
                          <td width="24%" height="25" align="right" valign="top"><strong><span class="a">*</span> Password:&nbsp;</strong></td>
                          <td height="25" colspan="3" valign="top"><input name="password" id="password" style="width:370px;"  value="<? echo htmlentities(stripslashes($ROW->password));?>" type="text"  class="solidinput">                          </td>
                        </tr>
						<tr>
                          <td width="24%" height="25" align="right" valign="top"><strong><span class="a">*</span>Confirm Password:&nbsp;</strong></td>
                          <td height="25" colspan="3" valign="top"><input name="conpassword" id="conpassword" style="width:370px;"  value="<? echo htmlentities(stripslashes($ROW->password));?>" type="text"  class="solidinput">                          </td>
                        </tr>
						<? if($_REQUEST['id']!=""){?>
						<tr>
                          <td width="24%" height="25" align="right" valign="top"><strong>Register Date:&nbsp;</strong></td>
                          <td height="25" colspan="3" valign="top"><? echo htmlentities(stripslashes($ROW->registerDate));?>&nbsp;</td>
                        </tr>
						<tr>
                          <td width="24%" height="25" align="right" valign="top"><strong>Last Visit Date:&nbsp;</strong></td>
                          <td height="25" colspan="3" valign="top"><? if($ROW->lastvisitDate!="0000-00-00 00:00:00"){echo htmlentities(stripslashes($ROW->lastvisitDate));}else{echo "Never";}?>&nbsp;</td>
                        </tr>
						<? } ?>
						<tr>
                          <td width="24%" height="25" align="right" valign="top"><strong>Ecom Acct:&nbsp;</strong></td>
                          <td height="25" colspan="3" valign="top"><input name="cb_ecomacct" id="cb_ecomacct" style="width:370px;"  value="<? echo htmlentities(stripslashes($ROW->cb_ecomacct));?>" type="text"  class="solidinput">                          </td>
                        </tr>
						<tr>
                          <td width="24%" height="25" align="right" valign="top"><strong>Contact Name:&nbsp;</strong></td>
                          <td height="25" colspan="3" valign="top"><input name="cb_contactname" id="cb_contactname" style="width:370px;"  value="<? echo htmlentities(stripslashes($ROW->cb_contactname));?>" type="text"  class="solidinput">                          </td>
                        </tr>
						<tr>
                          <td width="24%" height="25" align="right" valign="top"><strong>Shop Address:&nbsp;</strong></td>
                          <td height="25" colspan="3" valign="top"><input name="cb_storeaddress1" id="cb_storeaddress1" style="width:370px;"  value="<? echo htmlentities(stripslashes($ROW->cb_storeaddress1));?>" type="text"  class="solidinput">                          </td>
                        </tr>
						<tr>
                          <td width="24%" height="25" align="right" valign="top"><strong><span class="a">*</span>Shop Country:&nbsp;</strong></td>
                          <td height="25" colspan="3" valign="top">
						  <?php /*?><select name="cb_storecountry" class="text_field7" id="cb_storecountry"><option value="">Country</option><?=GetDropdown(name,name,directory_country,' where country_id!=\'\' and name!=\'\' order by name asc',$ROW->cb_storecountry);?></select><?php */?>
                          <select name="cb_storecountry" class="solidinput" id="cb_storecountry" style="width:370px;">
											<option value="">Country</option>
											<?                       
												$GETCountryQry="SELECT DISTINCT 
    CountryId, CountryName 
FROM 
    Countries
order by  
    CountryName asc";

												$GETCountryQryRs=mysql_query($GETCountryQry);
												$TotGETCountry=mysql_affected_rows();
												
												if($TotGETCountry>0)
												{
													for($CC=0;$CC<$TotGETCountry;$CC++)
													{
														$GETCountryQryRow=mysql_fetch_array($GETCountryQryRs);
														?>
														<option value="<?=stripslashes($GETCountryQryRow['CountryId']);?>" <? if(stripslashes($GETCountryQryRow['CountryId'])==stripslashes($ROW->CountryId)){echo "selected";}?>><?=stripslashes($GETCountryQryRow['CountryName']);?></option>
														<?	
													}
												}
											?>
										</select>
                                                    </td>
                        </tr>
						<tr>
                          <td width="24%" height="25" align="right" valign="top"><strong>City:&nbsp;</strong></td>
                          <td height="25" colspan="3" valign="top"><input name="cb_storecity" id="cb_storecity" style="width:370px;"  value="<? echo htmlentities(stripslashes($ROW->cb_storecity));?>" type="text"  class="solidinput">                          </td>
                        </tr>
						<tr>
                          <td width="24%" height="25" align="right" valign="top"><strong>State:&nbsp;</strong></td>
                          <td height="25" colspan="3" valign="top"><input name="cb_storeprostate" id="cb_storeprostate" style="width:370px;"  value="<? echo htmlentities(stripslashes($ROW->cb_storeprostate));?>" type="text"  class="solidinput">                          </td>
                        </tr>
						<tr>
                          <td width="24%" height="25" align="right" valign="top"><strong>Zip:&nbsp;</strong></td>
                          <td height="25" colspan="3" valign="top"><input name="cb_storepost" id="cb_storepost" style="width:370px;"  value="<? echo htmlentities(stripslashes($ROW->cb_storepost));?>" type="text"  class="solidinput">                          </td>
                        </tr>
						<tr>
                          <td width="24%" height="25" align="right" valign="top"><strong>Shop Phone Number:&nbsp;</strong></td>
                          <td height="25" colspan="3" valign="top"><input name="cb_storephone" id="cb_storephone" style="width:370px;"  value="<? echo htmlentities(stripslashes($ROW->cb_storephone));?>" type="text"  class="solidinput">                          </td>
                        </tr>
						<tr>
                          <td width="24%" height="25" align="right" valign="top"><strong>Shop Mobile Number:&nbsp;</strong></td>
                          <td height="25" colspan="3" valign="top"><input name="mobilenumber" id="mobilenumber" style="width:370px;"  value="<? echo htmlentities(stripslashes($ROW->mobilenumber));?>" type="text"  class="solidinput">                          </td>
                        </tr>
                        <tr>
                          <td width="24%" height="25" align="right" valign="top"><strong>Website:&nbsp;</strong></td>
                          <td height="25" colspan="3" valign="top"><input name="website" id="website" style="width:370px;"  value="<? echo htmlentities(stripslashes($ROW->cb_storewebsite));?>" type="text"  class="solidinput">                          </td>
                        </tr>
						<tr>
                          <td width="24%" height="25" align="right" valign="top"><strong>Date Opened:&nbsp;</strong></td>
                          <td height="25" colspan="3" valign="top"><input name="dateopened" id="dateopened" style="width:370px;"  value="<? echo htmlentities(stripslashes($ROW->dateopened));?>" type="text"  class="solidinput">                          </td>
                        </tr>
						<tr>
                          <td width="24%" height="25" align="right" valign="top"><strong>Number of Sale Staff:&nbsp;</strong></td>
                          <td height="25" colspan="3" valign="top"><input name="noofsalestaff" id="noofsalestaff" style="width:370px;"  value="<? echo htmlentities(stripslashes($ROW->noofsalestaff));?>" type="text"  class="solidinput">                          </td>
                        </tr>
						<tr>
                          <td width="24%" height="25" align="right" valign="top"><strong>Size of Shop:&nbsp;</strong></td>
                          <td height="25" colspan="3" valign="top"><input name="sizeofstaff" id="sizeofstaff" style="width:370px;"  value="<? echo htmlentities(stripslashes($ROW->sizeofstaff));?>" type="text"  class="solidinput">                          </td>
                        </tr>
						<tr>
                          <td width="24%" height="25" align="right" valign="top"><strong>Description of <br>
                          Location & shop:&nbsp;</strong></td>
                          <td height="25" colspan="3" valign="top">
						  <?php
									$oFCKeditor = new FCKeditor('descoflocandshop') ;
									$oFCKeditor->BasePath = 'fckeditor/';
									$oFCKeditor->Value = stripslashes($ROW->descoflocandshop);
									$oFCKeditor->Height = 500;
									$oFCKeditor->Width = 650;
									$oFCKeditor->Create() ;
							?>
						  </td>
                        </tr>
						<tr>
                          <td width="24%" height="25" align="right" valign="top"><strong>Current brands sold:&nbsp;</strong></td>
                          <td height="25" colspan="3" valign="top"><input name="currentbrand_sold" id="currentbrand_sold" style="width:370px;"  value="<? echo htmlentities(stripslashes($ROW->currentbrand_sold));?>" type="text"  class="solidinput">                          </td>
                        </tr>
						<tr>
                          <td width="24%" height="25" align="right" valign="top"><strong>Main Supplier:&nbsp;</strong></td>
                          <td height="25" colspan="3" valign="top"><input name="mainsupplier" id="mainsupplier" style="width:370px;"  value="<? echo htmlentities(stripslashes($ROW->mainsupplier));?>" type="text"  class="solidinput">                          </td>
                        </tr>
						<tr>
                          <td width="24%" height="25" align="right" valign="top"><strong>Do you manufacturer <br>
                          your own dresses?:&nbsp;</strong></td>
                          <td height="25" colspan="3" valign="top"><input name="doumanufacturer" id="doumanufacturer" style="width:370px;"  value="<? echo htmlentities(stripslashes($ROW->doumanufacturer));?>" type="text"  class="solidinput">                          </td>
                        </tr>
						<tr>
                          <td width="24%" height="25" align="right" valign="top"><strong>Average retail dress price:&nbsp;</strong></td>
                          <td height="25" colspan="3" valign="top"><input name="avgretailprice" id="avgretailprice" style="width:370px;"  value="<? echo htmlentities(stripslashes($ROW->avgretailprice));?>" type="text"  class="solidinput">                          </td>
                        </tr>
						<tr>
                          <td width="24%" height="25" align="right" valign="top"><strong>Approximate number of <br>
                          bridal units sold per year:&nbsp;</strong></td>
                          <td height="25" colspan="3" valign="top"><input name="soldperyear" id="soldperyear" style="width:370px;"  value="<? echo htmlentities(stripslashes($ROW->soldperyear));?>" type="text"  class="solidinput">                          </td>
                        </tr>
						<tr>
                          <td width="24%" height="25" align="right" valign="top" colspan="2">&nbsp;</td>
                        </tr>
						<tr>
                          <td width="24%" height="25" align="right" valign="top"><strong>Justin Alexander :&nbsp;</strong></td>
                          <td height="25" colspan="3" valign="top">
						  <select name="cb_jab"  id="cb_jab">
							<option value="" ></option>
							<option value="Yes" <? if($ROW->cb_jab=="Yes"){?>selected="selected"<? } ?>>Yes</option>
							<option value="No" <? if($ROW->cb_jab=="No"){?>selected="selected"<? } ?>>No</option>
						  </select></td>
                        </tr>
						<tr>
                          <td width="24%" height="25" align="right" valign="top"><strong>Justin Alexander Signature:&nbsp;</strong></td>
                          <td height="25" colspan="3" valign="top">
						  <select name="cb_jas"  id="cb_jas">
							<option value="" ></option>
							<option value="Yes" <? if($ROW->cb_jas=="Yes"){?>selected="selected"<? } ?>>Yes</option>
							<option value="No" <? if($ROW->cb_jas=="No"){?>selected="selected"<? } ?>>No</option>
						  </select></td>
                        </tr>
						<tr>
                          <td width="24%" height="25" align="right" valign="top"><strong>Pure by Justin Alexander :&nbsp;</strong></td>
                          <td height="25" colspan="3" valign="top">
						  <select name="cb_jap"  id="cb_jap">
							<option value="" ></option>
							<option value="Yes" <? if($ROW->cb_jap=="Yes"){?>selected="selected"<? } ?>>Yes</option>
							<option value="No" <? if($ROW->cb_jap=="No"){?>selected="selected"<? } ?>>No</option>
						  </select></td>
                        </tr>
						<tr>
                          <td width="24%" height="25" align="right" valign="top"><strong>Sincerity Bridal :&nbsp;</strong></td>
                          <td height="25" colspan="3" valign="top">
						  <select name="cb_sin"  id="cb_sin">
							<option value="" ></option>
							<option value="Yes" <? if($ROW->cb_sin=="Yes"){?>selected="selected"<? } ?>>Yes</option>
							<option value="No" <? if($ROW->cb_sin=="No"){?>selected="selected"<? } ?>>No</option>
						  </select></td>
                        </tr>
						<tr>
                          <td width="24%" height="25" align="right" valign="top"><strong>Sincerity Plus:&nbsp;</strong></td>
                          <td height="25" colspan="3" valign="top">
						  <select name="cb_sip"  id="cb_sip">
							<option value="" ></option>
							<option value="Yes" <? if($ROW->cb_sip=="Yes"){?>selected="selected"<? } ?>>Yes</option>
							<option value="No" <? if($ROW->cb_sip=="No"){?>selected="selected"<? } ?>>No</option>
						  </select></td>
                        </tr>
						<tr>
                          <td width="24%" height="25" align="right" valign="top"><strong>Sarah Danielle:&nbsp;</strong></td>
                          <td height="25" colspan="3" valign="top">
						  <select name="cb_sde"  id="cb_sde">
							<option value="" ></option>
							<option value="Yes" <? if($ROW->cb_sde=="Yes"){?>selected="selected"<? } ?>>Yes</option>
							<option value="No" <? if($ROW->cb_sde=="No"){?>selected="selected"<? } ?>>No</option>
						  </select></td>
                        </tr>
						<tr>
                          <td width="24%" height="25" align="right" valign="top"><strong>Sweetheart :&nbsp;</strong></td>
                          <td height="25" colspan="3" valign="top">
						  <select name="cb_swh"  id="cb_swh">
							<option value="" ></option>
							<option value="Yes" <? if($ROW->cb_swh=="Yes"){?>selected="selected"<? } ?>>Yes</option>
							<option value="No" <? if($ROW->cb_swh=="No"){?>selected="selected"<? } ?>>No</option>
						  </select></td>
                        </tr>
						<tr>
                          <td align="right">&nbsp;</td>
                          <td width="76%" colspan="3"><INPUT type=submit name="Submit" value="<? echo $Buttitle;?>" onClick="return valid();" class="bttn-s">                          </td>
                        </tr>
                      </table>
                    </form></td>
                </tr>
              </table></td>
          </tr>
        </tbody>
      </table></td>
  </tr>
</table>
</body>
</html>
