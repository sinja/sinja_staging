<?
include("connect.php");
////////////////////////////////////Load album images new PHP:
$aid = 	trim($_REQUEST['aid']);
$hueres=$sindb->get_results("SELECT id,title,pimage from galleryimages where pid='".$aid."' AND pimage!='' order by displayorder asc LIMIT 30");
echo json_encode($hueres);
	 
die();
	
/* Old PHP: 	
		
if($_REQUEST["Type"]=="Load_ALBUM_IMAGES")
{

		
		
		
	function validate($start,$aid)
	{	
		   global $ALBUM_URL;
		  $start=$start;
		  $pstart=0;
		  $nstart=0;
		  $selcnt=mysql_query("SELECT count(id) as cntrec from galleryimages where  pid='$aid' order by displayorder asc");
		  $selrow=mysql_fetch_array($selcnt);
		  $totrow=$selrow['cntrec'];
		  //$totrow=$totrow+1;
		  if($start>0) { $pstart=$start-1; }
		  if($start<($totrow-1)) { $nstart=$start+1; } else { $nstart=$start; }
		  $return="";
		 
		
		$Data.='<table border="0" cellspacing="0" cellpadding="0">
				  <tr>
					<td align="center" valign="middle">&nbsp;</td>
				  </tr>
				  <tr>
					<td align="center" valign="middle" width="600" height="450" >';
						  $hueres=mysql_query("SELECT * from galleryimages where pid='".$aid."'  order by displayorder asc limit $start,1");
						  $temptot=mysql_affected_rows();
						  if($temptot>0)
						  { 
								$n=0;
								while($huerow=mysql_fetch_array($hueres))
								{ 
									$n++;
										if($huerow["pimage"]!="")
										{
											$Data.='<img src="'.$ALBUM_URL.'/'.stripslashes($huerow['pimage']).'" height="493" border="0">';
										} 
										$Data.='</td>
										  </tr>
										  <tr>
											<td height="30" align="left" valign="middle">'.stripslashes($huerow['title']).'</td>
										  </tr>';
								}
						  }
						  $Data.='<tr>
								<td align="left" valign="middle" class="albums-border"><table width="98%" border="0" cellspacing="0" cellpadding="0">
								  <tr>
									<td width="32%" height="30" align="left" valign="middle" class="albums-font-11">'.($start+1).'/'.$totrow.'</td>
									<td width="32%" align="left" valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0">
									  <tr>
										<td align="center" valign="middle"><a href="#" onclick="return Load_ALBUM_IMAGES(\'Load_ALBUM_IMAGES_ID\','.$pstart.','.$aid.');" ><img src="images/btn_prev1.gif" width="19" height="11" border="0" /></a></td>
										<td align="center" valign="middle"><a href="#" onclick="return Load_ALBUM_IMAGES(\'Load_ALBUM_IMAGES_ID\','.$nstart.','.$aid.');"><img src="images/btn_next1.gif" width="19" height="11" border="0" /></a></td>
									  </tr>
									</table></td>
									<td width="32%" align="right" valign="middle"><a href="#" onclick="document.getElementById(\'Load_ALBUM_IMAGES_IDMAIN\').style.display=\'none\';"><img src="images/close_btn.gif" width="12" height="12" border="0" /></a></td>
								  </tr>
								</table></td>
							  </tr>';
						
						
						$Data.='</table>';		
	  return $Data;
	}
	echo validate(trim($_REQUEST['start']),trim($_REQUEST['aid']));
	
}
*/
?>