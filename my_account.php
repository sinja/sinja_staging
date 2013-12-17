<? include("connect.php"); 
if($_SESSION['UsErId']==""){header("location:index.php");}

if(trim($_POST['Hidsubmit'])=="1")
{
	$count1 = $_REQUEST['count'];
	for($i = 0;$i < $count1;$i++)
	{
		$description = "description_".$i;
		$pid = "pid".$i;
		$desc=$_REQUEST[$description];
		if($desc!="Comments")
		{
			$desc=$_REQUEST[$description];
		}
		else
		{
			$desc="";
		}
		$query = "update wishlist_item  set description='".addslashes($desc)."' where wishlist_item_id=".$_REQUEST[$pid];
		mysql_query($query);
	}
	header("location:my_account.php");
	exit;
}

$entity_id=$_SESSION['UsErId'];
$SelQry="SELECT  email FROM customer_entity WHERE entity_id='$entity_id'";
$SelQryRs=mysql_query($SelQry);
$SelQryRow=mysql_fetch_array($SelQryRs);
$Email=ucfirst(stripslashes($SelQryRow['email']));

$SelQry1="SELECT  value FROM customer_entity_varchar WHERE customer_entity_varchar.attribute_id=7 and customer_entity_varchar.entity_id='$entity_id'";
$SelQryRs1=mysql_query($SelQry1);
$SelQryRow1=mysql_fetch_array($SelQryRs1);
$Lastname=ucfirst(stripslashes($SelQryRow1['value']));

$SelQry2="SELECT  value FROM customer_entity_varchar WHERE customer_entity_varchar.attribute_id=5 and customer_entity_varchar.entity_id='$entity_id'";
$SelQryRs2=mysql_query($SelQry2);
$SelQryRow2=mysql_fetch_array($SelQryRs2);
$Firstname=ucfirst(stripslashes($SelQryRow2['value']));

$CustomerZip="";
$GetCustomerNameQryRs4=mysql_query("SELECT value FROM customer_address_entity_varchar WHERE entity_id='$entity_id' and attribute_id=28");
$GetCustomerNameQryRow4=mysql_fetch_array($GetCustomerNameQryRs4);
$CustomerZip=stripslashes($GetCustomerNameQryRow4['value']);

$Customercountry="";
$GetCustomerNameQryRs5=mysql_query("SELECT value FROM customer_address_entity_varchar WHERE entity_id='$entity_id' and attribute_id=25");
$GetCustomerNameQryRow5=mysql_fetch_array($GetCustomerNameQryRs5);
$Customercountry=stripslashes($GetCustomerNameQryRow5['value']);
$page_title = ' | '.ucwords(strtolower(strt("My Account & Favorites")));
?>
<? include("header.php");?>
<body>
<?php if(isset($_GET['newsletter'])){
	$del='';
if(isset($_GET['acc']) && isset($_GET['email'])){
	$del = "&acc=del&email=".$_GET['email'];
}
?>
 <script>
		$.ajax({
			  url: "<?php echo 'http://'.$_SERVER['SERVER_NAME'];?>/addContact.php?id=<?php echo $_SESSION['UsErId'].$del;?>",
			  context: document.body,
			  success: function(response){	
				//window.parent.location.href="<?php echo GetSiteUrl();?>/my_account.php";
			  }
			});
		
		</script>
<?php } ?>
<script language="javascript" type="text/javascript"> function deleteconfirm(str,strurl) { if (confirm(str)) {	this.location=strurl;} } </script>
    <div id="all">
       <? include("top.php");?>
       <div id="section">
       <? include("left.php");?>
            <div id="content">
            <?php breadcrumbs(); ?>
            <table id="myaccount" width="850" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                      <td height="32" align="left" valign="top" class="font-20-gra"><?php e_upstrt('My Account');?></td>
                    </tr>
                    <tr>
                      <td align="center" valign="top" >
                      <table width="850" border="0" align="center" cellpadding="0" cellspacing="0">
                          <tr>
                            <td width="610" align="left" valign="top">
							<form name="FrmWishlist" id="FrmWishlist" enctype="multipart/form-data" method="post">
							<table width="600" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td align="left" valign="middle">&nbsp;</td>
                                </tr>
                                <tr>
                                  <td align="left" valign="top" class="font-16-gra">
								  <?php e_upstrt('Account Information');?>
                                  </td>
                                </tr>
                                <tr>
                                  <td height="30" align="left" valign="top">&nbsp;</td>
                                </tr>
                                <tr>
                                  <td align="left" valign="top" class="font-16-gra">
                                   <table width="95%" border="0" align="center" cellpadding="3" cellspacing="0">
                                          <tr>
                                            <td class="font-14-wht"><?=$Firstname;?> <?=$Lastname;?><br />
                                              <?=$Email;?><br />
                                              <?=$Customercountry;?><br />
                                              <?=$CustomerZip;?></td>
                                          </tr>
                                          <tr>
                                            <td align="left" valign="middle"> <input type="button" value="<?php e_upstrt('EDIT');?>" onClick="window.location.href='edit_account.php'" class="JAbutton"/></td>
                                          </tr>
                                        </table>
                                   </td>
                                </tr>
                                <tr>
                                  <td height="50" align="left" valign="top">&nbsp;</td>
                                </tr>
                                <tr>
                                  <td height="30" align="left" valign="top" class="font-16-gra"><a class="underline" href="<?php echo GetSiteUrl();?>/favorites.php"><?php e_upstrt('Favorites');?></a></td>
                                </tr>                         
													
								
                              </table>
							</form>
							</td>
                            <td width="253" align="left" style="padding-left:51px;" valign="top"><? //include("right_facebook.php");?></td>
                          </tr>
                        </table>
                        </td>
                    </tr>
                  </table>
                  </div>  
        </div>
        
    </div>
    <? include("footer.php");?>
<? include("googleanalytic.php");?>
</body>
</html>