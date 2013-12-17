<? include("connect.php"); 
$doAjax = false;
$newsletter = '';
$del ='';
if($_SESSION['UsErId']==""){header("location:index.php");}

if($_POST['HidSubmit']=='1')
{
	if($_POST['weddingdate']!="Select a Date")
	{
		if($_POST['weddingdate']!="")
		{
			$sdate=explode("/",$_POST['weddingdate']);
			$weddingdate=$sdate[2]."-".$sdate[0]."-".$sdate[1];
		}
		else
		{
			$weddingdate="";
		}
	}
	$GetCustomerQry="SELECT entity_id FROM customer_entity WHERE email='".trim(addslashes($_POST['email']))."' and website_id='".SITE_ID."' and entity_id!='".$_SESSION['UsErId']."'";
	$GetCustomerQryRs=mysql_query($GetCustomerQry);
	$TotGetCustomer=mysql_affected_rows();
	if($TotGetCustomer<=0)
	{
		$InsertCustomerQry="UPDATE customer_entity SET  email='".trim(addslashes($_POST['email']))."',weddingdate_show='".trim(addslashes($_POST['weddingdate_show']))."',weddingdate='$weddingdate' where entity_id='".$_SESSION['UsErId']."'";
		$InsertCustomerQryRs=mysql_query($InsertCustomerQry);
		////add attribute
		$AttributeCustomerQry1="UPDATE customer_entity_varchar SET value='".trim(addslashes($_POST['firstname']))."' WHERE entity_id='".$_SESSION['UsErId']."' and attribute_id='5'";
		$AttributeCustomerQryRs1=mysql_query($AttributeCustomerQry1);
		
		$AttributeCustomerQry2="UPDATE customer_entity_varchar SET value='".trim(addslashes($_POST['lastname']))."' WHERE entity_id='".$_SESSION['UsErId']."' and attribute_id='7'";
		$AttributeCustomerQryRs2=mysql_query($AttributeCustomerQry2);
		
		$AttributeCustomerQry3="UPDATE customer_entity_varchar SET value='".trim(addslashes($_POST['password']))."' WHERE entity_id='".$_SESSION['UsErId']."' and attribute_id='12'";
		$AttributeCustomerQryRs3=mysql_query($AttributeCustomerQry3);
		
		$AttributeCustomerQry4="UPDATE customer_address_entity_varchar SET value='".trim(addslashes($_POST['country']))."' WHERE entity_id='".$_SESSION['UsErId']."'  and attribute_id='25'";
		$AttributeCustomerQryRs4=mysql_query($AttributeCustomerQry4);
		
		$AttributeCustomerQry5="UPDATE customer_address_entity_varchar SET value='".trim(addslashes($_POST['zipcode']))."' WHERE entity_id='".$_SESSION['UsErId']."' and attribute_id='28'";
		$AttributeCustomerQryRs5=mysql_query($AttributeCustomerQry5);
		
		////Newsletter subscriber
		if($_POST['newsletter']=="Y")
		{
			$GetAttributeCustomerQry6=mysql_query("SELECT * FROM newsletter_subscriber WHERE customer_id='".$_SESSION['UsErId']."'");
			$TotGetAttributeCustomerQry6=mysql_affected_rows();
			if($TotGetAttributeCustomerQry6<=0)
			{
				$AttributeCustomerQry6="INSERT INTO newsletter_subscriber SET subscriber_email='".trim(addslashes($_POST['email']))."',customer_id='".$_SESSION['UsErId']."',subscriber_status='1',change_status_at=now()";
				$AttributeCustomerQryRs6=mysql_query($AttributeCustomerQry6);
				$doAjax = true;				
			}	
			$newsletter = '?newsletter=true';
		}
		if($_POST['newsletter']!="Y")
		{
			$GetAttributeCustomerQry6=mysql_query("SELECT * FROM newsletter_subscriber WHERE customer_id='".$_SESSION['UsErId']."'");
			$TotGetAttributeCustomerQry6=mysql_affected_rows();
			if($TotGetAttributeCustomerQry6>0)
			{
				$AttributeCustomerQry6="DELETE FROM newsletter_subscriber WHERE customer_id='".$_SESSION['UsErId']."'";
				$AttributeCustomerQryRs6=mysql_query($AttributeCustomerQry6);
				$doAjax = true;
				$newsletter = '?newsletter=true';
				$del = "&acc=del&email=".$_POST['email'];
			}	
			
		}
		////End of Newsletter subscriber

		
		header("location:my_account.php".$newsletter.$del);
		exit;
		
	}
	else
	{
		$message="Email address already registered with us.";
	}
}


$AttributeCustomerQry="SELECT email,weddingdate,weddingdate_show FROM customer_entity  WHERE entity_id='".trim($_SESSION['UsErId'])."'";
$AttributeCustomerQryRs=mysql_query($AttributeCustomerQry);
$AttributeCustomerQryRow=mysql_fetch_array($AttributeCustomerQryRs);
$Email=stripslashes($AttributeCustomerQryRow['email']);
if($Email==""){$Email="Email";}

$AttributeCustomerQry1="SELECT value FROM customer_entity_varchar WHERE entity_id='".trim($_SESSION['UsErId'])."' and attribute_id='5'";
$AttributeCustomerQryRs1=mysql_query($AttributeCustomerQry1);
$AttributeCustomerQryRow1=mysql_fetch_array($AttributeCustomerQryRs1);
$Firstname=stripslashes($AttributeCustomerQryRow1['value']);
if($Firstname==""){$Firstname="First Name";}

$AttributeCustomerQry2="SELECT value FROM customer_entity_varchar WHERE entity_id='".trim($_SESSION['UsErId'])."' and attribute_id='7'";
$AttributeCustomerQryRs2=mysql_query($AttributeCustomerQry2);
$AttributeCustomerQryRow2=mysql_fetch_array($AttributeCustomerQryRs2);
$Lastname=stripslashes($AttributeCustomerQryRow2['value']);
if($Lastname==""){$Lastname="Last Name";}

$AttributeCustomerQry3="SELECT value FROM customer_entity_varchar WHERE entity_id='".trim($_SESSION['UsErId'])."' and attribute_id='12'";
$AttributeCustomerQryRs3=mysql_query($AttributeCustomerQry3);
$AttributeCustomerQryRow3=mysql_fetch_array($AttributeCustomerQryRs3);
$Password=stripslashes($AttributeCustomerQryRow3['value']);
if($Password==""){$Password="Password";}

$AttributeCustomerQry4="SELECT value FROM customer_address_entity_varchar WHERE entity_id='".trim($_SESSION['UsErId'])."' and attribute_id='25'";
$AttributeCustomerQryRs4=mysql_query($AttributeCustomerQry4);
$AttributeCustomerQryRow4=mysql_fetch_array($AttributeCustomerQryRs4);
$Country=stripslashes($AttributeCustomerQryRow4['value']);

$AttributeCustomerQry5="SELECT value FROM customer_address_entity_varchar WHERE entity_id='".trim($_SESSION['UsErId'])."' and attribute_id='28'";
$AttributeCustomerQryRs5=mysql_query($AttributeCustomerQry5);
$AttributeCustomerQryRow5=mysql_fetch_array($AttributeCustomerQryRs5);
$Zip=stripslashes($AttributeCustomerQryRow5['value']);
if($Zip==""){$Zip="Zip / Postal Code";}

$AttributeCustomerQry6="SELECT subscriber_id FROM newsletter_subscriber WHERE customer_id='".trim($_SESSION['UsErId'])."' and subscriber_status='1'";
$AttributeCustomerQryRs6=mysql_query($AttributeCustomerQry6);
$TotNeslleter=mysql_affected_rows();
if($TotNeslleter>0)
{
	$newsletterchecked="checked='checked'";
}
$page_title = ' | '.ucwords(strtolower(strt("My Account & Favorites")));
?>
<? $page = 'rg';?>
<? include("header.php");?>
<body>

 <div id="all">
       <? include("top.php");?>
       <div id="section">
       <? include("left.php");?>
            <div id="content">
            <?php breadcrumbs(); ?>
            <table width="850" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                      <td height="32" align="left" valign="top" class="font-20-gra"><?php e_strt("Edit Account Information");?></td>
                    </tr>
                    <tr>
                      <td align="center" valign="top"><table width="850" border="0" align="center" cellpadding="0" cellspacing="0">
                          <tr>
                            <td width="645" align="left" valign="top">
							<form name="FrmRegister" id="FrmRegister" enctype="multipart/form-data" method="post">
							<table width="600" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td align="left" valign="middle">&nbsp;</td>
                                </tr>
                                <tr>
                                  <td align="left" valign="top" class="font-12-gra"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                      <tr>
                                        <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                              <td width="85%" height="30" align="left" valign="middle" class="font-16-gra"><?php e_strt("Personal Information");?></td>
                                              <td width="15%" align="left" valign="middle" class="font-11-blk"><em>* <?php e_strt("required fields");?></em></td>
                                            </tr>
                                          </table></td>
                                      </tr>
                                      <tr>
                                        <td align="left" valign="top"><table border="0" cellspacing="0" cellpadding="3">
                                            <tr>
                                              <td width="5" align="right" valign="top" class="font-12-gra">* </td>
                                              <td align="left" valign="top" class="font-12-gra">
                                              <input name="firstname" type="text" class="text_field1" id="firstname" value="<?=$Firstname;?>" onFocus="if(this.value=='First Name'){this.value='';}" onBlur="if(this.value==''){this.value='First Name';}"/>
                                              </td>
                                              <td width="5" align="right" valign="top" class="font-12-gra">* </td>
                                              <td align="left" valign="top" class="font-12-gra">
                                              <select name="country" class="text_field1" style="width:187px;" id="country">
                                              <option value=""><?php e_strt("Country");?></option>
											  <?=GetDropdown(country_id,name,directory_country,' where country_id!=\'\' and name!=\'\'  order by name asc',$Country);?>
                                              </select>
                                              </td>
                                            </tr>
                                            <tr>
                                              <td align="right" valign="top" class="font-12-gra">*</td>
                                              <td align="left" valign="top" class="font-12-gra"><input name="lastname" type="text" class="text_field1" id="lastname" value="<?=$Lastname;?>"  onfocus="if(this.value=='Last Name'){this.value='';}" onBlur="if(this.value==''){this.value='Last Name';}"/></td>
                                              <td align="right" valign="top" class="font-12-gra">* </td>
                                              <td align="left" valign="top" class="font-12-gra"><input name="zipcode" type="text" class="text_field1" id="zipcode" value="<?=$Zip;?>"  onfocus="if(this.value=='Zip / Postal Code'){this.value='';}" onBlur="if(this.value==''){this.value='Zip / Postal Code';}"/></td>
                                            </tr>
                                            <tr>
                                              <td align="right" valign="top" class="font-12-gra">&nbsp;</td>
                                              <td align="left" valign="middle" class="font-12-gra"><input name="newsletter" value="Y" type="checkbox" id="newsletter" <?=$newsletterchecked;?>   />
                                                <?php e_strt("Newsletter Opt-In");?></td>
                                              <td align="right" valign="top" class="font-12-gra">&nbsp;</td>
                                              <td align="left" valign="top" class="font-12-gra">&nbsp;</td>
                                            </tr>
                                          </table></td>
                                      </tr>
                                      <tr>
                                        <td align="left" valign="top">&nbsp;</td>
                                      </tr>
                                    </table></td>
                                </tr>
                                <tr>
                                  <td align="left" valign="top">&nbsp;</td>
                                </tr>
                                <tr>
                                  <td align="left" valign="top" class="font-12-gra"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                      <tr>
                                        <td align="left" valign="top" class="font-16-gra" height="30"><?php e_strt("Login Information");?></td>
                                      </tr>
                                      <tr>
                                        <td align="left" valign="top"><table border="0" cellspacing="0" cellpadding="3">
                                            <tr>
                                              <td width="5" align="right" valign="top" class="font-12-gra">* </td>
                                              <td align="left" valign="top" class="font-12-gra"><input name="email" type="text" class="text_field1" id="email" value="<?=$Email;?>"  onfocus="if(this.value=='Email'){this.value='';}" onBlur="if(this.value==''){this.value='Email';}"/></td>
                                              <td width="5" align="right" valign="top" class="font-12-gra">&nbsp;</td>
                                              <td align="left" valign="top" class="font-12-gra">&nbsp;</td>
                                            </tr>
                                            <tr>
                                              <td align="right" valign="top" class="font-12-gra">*</td>
                                              <td align="left" valign="top" class="font-12-gra"><input name="password" type="password" class="text_field1" id="password" value="<?=$Password;?>"  onfocus="if(this.value=='Password'){this.value='';}" onBlur="if(this.value==''){this.value='Password';}"/></td>
                                              <td align="right" valign="top" class="font-12-gra">* </td>
                                              <td align="left" valign="top" class="font-12-gra"><input name="conpassword" type="password" class="text_field1" id="conpassword" value="<?=$Password;?>" onFocus="if(this.value=='Confirm Password'){this.value='';}" onBlur="if(this.value==''){this.value='Confirm Password';}"/></td>
                                            </tr>
                                          </table></td>
                                      </tr>
                                      <tr>
                                        <td align="left" valign="top">&nbsp;</td>
                                      </tr>
                                    </table></td>
                                </tr>
                                <tr>
                                  <td align="left" valign="top">&nbsp;</td>
                                </tr>
                                <tr>
                                  <td align="left" valign="top" class="font-12-gra"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                      <tr>
                                        <td align="left" valign="top" class="font-16-gra" height="30"><?php e_strt("Wedding Countdown");?></td>
                                      </tr>
                                      <tr>
                                        <td align="left" valign="top"><table border="0" cellspacing="0" cellpadding="3">
                                            <tr>
                                              <td align="left" valign="top" class="font-12-gra">
											  <? if($AttributeCustomerQryRow['weddingdate']!="" && $AttributeCustomerQryRow['weddingdate']!="0000-00-00")
											  {
													$sdate=explode("-",$AttributeCustomerQryRow['weddingdate']);
													$weddingdate=$sdate[1]."/".$sdate[2]."/".$sdate[0];
											  }
											  else
											  {
											  		$weddingdate="Select a Date";
											  }
											  ?>
											  <input name="weddingdate" type="text" class="text_field1" id="weddingdate" value="<?=$weddingdate;?>"  onfocus="if(this.value=='Select a Date'){this.value='';}displayCalendar(document.getElementById('weddingdate'),'mm/dd/yyyy',this);" onBlur="if(this.value==''){this.value='Select a Date';}" style="background-image:url(images/DDLIcon.gif); background-position:right; background-repeat:no-repeat;"/></td>
                                              <td align="left" valign="top" class="font-12-gra">&nbsp;</td>
                                              <td align="left" valign="top" class="font-12-gra"><input name="weddingdate_show" type="checkbox" id="weddingdate_show" value="Y" <? if($AttributeCustomerQryRow['weddingdate_show']=="Y"){?>checked="checked"<? } ?> />
                                                <?php e_strt("Use wedding countdown");?></td>
                                            </tr>
                                          </table></td>
                                      </tr>
                                      <tr>
                                        <td align="left" valign="top">&nbsp;</td>
                                      </tr>
                                    </table></td>
                                </tr>
                                <tr>
                                  <td height="40" align="left" valign="bottom">
								  <input type="hidden" name="HidSubmit" id="HidSubmit" value="0" />
								  <input type="button" value="<?php e_upstrt('UPDATE');?>" onClick="return FrmCheck();" class="JAbutton"/>
                                  </td>
                                </tr>
                              </table>
							</form>  
							</td>
                            <td width="202" align="left" valign="top"><? //include("right_facebook.php");?></td>
                          </tr>
                        </table></td>
                    </tr>
                  </table> </div>  
        </div>
        
    </div>
    <? include("footer.php");?>
<script language="javascript" type="text/javascript">
function FrmCheck()
{
	var frm=document.FrmRegister;
	if(frm.firstname.value.split(" ").join("")=="" || frm.firstname.value=="First Name")
	{
		alert("Please enter your first name.");
		frm.firstname.focus();
		return false;
	}
	if(frm.country.value.split(" ").join("")=="")
	{
		alert("Please select country.");
		frm.country.focus();
		return false;
	}
	if(frm.lastname.value.split(" ").join("")=="" || frm.lastname.value=="Last Name")
	{
		alert("Please enter your last name.");
		frm.lastname.focus();
		return false;
	}
	if(frm.zipcode.value.split(" ").join("")=="" || frm.zipcode.value=="Zip / Postal Code")
	{
		alert("Please enter zip/postal code.");
		frm.zipcode.focus();
		return false;
	}
	if(frm.email.value.split(" ").join("")=="" || frm.email.value=="Email")
	{
		alert("Please enter your email address.");
		frm.email.focus();
		return false;
	}
	if(frm.email.value!="")
	{
		if (!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(frm.email.value)))
		{
				alert("Please enter a proper email address.");
				frm.email.focus();
				return false;
		}
	}
	if(frm.password.value.split(" ").join("")=="" || frm.password.value=="Password")
	{
		alert("Please enter password.");
		frm.password.focus();
		return false;
	}
	if(frm.conpassword.value.split(" ").join("")=="" || frm.conpassword.value=="Confirm Password")
	{
		alert("Please enter confirm password.");
		frm.conpassword.focus();
		return false;
	}
	if(frm.password.value.split(" ").join("")!=frm.conpassword.value.split(" ").join(""))
	{
		alert("Confirm password does not match.");
		frm.conpassword.focus();
		return false;
	}
	frm.HidSubmit.value=1;
	frm.submit();
	return true;
}
</script>
<? include("googleanalytic.php");?>
</body>
</html>