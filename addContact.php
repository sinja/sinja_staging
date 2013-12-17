<?php
include("admin.config.inc.php"); 
include("connect1.php");
include("admin.cookie.php");
require_once 'include/cc/ConstantContact.php';
//require_once 'include/cc/config.php';	
$ConstantContact = new ConstantContact ( "basic", "8e0d649c-a3e3-4de9-b0e1-10f948b749ba", "jabridal", "workforce600" );
$id = $_REQUEST['id'];
$removeFromList = false;
$emailAddress = '';
$action = $_REQUEST['acc'];
if($action == 'del'){	
$emailAddress = $_REQUEST['email'];
$removeFromList = true;
}
if(!empty($id) && is_numeric($id)){
$SEL="select jos_users.*,CountryId,jos_comprofiler.cb_storepost
	      ,jos_comprofiler.cb_storename,jos_comprofiler.cb_storeaddress1,jos_comprofiler.cb_storephone,jos_comprofiler.cb_storewebsite,jos_comprofiler.cb_storeemail,jos_comprofiler.cb_contactname
		  ,jos_comprofiler.cb_ecomacct,jos_comprofiler.mobilenumber,jos_comprofiler.dateopened,jos_comprofiler.noofsalestaff
		  ,jos_comprofiler.sizeofstaff,jos_comprofiler.descoflocandshop,jos_comprofiler.currentbrand_sold,jos_comprofiler.mainsupplier,jos_comprofiler.doumanufacturer,jos_comprofiler.avgretailprice,jos_comprofiler.soldperyear
		  ,jos_comprofiler.cb_jab,jos_comprofiler.cb_jap,jos_comprofiler.cb_jas,jos_comprofiler.cb_jal,jos_comprofiler.cb_sin,jos_comprofiler.cb_sip,jos_comprofiler.cb_sde,jos_comprofiler.cb_swh
		  ,jos_comprofiler.cb_storecity,jos_comprofiler.cb_storeprostate,jos_comprofiler.cb_storepost, jos_comprofiler.RetailerStatusId
		  from jos_users,jos_comprofiler 
		  where 1=1 
		  and  jos_comprofiler.user_id=jos_users.id
		  and jos_users.id=".trim($id)."";

	$SELRs=mysql_query($SEL);
	$ROW=mysql_fetch_object($SELRs);
	
	/* Fatching th country name */
	$GETCountryQry="SELECT CountryName,CountryId, CountryCode2Letter FROM Countries WHERE CountryId = '".$ROW->CountryId."'";
	$GETCountryQryRs=mysql_query($GETCountryQry);
	$GETCountryQryRow=mysql_fetch_array($GETCountryQryRs);			
	$current_country_code = strtolower($GETCountryQryRow['CountryCode2Letter']);
	$current_country_name = strtolower($GETCountryQryRow['CountryName']);
	$emailAddress = $ROW->cb_storeemail;	
}


// search for a contact
$search = $ConstantContact->searchContactsByEmail ( $emailAddress );
if($removeFromList){
	$Contact = $ConstantContact->getContactDetails ( $search [0] );
	$Contact->lists = array();
	$result = $ConstantContact->updateContact ( $Contact );
}else{
// If the contact existed
if ($search) {
		
	// Get the details of this contact
	$Contact = $ConstantContact->getContactDetails ( $search [0] );
	
	$Contact->emailAddress = $ROW->cb_storeemail;
	$Contact->firstName = $ROW->cb_storename;
	$Contact->lastName = $ROW->username;
	$Contact->city = $ROW->cb_storecity;
//		$Contact->stateCode = '';
	$Contact->workPhone = $ROW->cb_storephone;
	$Contact->stateName = $ROW->cb_storeprostate;
	$Contact->countryCode = $current_country_code;
	$Contact->countryName = $current_country_name;
	$Contact->postalCode = $ROW->cb_storepost;
	$Contact->customField1 = $ROW->username;
	$Contact->customField2 = $ROW->cb_storename;
	$Contact->customField3 = $ROW->cb_ecomacct;
	$Contact->customField4 = $ROW->cb_jab;
	$Contact->customField5 = $ROW->cb_jal;
	$Contact->customField6 = $ROW->cb_jas;
	$Contact->customField7 = $ROW->cb_sin;
	$Contact->customField8 = $ROW->cb_sip;
	$Contact->customField9 = $ROW->cb_sde;
	$Contact->customField10 = $ROW->cb_swh;
	$Contact->customField11 = $ROW->cb_sdd;
	$Contact->customField12 = $ROW->RetailerStatusId;	

	$Contact->lists[0] = 'http://api.constantcontact.com/ws/customers/jabridal/lists/2';	
	$result = $ConstantContact->updateContact ( $Contact );
	// search for the contact again
	$searchExist = $ConstantContact->searchContactsByEmail($Contact->emailAddress);
	// getting the details of the contact again
	$detailsExist = $ConstantContact->getContactDetails($searchExist[0]);
	// Outputting the new information
	print "The contact was updated successfully!";
	

} else {
	if(is_object($ROW)){
	// Create a contact
	 $Contact = new Contact();
	$Contact->emailAddress = $ROW->cb_storeemail;
	$Contact->firstName = $ROW->cb_storename;
	$Contact->lastName = $ROW->username;
	$Contact->city = $ROW->cb_storecity;
//		$Contact->stateCode = '';
	$Contact->workPhone = $ROW->cb_storephone;
	$Contact->stateName = $ROW->cb_storeprostate;
//		$Contact->countryCode = $ROW->cb_storecountry;
	$Contact->countryName = $current_country_name;
	$Contact->postalCode = $ROW->cb_storepost;
	$Contact->customField1 = $ROW->username;
	$Contact->customField2 = $ROW->cb_storename;
	$Contact->customField3 = $ROW->cb_ecomacct;
	$Contact->customField4 = $ROW->cb_jab;
	$Contact->customField5 = $ROW->cb_jal;
	$Contact->customField6 = $ROW->cb_jas;
	$Contact->customField7 = $ROW->cb_sin;
	$Contact->customField8 = $ROW->cb_sip;
	$Contact->customField9 = $ROW->cb_sde;
	$Contact->customField10 = $ROW->cb_swh;
	$Contact->customField11 = $ROW->cb_sdd;
	$Contact->customField12 = $ROW->RetailerStatusId;
	
	$Contact->lists[0] = 'http://api.constantcontact.com/ws/customers/jabridal/lists/2';
	
	$NewContact = $ConstantContact->addContact($Contact);
	
	print "The contact was added to contacts list successfully";
	}
}
}
?>