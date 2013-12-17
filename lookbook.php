<? include("connect.php");?>
<? 
$page_title = ' | '.ucwords(strtolower(strt("Lookbook")));
include("header.php");?>
<body>
<div id="all">
       <? include("top.php");?>
       <div id="section">
       <? include("left.php");?>
            <div id="content">
            <?php breadcrumbs(); ?>
              <div class="pageTitle">
                    <h2>
                    <?php e_upstrt("LOOKBOOK");?> 
                    </h2>
                </div>

                <div>
                <!--<img src="img/assets/look-book.png" width="798" />-->
                <iframe width="798" src="<?php echo $LOOKBOOK_URL;?>" frameborder="0" height="553"></iframe>
                </div>
                            
                   </div>  
        </div>
        
    </div>
    <? include("footer.php");?>
<? include("googleanalytic.php");?>
</body>
</html>