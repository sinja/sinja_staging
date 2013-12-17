<? include("connect.php");
//if($_SESSION['SESSION_COUNTRY']==""){header("location:home.php");exit;}
if($_POST['HidSubmit']=='1')
{
	$AddUserQry="INSERT INTO general_inquiries SET
						name='".addslashes($_POST['name'])."',						
						email='".addslashes($_POST['email'])."',
						inquiry='".addslashes($_POST['inquiry'])."',
						phone='".addslashes($_POST['phone'])."',
						reason='".addslashes($_POST['reason'])."',
						region='".addslashes($_POST['region'])."',
                                                zipcode='".addslashes($_POST['zipcode'])."',
						websiteid='1',
						regdate=now()";	 
	$AddUserQryRs=mysql_query($AddUserQry);
	
	/////EMAIL TO CLIENT
	$subject1=stripslashes($_POST['reason'])." , sinceritybridal.com";
	$from1=$ADMIN_MAIL;
	$mailcontent1="
	<html>
		<link href=\"$SITE_URL/css/sincerity.css\" rel=\"stylesheet\" type=\"text/css\" />
		<style type='text/css'>td {
			font-family: Helvetica, Arial;
			font-size: 12px;
			font-weight: normal;
			color: #000000;
		}
		a {
			font-weight: normal;
			color: #000000;
			text-decoration: none;
		}
		</style>
		<body>
			<table cellpadding=\"3\" cellspacing=\"3\" class=\"font-12-gra\" border=\"0\">
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
					<Td align=\"left\" colspan=\"2\">Inquiry has been submited with the below details.</td>
				</tr>
				<tr>
					<Td align=\"left\" colspan=\"2\"></td>
				</tr>
				<tr>
					<Td align=\"left\" width=\"150\"><strong>Name:</strong></td>
					<Td align=\"left\">".stripslashes($_POST['name'])."</td>
				</tr>
				<tr>
					<Td align=\"left\" width=\"150\"><strong>Email:</strong></td>
					<Td align=\"left\">".stripslashes($_POST['email'])."</td>
				</tr>
				<tr>
					<Td align=\"left\" width=\"150\"><strong>Phone:</strong></td>
					<Td align=\"left\">".stripslashes($_POST['phone'])."</td>
				</tr>
				<tr>
					<Td align=\"left\" width=\"150\"><strong>Reason for interest:</strong></td>
					<Td align=\"left\">".stripslashes($_POST['reason'])."</td>
				</tr>
				<tr>
					<Td align=\"left\" width=\"150\"><strong>Region:</strong></td>
					<Td align=\"left\">".stripslashes($_POST['region'])."</td>
				</tr>
				<tr>
					<Td align=\"left\" width=\"150\"><strong>Zip Code:</strong></td>
					<Td align=\"left\">".stripslashes($_POST['zipcode'])."</td>
				</tr>
				<tr>
					<Td align=\"left\" width=\"150\" valign=\"top\"><strong>Inquiry:</strong></td>
					<Td align=\"left\" valign=\"top\">".nl2br(stripslashes($_POST['inquiry']))."</td>
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
	
	
	$SelQry2="SELECT  email2 FROM region_inquiry WHERE name='".addslashes($_POST['region'])."'";
	$SelQryRs2=mysql_query($SelQry2);
	$SelQryRow2=mysql_fetch_array($SelQryRs2);
	$to1=stripslashes($SelQryRow2['email2']);
	if($_SERVER['HTTP_HOST']!="plus")
	{
		HtmlMailSend($to1,$subject1,$mailcontent1,$from1);
	}
	/////END OF EMAIL TO CLIENT
	
	header("location:general_inquiries.php?msg=1");
	exit;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$SITE_TITLE;?></title>
<meta name="description" content="<?=$META_KEYWORD;?>" />
<meta name="keywords" content="<?=$META_DESC;?>" />
<meta name="robots" content="INDEX,FOLLOW" />
<link href="css/sincerity.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/iepngfix_tilebg.js"></script>
<style type="text/css">
img, div, input ,td{ behavior: url("iepngfix.htc") }
</style>
</head>
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left" valign="top"><? include("top.php");?></td>
  </tr>
  <tr>
    <td align="left" valign="top"><table width="1164" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="221" align="left" valign="top"><? include("left.php");?></td>
                <td align="left" valign="top"><table width="850" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                      <td height="32" align="left" valign="top" class="font-20-gra"><? if($_SESSION['SESSION_LANGUAGE']=="EN"){?>General Inquiries
					  <? }else if($_SESSION['SESSION_LANGUAGE']=="ESP"){?>Información general
					  <? }else if($_SESSION['SESSION_LANGUAGE']=="NED"){?>Algemene informatie
					  <? }else if($_SESSION['SESSION_LANGUAGE']=="PL"){?>Ogolne pytania
					  <? }else if($_SESSION['SESSION_LANGUAGE']=="GER"){?>Allgemeine Anfragen<? }else{ ?>General Inquiries<? } ?></td>
                    </tr>
                    <tr>
                      <td align="center" valign="top" class="gra_border1"><table width="850" border="0" align="center" cellpadding="0" cellspacing="0">
                          <tr>
                            <td width="645" align="left" valign="top"><table width="600" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td align="left" valign="middle">&nbsp;</td>
                                </tr>
                                <tr>
                                  <td align="left" valign="top" class="font-12-gra">
								  <form name="FrmInquiry" id="FrmInquiry" enctype="multipart/form-data" method="post">
								  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                      <tr>
                                        <td align="left" valign="top"><img src="images/general_inquiries_img.jpg" width="609" height="200" /></td>
                                      </tr>
                                      <tr>
                                        <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                              <td width="85%" height="30" align="left" valign="middle" class="font-16-gra">Have a question about SINCERITY?</td>
                                              <td width="15%" align="left" valign="middle" class="font-11-blk"><em>* required fields</em></td>
                                            </tr>
                                          </table></td>
                                      </tr>
									  <? if($_REQUEST['msg']=="1"){?><tr><td align="center" style="color:#FF0000;">Your inquiry has been sent successfully.<br /><br /></td></tr><? } ?>
                                      <tr>
                                        <td align="left" valign="top"><table border="0" cellspacing="0" cellpadding="3">
                                            <tr>
                                              <td width="5" align="right" valign="top" class="font-12-gra">* </td>
                                              <td align="left" valign="top" class="font-12-gra"><input name="name" type="text" class="text_field1" id="name" value="Name" onfocus="if(this.value=='Name'){this.value='';}" onblur="if(this.value==''){this.value='Name';}"/></td>
                                              <td width="5" align="right" valign="top" class="font-12-gra">* </td>
                                              <td align="left" valign="top" class="font-12-gra"><select name="reason" class="text_field1" id="reason"><option value="">Reason for interest</option><?=GetDropdown(name,name,reasonforinterest,' order by id asc',"");?></select></td>
                                            </tr>
                                            <tr>
                                              <td align="right" valign="top" class="font-12-gra">*</td>
                                              <td align="left" valign="top" class="font-12-gra"><input name="email" type="text" class="text_field1" id="email" value="Email"  onfocus="if(this.value=='Email'){this.value='';}" onblur="if(this.value==''){this.value='Email';}" /></td>
                                               <td width="5" align="right" valign="top" class="font-12-gra">* </td>
											  <td align="left" valign="top" class="font-12-gra"><select name="region" class="text_field1" id="region"><option value="">Region</option><?=GetDropdown(name,name,region_inquiry,' order by name asc',"");?></select></td>
                                            </tr>
                                            <tr>
                                              <td align="right" valign="top" class="font-12-gra">*</td>
                                              <td align="left" valign="top" class="font-12-gra"><input name="phone" type="text" class="text_field1" id="phone" value="Phone Number" onfocus="if(this.value=='Phone Number'){this.value='';}" onblur="if(this.value==''){this.value='Phone Number';}"/></td>
                                              <td align="right" valign="top" class="font-12-gra">&nbsp;</td>
                                              <td align="left" valign="top" class="font-12-gra"><input name="zipcode" type="text" class="text_field1" id="phone" value="Zip Code" onfocus="if(this.value=='Zip Code'){this.value='';}" onblur="if(this.value==''){this.value='Zip Code';}"/></td>
                                            </tr>
                                            <tr>
                                              <td align="right" valign="top" class="font-12-gra">*</td>
                                              <td colspan="3" align="left" valign="top"><textarea name="inquiry" rows="4" class="text_field4" id="inquiry" onfocus="if(this.value=='Inquiry'){this.value='';}" onblur="if(this.value==''){this.value='Inquiry';}">Inquiry</textarea></td>
                                            </tr>
                                          </table></td>
                                      </tr>
                                      <tr>
                                        <td height="25" align="left" valign="middle" class="font-11-blk"><em>If you are inquiring about location based information at the mimimum please supply us with your zip/postal code.</em></td>
                                      </tr>
                                      <tr>
                                        <td height="25" align="left" valign="middle" class="gra_border1">
										<input type="hidden" name="HidSubmit" id="HidSubmit" value="0" />
										<a href="#" onclick="return FrmCheck();"><img src="images/submit_btn.gif" width="85" height="23" vspace="5" border="0" /></a></td>
                                      </tr>
                                    </table>
								  </form>
								  </td>
                                </tr>
                              </table></td>
                            <td width="202" align="left" valign="top"><? include("right_facebook.php");?></td>
                          </tr>
                        </table></td>
                    </tr>
                  </table></td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td height="35" align="center" valign="top">&nbsp;</td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td align="center" valign="top"><? include("footer.php");?></td>
  </tr>
</table>
<script language="javascript" type="text/javascript">
function FrmCheck()
{
	var frm=document.FrmInquiry;
	if(frm.name.value.split(" ").join("")=="" || frm.name.value.split(" ").join("")=="Name")
	{
		alert("Please enter your name.");
		frm.name.focus();
		return false;
	}
	if(frm.reason.value.split(" ").join("")=="")
	{
		alert("Please select your reason for interest.");
		frm.reason.focus();
		return false;
	}
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
	if(frm.region.value.split(" ").join("")=="")
	{
		alert("Please select your region.");
		frm.region.focus();
		return false;
	}
	if(frm.inquiry.value.split(" ").join("")=="" || frm.inquiry.value.split(" ").join("")=="Inquiry")
	{
		alert("Please enter your inquiry details.");
		frm.inquiry.focus();
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