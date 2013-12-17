<? include("connect.php"); 
if($_POST['HidSubmit']=="1")
{
	$email=mysql_real_escape_string(trim($_POST['email']));
	if($email!="Email")
	{
		$SelQry="SELECT  customer_entity.entity_id,customer_entity.is_active,customer_entity_varchar.value as pass FROM customer_entity,customer_entity_varchar 
				 WHERE 
				 customer_entity.entity_id=customer_entity_varchar.entity_id and 
				 customer_entity.email='$email' and customer_entity_varchar.attribute_id=12 ";
		$SelQryRs=mysql_query($SelQry);
		$TotSelQry=mysql_affected_rows();
		if($TotSelQry>0)
		{
			$SelQryRow=mysql_fetch_array($SelQryRs);
			$entity_id=$SelQryRow['entity_id'];
			$is_active=$SelQryRow['is_active'];
			$pass=$SelQryRow['pass'];
			
			$SelQry2="SELECT  value FROM customer_entity_varchar WHERE customer_entity_varchar.attribute_id=5 and customer_entity_varchar.entity_id='$entity_id'";
			$SelQryRs2=mysql_query($SelQry2);
			$SelQryRow2=mysql_fetch_array($SelQryRs2);
			$Fname=stripslashes($SelQryRow2['value']);
			
			$subject1="Your Password Request from $SITE_NAME";
			$from1='live@justinalexanderbridal.co'; //$ADMIN_MAIL;
			$mailcontent1="
			<html>
				<body>
					<table cellpadding=\"3\" cellspacing=\"3\">
						<tr>
							<Td align=\"left\" colspan=\"2\"><img src='$SITE_URL/images/logo.gif' /></td>
						</tr>
						<tr>
							<Td align=\"left\" colspan=\"2\"></td>
						</tr>
						<tr>
							<Td align=\"left\" colspan=\"2\">Dear $Fname,</td>
						</tr>
						<tr>
							<Td align=\"left\" colspan=\"2\"></td>
						</tr>
						<tr>
							<Td align=\"left\" colspan=\"2\">This email is being sent to you in response to your request for a forgotten password.</td>
						</tr>
						<tr>
							<Td align=\"left\" colspan=\"2\"></td>
						</tr>
						<tr>
							<Td align=\"left\" colspan=\"2\">Your account password is:</td>
						</tr>
						<tr>
							<Td align=\"left\" colspan=\"2\">Password: $pass</td>
						</tr>
						<tr>
							<Td align=\"left\" colspan=\"2\"></td>
						</tr>
						<tr>
							<Td align=\"left\" colspan=\"2\">Use this information to access your account at the $SITE_NAME website at:</td>
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
							<Td align=\"left\" colspan=\"2\">Thank you.</td>
						</tr>
				</table>
				</body>
			</html>";
			//echo $mailcontent1;
			
			if($_SERVER['HTTP_HOST']!="plus")
			{
				HtmlMailSend($to1,$subject1,$mailcontent1,$from1);
			}	
			
			$Message1="Email with password has been sent to your email address.";
			
		}
		else
		{
			$Message1="Email address does not registered with us.";
		}
	}
}
?>
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
                      <td height="32" align="left" valign="top" class="font-20-lit-gra"><?php e_strt("Forgot Your Password?");?></td>
                    </tr>
                    <tr>
                      <td align="center" valign="top" class="gra_border1"><table width="850" border="0" align="center" cellpadding="0" cellspacing="0">
                          <tr>
                            <td width="645" align="left" valign="top"><table width="600" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td align="left" valign="middle">&nbsp;</td>
                                </tr>
                                <tr>
                                  <td align="left" valign="top"><table width="100%" border="0" align="center" cellpadding="5" cellspacing="0">
                                      <tr>
                                        
                                        <td width="55%" align="center" valign="middle" class="font-12-gra"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                            <tr>
                                              <td align="left" valign="top">
											  <form name="FrmLogin" id="FrmLogin" enctype="multipart/form-data" method="post">
											  <table width="97%" border="0" align="center" cellpadding="0" cellspacing="0">
                                                  <? if($Message1!=""){?>
												  <tr>
                                                    <td align="center" valign="middle"><?=$Message1;?></td>
                                                  </tr>
												  <? } ?>
												  <tr>
                                                    <td height="40" align="left" valign="middle" class="font-12-gold">
                                                    <?php e_strt("Please enter your email below and we'll send you a new password");?>.</td>
                                                  </tr>
                                                  <tr>
                                                    <td align="left" valign="top"><table border="0" align="left" cellpadding="3" cellspacing="0">
                                                        <tr>
                                                          <td align="left"><input name="email" type="text" class="text_field5" id="email" value="Email" onFocus="if(this.value=='Email'){this.value='';}" onBlur="if(this.value==''){this.value='Email';}" /></td>
                                                        </tr>
                                                        <tr>
                                                          <td align="left" valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                              <tr>
                                                                <td align="left" valign="middle">
                                                    <input type="hidden" name="HidSubmit" id="HidSubmit" value="0" />
                                                    <input type="button" value="<?php e_upstrt('SUBMIT');?>" onClick="return FrmCheck();" class="JAbutton"/>
                                                  <div style="padding-left:10px; float:right;">
                                                   <a href="login.php">
                                                   <input type="button" value="<?php e_upstrt('BACK');?>" class="JAbutton"/>
                                                   </a>
                                                   </div>
																</td>
                                                              </tr>
                                                            </table></td>
                                                        </tr>
                                                      </table></td>
                                                  </tr>
                                                  <tr>
                                                    <td align="left" valign="top">&nbsp;</td>
                                                  </tr>
                                                </table>
											  </form>
											  </td>
                                            </tr>
                                          </table></td>
                                      </tr>
                                    </table></td>
                                </tr>
                                <tr>
                                  <td height="35" align="left" valign="top" class="font-12-gra-dr">&nbsp;</td>
                                </tr>
                                
                              </table></td>
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
	var frm=document.FrmLogin;
	if(frm.email.value.split(" ").join("")=="" || frm.email.value.split(" ").join("")=="Email")
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

	frm.HidSubmit.value=1;
	frm.submit();
	return true;
}
</script>
<? include("googleanalytic.php");?>
</body>
</html>
