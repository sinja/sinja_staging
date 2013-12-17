<? include("connect.php");?>
<?php $page = 'cs';?>
<? 
$page_title = ' | '.ucwords(strtolower(strt("Contact Us")));
include("header.php");?>
<body>
<div id="all">
       <? include("top.php");?>
       <div id="section">
       <? include("left.php");?>
            <div id="content">
            <?php breadcrumbs(); ?>
<table width="850" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                      <td height="32" align="left" valign="top" class="font-20-gra">
					  <?php e_upstrt('Contact');?></td>
                    </tr>
                    <tr>
                      <td align="center" valign="top" class="gra_border1"><table width="850" border="0" align="center" cellpadding="0" cellspacing="0">
                          <tr>
                            <td width="849" align="left" valign="top"><table width="849" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td align="left" valign="middle">&nbsp;</td>
                                </tr>
                                <tr>
                                  <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                      <tr>
                                        <td align="left" valign="top"><table width="220" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                              <td align="left" valign="middle" height="30" class="font-16-gra"><a href="general_inquiries.php" class="font-16-gra-new">
											  <?php e_upstrt('General Inquiries');?>
											 </a></td>
                                            </tr>
                                            <tr>
                                              <td align="left" valign="middle" height="30" class="font-16-gra"><a href="retail_inquiries.php" class="font-16-gra-new">
											  <?php e_upstrt('Retail Inquiries');?>
											  </a></td>
                                            </tr>
                                          </table></td>
                                        <td align="left" valign="top"><img src="images/contact-img.jpg" width="624" height="394" /></td>
                                      </tr>
                                    </table>
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