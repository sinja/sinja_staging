<?
   include_once("admin.config.inc.php");
   include("admin.cookie.php");
   include("connect.php");
	
	if($_POST["Submit"])
    {		
		$pid=$_POST["pid"];
		$title=addslashes($_POST["title"]);
		$imagecaption = "";
		$filesToSave = $_POST["FilesTemp"];
	
	if(isset($_FILES["img"]['tmp_name']))
	{
		$img_name=$_FILES["img"]['tmp_name'];
		$img_name1=$_FILES['img']['name'];
		
		$imagename=ereg_replace("[^A-Za-z0-9.]","_",$_FILES['img']['name']);
		$imagename=rand()."_".$imagename;
		//$f1 = $randval.$imagename ;			
		$f1 = $imagename;			

		$path1 ="../Gallery/".$f1;
				
		if((!ereg(".jpg",$img_name1)) && (!ereg(".jpeg",$img_name1)) && (!ereg(".gif",$img_name1)) && (!ereg(".JPG",$img_name1)) && (!ereg(".JPEG",$img_name1)) && (!ereg(".GIF",$img_name1)) && (!ereg(".png",$img_name1)) && (!ereg(".PNG",$img_name1)))
		{
			$msg="Invalid Photo Please Check it again";
		}
		else
		{					
			$image=$img_name;
				
			if(!$msg)
			{
				copy($image,$path1);
				//$imgclass1=new imageresize($path1,$path1,500,500);
				//pjresize($path1,$path1,540,500,'Y');
				
				
				$selsql = " select * from galleryimages where pid=$pid " ;
				$selres = mysql_query($selsql);	
				$totalpics = mysql_num_rows($selres) + 1;
				
				$que="insert into galleryimages set `pid`=$pid,`pimage` ='$f1',`displayorder`='$totalpics',`title`='$title'";			
				$run=mysql_query($que);
				 //print $que;
				//header("location:imagesgallery.php?pid=$pid");
			}
		}
	}
	
	/* if(isset($_FILES["img"]['tmp_name']))
	{
		$img_name=$_FILES["img"]['tmp_name'];
		$img_name1=$_FILES['img']['name'];
		echo("$img_name <br> $img_name1");
		/*$imagename=$img_name1;
		$imagename=ereg_replace(" ","_",$imagename);
		$imagename=ereg_replace("'","_",stripslashes($imagename));
		$imagename=ereg_replace("#","_",stripslashes($imagename));
		$imagename=ereg_replace("%","_",stripslashes($imagename));
		$imagename=ereg_replace('"','_',stripslashes($imagename));
		$imagename=ereg_replace('&','_',stripslashes($imagename));
		$imagename=ereg_replace('\+','_',stripslashes($imagename));
		$imagename=ereg_replace('=','_',stripslashes($imagename));
		$imagename=ereg_replace('/','_',stripslashes($imagename));
		$imagename=ereg_replace('\|','_',stripslashes($imagename));
		$maxid=$mid;
		srand(make_seed());
		$randval = rand();*/
		
		$imagename=ereg_replace("[^A-Za-z0-9.]","_",$_FILES['img']['name']);
		$imagename=rand()."_".$imagename;
		//$f1 = $randval.$imagename ;			
		$f1 = $imagename;			

		$path1 ="../Gallery/".$f1;
				
		if((!ereg(".jpg",$img_name1)) && (!ereg(".jpeg",$img_name1)) && (!ereg(".gif",$img_name1)) && (!ereg(".JPG",$img_name1)) && (!ereg(".JPEG",$img_name1)) && (!ereg(".GIF",$img_name1)) && (!ereg(".png",$img_name1)) && (!ereg(".PNG",$img_name1)))
		{
			$msg="Invalid Photo Please Check it again";
		}
		else
		{					
			$image=$img_name;
				
			if(!$msg)
			{
				copy($image,$path1);
				//$imgclass1=new imageresize($path1,$path1,500,500);
				//pjresize($path1,$path1,540,500,'Y');
				
				
				$selsql = " select * from galleryimages where pid=$pid " ;
				$selres = mysql_query($selsql);	
				$totalpics = mysql_num_rows($selres) + 1;
				
				$que="insert into galleryimages set `pid`=$pid,`pimage` ='$f1',`displayorder`='$totalpics',`title`='$title'";			
				$run=mysql_query($que);
				 //print $que;
				//header("location:imagesgallery.php?pid=$pid");
			}
		}
	} */
}
?>