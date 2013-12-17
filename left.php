 <div id="fb-root"></div>
    <script>    
	(function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) { return; }
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=179251552151990";
        fjs.parentNode.insertBefore(js, fjs);
    } (document, 'script', 'facebook-jssdk'));
    </script>
             <div id="nav">
            <ul class="menu">            
                <li class="title"><?php e_upstrt('COLLECTIONS');?></li>
                <?php if(!empty($COLLECTION_ONE)){ ?>
                <li><a href="<?php echo GetSiteUrl();?>/wedding_dress"><?php echo $COLLECTION_ONE;?></a></li>
                <?php } ?>
                <?php if(!empty($COLLECTION_TWO)){ ?>                
                <li><a href="<?php echo GetSiteUrl();?>/plus_wedding_dress"><?php e_upstrt($COLLECTION_TWO);?></a></li>
                <?php } ?>
                 <?php if(!empty($COLLECTION_THREE)){ ?>                
                <li><a href="<?php echo GetSiteUrl();?>/collectionlist.php?collection=9"><?php e_upstrt($COLLECTION_THREE);?></a></li>
                <?php } ?>
             </ul>
            <ul class="menu">
             <li class="title"><?php e_upstrt('FEATURES');?></li>
                <li><a href="<?php echo GetSiteUrl();?>/wedding_accessories"><?php e_upstrt('ACCESSORIES');?></a></li>
                <li><a href="<?php echo GetSiteUrl();?>/new_arrivals"><?php e_upstrt('NEW ARRIVALS');?></a></li>
                <li><a href="<?php echo GetSiteUrl();?>/designer_picks"><?php e_upstrt('DESIGNER PICKS');?></a></li>
                <li><a href="<?php echo GetSiteUrl();?>/designer_days.php"><?php e_upstrt('TRUNK SHOWS');?></a></li>                           
              </ul>
           
            <ul class="menu">
                <li class="title"><?php e_upstrt('MEDIA');?></li>
                <li><a href="<?php echo GetSiteUrl();?>/lookbook.php"><?php e_upstrt('LOOKBOOK');?></a></li>
                <li><a href="<?php echo GetSiteUrl();?>/videos.php"><?php e_upstrt('VIDEOS');?></a></li>
                <li><a href="<?php echo GetSiteUrl();?>/image_gallery.php"><?php e_upstrt('GALLERY');?></a></li>
<!--                <li><a href="<?php echo GetSiteUrl();?>/blog/"><?php e_upstrt('BLOG');?></a></li>-->
            </ul>
            <ul class="menu">
                <li class="title"><?php e_upstrt('PRESS');?></li>
                <li><a href="<?php echo GetSiteUrl();?>/editorial_coverage.php"><?php e_upstrt('EDITORIAL COVERAGE');?></a></li>
                <li><a href="<?php echo GetSiteUrl();?>/press_inquiries.php"><?php e_upstrt('PRESS INQUIRIES');?></a></li>
            </ul>
            <ul class="menu">
                <li class="title"><a href="<?php echo GetSiteUrl();?>/contact_us.php"><?php e_upstrt('CONTACT US');?></a></li>
                <li><a href="<?php echo GetSiteUrl();?>/general_inquiries.php"><?php e_upstrt('GENERAL INQUIRIES');?></a></li>
                <li><a href="<?php echo GetSiteUrl();?>/retail_inquiries.php"><?php e_upstrt('RETAIL INQUIRIES');?></a></li>
                <li><a href="<?php echo GetSiteUrl();?>/career_opportunities.php"><?php e_upstrt('CAREER OPPORTUNITIES');?></a></li>
                
            </ul>

            <div class="socialBox">
               <a id="newsletterLink" href="<?php echo GetSiteUrl();?>/register_popup.php" target="_blank"><?php e_upstrt('NEWSLETTER');?></a> 
            </div>
        </div>