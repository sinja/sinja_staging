<div class="clr"></div>
<div id="footer">
        <div id="footContainer">
            <ul id="footNav">
                <li><a href="<?php echo GetSiteUrl();?>/about.php"><?php e_upstrt('ABOUT');?></a></li> 
                <li><a href="<?php echo GetSiteUrl();?>/faq.php"><?php e_upstrt("FAQs");?></a></li>
                <li><a href="<?php echo GetSiteUrl();?>/privacy_policy.php"><?php e_upstrt('PRIVACY POLICY');?></a></li>  
                <li><a href="<?php echo GetSiteUrl();?>/terms_of_use.php"><?php e_upstrt('TERMS OF USE');?></a></li>  
                <li><a href="<?php echo GetSiteUrl();?>/certified_products.php"><?php e_upstrt('CERTIFIED PRODUCTS');?></a></li>  
                <li><a href="<?php echo GetSiteUrl();?>/green_initiative.php"><?php e_upstrt('GREEN INITIATIVE');?></a></li>
                <!--<li><a href="javascript:void(0);"><?php e_upstrt('SITE MAP');?></a></li> -->
                <li><a href="<?php echo GetSiteUrl();?>/store_locator.php"><?php e_upstrt('STORE LOCATOR');?></a></li> 
                <li class="last"><a href="<?php echo GetSiteUrl();?>/contact_us.php"><?php e_upstrt('CONTACT US');?></a></li>
        	</ul>           
            <div id="footerBrands">
            <?php
            
            $SEL = "SELECT * from $FOOTER_TABLE where id='" . $FOOTER_ID . "'";
            $SELRs = mysql_query($SEL);
            $ROW = mysql_fetch_object($SELRs);
            $id = 'ja';
            $url = 'JustinAlexanderBridal.com';
            $text = stripslashes($ROW->box1_text);
            $img = ($ROW->box1_img == '') ? '' : $ALBUM_URL . '/footer/' . stripslashes($ROW->box1_img);
            $logo = ($ROW->box1_logo == '') ? '' : $ALBUM_URL . '/footer/' . stripslashes($ROW->box1_logo);
            footerBrandsBox($id, $url, $text, $img, $logo);
            $id = 'sin';
            $url = 'SINCERITYBRIDAL.COM';
            $text = stripslashes($ROW->box2_text);
            $img = ($ROW->box2_img == '') ? '' : $ALBUM_URL . '/footer/' . stripslashes($ROW->box2_img);
			$logo = ($ROW->box2_logo == '') ? '' : $ALBUM_URL . '/footer/' . stripslashes($ROW->box2_logo);
            footerBrandsBox($id, $url, $text, $img, $logo);
            $id = 'swh';
            $url = 'SWEETHEARTGOWNS.COM';
            $text = stripslashes($ROW->box3_text);
            $img = ($ROW->box3_img == '') ? '' : $ALBUM_URL . '/footer/' . stripslashes($ROW->box3_img);
			$logo = ($ROW->box3_logo == '') ? '' : $ALBUM_URL . '/footer/' . stripslashes($ROW->box3_logo);
            footerBrandsBox($id, $url, $text, $img, $logo);
            $id = 'sde';
            $url = 'JUSTINALEXANDERBRIDAL.COM';
            $text = stripslashes($ROW->box4_text);
            $img = ($ROW->box4_img == '') ? '' : $ALBUM_URL . '/footer/' . stripslashes($ROW->box4_img);
			$logo = ($ROW->box4_logo == '') ? '' : $ALBUM_URL . '/footer/' . stripslashes($ROW->box4_logo);
            footerBrandsBox($id, $url, $text, $img, $logo);
            ?>               
            <div class="clr"></div>
        </div>
        <?php echo stripslashes($ROW->text); ?>
        <div class="clr">&nbsp;</div>
        <div class="clr">&nbsp;</div>
        <p>
            <?php echo stripslashes($ROW->copyright); ?>
        </p>
        </div><script type="text/javascript">


function DM_prepClient(csid,client) {


client.DM_addEncToLoc("pid", "JASB");


}


</script>


<script src="http://js.revsci.net/gateway/gw.js?csid=K10981&auto=t"></script>
    </div>