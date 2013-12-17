<? include("connect.php");
/*if($_SESSION['SESSION_COUNTRY']==""){	header("location:home.php");	exit;}*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?=$SITE_TITLE;?></title>
<meta name="description" content="<?=$META_DESC;?>" />
<meta name="keywords" content="<?=$META_KEYWORD;?>" />
<meta name="robots" content="INDEX,FOLLOW" />
<link href="css/justin_alexander.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/iepngfix_tilebg.js"></script>
<style type="text/css">
img, div, input ,td{ behavior: url("iepngfix.htc") }
</style>
<script type="text/javascript">
<!--
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}
//-->
</script>
</head>
<body onload="MM_preloadImages('images/img1.jpg','images/img2.jpg','images/img3.jpg')">
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
                      <td align="left" valign="top" width="325">&nbsp;</td> <div style="width:1200px;height:700px"><!--change the width and height value as you want-->
  
  <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="100%" height="100%" id="FlipBookBuilder">
                <param name="movie" value="book.swf?pageIndex=5" />	<!--You change pageIndex=3 to other page index -->
                <param name="quality" value="high" />
                <param name="bgcolor" value="transparent" />
                <param name="allowScriptAccess" value="sameDomain" />
                <param name="allowFullScreen" value="true" />
                <!--[if !IE]>-->
                <object type="application/x-shockwave-flash" data="book.swf?1" width="100%" height="100%">	<!--You change pageIndex=3 to other page index -->
                    <param name="quality" value="high" />
                    <param name="bgcolor" value="transparent" />
                    <param name="allowScriptAccess" value="sameDomain" />
                    <param name="allowFullScreen" value="true" />
                <!--<![endif]-->
                <!--[if gte IE 6]>-->
                	<p> 
                		Either scripts and active content are not permitted to run or Adobe Flash Player version
                		9.0.0 or greater is not installed.
                	</p>
                <!--<![endif]-->
                    <a href="http://www.adobe.com/go/getflashplayer">
                       Get Adobe Flash Player
                    </a> 
                <!--[if !IE]>-->
                </object>
                <!--<![endif]-->
            </object>
</div>  
                      <td align="left" valign="top">&nbsp;</td>
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