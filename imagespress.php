<?php
  include_once("admin.config.inc.php");
  include("admin.cookie.php");
  include("connect.php") ;
  $mlevel=4;
  $Error=0;
    
  if($_POST["chseq"]!="")
  {
	$pid = $_POST["chseq"];
	$orgseq = $_POST["orgseq"];
	$newseq	= $_POST[$pid];
		
	$upqry1 = "update press_images set displayorder='$newseq' where id='$pid'";
	$upqry2 = "update press_images set displayorder='$orgseq' where displayorder='$newseq' and pid='".$_POST["PressId"]."'";
	
	$upres2 = mysql_query($upqry2);
	$upres1 = mysql_query($upqry1);	
	$msg = "Display Sequence Updated Successfully";			
  }
  
  
  if($_POST["imageset"])
  {
	  $pid=$_GET["pid"];	 
	  $selsql33 = " select * from press_images where pid=$pid order by displayorder" ;
	  $selres33 = mysql_query($selsql33);
	  while($obj33=mysql_fetch_object($selres33))
	  {
	  	    $title = "title_".$obj33->id;
			$titlefinal=addslashes($_REQUEST[$title]);
	   		$qryy = " update press_images set title='".$titlefinal."' where id=".$obj33->id;
 			mysql_query($qryy);
	  }	  
	  $msg = "Titles have been updated successfully";			
  }
  
  $pid=$_GET["pid"];
  $title=$_GET["title"];	
  $selsql = " select * from press_images where pid=$pid order by displayorder asc" ;
  $selres = mysql_query($selsql);
  $totpics = mysql_affected_rows();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD html 4.0 Transitional//EN">
<html>
<head>
<!-- Framework CSS -->

	<!--[if IE]><link rel="stylesheet" href="http://github.com/joshuaclayton/blueprint-css/raw/master/blueprint/ie.css" type="text/css" media="screen, projection"><![endif]-->
<!--[if lte IE 7]>
	<script type="text/javascript" src="http://getfirebug.com/releases/lite/1.2/firebug-lite-compressed.js"></script>
<![endif]-->


	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/mootools/1.2.2/mootools.js"></script>

	<script type="text/javascript" src="IMGUploads/source/Swiff.Uploader.js"></script>

	<script type="text/javascript" src="IMGUploads/source/Fx.ProgressBar.js"></script>

	<script type="text/javascript" src="http://github.com/mootools/mootools-more/raw/master/Source/Core/Lang.js"></script>

	<script type="text/javascript" src="IMGUploads/source/FancyUpload2.js"></script>


	<!-- See script.js -->
	<script type="text/javascript">
		//<![CDATA[

		/**
 * FancyUpload Showcase
 *
 * @license		MIT License
 * @author		Harald Kirschner <mail [at] digitarald [dot] de>
 * @copyright	Authors
 */

window.addEvent('domready', function() { // wait for the content

	// our uploader instance 
	
	var up = new FancyUpload2($('demo-status'), $('demo-list'), { // options object
		// we console.log infos, remove that in production!!
		verbose: true,
		
		// url is read from the form, so you just have to change one place
		url: $('form-demo').action,
		
		// path to the SWF file
		path: 'IMGUploads/source/Swiff.Uploader.swf',
		
		// remove that line to select all files, or edit it, add more items
		typeFilter: {
			'Images (*.jpg, *.jpeg, *.gif, *.png)': '*.jpg; *.jpeg; *.gif; *.png'
		},
		
		// this is our browse button, *target* is overlayed with the Flash movie
		target: 'demo-browse',
		
		// graceful degradation, onLoad is only called if all went well with Flash
		onLoad: function() {
			$('demo-status').removeClass('hide'); // we show the actual UI
			$('demo-fallback').destroy(); // ... and hide the plain form
			
			// We relay the interactions with the overlayed flash to the link
			this.target.addEvents({
				click: function() {
					return false;
				},
				mouseenter: function() {
					this.addClass('hover');
				},
				mouseleave: function() {
					this.removeClass('hover');
					this.blur();
				},
				mousedown: function() {
					this.focus();
				}
			});

			// Interactions for the 2 other buttons
			
			$('demo-clear').addEvent('click', function() {
				up.remove(); // remove all files
				return false;
			});

			$('demo-upload').addEvent('click', function() {
				up.start(); // start upload
				return false;
			});
		},
		
		// Edit the following lines, it is your custom event handling
		
		/**
		 * Is called when files were not added, "files" is an array of invalid File classes.
		 * 
		 * This example creates a list of error elements directly in the file list, which
		 * hide on click.
		 */ 
		onSelectFail: function(files) {
			files.each(function(file) {
				new Element('li', {
					'class': 'validation-error',
					html: file.validationErrorMessage || file.validationError,
					title: MooTools.lang.get('FancyUpload', 'removeTitle'),
					events: {
						click: function() {
							this.destroy();
						}
					}
				}).inject(this.list, 'top');
			}, this);
		},
		
		/**
		 * This one was directly in FancyUpload2 before, the event makes it
		 * easier for you, to add your own response handling (you probably want
		 * to send something else than JSON or different items).
		 */
		onFileSuccess: function(file, response) {
			var json = new Hash(JSON.decode(response, true) || {});
			
			if (json.get('status') == '1') {
				
				//content div
				
				file.element.addClass('file-success');
//				file.info.set('html', '<strong>Image was uploaded:</strong> ' + json.get('width') + ' x ' + json.get('height') + 'px, <em>' + json.get('mime') + '</em>)');
					file.info.set('html', '<strong>Image was uploaded:</strong> ');// + json.get('width') + ' x ' + json.get('height') + 'px, <em>' + json.get('mime') + '</em>)');
			} else {
				file.element.addClass('file-failed');
				file.info.set('html', '<strong>An error occured:</strong> ' + (json.get('error') ? (json.get('error') + ' #' + json.get('code')) : response));
			}
		},
		
		/**
		 * onFail is called when the Flash movie got bashed by some browser plugin
		 * like Adblock or Flashblock.
		 */
		onFail: function(error) {
			switch (error) {
				case 'hidden': // works after enabling the movie and clicking refresh
					alert('To enable the embedded uploader, unblock it in your browser and refresh (see Adblock).');
					break;
				case 'blocked': // This no *full* fail, it works after the user clicks the button
					alert('To enable the embedded uploader, enable the blocked Flash movie (see Flashblock).');
					break;
				case 'empty': // Oh oh, wrong path
					alert('A required file was not found, please be patient and we fix this.');
					break;
				case 'flash': // no flash 9+ :(
					alert('To enable the embedded uploader, install the latest Adobe Flash plugin.')
			}
		}
		
	});
	
});
		//]]>
	</script>



	<!-- See style.css -->
	<style type="text/css">
		/**
 * FancyUpload Showcase
 *
 * @license		MIT License
 * @author		Harald Kirschner <mail [at] digitarald [dot] de>
 * @copyright	Authors
 */

/* CSS vs. Adblock tabs */
.swiff-uploader-box a {
	display: none !important;
}

/* .hover simulates the flash interactions */
a:hover, a.hover {
	color: red;
}

#demo-status {
	padding: 10px 15px;
	width: 420px;
	border: 1px solid #eee;
}

#demo-status .progress {
	background: url(assets/progress-bar/progress.gif) no-repeat;
	background-position: +50% 0;
	margin-right: 0.5em;
	vertical-align: middle;
}

#demo-status .progress-text {
	font-size: 0.9em;
	font-weight: bold;
}

#demo-list {
	list-style: none;
	width: 450px;
	margin: 0;
}

#demo-list li.validation-error {
	padding-left: 44px;
	display: block;
	clear: left;
	line-height: 40px;
	color: #8a1f11;
	cursor: pointer;
	border-bottom: 1px solid #fbc2c4;
	background: #fbe3e4 url(assets/failed.png) no-repeat 4px 4px;
}

#demo-list li.file {
	border-bottom: 1px solid #eee;
	background: url(assets/file.png) no-repeat 4px 4px;
	overflow: auto;
}
#demo-list li.file.file-uploading {
	background-image: url(assets/uploading.png);
	background-color: #D9DDE9;
}
#demo-list li.file.file-success {
	background-image: url(assets/success.png);
}
#demo-list li.file.file-failed {
	background-image: url(assets/failed.png);
}

#demo-list li.file .file-name {
	font-size: 1.2em;
	margin-left: 44px;
	display: block;
	clear: left;
	line-height: 40px;
	height: 40px;
	font-weight: bold;
}
#demo-list li.file .file-size {
	font-size: 0.9em;
	line-height: 18px;
	float: right;
	margin-top: 2px;
	margin-right: 6px;
}
#demo-list li.file .file-info {
	display: block;
	margin-left: 44px;
	font-size: 0.9em;
	line-height: 20px;
	clear
}
#demo-list li.file .file-remove {
	clear: right;
	float: right;
	line-height: 18px;
	margin-right: 6px;
}	</style>
<title><?php echo $ADMIN_MAIN_SITE_NAME ?></title>
<link href="main.css" type=text/css rel=stylesheet>
<META content="MSHTML 6.00.2600.0" name=GENERATOR>
</head>
<body leftMargin=0 topMargin=0 marginheight="0" marginwidth="0">
<script language=javascript src="body.js"></script>
<script language="javascript">
function testings()
{	
  dom=document.frm;	
	if(dom.img.value == "")
	{
		alert("Please enter image.");
		dom.img.focus();
		return false; 
	}	
	else 
	{
		return true;
	}
}
function chseqfun(cid,oid)
{
	var cidobj = document.getElementById(cid);
	if(cidobj.value=="0")
	{
		alert("Select a sequence number to change sequence.");
		cidobj.focus();
		return false;
	}
	else
	{
		document.form2.chseq.value = cid;
		//alert(document.form2.chseq.value);
		document.form2.orgseq.value = oid;
		document.form2.submit();
	}
}
</script>
<table align="left" width="100%" cellpadding="0" cellspacing="0">
  <tr>
    <td><table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td height="75"><? include ("top.php"); ?></td>
        </tr>
      </table></td>
  </tr>
  <tr>
  <td>
  <table cellSpacing=0 cellPadding=0 width="100%" border=0>
    <tbody>
      <tr>
      
      <td width="20%"  valign="top" class="rightbdr" ><? include("inner_left_admin.php"); ?>
      </td>
      <td width="80%" valign="top" align="center">
      
      <table width="100%"  border=0 cellpadding="2" cellspacing="2">
        <tr>
          <TD height="35" class="form111">Manage Article Images </TD>
        </tr>
        <tr>
          <td class="formbg" valign="top">
	<div class="container">

	<!-- See index.html -->
		<div>
			<form action="IMGUploads/server/press_imagesscript.php?pid=<?= $_GET["pid"] ?>" method="post" enctype="multipart/form-data" id="form-demo">
<table width="98%" border="0" align="center" cellpadding="3" cellspacing="3" >
                <tr>
                  <td colspan="2" align="center"><strong>Add images to article [
                     <?=getname("press",$pid,"title");?>
                    ]</strong></td>
                </tr>
                <? if($msg){?>
                <tr>
                  <td colspan="2" align="center" class="a-l"><font ><? echo $msg; ?></font></td>
                </tr>
                <? } ?>
                <tr>
                </table>
	<fieldset id="demo-fallback">
		<legend>File Upload</legend>
		<label for="demo-photoupload">
			Upload a Photo:
			<input type="file" name="Filedata" />
		</label>
	</fieldset>

	<div id="demo-status" class="hide">
		<p>
			<a href="#" id="demo-browse">Browse Files</a> |
			<a href="#" id="demo-clear">Clear List</a> |
			<a href="#" id="demo-upload">Start Upload</a>
		</p>
		<div>
			<strong class="overall-title"></strong><br />
			<img src="IMGUploads/assets/progress-bar/bar.gif" class="progress overall-progress" />
		</div>
		<div>
			<strong class="current-title"></strong><br />
			<img src="IMGUploads/assets/progress-bar/bar.gif" class="progress current-progress" />
		</div>
		<div class="current-text"></div>
	</div>

	<ul id="demo-list"></ul>

</form>		</div>


	</div>
          <div style="padding:10px;">
                    <input name="Finish" type="button"  value="Return to list" onClick="javascript:document.location.href='manage_press.php'" class="bttn-s"/> <input name="Finish" type="button"  value="Click here when you are done uploading." onClick="javascript:document.location.href=document.location.href" class="bttn-s"/>  </div>
          </td>
        </tr>
        <tr>
          <td class="formbg">
          <!--start-->
          <form name="form2" method="post" id="form2">
            <table width="100%" align="center" border="0" cellspacing="4" cellpadding="4">
              <tr>
                <td colspan="3" align="center" height="35" ><strong>Current Images in [
                  <?=getname("press",$pid,"title");?>
                  ]</strong></td>
              </tr>
              <?
				$c=1;
				if($totpics==0)
				{
					echo "<pre><td>
					<table width='100%' border='1' cellpadding='2' cellspacing='2' bordercolor='#FFD447'>
					  <tr>
						<td align='center' class='yellowbold'>No Pictures Added</td>
					  </tr>
					</table></td></pre>";
				}
				while($obj=mysql_fetch_object($selres))
				{
				?>
              <td width="250" valign="top" >
                <table border='1' cellpadding='0' cellspacing='0' class="proimagetable" style="border-color:#999999;">
                  <tr>
                    <td align='center' height="105" width="250"><img src="onlinethumb.php?nm=<? echo "../Press/".$obj->pimage ;?>&mwidth=101&mheight=102" /></td>
                  </tr>
				   <tr>
					<td align='center' height="30px">
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
					  <tr>
						<td align="left" width="50">Order : </td>
						<td align="left"><select name="<? echo $obj->id; ?>" id="<? echo $obj->id; ?>" onChange="chseqfun(<? echo $obj->id; ?>,<? echo $obj->displayorder; ?>);"><option value="0">Select</option><? for($fc=1;$fc<=$totpics;$fc++){ ?><option value="<? echo $fc; ?>" <? if($fc==$obj->displayorder){echo "selected";} ?>><? echo $fc; ?></option><?	} ?></select></td>
						<td align="right"><a class='a-s' href='#' onClick="javascript:document.location.href='press_imagesdelete.php?<? echo "imgid=".$obj->id."&img=".$obj->pimage."&pid=$pid"; ?>';">Delete</a>&nbsp;</td>
					  </tr>
					</table>
					</td>
                  </tr>
				  <?php /*?><tr>
					<td align='center' height="30px">Set Feature Image : 
						<input type="radio" name="imgset" class="inputCheck" <? if($obj->featured=='Y') { ?> checked="checked" <? } ?> value="<? echo $obj->id; ?>">
					  </td>
                  </tr><?php */?>
                </table>
              </td>
              <?
					if($c%4==0) echo "</tr>";
					$c++;
				}
			  ?>
              <input type="hidden" name="chseq">
              <input type="hidden" name="orgseq">
              <input type="hidden" name="PressId" value="<?=$_GET["pid"];?>" >
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