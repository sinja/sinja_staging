<? include("connect.php"); ?>
<? include("header.php");?>
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
                                  <td width="33%" height="407" align="left" valign="bottom" class="blog_main" onClick="window.location.href='blog.php';" style="cursor:pointer;"><table width="87%" border="0" cellspacing="0" cellpadding="0">
                                      <tr>
                                        <td height="60" align="left" valign="middle" class="gallery_hd" onClick="window.location.href='blog.php';" style="cursor:pointer;">&nbsp;
										<?php e_strt("videos");?>
										
										</td>
                                      </tr>
                                      <tr>
                                        <td height="35" align="left" valign="middle">&nbsp;</td>
                                      </tr>
                                    </table></td>
                                  <td width="33%" align="left" valign="bottom" class="gallery_main" onClick="window.location.href='gallery.php';" style="cursor:pointer;"><table width="85%" border="0" cellspacing="0" cellpadding="0">
                                      <tr>
                                        <td height="60" align="left" valign="middle" class="gallery_hd" onClick="window.location.href='gallery.php';" style="cursor:pointer;">&nbsp;<?php e_strt("Gallery");?></td>
                                      </tr>
                                      <tr>
                                        <td height="35" align="left" valign="middle">&nbsp;</td>
                                      </tr>
                                    </table></td>
                                  <td width="33%" align="left" valign="bottom" class="press_main" onClick="window.location.href='press.php';" style="cursor:pointer;"><table width="85%" border="0" cellspacing="0" cellpadding="0">
                                      <tr>
                                        <td height="60" align="left" valign="middle" class="gallery_hd" onClick="window.location.href='press.php';" style="cursor:pointer;">&nbsp;<?php e_strt("Press");?></td>
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
                  </table>
                  </div>  
        </div>
        
    </div>
    <? include("footer.php");?>
<? include("googleanalytic.php");?>
</body>
</html>