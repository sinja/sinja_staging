<?php
include_once("admin.config.inc.php");
include("admin.cookie.php");
include("connect.php");
if($ADMIN_adminaddability=="N"){header("location:inner.php");}
$mlevel=3;
$Message="";
$Message="";
if(isset($_POST['Submit']))
{
   if($_POST['adminaddability']=='Y'){ $adminaddability='Y'; }else{ $adminaddability='N'; }
   if($_POST['TOP_admin']=='Y'){ $TOP_admin='Y'; }else{ $TOP_admin='N'; }
   if($_POST['TOP_designerdays_A']=='Y'){ $TOP_designerdays_A='Y'; }else{ $TOP_designerdays_A='N'; }
   if($_POST['TOP_designerdays_E']=='Y'){ $TOP_designerdays_E='Y'; }else{ $TOP_designerdays_E='N'; }
   if($_POST['TOP_designerdays_D']=='Y'){ $TOP_designerdays_D='Y'; }else{ $TOP_designerdays_D='N'; }
   if($_POST['TOP_customer']=='Y'){ $TOP_customer='Y'; }else{ $TOP_customer='N'; }
   if($_POST['TOP_customer_V']=='Y'){ $TOP_customer_V='Y'; }else{ $TOP_customer_V='N'; }
   if($_POST['TOP_customer_D']=='Y'){ $TOP_customer_D='Y'; }else{ $TOP_customer_D='N'; }
   if($_POST['TOP_customergroup_V']=='Y'){ $TOP_customergroup_V='Y'; }else{ $TOP_customergroup_V='N'; }
   if($_POST['TOP_products']=='Y'){ $TOP_products='Y'; }else{ $TOP_products='N'; }
   if($_POST['TOP_products_A']=='Y'){ $TOP_products_A='Y'; }else{ $TOP_products_A='N'; }
   if($_POST['TOP_products_E']=='Y'){ $TOP_products_E='Y'; }else{ $TOP_products_E='N'; }
   if($_POST['TOP_products_D']=='Y'){ $TOP_products_D='Y'; }else{ $TOP_products_D='N'; }
   if($_POST['TOP_products_sizes_A']=='Y'){ $TOP_products_sizes_A='Y'; }else{ $TOP_products_sizes_A='N'; }
   if($_POST['TOP_products_sizes_E']=='Y'){ $TOP_products_sizes_E='Y'; }else{ $TOP_products_sizes_E='N'; }
   if($_POST['TOP_products_sizes_D']=='Y'){ $TOP_products_sizes_D='Y'; }else{ $TOP_products_sizes_D='N'; }
   if($_POST['TOP_products_accessories_A']=='Y'){ $TOP_products_accessories_A='Y'; }else{ $TOP_products_accessories_A='N'; }
   if($_POST['TOP_products_accessories_E']=='Y'){ $TOP_products_accessories_E='Y'; }else{ $TOP_products_accessories_E='N'; }
   if($_POST['TOP_products_accessories_D']=='Y'){ $TOP_products_accessories_D='Y'; }else{ $TOP_products_accessories_D='N'; }
   if($_POST['TOP_products_colors_A']=='Y'){ $TOP_products_colors_A='Y'; }else{ $TOP_products_colors_A='N'; }
   if($_POST['TOP_products_colors_E']=='Y'){ $TOP_products_colors_E='Y'; }else{ $TOP_products_colors_E='N'; }
   if($_POST['TOP_products_colors_D']=='Y'){ $TOP_products_colors_D='Y'; }else{ $TOP_products_colors_D='N'; }
   if($_POST['TOP_products_collections_A']=='Y'){ $TOP_products_collections_A='Y'; }else{ $TOP_products_collections_A='N'; }
   if($_POST['TOP_products_collections_E']=='Y'){ $TOP_products_collections_E='Y'; }else{ $TOP_products_collections_E='N'; }
   if($_POST['TOP_products_collections_D']=='Y'){ $TOP_products_collections_D='Y'; }else{ $TOP_products_collections_D='N'; }
   if($_POST['TOP_products_silhouette_A']=='Y'){ $TOP_products_silhouette_A='Y'; }else{ $TOP_products_silhouette_A='N'; }
   if($_POST['TOP_products_silhouette_E']=='Y'){ $TOP_products_silhouette_E='Y'; }else{ $TOP_products_silhouette_E='N'; }
   if($_POST['TOP_products_silhouette_D']=='Y'){ $TOP_products_silhouette_D='Y'; }else{ $TOP_products_silhouette_D='N'; }
   if($_POST['TOP_products_neckline_A']=='Y'){ $TOP_products_neckline_A='Y'; }else{ $TOP_products_neckline_A='N'; }
   if($_POST['TOP_products_neckline_E']=='Y'){ $TOP_products_neckline_E='Y'; }else{ $TOP_products_neckline_E='N'; }
   if($_POST['TOP_products_neckline_D']=='Y'){ $TOP_products_neckline_D='Y'; }else{ $TOP_products_neckline_D='N'; }
   if($_POST['TOP_products_waist_A']=='Y'){ $TOP_products_waist_A='Y'; }else{ $TOP_products_waist_A='N'; }
   if($_POST['TOP_products_waist_E']=='Y'){ $TOP_products_waist_E='Y'; }else{ $TOP_products_waist_E='N'; }
   if($_POST['TOP_products_waist_D']=='Y'){ $TOP_products_waist_D='Y'; }else{ $TOP_products_waist_D='N'; }
   if($_POST['TOP_products_dresslength_A']=='Y'){ $TOP_products_dresslength_A='Y'; }else{ $TOP_products_dresslength_A='N'; }
   if($_POST['TOP_products_dresslength_E']=='Y'){ $TOP_products_dresslength_E='Y'; }else{ $TOP_products_dresslength_E='N'; }
   if($_POST['TOP_products_dresslength_D']=='Y'){ $TOP_products_dresslength_D='Y'; }else{ $TOP_products_dresslength_D='N'; }
   if($_POST['TOP_products_dresscolor_A']=='Y'){ $TOP_products_dresscolor_A='Y'; }else{ $TOP_products_dresscolor_A='N'; }
   if($_POST['TOP_products_dresscolor_E']=='Y'){ $TOP_products_dresscolor_E='Y'; }else{ $TOP_products_dresscolor_E='N'; }
   if($_POST['TOP_products_dresscolor_D']=='Y'){ $TOP_products_dresscolor_D='Y'; }else{ $TOP_products_dresscolor_D='N'; }
   if($_POST['TOP_blogs']=='Y'){ $TOP_blogs='Y'; }else{ $TOP_blogs='N'; }
   if($_POST['TOP_blog_A']=='Y'){ $TOP_blog_A='Y'; }else{ $TOP_blog_A='N'; }
   if($_POST['TOP_blog_E']=='Y'){ $TOP_blog_E='Y'; }else{ $TOP_blog_E='N'; }
   if($_POST['TOP_blog_D']=='Y'){ $TOP_blog_D='Y'; }else{ $TOP_blog_D='N'; }
   if($_POST['TOP_blogcategory_A']=='Y'){ $TOP_blogcategory_A='Y'; }else{ $TOP_blogcategory_A='N'; }
   if($_POST['TOP_blogcategory_E']=='Y'){ $TOP_blogcategory_E='Y'; }else{ $TOP_blogcategory_E='N'; }
   if($_POST['TOP_blogcategory_D']=='Y'){ $TOP_blogcategory_D='Y'; }else{ $TOP_blogcategory_D='N'; }
   if($_POST['TOP_blogcomment_E']=='Y'){ $TOP_blogcomment_E='Y'; }else{ $TOP_blogcomment_E='N'; }
   if($_POST['TOP_blogcomment_D']=='Y'){ $TOP_blogcomment_D='Y'; }else{ $TOP_blogcomment_D='N'; }
   if($_POST['TOP_press_A']=='Y'){ $TOP_press_A='Y'; }else{ $TOP_press_A='N'; }
   if($_POST['TOP_press_E']=='Y'){ $TOP_press_E='Y'; }else{ $TOP_press_E='N'; }
   if($_POST['TOP_press_D']=='Y'){ $TOP_press_D='Y'; }else{ $TOP_press_D='N'; }
   if($_POST['TOP_gallery_A']=='Y'){ $TOP_gallery_A='Y'; }else{ $TOP_gallery_A='N'; }
   if($_POST['TOP_gallery_E']=='Y'){ $TOP_gallery_E='Y'; }else{ $TOP_gallery_E='N'; }
   if($_POST['TOP_gallery_D']=='Y'){ $TOP_gallery_D='Y'; }else{ $TOP_gallery_D='N'; }
   if($_POST['TOP_newsletter']=='Y'){ $TOP_newsletter='Y'; }else{ $TOP_newsletter='N'; }
   if($_POST['TOP_newsletter_D']=='Y'){ $TOP_newsletter_D='Y'; }else{ $TOP_newsletter_D='N'; }
   if($_POST['TOP_StaticPage']=='Y'){ $TOP_StaticPage='Y'; }else{ $TOP_StaticPage='N'; }
   if($_POST['TOP_custoserloc_A']=='Y'){ $TOP_custoserloc_A='Y'; }else{ $TOP_custoserloc_A='N'; }
   if($_POST['TOP_custoserloc_E']=='Y'){ $TOP_custoserloc_E='Y'; }else{ $TOP_custoserloc_E='N'; }
   if($_POST['TOP_custoserloc_D']=='Y'){ $TOP_custoserloc_D='Y'; }else{ $TOP_custoserloc_D='N'; }
   if($_POST['TOP_Retailers']=='Y'){ $TOP_Retailers='Y'; }else{ $TOP_Retailers='N'; }
   if($_POST['TOP_retailers_A']=='Y'){ $TOP_retailers_A='Y'; }else{ $TOP_retailers_A='N'; }
   if($_POST['TOP_retailers_E']=='Y'){ $TOP_retailers_E='Y'; }else{ $TOP_retailers_E='N'; }
   if($_POST['TOP_retailers_D']=='Y'){ $TOP_retailers_D='Y'; }else{ $TOP_retailers_D='N'; }
   if($_POST['TOP_newsnpromo_A']=='Y'){ $TOP_newsnpromo_A='Y'; }else{ $TOP_newsnpromo_A='N'; }
   if($_POST['TOP_newsnpromo_E']=='Y'){ $TOP_newsnpromo_E='Y'; }else{ $TOP_newsnpromo_E='N'; }
   if($_POST['TOP_newsnpromo_D']=='Y'){ $TOP_newsnpromo_D='Y'; }else{ $TOP_newsnpromo_D='N'; }
   if($_POST['TOP_documents_A']=='Y'){ $TOP_documents_A='Y'; }else{ $TOP_documents_A='N'; }
   if($_POST['TOP_documents_E']=='Y'){ $TOP_documents_E='Y'; }else{ $TOP_documents_E='N'; }
   if($_POST['TOP_documents_D']=='Y'){ $TOP_documents_D='Y'; }else{ $TOP_documents_D='N'; }
   if($_POST['TOP_documentscat_A']=='Y'){ $TOP_documentscat_A='Y'; }else{ $TOP_documentscat_A='N'; }
   if($_POST['TOP_documentscat_E']=='Y'){ $TOP_documentscat_E='Y'; }else{ $TOP_documentscat_E='N'; }
   if($_POST['TOP_documentscat_D']=='Y'){ $TOP_documentscat_D='Y'; }else{ $TOP_documentscat_D='N'; }
   if($_POST['TOP_retaileremail_E']=='Y'){ $TOP_retaileremail_E='Y'; }else{ $TOP_retaileremail_E='N'; }
   
   
   			$strQueryPerPage="select * from admin where username='".addslashes($_POST["username"])."'  and id!='".trim($_GET['id'])."'";
			$strResultPerPage=mysql_query($strQueryPerPage);
			$strTotalPerPage=mysql_affected_rows(); 
			if($strTotalPerPage<1)
			{
				$sql="UPDATE admin SET 
						username='".addslashes($_POST["username"])."',
						password='".addslashes($_POST["password"])."',
						email='".addslashes($_POST["email"])."',
						adminaddability='$adminaddability',
						TOP_admin='$TOP_admin',
						TOP_designerdays_A='$TOP_designerdays_A',
						TOP_designerdays_E='$TOP_designerdays_E',
						TOP_designerdays_D='$TOP_designerdays_D',
						TOP_customer='$TOP_customer',
						TOP_customer_V='$TOP_customer_V',
						TOP_customer_D='$TOP_customer_D',
						TOP_customergroup_V='$TOP_customergroup_V',
						TOP_products='$TOP_products',
						TOP_products_A='$TOP_products_A',
						TOP_products_E='$TOP_products_E',
						TOP_products_D='$TOP_products_D',
						TOP_products_sizes_A='$TOP_products_sizes_A',
						TOP_products_sizes_E='$TOP_products_sizes_E',
						TOP_products_sizes_D='$TOP_products_sizes_D',
						TOP_products_accessories_A='$TOP_products_accessories_A',
						TOP_products_accessories_E='$TOP_products_accessories_E',
						TOP_products_accessories_D='$TOP_products_accessories_D',
						TOP_products_colors_A='$TOP_products_colors_A',
						TOP_products_colors_E='$TOP_products_colors_E',
						TOP_products_colors_D='$TOP_products_colors_D',
						TOP_products_collections_A='$TOP_products_collections_A',
						TOP_products_collections_E='$TOP_products_collections_E',
						TOP_products_collections_D='$TOP_products_collections_D',
						TOP_products_silhouette_A='$TOP_products_silhouette_A',
						TOP_products_silhouette_E='$TOP_products_silhouette_E',
						TOP_products_silhouette_D='$TOP_products_silhouette_D',
						TOP_products_neckline_A='$TOP_products_neckline_A',
						TOP_products_neckline_E='$TOP_products_neckline_E',
						TOP_products_neckline_D='$TOP_products_neckline_D',
						TOP_products_waist_A='$TOP_products_waist_A',
						TOP_products_waist_E='$TOP_products_waist_E',
						TOP_products_waist_D='$TOP_products_waist_D',
						TOP_products_dresslength_A='$TOP_products_dresslength_A',
						TOP_products_dresslength_E='$TOP_products_dresslength_E',
						TOP_products_dresslength_D='$TOP_products_dresslength_D',
						TOP_products_dresscolor_A='$TOP_products_dresscolor_A',
						TOP_products_dresscolor_E='$TOP_products_dresscolor_E',
						TOP_products_dresscolor_D='$TOP_products_dresscolor_D',
						TOP_blogs='$TOP_blogs',
						TOP_blog_A='$TOP_blog_A',
						TOP_blog_E='$TOP_blog_E',
						TOP_blog_D='$TOP_blog_D',
						TOP_blogcategory_A='$TOP_blogcategory_A',
						TOP_blogcategory_E='$TOP_blogcategory_E',
						TOP_blogcategory_D='$TOP_blogcategory_D',
						TOP_blogcomment_E='$TOP_blogcomment_E',
						TOP_blogcomment_D='$TOP_blogcomment_D',
						TOP_press_A='$TOP_press_A',
						TOP_press_E='$TOP_press_E',
						TOP_press_D='$TOP_press_D',
						TOP_gallery_A='$TOP_gallery_A',
						TOP_gallery_E='$TOP_gallery_E',
						TOP_gallery_D='$TOP_gallery_D',
						TOP_newsletter='$TOP_newsletter',
						TOP_newsletter_D='$TOP_newsletter_D',
						TOP_StaticPage='$TOP_StaticPage',
						TOP_custoserloc_A='$TOP_custoserloc_A',
						TOP_custoserloc_E='$TOP_custoserloc_E',
						TOP_custoserloc_D='$TOP_custoserloc_D',
						TOP_Retailers='$TOP_Retailers',
						TOP_retailers_A='$TOP_retailers_A',
						TOP_retailers_E='$TOP_retailers_E',
						TOP_retailers_D='$TOP_retailers_D',
						TOP_newsnpromo_A='$TOP_newsnpromo_A',
						TOP_newsnpromo_E='$TOP_newsnpromo_E',
						TOP_newsnpromo_D='$TOP_newsnpromo_D',
						TOP_documents_A='$TOP_documents_A',
						TOP_documents_E='$TOP_documents_E',
						TOP_documents_D='$TOP_documents_D',
						TOP_documentscat_A='$TOP_documentscat_A',
						TOP_documentscat_E='$TOP_documentscat_E',
						TOP_documentscat_D='$TOP_documentscat_D',
						TOP_retaileremail_E='$TOP_retaileremail_E' where id='".trim($_GET['id'])."'";	
				$q=mysql_query($sql);
				header("location:manage_adminuser.php?msgs=3");
				exit;
			}
			else 
			{
				$Message="Username already exists.";
			}
	
}

if($_GET['id'])
{
	$Buttitle="Save changes";
	$SelUserQry="SELECT * FROM admin WHERE id='".$_GET['id']."'";
	$SelUserQryRs=mysql_query($SelUserQry);
	$SelUserQryRow=mysql_fetch_object($SelUserQryRs);
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
	
	if(form.username.value.split(" ").join("")=="")
	{
		alert("Please enter username.");
		form.username.focus();
		return false;
	}	
	else if(form.password.value.split(" ").join("")=="")
	{
		alert("Please enter password.");
		form.password.focus();
		return false;
	}	
	else if(form.email.value.split(" ").join("")=="")
	{
		alert("Please enter email.");
		form.email.focus();
		return false;
	}	
	else if (!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(form.email.value)))
	{
			alert("Please enter a proper email address.");
			form.email.focus();
			return false;
	}
	else
	{
		return  true;	
	}	
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
                    Admin User </td>
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
                          <td width="44%" height="25" align="right" valign="top"><strong><span class="a">*</span> Username :&nbsp;</strong></td>
                          <td height="25" colspan="3" valign="top"><input name="username" id="username" style="width:170px;"  value="<? echo htmlentities(stripslashes($SelUserQryRow->username));?>" type="text"  class="solidinput"></td>
                        </tr>
                        <tr>
                          <td width="44%" height="25" align="right" valign="top"><strong><span class="a">*</span> Password :&nbsp;</strong></td>
                          <td height="25" colspan="3" valign="top"><input name="password" id="password" style="width:170px;"  value="<? echo htmlentities(stripslashes($SelUserQryRow->password));?>" type="text"  class="solidinput"></td>
                        </tr>
                        <tr>
                          <td width="44%" height="25" align="right" valign="top"><strong><span class="a">*</span> Email Address :&nbsp;</strong></td>
                          <td height="25" colspan="3" valign="top"><input name="email" id="email" style="width:170px;"  value="<? echo htmlentities(stripslashes($SelUserQryRow->email));?>" type="text"  class="solidinput"></td>
                        </tr>
                        <tr>
                          <td colspan="2" align="left">&nbsp;</td>
                        </tr>
                        <tr>
                          <td class="formbg" colspan="2" align="left"><strong>Assign Permissions</strong></td>
                        </tr>
                        <tr>
                          <td colspan="2" align="left">&nbsp;</td>
                        </tr>
                        <tr>
                          <td align="left" width="44%"  ><strong>Admin User Add Ability :</strong></td>
                          <td align="left"  ><input type="radio" name="adminaddability" id="adminaddabilityno" <? if($SelUserQryRow->adminaddability=="N"){ echo "checked";}?> value="N">
                            No&nbsp;&nbsp;
                            <input type="radio" name="adminaddability" id="adminaddabilityyes" value="Y" <? if($SelUserQryRow->adminaddability=="Y"){ echo "checked";}?>>
                            Yes </td>
                        </tr>
                        <tr>
                          <td colspan="2" align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr class="bg-bottom-line-div">
                                <td width="12%"  align="left"  class="stat_linkgreybold" ><strong >Admin</strong>&nbsp;</td>
                                <td width="35%"  align="left"   class="stat_linkgreybold" ><strong>TOP MENU</strong>&nbsp;
                                  <input class="inputCheck" type="checkbox" name="TOP_admin" id="TOP_admin" value="Y" <? if($SelUserQryRow->TOP_admin=="Y"){ echo "checked='checked'";}?>>
                                &nbsp;</td>
                                <td width="13%"  align="left"  >&nbsp;</td>
                                <td width="20%"  align="left"  >&nbsp;</td>
                                <td width="20%"  align="left"  >&nbsp;</td>
                              </tr>
                              
							  
							  <tr class="bg-bottom-line-div">
                                <td width="12%"  align="left"  class="stat_linkgreybold" ><strong >Customers</strong>&nbsp;</td>
                                <td width="35%"  align="left"   class="stat_linkgreybold" ><strong>TOP MENU</strong>&nbsp;
                                  <input class="inputCheck" type="checkbox" name="TOP_customer" id="TOP_customer" value="Y" <? if($SelUserQryRow->TOP_customer=="Y"){ echo "checked='checked'";}?>>
                                &nbsp;</td>
                                <td width="13%"  align="left"  >&nbsp;</td>
                                <td width="20%"  align="left"  >&nbsp;</td>
                                <td width="20%"  align="left"  >&nbsp;</td>
                              </tr>
							  <tr>
                                <td width="12%" align="right"  >&nbsp;</td>
                                <td width="35%"  align="left"  >Manage Customer</td>
                                <td width="13%" align="right" >&nbsp;</td>
                                <td width="20%" align="right" >View Customer&nbsp;
                                <input class="inputCheck" type="checkbox" name="TOP_customer_V" id="TOP_customer_V" value="Y" <? if($SelUserQryRow->TOP_customer_V=="Y"){ echo "checked='checked'";}?>></td>
                                <td width="20%" align="right" >Delete &nbsp;
                                  <input class="inputCheck" type="checkbox" name="TOP_customer_D" id="TOP_customer_D" value="Y" <? if($SelUserQryRow->TOP_customer_D=="Y"){ echo "checked='checked'";}?>></td>
                              </tr>
							  
                              <tr>
                                <td width="12%" align="right"  >&nbsp;</td>
                                <td width="35%"  align="left"  >Manage Customer Group </td>
                                <td width="13%" align="right" >&nbsp;</td>
                                <td width="20%" align="right" >View Customer Group &nbsp;
                                  <input class="inputCheck" type="checkbox" name="TOP_customergroup_V" id="TOP_customergroup_V" value="Y" <? if($SelUserQryRow->TOP_customergroup_V=="Y"){ echo "checked='checked'";}?>></td>
                                <td width="20%" align="right" >&nbsp;</td>
                              </tr>
                              <tr class="bg-bottom-line-div">
                                <td width="12%"  align="left" class="stat_linkgreybold" ><strong>Products</strong>&nbsp;</td>
                                <td colspan="4"  align="left"   class="stat_linkgreybold" ><strong>TOP MENU</strong>&nbsp;
                                  <input class="inputCheck" type="checkbox" name="TOP_products" id="TOP_products" value="Y" <? if($SelUserQryRow->TOP_products=="Y"){ echo "checked='checked'";}?>>
                                &nbsp;</td>
                              </tr>
                              <tr>
                                <td width="12%" align="right"  >&nbsp;</td>
                                <td width="35%"  align="left"  >Manage Product</td>
                                <td width="13%" align="right" >Add &nbsp;
                                  <input class="inputCheck" type="checkbox" name="TOP_products_A" id="TOP_products_A" value="Y" <? if($SelUserQryRow->TOP_products_A=="Y"){ echo "checked='checked'";}?>></td>
                                <td width="20%" align="right" >Edit &nbsp;
                                  <input class="inputCheck" type="checkbox" name="TOP_products_E" id="TOP_products_E" value="Y" <? if($SelUserQryRow->TOP_products_E=="Y"){ echo "checked='checked'";}?>></td>
                                <td width="20%" align="right" >Delete &nbsp;
                                  <input class="inputCheck" type="checkbox" name="TOP_products_D" id="TOP_products_D" value="Y" <? if($SelUserQryRow->TOP_products_D=="Y"){ echo "checked='checked'";}?>></td>
                              </tr>
                              <tr>
                                <td width="12%" align="right"  >&nbsp;</td>
                                <td width="35%"  align="left"  >Product Sizes</td>
                                <td width="13%" align="right" >Add &nbsp;
                                  <input class="inputCheck" type="checkbox" name="TOP_products_sizes_A" id="TOP_products_sizes_A" value="Y" <? if($SelUserQryRow->TOP_products_sizes_A=="Y"){ echo "checked='checked'";}?>></td>
                                <td width="20%" align="right" >Edit &nbsp;
                                  <input class="inputCheck" type="checkbox" name="TOP_products_sizes_E" id="TOP_products_sizes_E" value="Y" <? if($SelUserQryRow->TOP_products_sizes_E=="Y"){ echo "checked='checked'";}?>></td>
                                <td width="20%" align="right" >Delete &nbsp;
                                  <input class="inputCheck" type="checkbox" name="TOP_products_sizes_D" id="TOP_products_sizes_D" value="Y" <? if($SelUserQryRow->TOP_products_sizes_D=="Y"){ echo "checked='checked'";}?>></td>
                              </tr>
                              <tr>
                                <td width="12%" align="right"  >&nbsp;</td>
                                <td width="35%"  align="left"  >Product Accessories</td>
                                <td width="13%" align="right" >Add &nbsp;
                                  <input class="inputCheck" type="checkbox" name="TOP_products_accessories_A" id="TOP_products_accessories_A" value="Y" <? if($SelUserQryRow->TOP_products_accessories_A=="Y"){ echo "checked='checked'";}?>></td>
                                <td width="20%" align="right" >Edit &nbsp;
                                  <input class="inputCheck" type="checkbox" name="TOP_products_accessories_E" id="TOP_products_accessories_E" value="Y" <? if($SelUserQryRow->TOP_products_accessories_E=="Y"){ echo "checked='checked'";}?>></td>
                                <td width="20%" align="right" >Delete &nbsp;
                                  <input class="inputCheck" type="checkbox" name="TOP_products_accessories_D" id="TOP_products_accessories_D" value="Y" <? if($SelUserQryRow->TOP_products_accessories_D=="Y"){ echo "checked='checked'";}?>></td>
                              </tr>
							  <tr>
                                <td width="12%" align="right"  >&nbsp;</td>
                                <td width="35%"  align="left"  >Product Colors</td>
                                <td width="13%" align="right" >Add &nbsp;
                                  <input class="inputCheck" type="checkbox" name="TOP_products_colors_A" id="TOP_products_colors_A" value="Y" <? if($SelUserQryRow->TOP_products_colors_A=="Y"){ echo "checked='checked'";}?>></td>
                                <td width="20%" align="right" >Edit &nbsp;
                                  <input class="inputCheck" type="checkbox" name="TOP_products_colors_E" id="TOP_products_colors_E" value="Y" <? if($SelUserQryRow->TOP_products_colors_E=="Y"){ echo "checked='checked'";}?>></td>
                                <td width="20%" align="right" >Delete &nbsp;
                                  <input class="inputCheck" type="checkbox" name="TOP_products_colors_D" id="TOP_products_colors_D" value="Y" <? if($SelUserQryRow->TOP_products_colors_D=="Y"){ echo "checked='checked'";}?>></td>
                              </tr>
							  <tr>
                                <td width="12%" align="right"  >&nbsp;</td>
                                <td width="35%"  align="left"  >Product Collection</td>
                                <td width="13%" align="right" >Add &nbsp;
                                  <input class="inputCheck" type="checkbox" name="TOP_products_collections_A" id="TOP_products_collections_A" value="Y" <? if($SelUserQryRow->TOP_products_collections_A=="Y"){ echo "checked='checked'";}?>></td>
                                <td width="20%" align="right" >Edit &nbsp;
                                  <input class="inputCheck" type="checkbox" name="TOP_products_collections_E" id="TOP_products_collections_E" value="Y" <? if($SelUserQryRow->TOP_products_collections_E=="Y"){ echo "checked='checked'";}?>></td>
                                <td width="20%" align="right" >Delete &nbsp;
                                  <input class="inputCheck" type="checkbox" name="TOP_products_collections_D" id="TOP_products_collections_D" value="Y" <? if($SelUserQryRow->TOP_products_collections_D=="Y"){ echo "checked='checked'";}?>></td>
                              </tr>
							  <tr>
                                <td width="12%" align="right"  >&nbsp;</td>
                                <td width="35%"  align="left"  >Product Silhouette</td>
                                <td width="13%" align="right" >Add &nbsp;
                                  <input class="inputCheck" type="checkbox" name="TOP_products_silhouette_A" id="TOP_products_silhouette_A" value="Y" <? if($SelUserQryRow->TOP_products_silhouette_A=="Y"){ echo "checked='checked'";}?>></td>
                                <td width="20%" align="right" >Edit &nbsp;
                                  <input class="inputCheck" type="checkbox" name="TOP_products_silhouette_E" id="TOP_products_silhouette_E" value="Y" <? if($SelUserQryRow->TOP_products_silhouette_E=="Y"){ echo "checked='checked'";}?>></td>
                                <td width="20%" align="right" >Delete &nbsp;
                                  <input class="inputCheck" type="checkbox" name="TOP_products_silhouette_D" id="TOP_products_silhouette_D" value="Y" <? if($SelUserQryRow->TOP_products_silhouette_D=="Y"){ echo "checked='checked'";}?>></td>
                              </tr>
							   <tr>
                                <td width="12%" align="right"  >&nbsp;</td>
                                <td width="35%"  align="left"  >Product Neckline</td>
                                <td width="13%" align="right" >Add &nbsp;
                                  <input class="inputCheck" type="checkbox" name="TOP_products_neckline_A" id="TOP_products_neckline_A" value="Y" <? if($SelUserQryRow->TOP_products_neckline_A=="Y"){ echo "checked='checked'";}?>></td>
                                <td width="20%" align="right" >Edit &nbsp;
                                  <input class="inputCheck" type="checkbox" name="TOP_products_neckline_E" id="TOP_products_neckline_E" value="Y" <? if($SelUserQryRow->TOP_products_neckline_E=="Y"){ echo "checked='checked'";}?>></td>
                                <td width="20%" align="right" >Delete &nbsp;
                                  <input class="inputCheck" type="checkbox" name="TOP_products_neckline_D" id="TOP_products_neckline_D" value="Y" <? if($SelUserQryRow->TOP_products_neckline_D=="Y"){ echo "checked='checked'";}?>></td>
                              </tr>
							  <tr>
                                <td width="12%" align="right"  >&nbsp;</td>
                                <td width="35%"  align="left"  >Product Waist</td>
                                <td width="13%" align="right" >Add &nbsp;
                                  <input class="inputCheck" type="checkbox" name="TOP_products_waist_A" id="TOP_products_waist_A" value="Y" <? if($SelUserQryRow->TOP_products_waist_A=="Y"){ echo "checked='checked'";}?>></td>
                                <td width="20%" align="right" >Edit &nbsp;
                                  <input class="inputCheck" type="checkbox" name="TOP_products_waist_E" id="TOP_products_waist_E" value="Y" <? if($SelUserQryRow->TOP_products_waist_E=="Y"){ echo "checked='checked'";}?>></td>
                                <td width="20%" align="right" >Delete &nbsp;
                                  <input class="inputCheck" type="checkbox" name="TOP_products_waist_D" id="TOP_products_waist_D" value="Y" <? if($SelUserQryRow->TOP_products_waist_D=="Y"){ echo "checked='checked'";}?>></td>
                              </tr>
							  <tr>
                                <td width="12%" align="right"  >&nbsp;</td>
                                <td width="35%"  align="left"  >Product Dress Length</td>
                                <td width="13%" align="right" >Add &nbsp;
                                  <input class="inputCheck" type="checkbox" name="TOP_products_dresslength_A" id="TOP_products_dresslength_A" value="Y" <? if($SelUserQryRow->TOP_products_dresslength_A=="Y"){ echo "checked='checked'";}?>></td>
                                <td width="20%" align="right" >Edit &nbsp;
                                  <input class="inputCheck" type="checkbox" name="TOP_products_dresslength_E" id="TOP_products_dresslength_E" value="Y" <? if($SelUserQryRow->TOP_products_dresslength_E=="Y"){ echo "checked='checked'";}?>></td>
                                <td width="20%" align="right" >Delete &nbsp;
                                  <input class="inputCheck" type="checkbox" name="TOP_products_dresslength_D" id="TOP_products_dresslength_D" value="Y" <? if($SelUserQryRow->TOP_products_dresslength_D=="Y"){ echo "checked='checked'";}?>></td>
                              </tr>
							  <tr>
                                <td width="12%" align="right"  >&nbsp;</td>
                                <td width="35%"  align="left"  >Product Dress Color</td>
                                <td width="13%" align="right" >Add &nbsp;
                                  <input class="inputCheck" type="checkbox" name="TOP_products_dresscolor_A" id="TOP_products_dresscolor_A" value="Y" <? if($SelUserQryRow->TOP_products_dresscolor_A=="Y"){ echo "checked='checked'";}?>></td>
                                <td width="20%" align="right" >Edit &nbsp;
                                  <input class="inputCheck" type="checkbox" name="TOP_products_dresscolor_E" id="TOP_products_dresscolor_E" value="Y" <? if($SelUserQryRow->TOP_products_dresscolor_E=="Y"){ echo "checked='checked'";}?>></td>
                                <td width="20%" align="right" >Delete &nbsp;
                                  <input class="inputCheck" type="checkbox" name="TOP_products_dresscolor_D" id="TOP_products_dresscolor_D" value="Y" <? if($SelUserQryRow->TOP_products_dresscolor_D=="Y"){ echo "checked='checked'";}?>></td>
                              </tr>
							 <tr class="bg-bottom-line-div">
                                <td width="12%"  align="left" class="stat_linkgreybold" ><strong>Blogs</strong>&nbsp;</td>
                                <td colspan="4"  align="left"   class="stat_linkgreybold" ><strong>TOP MENU</strong>&nbsp;
                                  <input class="inputCheck" type="checkbox" name="TOP_blogs" id="TOP_blogs" value="Y" <? if($SelUserQryRow->TOP_blogs=="Y"){ echo "checked='checked'";}?>>
                                &nbsp;</td>
                              </tr>
                              
							  <tr>
                                <td width="12%" align="right"  >&nbsp;</td>
                                <td width="35%"  align="left"  >Blog Management</td>
                                <td width="13%" align="right" >Add &nbsp;
                                <input class="inputCheck" type="checkbox" name="TOP_blog_A" id="TOP_blog_A" value="Y" <? if($SelUserQryRow->TOP_blog_A=="Y"){ echo "checked='checked'";}?>></td>
                                <td width="20%" align="right" >Edit &nbsp;
                                  <input class="inputCheck" type="checkbox" name="TOP_blog_E" id="TOP_blog_E" value="Y" <? if($SelUserQryRow->TOP_blog_E=="Y"){ echo "checked='checked'";}?>></td>
                                <td width="20%" align="right" >Delete &nbsp;
                                  <input class="inputCheck" type="checkbox" name="TOP_blog_D" id="TOP_blog_D" value="Y" <? if($SelUserQryRow->TOP_blog_D=="Y"){ echo "checked='checked'";}?>></td>
                              </tr>
							  <tr>
                                <td width="12%" align="right"  >&nbsp;</td>
                                <td width="35%"  align="left"  >Blog Category Management</td>
                                <td width="13%" align="right" >Add &nbsp;
                                <input class="inputCheck" type="checkbox" name="TOP_blogcategory_A" id="TOP_blogcategory_A" value="Y" <? if($SelUserQryRow->TOP_blogcategory_A=="Y"){ echo "checked='checked'";}?>></td>
                                <td width="20%" align="right" >Edit &nbsp;
                                  <input class="inputCheck" type="checkbox" name="TOP_blogcategory_E" id="TOP_blogcategory_E" value="Y" <? if($SelUserQryRow->TOP_blogcategory_E=="Y"){ echo "checked='checked'";}?>></td>
                                <td width="20%" align="right" >Delete &nbsp;
                                  <input class="inputCheck" type="checkbox" name="TOP_blogcategory_D" id="TOP_blogcategory_D" value="Y" <? if($SelUserQryRow->TOP_blogcategory_D=="Y"){ echo "checked='checked'";}?>></td>
                              </tr>
							  <tr>
                                <td width="12%" align="right"  >&nbsp;</td>
                                <td width="35%"  align="left"  >Blog Comments Management</td>
                                <td width="13%" align="right" >&nbsp;</td>
                                <td width="20%" align="right" >Edit &nbsp;
                                  <input class="inputCheck" type="checkbox" name="TOP_blogcomment_E" id="TOP_blogcomment_E" value="Y" <? if($SelUserQryRow->TOP_blogcomment_E=="Y"){ echo "checked='checked'";}?>></td>
                                <td width="20%" align="right" >Delete &nbsp;
                                  <input class="inputCheck" type="checkbox" name="TOP_blogcomment_D" id="TOP_blogcomment_D" value="Y" <? if($SelUserQryRow->TOP_blogcomment_D=="Y"){ echo "checked='checked'";}?>></td>
                              </tr>
							  <tr>
                                <td width="12%" align="right"  >&nbsp;</td>
                                <td width="35%"  align="left"  >Press Management</td>
                                <td width="13%" align="right" >Add &nbsp;
                                <input class="inputCheck" type="checkbox" name="TOP_press_A" id="TOP_press_A" value="Y" <? if($SelUserQryRow->TOP_press_A=="Y"){ echo "checked='checked'";}?>></td>
                                <td width="20%" align="right" >Edit &nbsp;
                                  <input class="inputCheck" type="checkbox" name="TOP_press_E" id="TOP_press_E" value="Y" <? if($SelUserQryRow->TOP_press_E=="Y"){ echo "checked='checked'";}?>></td>
                                <td width="20%" align="right" >Delete &nbsp;
                                  <input class="inputCheck" type="checkbox" name="TOP_press_D" id="TOP_press_D" value="Y" <? if($SelUserQryRow->TOP_press_D=="Y"){ echo "checked='checked'";}?>></td>
                              </tr>
							  <tr>
                                <td width="12%" align="right"  >&nbsp;</td>
                                <td width="35%"  align="left"  >Gallery Management</td>
                                <td width="13%" align="right" >Add &nbsp;
                                <input class="inputCheck" type="checkbox" name="TOP_gallery_A" id="TOP_gallery_A" value="Y" <? if($SelUserQryRow->TOP_gallery_A=="Y"){ echo "checked='checked'";}?>></td>
                                <td width="20%" align="right" >Edit &nbsp;
                                  <input class="inputCheck" type="checkbox" name="TOP_gallery_E" id="TOP_gallery_E" value="Y" <? if($SelUserQryRow->TOP_gallery_E=="Y"){ echo "checked='checked'";}?>></td>
                                <td width="20%" align="right" >Delete &nbsp;
                                  <input class="inputCheck" type="checkbox" name="TOP_gallery_D" id="TOP_gallery_D" value="Y" <? if($SelUserQryRow->TOP_gallery_D=="Y"){ echo "checked='checked'";}?>></td>
                              </tr>
							  <tr>
                                <td width="12%" align="right"  >&nbsp;</td>
                                <td width="35%"  align="left"  >Designer Days</td>
                                <td width="13%" align="right" >Add &nbsp;
                                <input class="inputCheck" type="checkbox" name="TOP_designerdays_A" id="TOP_designerdays_A" value="Y" <? if($SelUserQryRow->TOP_designerdays_A=="Y"){ echo "checked='checked'";}?>></td>
                                <td width="20%" align="right" >Edit &nbsp;
                                  <input class="inputCheck" type="checkbox" name="TOP_designerdays_E" id="TOP_designerdays_E" value="Y" <? if($SelUserQryRow->TOP_designerdays_E=="Y"){ echo "checked='checked'";}?>></td>
                                <td width="20%" align="right" >Delete &nbsp;
                                  <input class="inputCheck" type="checkbox" name="TOP_designerdays_D" id="TOP_designerdays_D" value="Y" <? if($SelUserQryRow->TOP_designerdays_D=="Y"){ echo "checked='checked'";}?>></td>
                              </tr>
							  <tr class="bg-bottom-line-div">
                                <td width="12%"  align="left" class="stat_linkgreybold" ><strong>Newsletter</strong>&nbsp;</td>
                                <td colspan="4"  align="left"   class="stat_linkgreybold" ><strong>TOP MENU</strong>&nbsp;
                                  <input class="inputCheck" type="checkbox" name="TOP_newsletter" id="TOP_newsletter" value="Y" <? if($SelUserQryRow->TOP_newsletter=="Y"){ echo "checked='checked'";}?>>
                                &nbsp;</td>
                              </tr>
                              <tr>
                                <td width="12%" align="right"  >&nbsp;</td>
                                <td width="35%"  align="left"  >Newsletter Management &nbsp;</td>
                                <td width="13%" align="right" >&nbsp;</td>
                                <td width="20%" align="right" >Delete <input class="inputCheck" type="checkbox" name="TOP_newsletter_D" id="TOP_newsletter_D" value="Y" <? if($SelUserQryRow->TOP_newsletter_D=="Y"){ echo "checked='checked'";}?>>&nbsp;</td>
                                <td width="20%" align="right" >&nbsp;</td>
                              </tr>
							  
							  
							  
							  <tr class="bg-bottom-line-div">
                                <td width="12%"  align="left" class="stat_linkgreybold" ><strong>Static Page</strong>s</td>
                                <td colspan="4"  align="left"   class="stat_linkgreybold" ><strong>TOP MENU</strong>&nbsp;
                                  <input class="inputCheck" type="checkbox" name="TOP_StaticPage" id="TOP_StaticPage" value="Y" <? if($SelUserQryRow->TOP_StaticPage=="Y"){ echo "checked='checked'";}?>>
                                &nbsp;</td>
                              </tr>
							   <tr>
                                <td width="12%" align="right"  >&nbsp;</td>
                                <td width="35%"  align="left"  >Customer Service Location  Management</td>
                                <td width="13%" align="right" >Add &nbsp;
                                <input class="inputCheck" type="checkbox" name="TOP_custoserloc_A" id="TOP_custoserloc_A" value="Y" <? if($SelUserQryRow->TOP_custoserloc_A=="Y"){ echo "checked='checked'";}?>></td>
                                <td width="20%" align="right" >Edit &nbsp;
                                  <input class="inputCheck" type="checkbox" name="TOP_custoserloc_E" id="TOP_custoserloc_E" value="Y" <? if($SelUserQryRow->TOP_custoserloc_E=="Y"){ echo "checked='checked'";}?>></td>
                                <td width="20%" align="right" >Delete &nbsp;
                                  <input class="inputCheck" type="checkbox" name="TOP_custoserloc_D" id="TOP_custoserloc_D" value="Y" <? if($SelUserQryRow->TOP_custoserloc_D=="Y"){ echo "checked='checked'";}?>></td>
                              </tr>
							  
							  <tr class="bg-bottom-line-div">
                                <td width="12%"  align="left" class="stat_linkgreybold" ><strong>Retailers</strong></td>
                                <td colspan="4"  align="left"   class="stat_linkgreybold" ><strong>TOP MENU</strong>&nbsp;
                                  <input class="inputCheck" type="checkbox" name="TOP_Retailers" id="TOP_Retailers" value="Y" <? if($SelUserQryRow->TOP_Retailers=="Y"){ echo "checked='checked'";}?>>
                                &nbsp;</td>
                              </tr>
							   <tr>
                                <td width="12%" align="right"  >&nbsp;</td>
                                <td width="35%"  align="left"  >Manage Retailers</td>
                                <td width="13%" align="right" >Add &nbsp;
                                <input class="inputCheck" type="checkbox" name="TOP_retailers_A" id="TOP_retailers_A" value="Y" <? if($SelUserQryRow->TOP_retailers_A=="Y"){ echo "checked='checked'";}?>></td>
                                <td width="20%" align="right" >Edit &nbsp;
                                  <input class="inputCheck" type="checkbox" name="TOP_retailers_E" id="TOP_retailers_E" value="Y" <? if($SelUserQryRow->TOP_retailers_E=="Y"){ echo "checked='checked'";}?>></td>
                                <td width="20%" align="right" >Delete &nbsp;
                                  <input class="inputCheck" type="checkbox" name="TOP_retailers_D" id="TOP_retailers_D" value="Y" <? if($SelUserQryRow->TOP_retailers_D=="Y"){ echo "checked='checked'";}?>></td>
                              </tr>
							   <tr>
                                <td width="12%" align="right"  >&nbsp;</td>
                                <td width="35%"  align="left"  >Manage News & Promotion</td>
                                <td width="13%" align="right" >Add &nbsp;
                                <input class="inputCheck" type="checkbox" name="TOP_newsnpromo_A" id="TOP_newsnpromo_A" value="Y" <? if($SelUserQryRow->TOP_newsnpromo_A=="Y"){ echo "checked='checked'";}?>></td>
                                <td width="20%" align="right" >Edit &nbsp;
                                  <input class="inputCheck" type="checkbox" name="TOP_newsnpromo_E" id="TOP_newsnpromo_E" value="Y" <? if($SelUserQryRow->TOP_newsnpromo_E=="Y"){ echo "checked='checked'";}?>></td>
                                <td width="20%" align="right" >Delete &nbsp;
                                  <input class="inputCheck" type="checkbox" name="TOP_newsnpromo_D" id="TOP_newsnpromo_D" value="Y" <? if($SelUserQryRow->TOP_newsnpromo_D=="Y"){ echo "checked='checked'";}?>></td>
                              </tr>
							   <tr>
                                <td width="12%" align="right"  >&nbsp;</td>
                                <td width="35%"  align="left"  >Manage Documents</td>
                                <td width="13%" align="right" >Add &nbsp;
                                <input class="inputCheck" type="checkbox" name="TOP_documents_A" id="TOP_documents_A" value="Y" <? if($SelUserQryRow->TOP_documents_A=="Y"){ echo "checked='checked'";}?>></td>
                                <td width="20%" align="right" >Edit &nbsp;
                                  <input class="inputCheck" type="checkbox" name="TOP_documents_E" id="TOP_documents_E" value="Y" <? if($SelUserQryRow->TOP_documents_E=="Y"){ echo "checked='checked'";}?>></td>
                                <td width="20%" align="right" >Delete &nbsp;
                                  <input class="inputCheck" type="checkbox" name="TOP_documents_D" id="TOP_documents_D" value="Y" <? if($SelUserQryRow->TOP_documents_D=="Y"){ echo "checked='checked'";}?>></td>
                              </tr>
							   <tr>
                                <td width="12%" align="right"  >&nbsp;</td>
                                <td width="35%"  align="left"  >Manage Documents Category</td>
                                <td width="13%" align="right" >Add &nbsp;
                                <input class="inputCheck" type="checkbox" name="TOP_documentscat_A" id="TOP_documentscat_A" value="Y" <? if($SelUserQryRow->TOP_documentscat_A=="Y"){ echo "checked='checked'";}?>></td>
                                <td width="20%" align="right" >Edit &nbsp;
                                  <input class="inputCheck" type="checkbox" name="TOP_documentscat_E" id="TOP_documentscat_E" value="Y" <? if($SelUserQryRow->TOP_documentscat_E=="Y"){ echo "checked='checked'";}?>></td>
                                <td width="20%" align="right" >Delete &nbsp;
                                  <input class="inputCheck" type="checkbox" name="TOP_documentscat_D" id="TOP_documentscat_D" value="Y" <? if($SelUserQryRow->TOP_documentscat_D=="Y"){ echo "checked='checked'";}?>></td>
                              </tr>
							  <?php /*?><tr>
                                <td width="12%" align="right"  >&nbsp;</td>
                                <td width="35%"  align="left"  >Manage Retailer Email Receivers</td>
                                <td width="13%" align="right" >&nbsp;</td>
                                <td width="20%" align="right" >Edit &nbsp;
                                  <input class="inputCheck" type="checkbox" name="TOP_retaileremail_E" id="TOP_retaileremail_E" value="Y" <? if($SelUserQryRow->TOP_retaileremail_E=="Y"){ echo "checked='checked'";}?>></td>
                                <td width="20%" align="right" >&nbsp;</td>
                              </tr><?php */?>
                            </table></td>
                        </tr>
                        <tr>
                          <td align="right">&nbsp;</td>
                          <td width="56%" colspan="3"><INPUT type=submit name="Submit" value="<? echo $Buttitle;?>" onClick="return valid();" class="bttn-s">
                          </td>
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
