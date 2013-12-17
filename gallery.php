<? include("connect.php"); ?>
<? 
$page_title = ' | '.ucwords(strtolower(strt("Image Gallery")));
include("header.php");?>
<body>
    <div id="all">
       <? include("top.php");?>
       <div id="section">
       <? include("left.php");?>
            <div id="content">
            <?php breadcrumbs(); ?>
            <table width="808" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td align="left" valign="top"><table width="781" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td align="left" valign="top"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                <tr>
                                  <td width="33%" height="407" align="left" valign="bottom" class="champion" onClick="window.location.href='albums.php?aid=1';" style="cursor:pointer;"><table width="87%" border="0" cellspacing="0" cellpadding="0">
                                      <tr>
                                        <td height="60" align="left" valign="middle" class="gallery_hd" onClick="window.location.href='albums.php?aid=1';" style="cursor:pointer;"><?php e_upstrt('campaigns');?></td>
                                      </tr>
                                      <tr>
                                        <td height="35" align="left" valign="middle">&nbsp;</td>
                                      </tr>
                                    </table></td>
                                  <td width="33%" align="left" valign="bottom" class="champion2" onClick="window.location.href='albums.php?aid=2';" style="cursor:pointer;"><table width="85%" border="0" cellspacing="0" cellpadding="0">
                                      <tr>
                                     <td height="60" align="left" valign="middle" class="gallery_hd" onClick="window.location.href='albums.php?aid=2';" style="cursor:pointer;"><?php e_upstrt('fashion shows');?></td>
                                      </tr>
                                      <tr>
                                        <td height="35" align="left" valign="middle">&nbsp;</td>
                                      </tr>
                                    </table></td>
                                  <td width="33%" align="left" valign="bottom" class="champion3" onClick="window.location.href='albums.php?aid=3';" style="cursor:pointer;"><table width="85%" border="0" cellspacing="0" cellpadding="0">
                                      <tr>
                                     <td height="60" align="left" valign="middle" class="gallery_hd" onClick="window.location.href='albums.php?aid=3';" style="cursor:pointer;"><?php e_upstrt('behind the scenes');?></td>
                                      </tr>
                                      <tr>
                                        <td height="35" align="left" valign="middle">&nbsp;</td>
                                      </tr>
                                    </table></td>
                                </tr>
                              </table></td>
                          </tr>
                        </table></td>
                    </tr>
                  </table> </div>  
        </div>
        
    </div>
    <? include("footer.php");?>
<? include("googleanalytic.php");?>
</body>
</html>