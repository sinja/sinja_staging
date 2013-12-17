<? 
header("location:collectionlist.php?collection=1");
		exit;
include("connect.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?=$SITE_TITLE;?></title>
<meta name="description" content="<?=$META_KEYWORD;?>" />
<meta name="keywords" content="<?=$META_DESC;?>" />
<meta name="robots" content="INDEX,FOLLOW" />
<link href="css/justin_alexander.css" rel="stylesheet" type="text/css" />
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
                <td width="215" align="left" valign="top"><? include("left.php");?></td>
                <td align="left" valign="top"><table border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td align="left" valign="top" width="325"><a href="collectionlist.php?collection=1"><img src="images/justin-alexander-img.png" width="310" height="495" border="0" /></a></td>
                      <td align="left" valign="top" width="325"><img src="images/img2.jpg" width="310" height="495" border="0" /></td>
                      <td align="left" valign="top"><img src="images/img3.jpg" width="310" height="495" border="0" /></td>
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
<? include("googleanalytic.php");?>
</body>
</html>