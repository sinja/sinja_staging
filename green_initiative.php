<? include("connect.php");
$SEL="SELECT * from staticpage where id='".$GREEN_INITIATIVE."'";
$SELRs=mysql_query($SEL);
$ROW=mysql_fetch_object($SELRs);
$content=stripslashes($ROW->content);
$page_title = ' | '.ucwords(strtolower(strt("Green Initiative")));
?>
<? include("header.php");?>
<body>
<div id="all">
       <? include("top.php");?>
       <div id="section">
       <? include("left.php");?>
            <div id="content">        
				<?php breadcrumbs(); ?>
                <div id="greenHeading" class="inqueriesBG">
                <div class="font-48-gra-bold floatHeading">
                 <?php e_upstrt('Green Initiative');?>
                 </div>                                        
                 </div> 
                 <div id="greenContent">
				  <?=$content;?>
                  </div>
                  </div>  
        </div>
        
    </div>
    <? include("footer.php");?>
<? include("googleanalytic.php");?>
</body>
</html>