<? include("connect.php");
$SEL="SELECT * from staticpage where id='".$PRIVACY_POLICY_ID."'";
$SELRs=mysql_query($SEL);
$ROW=mysql_fetch_object($SELRs);
$content=stripslashes($ROW->content);
$page_title = ' | '.ucwords(strtolower(strt("Privacy Policy")));
?>
<? include("header.php");?>
<body>
<div id="all">
       <? include("top.php");?>
       <div id="section">
       <? include("left.php");?>
				<div id="content" >
             
                 <div class="pageTitle">
                <h2>
                  <?php e_upstrt("Privacy Policy");?>             
                  </h2>
                 </div> 
                 <div class="clr"></div>
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