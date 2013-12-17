<? include("connect.php"); 
if($_POST['HidSubmit']=="1")
{
	$email=mysql_real_escape_string(trim($_POST['email']));
	$password=trim($_POST['password']);
	if($email!="Email" && $password!="Password")
	{
		$SelQry="SELECT  customer_entity.entity_id,customer_entity.is_active FROM customer_entity,customer_entity_varchar 
				 WHERE 
				 customer_entity.entity_id=customer_entity_varchar.entity_id and 
				 customer_entity.email='$email' and customer_entity_varchar.attribute_id=12 and customer_entity_varchar.value='$password'";
		$SelQryRs=mysql_query($SelQry);
		$TotSelQry=mysql_affected_rows();
		if($TotSelQry>0)
		{
			$SelQryRow=mysql_fetch_array($SelQryRs);
			$entity_id=$SelQryRow['entity_id'];
			$is_active=$SelQryRow['is_active'];
			if($is_active==1)
			{
				$_SESSION['UsErId']=$entity_id;
				
				$SelQry2="SELECT  value FROM customer_entity_varchar WHERE customer_entity_varchar.attribute_id=5 and customer_entity_varchar.entity_id='$entity_id'";
				$SelQryRs2=mysql_query($SelQry2);
				$SelQryRow2=mysql_fetch_array($SelQryRs2);
				$_SESSION['UsErNaMe']=stripslashes($SelQryRow2['value']);
				if($_REQUEST['Bk']!="")
				{
					header("location:".$_SERVER['HTTP_REFERER']."");
					exit;
				}
				else
				{
					header("location:my_account.php");
					exit;
				}	
			}
			else
			{
				$Message1="Please activate your account.";
			}
		}
		else
		{
			$Message1="Invalid email or password.";
		}
	}
}
$Message2="";
if($_POST['HidSubmit2']=="1")
{	if(10 > 20)//if(stripos($_SERVER["SERVER_NAME"], 'staging', 0) == 0)
	{
		$DATABASENAME = "sin2009_staging2retailer";
		$USERNAME = "sin2009_usrJa";
		$PASSWORD = "Ja123pass456";		
	}
	else
	{
		$DATABASENAME = "sin2009_retailer";
		$USERNAME = "sin2009_usrJa";
		$PASSWORD = "Ja123pass456";			
	}
	$db=mysql_connect($DBSERVER, $USERNAME, $PASSWORD) or die(mysql_error());
	mysql_select_db($DATABASENAME,$db);	
	$username=mysql_real_escape_string(trim($_POST['username']));
	$password=trim($_POST['password2']);
	if($username!="Username" && $password2!="Password")
	{
		$SelQry="SELECT * FROM jos_users WHERE username='$username' and password='$password'";
		$SelQryRs=mysql_query($SelQry);
		$TotSelQry=mysql_affected_rows();
		if($TotSelQry>0)
		{
			$SelQryRow=mysql_fetch_array($SelQryRs);
			$id=$SelQryRow['id'];
			$block=$SelQryRow['block'];
			if($block==0)
			{
				$_SESSION['UsErIdReTaIlEr']=$id;
				$_SESSION['UsErNaMeReTaIlEr']=stripslashes($SelQryRow['name']);	
				
				//save a flag in the database
				$SelQry="INSERT INTO userrelaycache SET username='$username', password='$password'";
				$SelQryRs=mysql_query($SelQry);
				//retrieve new cacheid
				$newId = mysql_insert_id();
				
				if(10 > 20)//if(stripos($_SERVER["SERVER_NAME"], 'staging', 0) == 0)
				{
					header("location:http://stagingretailers.sinceritybridal.com/login.php?l=$newId");
					exit;
				}
				else
				{
					header("location:http://retailers.sinceritybridal.com/login.php?l=$newId");
					exit;
				}	
			}
			else
			{
				$Message2="Your account is disabled.";
			}
		}
		else
		{
			$Message2="Invalid username or password.";
		}
	}
	mysql_close();	if(10 > 20)//if(stripos($_SERVER["SERVER_NAME"], 'staging', 0) == 0)
	{
		$DBSERVER = "localhost";
		$DATABASENAME = "sin2009_staging2main";
		$USERNAME = "sin2009_usrJa";
		$PASSWORD = "Ja123pass456";	
	}
	else
	{
		$DBSERVER = "localhost";
		$DATABASENAME = "sin2009_janew";
		$USERNAME = "sin2009_usrJa";
		$PASSWORD = "Ja123pass456";	
	}
	$db=mysql_connect($DBSERVER, $USERNAME, $PASSWORD) or die(mysql_error());
	mysql_select_db($DATABASENAME,$db);	
}
$page_title = ' | '.ucwords(strtolower(strt("Login")));
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
                      <td height="32" align="left" valign="top" class="font-20-lit-gra"><?php e_upstrt('Log In or Register');?></td>
                    </tr>
                    <tr>
                      <td align="center" valign="top"><table width="850" border="0" align="center" cellpadding="0" cellspacing="0">
                          <tr>
                            <td width="645" align="left" valign="top"><table width="600" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td align="center" valign="middle"><?=$Message1;?>&nbsp;</td>
                                </tr>
                                <tr>
                                  <td align="left" valign="top"><table width="100%" border="0" align="center" cellpadding="5" cellspacing="0">
                                      <tr>
                                        <td width="45%" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                              <td height="35" align="left" valign="middle"><span class="font-16-gra">
											  <?php e_upstrt('Create an Account');?></span></td>
                                            </tr>
                                            <tr>
                                              <td align="left" valign="top" class="font-14-gra">
											  <? echo strip_tags(stripslashes(GetName1("staticpage","content","id","13")),"<a></a><b></b><strong></strong><u></u>");?></td>
                                            </tr>
                                            <tr>
                                              <td align="left" valign="bottom">                                              
                                              <a href="register.php">
                                               <input type="button" value="<?php e_upstrt('REGISTER');?>" class="JAbutton"/>
                                              </a></td>
                                            </tr>
                                          </table></td>
                                        <td width="55%" align="center" valign="middle" class="font-12-gra"><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                                            <tr>
                                            <script type="text/javascript">
											function handleEnter (field, event,id) {
												var keyCode = event.keyCode ? event.keyCode : event.which ? event.which : event.charCode;
												if (keyCode == 13) {
													if(id == 0){
														FrmCheck();
													}else if(id == 1){
														FrmCheck2();													
													} 
												}
													else
														return true;
												}      
											</script>
                                              <td align="left" valign="top">
											  <form name="FrmLogin" id="FrmLogin" enctype="multipart/form-data" method="post">
											  <table width="92%" border="0" align="center" cellpadding="0" cellspacing="0">
                                                  <tr>
                                                    <td height="40" align="left" valign="middle" class="font-16-gra"><?php e_upstrt('Login');?></td>
                                                  </tr>
                                                  <tr>
                                                    <td align="left" valign="top"><table width="90" border="0" align="center" cellpadding="3" cellspacing="0">
                                                        <tr>
                                                          <td align="left">
                                                          <input name="email" type="text" class="text_field5" id="email" value="Email" onFocus="if(this.value=='Email'){this.value='';}" onBlur="if(this.value==''){this.value='Email';}" /></td>
                                                        </tr>
                                                        <tr>
                                                          <td align="left">
                                                          <input name="password" type="text" class="text_field5" id="password" value="Password"  onfocus="this.type='password';if(this.value=='Password'){this.value='';}" onKeyPress="return handleEnter(this, event,0)" onBlur="this.type='password';if(this.value==''){this.value='Password';}" /></td>
                                                        </tr>
                                                        <tr>
                                                          <td align="left" valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                              <tr>
                                                                <td align="left" valign="middle">
                                                                <a href="forgotpass.php" class="link3"><?php e_strt("Forgot password?");?></a></td>
                                                                <td align="right" valign="middle">
																<input type="hidden" name="HidSubmit" id="HidSubmit" value="0" />
                                                                <input type="button" value="<?php e_upstrt('LOGIN');?>" onClick="return FrmCheck();" class="JAbutton"/>
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
								<? if($Message2!=""){?>
								<tr>
                                  <td align="center" valign="middle"><?=$Message2;?>&nbsp;</td>
                                </tr>
								<? } ?>
                                <tr>
                                  <td align="left" valign="top" class="font-12-gra-dr"><table width="100%" border="0" align="center" cellpadding="5" cellspacing="0">
                                      <tr>
                                        <td width="45%" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                              <td height="35" align="left" valign="middle"><span class="font-16-gra"><?php e_upstrt('Request to become a retailer');?></span></td>
                                            </tr>
                                            <tr>
                                              <td align="left" valign="top" class="font-14-gra"><? echo strip_tags(stripslashes(GetName1("staticpage","content","id","14")),"<a></a><b></b><strong></strong><u></u>");?></td>
                                            </tr>
                                            <tr>
                                              <td align="left" valign="bottom"><a href="retail_inquiries.php">
                                              <input type="button" value="<?php e_upstrt('REQUEST');?>" class="JAbutton"/>
                                              </a></td>
                                            </tr>
                                          </table></td>
                                        <td width="55%" align="center" valign="middle" class="font-12-gra"><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                                            <tr>
                                              <td align="left" valign="top">
											  <form name="FrmLogin2" id="FrmLogin2" enctype="multipart/form-data" method="post">
											  <table width="92%" border="0" align="center" cellpadding="0" cellspacing="0">
                                                  <tr>
                                                    <td height="40" align="left" valign="middle" class="font-16-gra"><?php e_upstrt('Retail Login');?></td>
                                                  </tr>
                                                  <tr>
                                                    <td align="left" valign="top"><table width="90" border="0" align="center" cellpadding="3" cellspacing="0">
                                                        <tr>
                                                          <td align="left"><input name="username" type="text" class="text_field5" id="username" value="Username" onFocus="if(this.value=='Username'){this.value='';}" onBlur="if(this.value==''){this.value='Username';}" /></td>
                                                        </tr>
                                                        <tr>
                                                          <td align="left"><input name="password2" type="text" class="text_field5" id="password2" value="Password"  onfocus="this.type='password';if(this.value=='Password'){this.value='';}" onKeyPress="return handleEnter(this, event,1)" onBlur="this.type='password';if(this.value==''){this.value='Password';}" /></td>
                                                        </tr>
                                                        <tr>
                                                          <td align="left" valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                              <tr>
                                                                <td align="left" valign="middle"><a href="#" class="link3"><?php e_strt("Forgot password?");?> </a></td>
                                                                <td align="right" valign="middle">
																<input type="hidden" name="HidSubmit2" id="HidSubmit2" value="0" />
                                                                 <input type="button" value="<?php e_upstrt('LOGIN');?>" onClick="return FrmCheck2();" class="JAbutton"/>
															
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
                              </table></td>
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
	if(frm.password.value.split(" ").join("")=="" || frm.password.value.split(" ").join("")=="Password")
	{
		alert("Please enter your password.");
		frm.password.focus();
		return false;
	}
	frm.HidSubmit.value=1;
	frm.submit();
	return true;
}
function FrmCheck2()
{
	var frm=document.FrmLogin2;
	if(frm.username.value.split(" ").join("")=="" || frm.username.value.split(" ").join("")=="Username")
	{
		alert("Please enter your username.");
		frm.username.focus();
		return false;
	}
	if(frm.password2.value.split(" ").join("")=="" || frm.password2.value.split(" ").join("")=="Password")
	{
		alert("Please enter your password.");
		frm.password2.focus();
		return false;
	}
	frm.HidSubmit2.value=1;
	frm.submit();
	return true;
}
</script>
<? include("googleanalytic.php");?>
</body>
</html>