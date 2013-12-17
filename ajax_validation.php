<?php
include("connect.php");
global $THUMBNAIL_IMAGEPATH;
///////////Username Validation//////////
if($_REQUEST["Type"]=="AddNewColor")
{
	function validate($colorname)
	{
		if($colorname!="")
		{
			$sql1="select * from products_colors where name='".addslashes($colorname)."'";
			$rs1=mysql_query($sql1);
			$tottt=mysql_affected_rows();
			if($tottt<=0)
			{
					$sql1="insert into products_colors set name='".addslashes($colorname)."'";
					$rs1=mysql_query($sql1);
					$Data.="";
			}	
			else
			{
					$Data.="<strong><br>Product color name already exists.</strong>";
			}
		}	
		else
		{
			$Data.="<strong><br>Please enter color name.</strong>";
		}
		return $Data;
	}
	echo validate(trim($_REQUEST['colorname']));
}
if($_REQUEST["Type"]=="AddNewAccessory")
{
	function validate($accessoryname)
	{
		if($accessoryname!="")
		{
			$sql1="select * from productaccessories where AccessoryName='".addslashes($accessoryname)."'";
			$rs1=mysql_query($sql1);
			$tottt=mysql_affected_rows();
			if($tottt<=0)
			{
					$sql1="insert into productaccessories set AccessoryName='".addslashes($accessoryname)."'";
					$rs1=mysql_query($sql1);
					$Data.="";
			}	
			else
			{
					$Data.="<strong><br>Product accessory already exists.</strong>";
			}
		}	
		else
		{
			$Data.="<strong><br>Please enter accessory name.</strong>";
		}
		return $Data;
	}
	echo validate(trim($_REQUEST['accessoryname']));
}
if($_REQUEST["Type"]=="LoadAccessoriesAvail")
{
	function validate($aaa)
	{
		$colors_availQryRs=mysql_query("SELECT * from productaccessories order by AccessoryName asc");
		$Totcolors_avail=mysql_affected_rows();
		$data='<select name="accessories_avail[]" id="accessories_avail"  multiple="multiple" style="width:250px;height:150px;" class="solidinput">';
		for($PS2=0;$PS2<$Totcolors_avail;$PS2++)
		{
			$colors_availQryRow=mysql_fetch_array($colors_availQryRs);
			$data.="<option value=".stripslashes($colors_availQryRow['AccessoryId']).">".stripslashes($colors_availQryRow['AccessoryName'])."</option>";
		}
		$data.="</select>";
		return $data;
	}
	echo validate("test");
}
if($_REQUEST["Type"]=="LoadAccessoriesShown")
{
	function validate($aaa)
	{
		$colors_availQryRs=mysql_query("SELECT * from productaccessories order by AccessoryName asc");
		$Totcolors_avail=mysql_affected_rows();
		$data='<select name="colors_shown[]" id="colors_shown"  multiple="multiple" style="width:250px;height:150px;" class="solidinput">';
		for($PS2=0;$PS2<$Totcolors_avail;$PS2++)
		{
			$colors_availQryRow=mysql_fetch_array($colors_availQryRs);
			$data.="<option value=".stripslashes($colors_availQryRow['AccessoryId']).">".stripslashes($colors_availQryRow['AccessoryName'])."</option>";
		}
		$data.="</select>";
		return $data;
	}
	echo validate("test");
}
if($_REQUEST["Type"]=="LoadColorsAvail")
{
	function validate($aaa)
	{
		$colors_availQryRs=mysql_query("SELECT * from accessories order by name asc");
		$Totcolors_avail=mysql_affected_rows();
		$data='<select name="colors_avail[]" id="colors_avail"  multiple="multiple" style="width:250px;height:150px;" class="solidinput">';
		for($PS2=0;$PS2<$Totcolors_avail;$PS2++)
		{
			$colors_availQryRow=mysql_fetch_array($colors_availQryRs);
			$data.="<option value=".stripslashes($colors_availQryRow['id']).">".stripslashes($colors_availQryRow['name'])."</option>";
		}
		$data.="</select>";
		return $data;
	}
	echo validate("test");
}
if($_REQUEST["Type"]=="LoadColorsShown")
{
	function validate($aaa)
	{
		$colors_availQryRs=mysql_query("SELECT * from products_colors order by name asc");
		$Totcolors_avail=mysql_affected_rows();
		$data='<select name="colors_shown[]" id="colors_shown"  multiple="multiple" style="width:250px;height:150px;" class="solidinput">';
		for($PS2=0;$PS2<$Totcolors_avail;$PS2++)
		{
			$colors_availQryRow=mysql_fetch_array($colors_availQryRs);
			$data.="<option value=".stripslashes($colors_availQryRow['id']).">".stripslashes($colors_availQryRow['name'])."</option>";
		}
		$data.="</select>";
		return $data;
	}
	echo validate("test");
}
?>