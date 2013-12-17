<?php
$path = ereg_replace(" ","+",$_GET["nm"]);
$jpeg = fopen($path,"r");
while (!feof($jpeg)) {
  $data .= fread($jpeg, 8192);
}

$mwidth=$_GET["mwidth"];
$mheight=$_GET["mheight"];

define(MAX_WIDTH, $mwidth);
define(MAX_HEIGHT, $mheight);

$img = null;

$img = @imagecreatefromstring($data);

if ($img) {

    # Get image size and scale ratio
    $width = imagesx($img);
    $height = imagesy($img);
    $scale = min(MAX_WIDTH/$width, MAX_HEIGHT/$height);

    # If the image is larger than the max shrink it
    if ($scale < 1) {
        $new_width = floor($scale*$width);
        $new_height = floor($scale*$height);

        # Create a new temporary image
        		
		$tmp_img = imagecreatetruecolor($new_width, $new_height);

		$bgColor = imagecolorallocate($tmp_img, 255,255,255);
		imagefill($tmp_img , 0,0 , $bgColor);

        # Copy and resize old image into new image
        imagecopyresampled($tmp_img, $img, 0, 0, 0, 0,
                         $new_width, $new_height, $width, $height);
        imagedestroy($img);
        $img = $tmp_img;
    }
}

# Create error image if necessary
if (!$img) {
    $img = imagecreate(MAX_WIDTH, MAX_HEIGHT);
    imagecolorallocate($img,0,0,0);
    $c = imagecolorallocate($img,70,70,70);
    imageline($img,0,0,MAX_WIDTH,MAX_HEIGHT,$c2);
    imageline($img,MAX_WIDTH,0,0,MAX_HEIGHT,$c2);
}

# Display the image
header("Content-type: image/jpeg");
@imagejpeg($img);
@imagedestroy($img);
@imagedestroy($tmp_img); 
?>