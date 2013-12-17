<? include("connect.php");
$SEL="SELECT * from staticpage where id='".$CERTIFIED_ID."'";
$SELRs=mysql_query($SEL);
$ROW=mysql_fetch_object($SELRs);
$content=stripslashes($ROW->content);
?>
<?
$class='';
if(!empty($current_language)){
	$class='class="'.$current_language.'"';	
}
$page_title = ' | '.ucwords(strtolower(strt("Certified Products")));
?>
<? include("header.php");?>
<body>
<div id="all">
       <? include("top.php");?>
       <div id="section">
       <? include("left.php");?>
				<div id="content" <?=$class?> >
      
               <div class="pageTitle">
                <h2>
                 <?php e_upstrt("Certified Products");?>             
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