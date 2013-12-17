<div id="header">
    <h1 class="mir"><a id="logo" href="<?php echo GetSiteUrl(); ?>/index.php"><?php echo $SITE_NAME; ?></a></h1>
    <div id="actionBox">            
        <div class="access">
            <?php if (is_logged_in()) { ?>               
                <a id="locator" href="<?php echo GetSiteUrl(); ?>/favorites.php"><?php e_upstrt('FAVORITES'); ?></a>     
                <a id="logout" href="<?php echo GetSiteUrl(); ?>/logout.php"><?php e_upstrt('LOGOUT'); ?></a>    
            <?php } else { ?>
                <a id="login" href="<?php echo GetSiteUrl(); ?>/login.php"><?php e_upstrt('LOGIN'); ?></a>
            <?php } ?>
        </div>
        
        <style type="text/css">
            body { font-family:Arial, Helvetica, sans-serif }
            span.customStyleSelectBox { 
                font-size:11px; 
                background-color: transparent; 
                color:#FEFEFE; 
                border: none;
                text-transform: uppercase;
                text-align: right;
                margin-left: 80px;
            }
            .styleselect { 
                margin-left: 80px;
                background: #574759;
                color:#FEFEFE; 
                display: none;
            }
            span.customStyleSelectBox.changed { }
            .customStyleSelectBoxInner { }
        </style>
        <script type="text/javascript">
            (function($){
                $.fn.extend({
 
                    customStyle : function(options) {
                        if(!$.browser.msie || ($.browser.msie&&$.browser.version>6)){
                            return this.each(function() {
	  
                                var currentSelected = $(this).find(':selected');
                                $(this).after('<span class="customStyleSelectBox"><span class="customStyleSelectBoxInner">'+currentSelected.text()+'</span></span>').css({position:'absolute', opacity:0,fontSize:$(this).next().css('font-size')});
                                var selectBoxSpan = $(this).next();
                                var selectBoxWidth = parseInt($(this).width()) - parseInt(selectBoxSpan.css('padding-left')) -parseInt(selectBoxSpan.css('padding-right'));			
                                var selectBoxSpanInner = selectBoxSpan.find(':first-child');
                                selectBoxSpan.css({display:'inline-block'});
                                selectBoxSpanInner.css({width:selectBoxWidth, display:'inline-block'});
                                var selectBoxHeight = parseInt(selectBoxSpan.height()) + parseInt(selectBoxSpan.css('padding-top')) + parseInt(selectBoxSpan.css('padding-bottom'));
                                $(this).height(selectBoxHeight).change(function(){
                                    //selectBoxSpanInner.text($(this).val()).parent().addClass('changed');
                                    selectBoxSpanInner.text($(this).find(':selected').text()).parent().addClass('changed');
                                    // Thanks to Juarez Filho & PaddyMurphy
                                });
			
                            });
                        }
                    }
                });
            })(jQuery);

            $(function(){
            
                var width = $('.access').width();
                
                width = 205 - parseInt(width);
                
                $('span.customStyleSelectBox').width(width);
                $('.styleselect').width(width);
                
                $('.styleselect').customStyle();
                $('.styleselect').show();
            });
        </script>

        <?php
        $langs = get_active_languages();
        global $current_language;
        ?>		

        <form name="frmfooter" id="frmfooter" enctype="multipart/form-data" method="get" action="<?php echo GetSiteUrl(); ?>/changelanguage.php">
            <select name="footer_lang" class="styleselect" id="footer_lang" onchange="document.frmfooter.submit();">
                <?php foreach ($langs as $row) { ?>                
                    <option value="<?php echo $row['code']; ?>" <?
                if ($current_language == $row['code']) {
                    echo "selected";
                }
                    ?>><?php
                        if (empty($row['translation'])) {
                            echo $row['name'];
                        } else {
                            echo $row['translation'];
                        }
                    ?></option>
                <?php } ?>
            </select>
        </form> 

        <div class="spacer-10">&nbsp;</div>
        <form name="frmtopsearch" id="frmtopsearch" enctype="multipart/form-data" method="get" action="<?php echo GetSiteUrl(); ?>/searchresult.php">
            <input name="srch" type="text" class="searchBox" id="txtSearch" value="<?php e_upstrt('SEARCH CATALOG'); ?>"/>
        </form>

        <a target="_blank" href="https://plus.google.com/+sinceritybridal"><img class="socialTop" src="<?php echo GetSiteUrl(); ?>/img/social/GOOGLE-PLUS_grey.png" alt="" /></a>
        <a target="_blank" href="https://twitter.com/sinceritybridal"><img class="socialTop" src="<?php echo GetSiteUrl(); ?>/img/social/TWITTER_grey.png" alt="" /></a>
        <a target="_blank" href="http://www.pinterest.com/sinceritybridal"><img class="socialTop" src="<?php echo GetSiteUrl(); ?>/img/social/PINTEREST_grey.png" alt="" /></a>
        <a target="_blank" href="https://www.facebook.com/sinceritybridal"><img class="socialTop" src="<?php echo GetSiteUrl(); ?>/img/social/FACEBOOK_grey.png" alt="" /></a>

        <div class="spacer-10">&nbsp;</div>
        <a id="lang" href="<?php echo GetSiteUrl(); ?>/store_locator.php"><?php e_upstrt('STORE LOCATOR'); ?></a>
        <div id="welcome" class="clr">
            <?php if (is_logged_in()) { ?>  
                <a id="welcome-user" href="<?php echo GetSiteUrl(); ?>/my_account.php">
                    <?php e_strt('Welcome'); ?>
                    <? echo ucwords($_SESSION['UsErNaMe']); ?>!
                </a>                 
                <?php
                if ($FINDASTORE != "Y" && $RETAILINQ != "Y") {
                    $TOPGetCustomerQry = "SELECT entity_id,weddingdate,weddingdate_show FROM customer_entity WHERE entity_id='" . $_SESSION['UsErId'] . "'";
                    $TOPGetCustomerQryRs = mysql_query($TOPGetCustomerQry);
                    $TOPGetCustomerQryRow = mysql_fetch_array($TOPGetCustomerQryRs);
                    if ($TOPGetCustomerQryRow['weddingdate'] != "" && $TOPGetCustomerQryRow['weddingdate'] != "0000-00-00" && $TOPGetCustomerQryRow['weddingdate_show'] == "Y") {
                        ?>

                        <?php e_upstrt('WEDDING COUNTDOWN:'); ?>	<span class="welcome-name"><?= GetDaysAgoFomTime($TOPGetCustomerQryRow['weddingdate']); ?></span>
                        <?php
                    }
                }
            }
            ?>
            <div class="clr"></div>
        </div>
    </div>
    <div class="clr"></div>
</div>