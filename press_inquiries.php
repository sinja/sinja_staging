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
						websiteid='".SITE_ID."',
						regdate=now()";	 
	$AddUserQryRs=mysql_query($AddUserQry);
	
	/////EMAIL TO CLIENT
	$subject1=stripslashes($_POST['reason'])." , $SITE_URL_IN_EMAIL";
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
	
	
	$SelQry2="SELECT  email1 FROM region_inquiry WHERE name='".addslashes($_POST['region'])."'";
	$SelQryRs2=mysql_query($SelQry2);
	$SelQryRow2=mysql_fetch_array($SelQryRs2);
	$to1=stripslashes($SelQryRow2['email1']);
	if($_SERVER['HTTP_HOST']!="plus")
	{
		HtmlMailSend($to1,$subject1,$mailcontent1,$from1);
	}
	/////END OF EMAIL TO CLIENT
	
	header("location:press_inquiries.php?msg=1");
	exit;
}
$page_title = ' | '.ucwords(strtolower(strt("Press Inquiries")));
?>
<? include("header.php");?>
<body>
<div id="all">
       <? include("top.php");?>
       <div id="section">
       <? include("left.php");?>
            <div id="content">
            <?php breadcrumbs(); ?>
                 <div class="pageTitle" style="width:780px;">
                <h2>
               <?php e_upstrt('Press Inquiries');?>
                </h2>
            </div>                
          <form name="FrmInquiry" id="FrmInquiry" enctype="multipart/form-data" method="post">
          <input type="hidden" name="reason" value="Press Inquiry" id="reason"/>
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="left" valign="top">
                <div id="pressInHeading" class="inqueriesBG">
                                                      
                 </div>                                         
              </tr>
              <tr>
                <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="85%" height="40" align="left" valign="middle" class="font-16-gra"><?php e_upstrt('IF YOU HAVE A PRESS INQUIRY, PLEASE FILL OUT THIS FORM:');?></td>
                      <td width="15%" align="left" valign="middle" class="font-11-blk"><em>* <?php e_strt('required fields');?></em></td>
                    </tr>
                  </table></td>
              </tr>
              <? if($_REQUEST['msg']=="1"){?><tr><td align="center" style="color:#F8FBF9;"><?php e_strt('Your inquiry has been sent successfully');?>.<br /><br /></td></tr><? } ?>
              <tr>
                <td align="left" valign="top"><table border="0" cellspacing="0" cellpadding="3">
                    <tr>
                      <td width="5" align="right" valign="top" class="font-12-gra">* </td>
                      <td align="left" valign="top" class="font-12-gra">
                      <input name="name" type="text" class="text_field1" id="name" value="<?php e_strt('Name');?>" onFocus="if(this.value=='<?php e_strt('Name');?>'){this.value='';}" onBlur="if(this.value==''){this.value='<?php e_strt('Name');?>';}"/>
                      </td>
                      <td width="5" align="right" valign="top" class="font-12-gra">* </td>
                      <td align="left" valign="top" class="font-12-gra">
                      <input name="company" type="text" class="text_field1" id="company" value="<?php e_strt('Company');?>" onFocus="if(this.value=='<?php e_strt('Company');?>'){this.value='';}" onBlur="if(this.value==''){this.value='<?php e_strt('Company');?>';}"/>                                              
                      </td>
                    </tr>
                    <tr>
                      <td align="right" valign="top" class="font-12-gra">*</td>
                      <td align="left" valign="top" class="font-12-gra"><input name="email" type="text" class="text_field1" id="email" value="<?php e_strt('Email');?>"  onfocus="if(this.value=='<?php e_strt('Email');?>'){this.value='';}" onBlur="if(this.value==''){this.value='<?php e_strt('Email');?>';}" /></td>
                       <td width="5" align="right" valign="top" class="font-12-gra">* </td>
                      <td align="left" valign="top" class="font-12-gra"><select name="region" class="text_field1" id="region">
                      <option value=""><?php e_strt("Region");?></option>
					  <?=GetDropdown(name,name,region_inquiry,' order by name asc',"");?></select></td>
                    </tr>
                    <tr>
                      <td align="right" valign="top" class="font-12-gra">*</td>
                      <td align="left" valign="top" class="font-12-gra"><input name="phone" type="text" class="text_field1" id="phone" value="<?php e_strt('Phone Number');?>" onFocus="if(this.value=='<?php e_strt('Phone Number');?>'){this.value='';}" onBlur="if(this.value==''){this.value='<?php e_strt('Phone Number');?>';}"/></td>
                      <td align="right" valign="top" class="font-12-gra">&nbsp;</td>
                      <td align="left" valign="top" class="font-12-gra"><input name="zipcode" type="text" class="text_field1" id="zipcode" value="<?php e_strt('Zip Code');?>" onFocus="if(this.value=='<?php e_strt('Zip Code');?>'){this.value='';}" onBlur="if(this.value==''){this.value='<?php e_strt('Zip Code');?>';}"/></td>
                    </tr>
                    <tr>
                      <td align="right" valign="top" class="font-12-gra">*</td>
                      <td class="font-12-gra" colspan="3" align="left" valign="top"><textarea name="inquiry" rows="4" class="text_field4" id="inquiry" onFocus="if(this.value=='<?php e_strt('Inquiry');?>'){this.value='';}" onBlur="if(this.value==''){this.value='<?php e_strt('Inquiry');?>';}"><?php e_strt('Inquiry');?></textarea></td>
                    </tr>
                  </table></td>
              </tr>
              <tr class="bottom-submit">
                <td height="25" align="left" valign="middle" class="font-11-blk"><em><?php e_strt('If you are inquiring about location based information at the mimimum please supply us with your zip/postal code');?>.</em></td>
              </tr>
              <tr class="bottom-submit">
                <td height="25" align="left" valign="middle">
                <input type="hidden" name="HidSubmit" id="HidSubmit" value="0" />
                <input type="button" value="<?php e_upstrt('SUBMIT');?>" onClick="return FrmCheck();" class="JAbutton"/>
                </td>
              </tr>
            </table>
          </form>
         
                  </div>  
        </div>
        
    </div>
    <? include("footer.php");?>
<script language="javascript" type="text/javascript">
function FrmCheck()
{
	var frm=document.FrmInquiry;
	if(frm.name.value.split(" ").join("")=="" || frm.name.value.split(" ").join("")=="<?php e_strt('Name');?>")
	{
		alert("<?php e_strt('Please enter your name.');?>");
		frm.name.focus();
		return false;
	}
	if(frm.reason.value.split(" ").join("")=="")
	{
		alert("<?php e_strt('Please select your reason for interest.');?>");
		frm.reason.focus();
		return false;
	}
	if(frm.email.value.split(" ").join("")=="" || frm.email.value.split(" ").join("")=="<?php e_strt('Email');?>")
	{
		alert("<?php e_strt('Please enter your email address.');?>");
		frm.email.focus();
		return false;
	}
	if(frm.email.value!="")
	{
		if (!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(frm.email.value)))
		{
				alert("<?php e_strt('Please enter a proper email address.');?>");
				frm.email.focus();
				return false;
		}
	}
	if(frm.region.value.split(" ").join("")=="")
	{
		alert("<?php e_strt('Please select your region.');?>");
		frm.region.focus();
		return false;
	}
	if(frm.inquiry.value.split(" ").join("")=="" || frm.inquiry.value.split(" ").join("")=="<?php e_strt('Inquiry');?>")
	{
		alert("<?php e_strt('Please enter your inquiry details.');?>");
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
