<? include("connect.php");
$doAjax = false;
$newsletter = '';
if($_POST['HidSubmit']=='1')
{
	$GetCustomerQry="SELECT entity_id FROM customer_entity WHERE email='".trim(addslashes($_POST['email']))."' and website_id='".SITE_ID."'";
	$GetCustomerQryRs=mysql_query($GetCustomerQry);
	$TotGetCustomer=mysql_affected_rows();
	if($TotGetCustomer<=0)
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
		$InsertCustomerQry="INSERT INTO customer_entity SET
							email='".trim(addslashes($_POST['email']))."',
							website_id=".SITE_ID.",
							created_at=now(),
							weddingdate='$weddingdate',
							weddingdate_show='Y',
							is_active=1";
		$InsertCustomerQryRs=mysql_query($InsertCustomerQry);
		$insertedentity=mysql_insert_id();
		////add attribute
		$AttributeCustomerQry1="INSERT INTO customer_entity_varchar SET value='".trim(addslashes($_POST['firstname']))."',entity_id='$insertedentity',attribute_id='5',entity_type_id=1";
		$AttributeCustomerQryRs1=mysql_query($AttributeCustomerQry1);
		
		$AttributeCustomerQry2="INSERT INTO customer_entity_varchar SET value='".trim(addslashes($_POST['lastname']))."',entity_id='$insertedentity',attribute_id='7',entity_type_id=1";
		$AttributeCustomerQryRs2=mysql_query($AttributeCustomerQry2);
		
		$AttributeCustomerQry3="INSERT INTO customer_entity_varchar SET value='".trim(addslashes($_POST['password']))."',entity_id='$insertedentity',attribute_id='12',entity_type_id=1";
		$AttributeCustomerQryRs3=mysql_query($AttributeCustomerQry3);
		
		$AttributeCustomerQry4="INSERT INTO customer_address_entity_varchar SET value='".trim(addslashes($_POST['country']))."',entity_id='$insertedentity',attribute_id='25',entity_type_id=2";
		$AttributeCustomerQryRs4=mysql_query($AttributeCustomerQry4);
		
		$AttributeCustomerQry5="INSERT INTO customer_address_entity_varchar SET value='".trim(addslashes($_POST['zipcode']))."',entity_id='$insertedentity',attribute_id='28',entity_type_id=2";
		$AttributeCustomerQryRs5=mysql_query($AttributeCustomerQry5);
		
		////Newsletter subscriber
		if($_POST['newsletter']=="Y")
		{
			$AttributeCustomerQry6="INSERT INTO newsletter_subscriber SET subscriber_email='".trim(addslashes($_POST['email']))."',customer_id='$insertedentity',subscriber_status='1',change_status_at=now()";
			$AttributeCustomerQryRs6=mysql_query($AttributeCustomerQry6);
		}
		////End of Newsletter subscriber
		
		$_SESSION['UsErNaMe']=trim(addslashes($_POST['firstname']));
		$_SESSION['UsErId']=$insertedentity;
		if($_POST['newsletter']=="Y")
		{
			$doAjax = true;
			$newsletter = '?newsletter=true';
		}
		header("location:my_account.php".$newsletter);
		exit;
		
	}
	else
	{
		$message="Email address already registered with us.";
	}
}
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
            <table width="850" border="0" align="center" cellpadding="0" cellspacing="0" style="margin-left:30px;">
                    <tr>
                      <td height="32" align="left" valign="top" class="font-20-gra"><?php e_upstrt("Register");?></td>
                    </tr>
                    <tr>
                      <td align="center" valign="top"><table width="850" border="0" align="center" cellpadding="0" cellspacing="0">
                          <tr>
                            <td width="645" align="left" valign="top">
							<form name="FrmRegister" id="FrmRegister" enctype="multipart/form-data" method="post">
							<table width="600" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td align="center" valign="middle"><?=$message;?>&nbsp;</td>
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
                                              <td align="left" valign="top" class="font-12-gra"><input name="firstname" type="text" class="text_field1" id="firstname" value="<?php e_strt("First Name");?>" onFocus="if(this.value=='<?php e_strt("First Name");?>'){this.value='';}" onBlur="if(this.value==''){this.value='<?php e_strt("First Name");?>';}"/></td>
                                              <td width="5" align="right" valign="top" class="font-12-gra">* </td>
                                              <td align="left" valign="top" class="font-12-gra"><select name="country" class="text_field1" style="width:187px;" id="country"><option value=""><?php e_strt("Country");?></option><?=GetDropdown(country_id,name,directory_country,' where country_id!=\'\' and name!=\'\' order by name asc',$country);?></select>
                                              </td>
                                            </tr>
                                            <tr>
                                              <td align="right" valign="top" class="font-12-gra">*</td>
                                              <td align="left" valign="top" class="font-12-gra"><input name="lastname" type="text" class="text_field1" id="lastname" value="<?php e_strt("Last Name");?>"  onfocus="if(this.value=='<?php e_strt("Last Name");?>'){this.value='';}" onBlur="if(this.value==''){this.value='<?php e_strt("Last Name");?>';}"/></td>
                                              <td align="right" valign="top" class="font-12-gra">* </td>
                                              <td align="left" valign="top" class="font-12-gra"><input name="zipcode" type="text" class="text_field1" id="zipcode" value="<?php e_strt("Zip / Postal Code");?>"  onfocus="if(this.value=='<?php e_strt("Zip / Postal Code");?>'){this.value='';}" onBlur="if(this.value==''){this.value='<?php e_strt("Zip / Postal Code");?>';}"/></td>
                                            </tr>
                                            <tr>
                                              <td align="right" valign="top" class="font-12-gra">&nbsp;</td>
                                              <td align="left" valign="middle" class="font-12-gra"><input name="newsletter" value="Y" type="checkbox" id="newsletter" checked="checked" />
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
                                              <td align="left" valign="top" class="font-12-gra"><input name="email" type="text" class="text_field1" id="email" value="<?php e_strt("Email");?>"  onfocus="if(this.value=='<?php e_strt("Email");?>'){this.value='';}" onBlur="if(this.value==''){this.value='<?php e_strt("Email");?>';}"/></td>
                                              <td width="5" align="right" valign="top" class="font-12-gra">&nbsp;</td>
                                              <td align="left" valign="top" class="font-12-gra">&nbsp;</td>
                                            </tr>
                                            <tr>
                                              <td align="right" valign="top" class="font-12-gra">*</td>
                                              <td align="left" valign="top" class="font-12-gra"><input name="password" type="text" class="text_field1" id="password" value="<?php e_strt("Password");?>"  onfocus="this.type='password';if(this.value=='<?php e_strt("Password");?>'){this.value='';}else{this.type='password';}" onBlur="this.type='password';if(this.value==''){this.value='<?php e_strt("Password");?>';this.type='text';}"/></td>
                                              <td align="right" valign="top" class="font-12-gra">* </td>
                                              <td align="left" valign="top" class="font-12-gra"><input name="conpassword" type="text" class="text_field1" id="conpassword" value="<?php e_strt("Confirm Password");?>" onFocus="this.type='password';if(this.value=='<?php e_strt("Confirm Password");?>'){this.value='';}else{this.type='password';}" onBlur="this.type='password';if(this.value==''){this.value='<?php e_strt("Confirm Password");?>';this.type='text';}"/></td>
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
                                              <td width="5" align="right" valign="top" class="font-12-gra"></td>
                                              <td align="left" valign="top" class="font-12-gra"><input name="weddingdate" type="text" class="text_field1" id="weddingdate" value="Select a Date"  onfocus="if(this.value=='Select a Date'){this.value='';}displayCalendar(document.getElementById('weddingdate'),'mm/dd/yyyy',this);" onBlur="if(this.value==''){this.value='Select a Date';}" style="background-image:url(images/DDLIcon.gif); background-position:right; background-repeat:no-repeat;"/>
                                                <?php /*?><img align="absmiddle" style="padding-bottom:2px;cursor:pointer;" src="images/calendar.gif" border="0" onClick="displayCalendar(document.getElementById('weddingdate'),'mm/dd/yyyy',this);" ><?php */?></td>
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
                                  <input type="button" value="<?php e_upstrt('SUBMIT');?>" onClick="return FrmCheck();" class="JAbutton"/>
								 </td>
                                </tr>
                              </table>
							</form>  
							</td>
                            <td width="202" align="left" valign="top"><? //include("right_facebook.php");?></td>
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