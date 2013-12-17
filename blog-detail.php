<? include("connect.php"); 
$productsQry="select * from aw_blog  where 1=1 and post_id='".mysql_real_escape_string(trim($_REQUEST['id']))."' and status=1 ";
$productsQryRs=mysql_query($productsQry);
$Totproducts=mysql_affected_rows();
if($Totproducts<=0)
{
	header("locaiton:blog.php");
	exit;
}
else
{
	$article=mysql_fetch_array($productsQryRs);	
}
?>
<? include("header.php");?>
<?php
$page_level = 2;
$page_name = $article['title'];
?>
<body>
<div id="fb-root"></div>
    <script>    (function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) { return; }
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=179251552151990";
        fjs.parentNode.insertBefore(js, fjs);
    } (document, 'script', 'facebook-jssdk'));</script>
    <div id="all">
       <? include("top.php");?>
       <div id="section">
       <? include("left.php");?>
            <div id="content">
            <?php breadcrumbs(); ?>
            
<script>
function ShowReadMore(linkControl, contentControlName)
{
	var shoText = "READ MORE &gt;&gt;&gt;";
	var hidText = "&lt;&lt;&lt; COLLAPSE SECTION";
	
	if($('#'+linkControl).html() == hidText)
	{
		$('#'+contentControlName).hide();
		$('#'+linkControl).html(shoText)
	}
	else
	{	
		$('#'+contentControlName).show();
		$('#'+linkControl).html(hidText)
	}
}
</script>
                          <div class="contentPage">
                             <div class="spacer"></div>
                                <h3 class="pageHeader"><a href="blog-detail.php?id=<?=$article['post_id']?>"><?=stripslashes($article['title']);?></a></h3>
                                <span class="headerInfo"><?=date("F jS, Y",strtotime($article['created_time']));?></span>                                
                                <div><?=stripslashes($article['post_content']);?></div><div><?= stripslashes($article['post_contentmore']) ;?></div>                                     
                                    
                               <div class="actionButtons">
                                <div class="shareButton" style="float:left;">
                    <a class="sendPress" href="javascript:void(0);" title="share this"></a>
                        <div class="tooltipBig">
                            <div class="addthis_toolbox addthis_default_style addthis_32x32_style">
                            <a class="addthis_button_preferred_1"></a>
                            <a class="addthis_button_preferred_2"></a>
                            <a class="addthis_button_preferred_3"></a>
                            <a class="addthis_button_preferred_4"></a>
                            <a class="addthis_button_compact"></a>
                            <a class="addthis_counter addthis_bubble_style"></a>
                            </div>
                            <script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#username=xa-4b5d485814507317"></script>
                        </div>
                      </div>
                                <div class="fb-like" data-send="false" data-width="350" data-show-faces="false" style="margin:2px 0px 0px 5px;"></div>
                                
                                </div>
                            <div class="clr"></div>	
                            
                            </div>                   				
                      
			 </div>  
        </div>
        
    </div>
    <? include("footer.php");?>
<? include("googleanalytic.php");?>
</body>
</html>