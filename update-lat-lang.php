<? include("connect1.php");

$jos_comprofilerQry="select id,cb_storepost from jos_comprofiler where cb_storepost!='' order by id asc ";
$jos_comprofilerQryRs=mysql_query($jos_comprofilerQry);
$Totjos_comprofiler=mysql_affected_rows();
if($Totjos_comprofiler>0)
{
	for($JJ=0;$JJ<$Totjos_comprofiler;$JJ++)
	{
		$jos_comprofilerQryRow=mysql_fetch_array($jos_comprofilerQryRs);	
		$zip=trim($jos_comprofilerQryRow['cb_storepost']);
		
			$jos_comprofilerQry2="select Latitude,Longitude from zipcodes where PostalCode='$zip'";
			$jos_comprofilerQryRs2=mysql_query($jos_comprofilerQry2);
			$Totjos_comprofiler2=mysql_affected_rows();
			if($Totjos_comprofiler2>0)
			{
				$jos_comprofilerQryRow2=mysql_fetch_array($jos_comprofilerQryRs2);
				$Latitude=trim($jos_comprofilerQryRow2['Latitude']);
				$Longitude=trim($jos_comprofilerQryRow2['Longitude']);
				
				echo "<br>". $jos_comprofilerQry3="UPDATE jos_comprofiler SET cb_maplat='$Latitude',cb_maplong='$Longitude'	where id='".$jos_comprofilerQryRow['id']."'";
				$jos_comprofilerQryRs3=mysql_query($jos_comprofilerQry3);
			}
	}
}
?>