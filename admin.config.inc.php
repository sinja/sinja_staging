<?php
  /*  This is the config File for the admin panel                    */
  $ADMIN_PANEL_VERSION = "1.4";

  /********************************************************************
    This is the name which is going to appear on all the pages
  ********************************************************************/

  $ADMIN_MAIN_SITE_NAME = "Sincerity Bridal Worldwide - Administration";

  /********************************************************************
   Color Scheme for the main pages
  ********************************************************************/

  $ADMIN_MAIN_PAGES_TEXT_COLOR = "#000000";
  $ADMIN_MAIN_PAGES_BG_COLOR = "#FFFFFF";
  $ADMIN_MAIN_PAGES_LINKS_COLOR = "#FFFFFF";

  /********************************************************************
    Color Scheme for the header
  ********************************************************************/

  $ADMIN_HEADER_BG_COLOR = "#E44591";
  $ADMIN_HEADER_FONT_COLOR = "#ffffff";

  /********************************************************************
    Color scheme for the footer
  ********************************************************************/

  $ADMIN_FOOTER_BG_COLOR ="#E44591";
  $ADMIN_FOOTER_FONT_COLOR = "#ffffff";

  /********************************************************************
    Color scheme for the sidebar
  ********************************************************************/

  $ADMIN_SIDEBAR_BG_COLOR = "#F7C4DC";
  $ADMIN_SIDEBAR_FONT_COLOR = "#000000";
  $ADMIN_SIDEBAR_FONT_SIZE = 1;

  /********************************************************************
    Color scheme for the inner tables
  ********************************************************************/

  $ADMIN_TABLE_BG_COLOR = "#FCE9F2";
  $ADMIN_TABLE_FONT_COLOR = "#ffffff";
  

  ////////////////////////////////////////////////////////////////////
  ////////////////////////////////////////////////////////////////////
  /*  Admin Settings                                                */
  ////////////////////////////////////////////////////////////////////
  ////////////////////////////////////////////////////////////////////

  /********************************************************************
    If you set the below parameter to NO then the variables
    $ADMIN_USERNAME & $ADMIN_PASSWORD are used, otherwise the users
    are validated from the table
  ********************************************************************/

  $ADMIN_USE_DATABASE = "NO";
  $ADMIN_USERS_TABLE = "admin_users";
  $STYLE="<link rel='stylesheet' href='Style.css' type='text/css'>";
  /********************************************************************
   Admin Username Password Settings
   if the $ADMIN_USE_DATABASE is set to NO then these variables will
   be used
  ********************************************************************/

  $ADMIN_USERNAME = "admin";
  $ADMIN_PASSWORD = "admin";
 
?>