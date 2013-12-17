<?php
class imageresize
{
	var $width;
	var $height;

	function imageresize($name,$filename,$new_w,$new_h){
		$system=explode(".",$name);
		$count = count($system);
		if($count>0){
			$ext = strtolower($system[$count-1]);
		}else{
			$ext = "";
		}
		$src_img = "";			
		
		if (preg_match("/jpg|jpeg/",$system[1])){
			$src_img=imagecreatefromjpeg($name);				
		}else if (preg_match("/png/",$system[1])){
			$src_img=imagecreatefrompng($name);				
		}else if (preg_match("/gif/",$system[1])){
			$src_img=imagecreatefromgif($name);				
		}else if (preg_match("/bmp/",$system[1])){
			$src_img=imagecreatefromwbmp($name);				
		}else if($ext=="jpg" || $ext=="jpeg" || $ext=="JPEG" || $ext=="JPG"){
			$src_img=imagecreatefromjpeg($name);
		}else if($ext=="gif" || $ext=="GIF"){
			$src_img=imagecreatefromgif($name);
		}else if($ext=="png" || $ext=="PNG"){
			$src_img=imagecreatefrompng($name);
		}else if($ext=="bmp" || $ext=="BMP"){
			$src_img=imagecreatefromwbmp($name);
		}else{
			$src_img=imagecreatefromjpeg($name);
		}			
				
		$old_x=imageSX($src_img);
		$old_y=imageSY($src_img);
		
		$this->getnewsize($new_w,$new_h,$name);

		$dst_img=imagecreatetruecolor($this->width,$this->height);
		imagecopyresampled($dst_img,$src_img,0,0,0,0,$this->width,$this->height,$old_x,$old_y);
		
		if (preg_match("/png/",$system[1]))
		{
			imagepng($dst_img,$filename); 
		}else {
			imagejpeg($dst_img,$filename,100); 
		}
		imagedestroy($dst_img); 
		imagedestroy($src_img); 
	}
	
	function getnewsize($w,$h,$path)
	{
			$size1=getimagesize($path);
	
			$oldwidth=$size1[0];
			$oldheight=$size1[1];
	
			if($oldwidth>$w && $oldheight>$h)
			{
				$tempwidth=$oldwidth-$w;					
				$tempheight=$oldheight-$h;
				
				if($tempwidth>$tempheight)
				{
					$this->width=$w;
					$this->height=($oldheight*$this->width)/$oldwidth;
				}
				elseif($tempwidth<$tempheight)
				{
					$this->height=$h;
					$this->width=($oldwidth*$this->height)/$oldheight;
				}
				else
				{
					$this->width=$w;
					$this->height=$h;
				}
			}
			elseif($oldwidth>$w)
			{
				$this->width=$w;
				$this->height=($oldheight*$this->width)/$oldwidth;
			}
			elseif($oldheight>$h)
			{
				$this->height=$h;
				$this->width=($oldwidth*$this->height)/$oldheight;
			}
			else
			{
				$this->width=$oldwidth;
				$this->height=$oldheight;
			}
	}
}
?>