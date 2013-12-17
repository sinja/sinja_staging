<? 
include("connect.php");
$SEL="SELECT * from staticpage where id='".$FAQ_ID."'";
$SELRs=mysql_query($SEL);
$ROW=mysql_fetch_object($SELRs);
$content=stripslashes($ROW->content);
//error_reporting(E_ALL);	
$page_title = ' | '.ucwords(strtolower(strt("Frequently Asked Questions")));
?>
<? include("header.php");?>
<body>
<div id="all">
       <? include("top.php");?>
       <div id="section">
       <? include("left.php");?>
            <div id="content">
             <?php breadcrumbs(); ?>              
             <div class="pageTitle">
                <h2>
               <?php e_strt("FAQs");?>
                </h2>
            </div>
               
                 <div id="faqContent" class="staticPages">
                 <div>
				  <?=$content;?>
                  </div>
                  </div>
                  </div>  
                            
                   </div>  
        </div>
        
    </div>
    <? include("footer.php");?>
<? include("googleanalytic.php");?>
</body>
</html>