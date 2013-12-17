<?php
include_once("admin.config.inc.php");
include("admin.cookie.php");
include("connect.php") ;
$mlevel=3;
$Error=0;
if(isset($_POST['Submit']))
{
	if(isset($_POST['name']))
	$name=$_POST['name'];
	$query = "update admin set password='$name'";
	$result = mysql_query($query,$db);
	$Message = "Password Changed Successfully"; 
}
$query = "select * from admin";
$result = mysql_query($query,$db);
$row = mysql_fetch_array($result);
$name= $row["password"];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD html 4.0 Transitional//EN">
<html>
<head>
<title><?php echo $ADMIN_MAIN_SITE_NAME ?></title>
<link href="main.css" type=text/css rel=stylesheet>
<META content="MSHTML 6.00.2600.0" name=GENERATOR>
</head>
<body leftMargin=0 topMargin=0 marginheight="0" marginwidth="0">
<script language="javascript" src="body.js"></script>
<script language="javascript" type="text/javascript">
function valid()
{
	form=document.addmaterial;
	if(form.name.value=="")
	{
		alert("Please enter password.");
		form.name.focus();
		return false;
	}	
	return  true;
}
</script>
<table align="left" width="100%" cellpadding="0" cellspacing="0">
  <tr>
    <td><table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td height="75"><? include ("top.php"); ?></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td><table cellSpacing=0 cellPadding=0 width="100%" border=0>
        <tbody >
          <tr>
            <td width="20%"  valign="top" class="rightbdr" ><? include("inner_left_admin.php"); ?>
            </td>
            <td width="80%" valign="top" align="center"><table width="100%"  border=0 cellpadding="2" cellspacing="2">
                <tr>
                  <TD height="35" class="form111">Change Password</TD>
                </tr>
                <tr>
                  <td height="222" class="formbg" valign="top"><form name="addmaterial"  method=post enctype="multipart/form-data">
                      <table cellSpacing=2 cellPadding=2 width=98% border=0>
                        <tr>
                          <TD class=a align=right colSpan=4 nowrap>* Required Information</TD>
                        </tr>
                        <? if($Message) { ?>
                        <tr>
                          <TD colSpan=4 align="center" vAlign=top><span class="a-l"><? echo  $Message; ?></span></TD>
                        </tr>
                        <? } ?>
                        <tr>
                          <TD width="23%" height="25" align=right><strong><span class="a">*</span> Password :&nbsp;</strong></TD>
                          <TD height="25" colSpan=3 vAlign=top><input name="name" type="text"  class="solidinput" value="<?php echo $name; ?>" size="30"></TD>
                        </tr>
                        <tr>
                          <TD colSpan=4>&nbsp;</TD>
                        </tr>
                        <tr>
                          <TD align=right>&nbsp;</TD>
                          <TD width="77%" colspan="3"><INPUT type=submit name="Submit" class="bttn-s" value="Change Password" onClick="return valid();">
                          </TD>
                        </tr>
                        <tr>
                          <TD colSpan=4><P>&nbsp;</P>
                            <P>&nbsp;</P></TD>
                        </tr>
                      </table>
                    </FORM></td>
                </tr>
              </table></td>
          </tr>
        </tbody>
      </table></td>
  </tr>
</table>
</body>
</html>