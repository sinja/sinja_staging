<?php 
switch(basename($_SERVER['SCRIPT_NAME'])){
	case "prodrewrite.php":
		$crumbs[0]['url'] = GetSiteUrl();
		$crumbs[0]['label'] = strt("Home");
		$crumbs[1]['url'] = GetSiteUrl().'/collectionlist.php?collection=1';
		$crumbs[1]['label'] = strt("Collection");
		$crumbs[2]['url'] = '';
		$crumbs[2]['label'] = $_REQUEST['sku'];
		breadout($crumbs);
		break;
	default:
		$crumbs[0]['url'] = GetSiteUrl();
		$crumbs[0]['label'] = strt("Home");
		$crumbs[1]['url'] = '';
		$crumbs[1]['label'] = '';
	break;
}

function breadout($crumbs){
	echo "<div id='breadcrumb'><ul>";
		$i = 0;
		$sp = " | ";
      foreach ($crumbs as $crumb){  
		if($i==0) $spac = '';
		else $spac = $sp;
         if ($crumb['url']){

            echo "<li>$spac<a href='".$crumb['url']."' title='".$crumb['label']."'>".$crumb['label']."</a></li> ";

         } else {

            echo "<li>".$spac.$crumb['label']."</li> ";

         }
		 $i++;
      }

      echo "</ul></div>";
}
?>
