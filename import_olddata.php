<?php
include_once("admin.config.inc.php");
include("admin.cookie.php");
include("connect.php");

/*503=size		
504=colors_ja_all
57=description
58=short_description 	
82=url_key
56=name
507=price_retailer
70=image
71=small_image
72=thumbnail
68=meta_keyword
495=collection_yr
80=status
514=discontinued
85=visibility
506=season


get color from eav_attribute_option_value where option_id=colorid
get color from eav_attribute_option_value where option_id=size
eav_attribute_option_value ==>option_id =141 = Spring
collection year from this table ==>catalog_product_entity_int*/


$get1="select * from catalog_product_entity order by 	entity_id asc";
$getRs1=mysql_query($get1);
$Totget1=mysql_affected_rows();
for($F1=0;$F1<$Totget1;$F1++)
{
	$getRow1=mysql_fetch_array($getRs1);
	$entity_id =trim($getRow1['entity_id']);
	$sku =trim($getRow1['sku']);
	$attribute_set_id=trim($getRow1['attribute_set_id']);
	$addeddate=trim($getRow1['created_at']);
	$updateddate=trim($getRow1['updated_at']);
	
	$name='';
	$get2_1="select * from catalog_product_entity_varchar where entity_id='".$entity_id."' and attribute_id='56'";
	$getRs2_1=mysql_query($get2_1);
	$getRow2_1=mysql_fetch_array($getRs2_1);
	$name=addslashes($getRow2_1['value']);
	
	$image_base='';
	$get2_2="select * from catalog_product_entity_varchar where entity_id='".$entity_id."' and attribute_id='70'";
	$getRs2_2=mysql_query($get2_2);
	$getRow2_2=mysql_fetch_array($getRs2_2);
	$image_base=addslashes($getRow2_2['value']);
	
	$image_small='';
	$get2_3="select * from catalog_product_entity_varchar where entity_id='".$entity_id."' and attribute_id='71'";
	$getRs2_3=mysql_query($get2_3);
	$getRow2_3=mysql_fetch_array($getRs2_3);
	$image_small=addslashes($getRow2_3['value']);
	
	$image_thumbnail='';
	$get2_4="select * from catalog_product_entity_varchar where entity_id='".$entity_id."' and attribute_id='72'";
	$getRs2_4=mysql_query($get2_4);
	$getRow2_4=mysql_fetch_array($getRs2_4);
	$image_thumbnail=addslashes($getRow2_4['value']);
	
	/////size
	$Fianlsize="";
	$get2_5="select * from catalog_product_entity_varchar where entity_id='".$entity_id."' and attribute_id='503'";
	$getRs2_5=mysql_query($get2_5);
	$getRow2_5=mysql_fetch_array($getRs2_5);
	if($getRow2_5['value']!="")
	{
		$arrysize=split(",",$getRow2_5['value']);
		for($ss=0;$ss<count($arrysize);$ss++)
		{
			$get2_5_1="select * from eav_attribute_option_value where option_id='".$arrysize[$ss]."' and store_id='0'";
			$getRs2_5_1=mysql_query($get2_5_1);
			$getRow2_5_1=mysql_fetch_array($getRs2_5_1);
			
			$get2_5_11="select * from products_sizes where name='".$getRow2_5_1['value']."'";
			$getRs2_5_11=mysql_query($get2_5_11);
			$getRow2_5_11=mysql_fetch_array($getRs2_5_11);
			$Fianlsize.=$getRow2_5_11['id'].",";
		}	
		$Fianlsize=substr($Fianlsize,0,-1);
	}
	
	/////color
	$Fianlcolor="";
	$get2_6="select * from catalog_product_entity_varchar where entity_id='".$entity_id."' and attribute_id='503'";
	$getRs2_6=mysql_query($get2_6);
	$getRow2_6=mysql_fetch_array($getRs2_6);
	if($getRow2_6['value']!="")
	{
		$arrycolor=split(",",$getRow2_6['value']);
		for($cc=0;$cc<count($arrycolor);$cc++)
		{
			$get2_6_1="select * from eav_attribute_option_value where option_id='".$arrycolor[$cc]."'";
			$getRs2_6_1=mysql_query($get2_6_1);
			$getRow2_6_1=mysql_fetch_array($getRs2_6_1);
			
			$get2_6_11="select * from products_sizes where name='".$getRow2_6_1['value']."'";
			$getRs2_6_11=mysql_query($get2_6_11);
			$getRow2_6_11=mysql_fetch_array($getRs2_6_11);
			$Fianlcolor.=$getRow2_6_11['id'].",";
		}	
		$Fianlcolor=substr($Fianlcolor,0,-1);
	}
	
	$description='';
	$get2_7="select * from catalog_product_entity_text where entity_id='".$entity_id."' and attribute_id='57'";
	$getRs2_7=mysql_query($get2_7);
	$getRow2_7=mysql_fetch_array($getRs2_7);
	$description=addslashes($getRow2_7['value']);
	
	$meta_keywords='';
	$get2_8="select * from catalog_product_entity_text where entity_id='".$entity_id."' and attribute_id='68'";
	$getRs2_8=mysql_query($get2_8);
	$getRow2_8=mysql_fetch_array($getRs2_8);
	$meta_keywords=addslashes($getRow2_8['value']);
	
	$collectionyear='';
	$get2_8="select * from catalog_product_entity_int where entity_id='".$entity_id."' and attribute_id='495'";
	$getRs2_8=mysql_query($get2_8);
	$getRow2_8=mysql_fetch_array($getRs2_8);
	$collectionyearval=addslashes($getRow2_8['value']);
	if($collectionyearval!="")
	{
		$get2_8_1="select * from eav_attribute_option_value where option_id='".$collectionyearval."'";
		$getRs2_8_1=mysql_query($get2_8_1);
		$getRow2_8_1=mysql_fetch_array($getRs2_8_1);
		$collectionyear=addslashes($getRow2_8_1['value']);
	}
	
	$discontinued='';
	$discontinuedval='';
	$get2_9="select * from catalog_product_entity_int where entity_id='".$entity_id."' and attribute_id='514'";
	$getRs2_9=mysql_query($get2_9);
	$getRow2_9=mysql_fetch_array($getRs2_9);
	$discontinuedval=addslashes($getRow2_9['value']);
	if($discontinuedval!="")
	{
		$get2_9_1="select * from eav_attribute_option_value where option_id='".$discontinuedval."'";
		$getRs2_9_1=mysql_query($get2_9_1);
		$getRow2_9_1=mysql_fetch_array($getRs2_9_1);
		$discontinued=addslashes($getRow2_9_1['value']);
		if($discontinued=="Yes")
		{
			$status="Discontinued";
		}
	}
	
	$status='';
	$statusval='';
	$get2_10="select * from catalog_product_entity_int where entity_id='".$entity_id."' and attribute_id='80'";
	$getRs2_10=mysql_query($get2_10);
	$getRow2_10=mysql_fetch_array($getRs2_10);
	$statusval=addslashes($getRow2_10['value']);
	if($statusval!="")
	{
		if($statusval==1)
		{
			$status="Able";
		}
		if($statusval==2)
		{
			$status="Disabled";
		}	
	}
	
	$season='';
	$seasonval='';
	$get2_11="select * from catalog_product_entity_int where entity_id='".$entity_id."' and attribute_id='506'";
	$getRs2_11=mysql_query($get2_11);
	$getRow2_11=mysql_fetch_array($getRs2_11);
	$seasonval=addslashes($getRow2_11['value']);
	if($seasonval!="")
	{
		$get2_11_1="select * from eav_attribute_option_value where option_id='".$seasonval."'";
		$getRs2_11_1=mysql_query($get2_11_1);
		$getRow2_11_1=mysql_fetch_array($getRs2_11_1);
		$season=addslashes($getRow2_11_1['value']);
	}
	
	
	if($attribute_set_id==29)
	{
		$websiteid="1";
	}
	if($attribute_set_id==30)
	{
		$websiteid="2";
	}
	
	$sql="INSERT INTO products SET 
			entity_id='".addslashes($entity_id)."',
			eav_attribute_set='".addslashes($attribute_set_id)."',
			sku='".addslashes($sku)."',
			name='".addslashes($name)."',
			sizes='".addslashes($Fianlsize)."',
			colors_avail='".addslashes($Fianlcolor)."',
			colors_shown='".addslashes($Fianlcolor)."',
			description='".addslashes($description)."',
			collectionyear='".addslashes($collectionyear)."',
			season='".addslashes($season)."',
			status='".addslashes($status)."',
			meta_title='".addslashes($meta_title)."',
			meta_keywords='".addslashes($meta_keywords)."',
			meta_description='".addslashes($meta_description)."',
			exclude='".addslashes($exclude)."',
			websiteid='".addslashes($websiteid)."',
			addeddate='".addslashes($addeddate)."',
			updateddate='".addslashes($updateddate)."'";	
	$q=mysql_query($sql);

}
echo "<br><br>DONE";
?>