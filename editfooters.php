<?php
include_once("admin.config.inc.php");
include("admin.cookie.php");
include("connect.php");
include("fckeditor/fckeditor.php");
$mlevel = 10;
$id = (isset($_GET['id'])) ? $_GET['id'] : 1;

$msg = "";
if ($_POST["submit"]) {
    $box1_text = addslashes($_POST['box1_text']);
    $box1_img = addslashes($_POST['box1_img_act']);
    $box1_logo = addslashes($_POST['box1_logo_act']);
    $box2_text = addslashes($_POST['box2_text']);
    $box2_img = addslashes($_POST['box2_img_act']);
	$box2_logo = addslashes($_POST['box2_logo_act']);
    $box3_text = addslashes($_POST['box3_text']);
    $box3_img = addslashes($_POST['box3_img_act']);
	$box3_logo = addslashes($_POST['box3_logo_act']);
    $box4_text = addslashes($_POST['box4_text']);
    $box4_img = addslashes($_POST['box4_img_act']);
	$box4_logo = addslashes($_POST['box4_logo_act']);
    $text = addslashes($_POST['text']);
    $copyright = addslashes($_POST['copyright']);

    $imgs = array(
        'Box 1' => 'box1_img',
        'Box 2' => 'box2_img',
        'Box 3' => 'box3_img',
        'Box 4' => 'box4_img',
    );

    $err = '';

    foreach ($imgs as $site => $img) {
        if ($_FILES[$img]['tmp_name'] != "") {
            $send_name3 = ereg_replace("[^A-Za-z0-9.]", "_", $_FILES[$img]['name']);
            $filename3 = rand() . $send_name3;
            $filetoupload3 = $_FILES[$img]['tmp_name'];
            $path3 = "../Gallery/footer/" . $filename3;

            $size = getimagesize($filetoupload3);
            $width = $size[0];
            $height = $size[1];

            if ($width == 52 AND $height == 73) {
                copy($filetoupload3, $path3);
                $$img = $filename3;
            } else {
                $err .= 'Image size error in ' . $site . '. <br/>';
            }
        }
    }
	
	$imgs = array(
        'Box 1' => 'box1_logo',
        'Box 2' => 'box2_logo',
        'Box 3' => 'box3_logo',
        'Box 4' => 'box4_logo',
    );

    foreach ($imgs as $site => $img) {
        if ($_FILES[$img]['tmp_name'] != "") {
            $send_name3 = ereg_replace("[^A-Za-z0-9.]", "_", $_FILES[$img]['name']);
            $filename3 = rand() . $send_name3;
            $filetoupload3 = $_FILES[$img]['tmp_name'];
            $path3 = "../Gallery/footer/" . $filename3;

            $size = getimagesize($filetoupload3);
            $width = $size[0];
            $height = $size[1];

            if ($width <= 150 AND $height <= 40) {
                copy($filetoupload3, $path3);
                $$img = $filename3;
            } else {
                $err .= 'Logo size error in ' . $site . '. <br/>';
            }
        }
    }

    $sql = "UPDATE  footers SET  
            `box1_text` =  '$box1_text',
            `box1_img` =  '$box1_img',
            `box1_logo` =  '$box1_logo',
            `box2_text` =  '$box2_text',
            `box2_img` =  '$box2_img',
			`box2_logo` =  '$box2_logo',
            `box3_text` =  '$box3_text',
            `box3_img` =  '$box3_img',
			`box3_logo` =  '$box3_logo',
            `box4_text` =  '$box4_text',
            `box4_img` =  '$box4_img',
			`box4_logo` =  '$box4_logo',
            `text` =  '$text', 
            `copyright` =  '$copyright' 
            WHERE  id = $id";

    mysql_query($sql) or die(mysql_error());
    $msg = "<font color='green'>Has been updated successfully.</font> <br/>";
    if ($err != '') {
        $msg .= "<font color='red'><strong>Except:</strong> <br/> $err </font>";
    }
}
$qry = "select * from footers where id=$id";
$rs = mysql_query($qry);
$arr = mysql_fetch_array($rs);
$pgnm = $arr["name"];
$arr["box1_text"] 	= stripslashes($arr["box1_text"]);
$arr["box2_text"] 	= stripslashes($arr["box2_text"]);
$arr["box3_text"] 	= stripslashes($arr["box3_text"]);
$arr["box4_text"] 	= stripslashes($arr["box4_text"]);
$arr["text"] 		= stripslashes($arr["text"]);
$arr["copyright"] 	= stripslashes($arr["copyright"]);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD html 4.0 Transitional//EN">
<html>
    <head>
        <title><?php echo $ADMIN_MAIN_SITE_NAME ?></title>
        <link href="main.css" type="text/css" rel="stylesheet" />
    </head>
    <body leftMargin=0 topMargin=0 marginheight="0" marginwidth="0">
        <script language="javascript" src="body.js"></script>
        <table align="left" width="100%" cellpadding="0" cellspacing="0">
            <tr>
                <td>
                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td height="75"><? include ("top.php"); ?></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <table cellSpacing=0 cellPadding=0 width="100%" border=0>
                        <tbody >
                            <tr>
                                <td width="20%"  valign="top" class="rightbdr" ><? include("inner_left_admin.php"); ?>
                                </td>
                                <td width="80%" valign="top" align="center"><table width="100%"  border=0 cellpadding="2" cellspacing="2">
                                        <tr>
                                            <td height="35" class=form111>Edit
                                                <?= $pgnm; ?>
                                                footer</td>
                                        </tr>
                                        <tr>
                                            <td height="222" class="formbg" valign="top"><form name="addstonecolor"  method=post enctype="multipart/form-data">
                                                    <table cellSpacing=2 cellPadding=2 width=98% border=0 class="t-b">
                                                        <? if ($msg) { ?>
                                                            <tr>
                                                                <td width="13%" height="25" align=right vAlign=top class=dataLabel>&nbsp;</td>
                                                                <td height="25" colSpan=3 vAlign=top><? echo $msg; ?></td>
                                                            </tr>
                                                        <? } ?>
                                                        <tr>
                                                            <td width="13%" height="25" align=right vAlign=top class=dataLabel>&nbsp;</td>
                                                            <td height="25" colSpan=3 vAlign=top><h3>BOX 1</h3></td>
                                                        </tr>
                                                        <tr>
                                                            <td width="13%" height="25" align=right vAlign=top class=dataLabel>Text: </td>
                                                            <td height="25" colSpan=3 vAlign=top><?php
                                                        $oFCKeditor = new FCKeditor('box1_text');
                                                        $oFCKeditor->BasePath = 'fckeditor/';
                                                        $oFCKeditor->Value = $arr["box1_text"];
                                                        $oFCKeditor->Height = 300;
                                                        $oFCKeditor->Width = 650;
                                                        $oFCKeditor->Create();
                                                        ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td width="13%" height="25" align=right vAlign=top class=dataLabel>Image: </td>
                                                            <td height="25" colSpan=3 vAlign=top><input type="file" name="box1_img" id="box1_img"><input type="hidden" name="box1_img_act" value="<?= $arr["box1_img"] ?>" /><? if($arr["box1_img"]!=""){?><a href="<?=$SITE_URL;?>/Gallery/footer/<?=stripslashes($arr["box1_img"]);?>" target="_blank">View Current Image</a><? } ?> <br/> (size: 52x73)</td>
                                                        </tr>
														<tr>
                                                            <td width="13%" height="25" align=right vAlign=top class=dataLabel>Logo: </td>
                                                            <td height="25" colSpan=3 vAlign=top><input type="file" name="box1_logo" id="box1_logo"><input type="hidden" name="box1_logo_act" value="<?= $arr["box1_logo"] ?>" /><? if($arr["box1_logo"]!=""){?><a href="<?=$SITE_URL;?>/Gallery/footer/<?=stripslashes($arr["box1_logo"]);?>" target="_blank">View Current Logo</a><? } ?> <br/> (width <= 150px and height <= 40px)</td>
                                                        </tr>
                                                        <tr>
                                                            <td width="13%" height="25" align=right vAlign=top class=dataLabel>&nbsp;</td>
                                                            <td height="25" colSpan=3 vAlign=top><h3>BOX 2</h3></td>
                                                        </tr>
                                                        <tr>
                                                            <td width="13%" height="25" align=right vAlign=top class=dataLabel>Text: </td>
                                                            <td height="25" colSpan=3 vAlign=top><?php
                                                                $oFCKeditor = new FCKeditor('box2_text');
                                                                $oFCKeditor->BasePath = 'fckeditor/';
                                                                $oFCKeditor->Value = $arr["box2_text"];
                                                                $oFCKeditor->Height = 300;
                                                                $oFCKeditor->Width = 650;
                                                                $oFCKeditor->Create();
                                                        ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td width="13%" height="25" align=right vAlign=top class=dataLabel>Image: </td>
                                                            <td height="25" colSpan=3 vAlign=top><input type="file" name="box2_img" id="box2_img"><input type="hidden" name="box2_img_act" value="<?= $arr["box2_img"] ?>" /><? if($arr["box2_img"]!=""){?><a href="<?=$SITE_URL;?>/Gallery/footer/<?=stripslashes($arr["box2_img"]);?>" target="_blank">View Current Image</a><? } ?> <br/>  (size: 52x73)</td>
                                                        </tr>
														<tr>
                                                            <td width="13%" height="25" align=right vAlign=top class=dataLabel>Logo: </td>
                                                            <td height="25" colSpan=3 vAlign=top><input type="file" name="box2_logo" id="box2_logo"><input type="hidden" name="box2_logo_act" value="<?= $arr["box2_logo"] ?>" /><? if($arr["box2_logo"]!=""){?><a href="<?=$SITE_URL;?>/Gallery/footer/<?=stripslashes($arr["box2_logo"]);?>" target="_blank">View Current Logo</a><? } ?> <br/> (width <= 150px and height <= 40px)</td>
                                                        </tr>
                                                        <tr>
                                                            <td width="13%" height="25" align=right vAlign=top class=dataLabel>&nbsp;</td>
                                                            <td height="25" colSpan=3 vAlign=top><h3>BOX 3</h3></td>
                                                        </tr>
                                                        <tr>
                                                            <td width="13%" height="25" align=right vAlign=top class=dataLabel>Text: </td>
                                                            <td height="25" colSpan=3 vAlign=top><?php
                                                                $oFCKeditor = new FCKeditor('box3_text');
                                                                $oFCKeditor->BasePath = 'fckeditor/';
                                                                $oFCKeditor->Value = $arr["box3_text"];
                                                                $oFCKeditor->Height = 300;
                                                                $oFCKeditor->Width = 650;
                                                                $oFCKeditor->Create();
                                                        ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td width="13%" height="25" align=right vAlign=top class=dataLabel>Image: </td>
                                                            <td height="25" colSpan=3 vAlign=top><input type="file" name="box3_img" id="box3_img"><input type="hidden" name="box3_img_act" value="<?= $arr["box3_img"] ?>" /><? if($arr["box3_img"]!=""){?><a href="<?=$SITE_URL;?>/Gallery/footer/<?=stripslashes($arr["box3_img"]);?>" target="_blank">View Current Image</a><? } ?> <br/>  (size: 52x73)</td>
                                                        </tr>
														<tr>
                                                            <td width="13%" height="25" align=right vAlign=top class=dataLabel>Logo: </td>
                                                            <td height="25" colSpan=3 vAlign=top><input type="file" name="box3_logo" id="box3_logo"><input type="hidden" name="box3_logo_act" value="<?= $arr["box3_logo"] ?>" /><? if($arr["box3_logo"]!=""){?><a href="<?=$SITE_URL;?>/Gallery/footer/<?=stripslashes($arr["box3_logo"]);?>" target="_blank">View Current Logo</a><? } ?> <br/> (width <= 150px and height <= 40px)</td>
                                                        </tr>
                                                        <tr>
                                                            <td width="13%" height="25" align=right vAlign=top class=dataLabel>&nbsp;</td>
                                                            <td height="25" colSpan=3 vAlign=top><h3>BOX 4</h3></td>
                                                        </tr>
                                                        <tr>
                                                            <td width="13%" height="25" align=right vAlign=top class=dataLabel>Text: </td>
                                                            <td height="25" colSpan=3 vAlign=top><?php
                                                                $oFCKeditor = new FCKeditor('box4_text');
                                                                $oFCKeditor->BasePath = 'fckeditor/';
                                                                $oFCKeditor->Value = $arr["box4_text"];
                                                                $oFCKeditor->Height = 300;
                                                                $oFCKeditor->Width = 650;
                                                                $oFCKeditor->Create();
                                                        ?></td>
                                                        <tr>
                                                            <td width="13%" height="25" align=right vAlign=top class=dataLabel>Image: </td>
                                                            <td height="25" colSpan=3 vAlign=top><input type="file" name="box4_img" id="box4_img"><input type="hidden" name="box4_img_act" value="<?= $arr["box4_img"] ?>" /><? if($arr["box4_img"]!=""){?><a href="<?=$SITE_URL;?>/Gallery/footer/<?=stripslashes($arr["box4_img"]);?>" target="_blank">View Current Image</a><? } ?> <br/>  (size: 52x73)</td>
                                                        </tr>
														<tr>
                                                            <td width="13%" height="25" align=right vAlign=top class=dataLabel>Logo: </td>
                                                            <td height="25" colSpan=3 vAlign=top><input type="file" name="box4_logo" id="box4_logo"><input type="hidden" name="box4_logo_act" value="<?= $arr["box4_logo"] ?>" /><? if($arr["box4_logo"]!=""){?><a href="<?=$SITE_URL;?>/Gallery/footer/<?=stripslashes($arr["box4_logo"]);?>" target="_blank">View Current Logo</a><? } ?> <br/> (width <= 150px and height <= 40px)</td>
                                                        </tr>
                                                        </tr>
                                                        <tr>
                                                            <td width="13%" height="25" align=right vAlign=top class=dataLabel>&nbsp;</td>
                                                            <td height="25" colSpan=3 vAlign=top>&nbsp;</td>
                                                        </tr>
                                                        <tr>
                                                            <td width="13%" height="25" align=right vAlign=top class=dataLabel>Footer Text: </td>
                                                            <td height="25" colSpan=3 vAlign=top><?php
                                                                $oFCKeditor = new FCKeditor('text');
                                                                $oFCKeditor->BasePath = 'fckeditor/';
                                                                $oFCKeditor->Value = $arr["text"];
                                                                $oFCKeditor->Height = 300;
                                                                $oFCKeditor->Width = 650;
                                                                $oFCKeditor->Create();
                                                        ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td width="13%" height="25" align=right vAlign=top class=dataLabel>Copyright: </td>
                                                            <td height="25" colSpan=3 vAlign=top><?php
                                                                $oFCKeditor = new FCKeditor('copyright');
                                                                $oFCKeditor->BasePath = 'fckeditor/';
                                                                $oFCKeditor->Value = $arr["copyright"];
                                                                $oFCKeditor->Height = 300;
                                                                $oFCKeditor->Width = 650;
                                                                $oFCKeditor->Create();
                                                        ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td width="13%" height="25" align=right vAlign=top class=dataLabel>&nbsp;</td>
                                                            <td colSpan=3 align="left"><input name="submit" type="submit" value=" Edit Page " class="bttn-s"></td>
                                                        </tr>
                                                        <tr>
                                                            <td colSpan=4>&nbsp;</td>
                                                        </tr>
                                                    </table>
                                                </form>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </table>
    </body>
</html>