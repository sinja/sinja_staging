<?
include("connect.php");
$getallstoreforQry = "SELECT store_id FROM core_store WHERE website_id='" . SITE_ID . "'";
$getallstoreforQryRs = mysql_query($getallstoreforQry);
$Totgetallstorefor = mysql_affected_rows();
if ($Totgetallstorefor > 0) {
    for ($ST = 0; $ST < $Totgetallstorefor; $ST++) {
        $getallstoreforQryRow = mysql_fetch_array($getallstoreforQryRs);
        $Fianlstore_id.=$getallstoreforQryRow['store_id'] . ",";
    }
    $Fianlstore_id = substr($Fianlstore_id, 0, -1);
}
if (!empty($Fianlstore_id)) {
    $getallstorePostforQry = "SELECT distinct post_id FROM aw_blog_store WHERE store_id in ($Fianlstore_id)";
    $getallstorePostforQryRs = mysql_query($getallstorePostforQry);
    $TotggetallstorePostfor = mysql_affected_rows();
    if ($TotggetallstorePostfor > 0) {
        for ($ST2 = 0; $ST2 < $TotggetallstorePostfor; $ST2++) {
            $getallstorePostforQryRow = mysql_fetch_array($getallstorePostforQryRs);
            $Fianlpost_id.=$getallstorePostforQryRow['post_id'] . ",";
        }
        $Fianlpost_id = substr($Fianlpost_id, 0, -1);
    }
}
if ($Fianlpost_id != "") {
    $AndQry = " and post_id in ($Fianlpost_id)";
} else {
    $AndQry.="  and concat(',',concat(websiteid,','))  like '%," . SITE_ID . ",%'";
}
$page_title = ' | ' . ucwords(strtolower(strt("Blog")));
?>
<? include("header.php"); ?>
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
<? include("top.php"); ?>
        <div id="section">
<? include("left.php"); ?>
            <div id="content">
        <?php breadcrumbs(); ?>
                <div class="pageTitle">
                    <h2>
                <?php e_upstrt("blog"); ?>
                    </h2>
                </div>
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
<?
$productsQry = "select * from aw_blog  where 1=1 $AndQry and status=1 order by created_time desc";
$productsQryRs = mysql_query($productsQry);
$Totproducts = mysql_affected_rows();
if ($Totproducts > 0) {
    $result = $prs_pageing->sin_press_new_paging($productsQry, 4, 10, "Y", "Y");
    $ffff = 0;
    while ($row = mysql_fetch_array($result[0])) {
        ?> 
                        <div class="contentPage">
                            <div class="spacer"></div>
                            <h3 class="pageHeader"><a href="blog-detail.php?id=<?= $row['post_id'] ?>"><?= stripslashes($row['title']); ?></a></h3>
                            <span class="headerInfo"><?= date("F jS, Y", strtotime($row['created_time'])); ?></span>                                
                            <p>
                        <?
                        $trimContent = trim($row['post_content']);
                        echo stripslashes($trimContent);
                        ?>                                  
                            </p>
                                <?
                                if (!empty($row['post_contentmore'])) {
                                    ?>                  
                                <span id="spanContHide<?= stripslashes($row['post_id']); ?>">
                                    <?= stripslashes($row['post_contentmore']); ?>
                                </span>
                                <div>
                                    <a href="javascript:void;" onClick="ShowReadMore('lnk<?= stripslashes($row['post_id']); ?>', 'spanContHide<?= stripslashes($row['post_id']); ?>');" id="lnk<?= stripslashes($row['post_id']); ?>" style="color:#fff; text-decoration:none; font-weight:bold;">
                                        &lt;&lt;&lt; COLLAPSE SECTION
                                    </a>
                                </div>        
                                <script>
                                ShowReadMore('lnk<?= stripslashes($row['post_id']); ?>',  'spanContHide<?= stripslashes($row['post_id']); ?>');
                                </script>              
        <? } ?>     
                            <!--<br /><br />
                            Watch the video here:<br />
                            <a href="http://gma.yahoo.com/video/fashionbeauty-26594250/avoid-wedding-dress-blues-27146103.html">
                            Fashion and Beauty Videos - Yahoo!</a>-->
                            <div class="actionButtons">                                
                                <a class="viewArticle" href="blog-detail.php?id=<?= $row['post_id'] ?>"><?php e_strt('Read More'); ?></a>                    	 
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

        <? $ffff++;
    } ?>
<? } ?>		 

<? if ($Totproducts > 0) { ?>
                    <div id="pagingPress" class="clr" style="padding-top:20px;">
                    <?= $result[1]; ?>
                        <div class="clr"></div>	
                    </div>						
                <? } ?>                         
                <? //include("right_facebook.php");?>                    
            </div>  
        </div>

    </div>
                <? include("footer.php"); ?>
                <? include("googleanalytic.php"); ?>
</body>
</html>