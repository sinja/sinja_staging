<style type="text/css">
    .bloglikeButton {
        display: none;
    }

    .followus {
        height: 40px;
        border-bottom: 2px solid #3a3a3a;
        margin-bottom: 20px;
    }

    .likesend {
        margin-bottom: 20px;
        padding-left: 53px;
    }

    .followus a {
        position: relative;
        float: left;
        margin: 0px 18px;
    }

    .followus a span.arrow{
        width: 13px;
        height: 12px;
        background: url(<?php echo GetSiteUrl(); ?>/img/icon/followus_arrow.png) no-repeat;
        position: absolute;
        bottom: -20px;
        display: none;
    }

    .followus a.afb:hover span.arrow{
        left: 0px;
        display: block;
    }

    .followus a.apt:hover span.arrow{
        left: 7px;
        display: block;
    }

    .followus a.atw:hover span.arrow{
        left: 9px;
        display: block;
    }

    .followus a.agp:hover span.arrow {
        left: 2px;
        display: block;
    }

    .followus span.fb {
        background: url(<?php echo GetSiteUrl(); ?>/img/icon/facebook.png) no-repeat; width: 13px; height: 25px; display: block; 
    }

    .followus span.fb:hover{
        background: url(<?php echo GetSiteUrl(); ?>/img/icon/facebook_selected.png) no-repeat;
    }

    .followus span.pt {
        background: url(<?php echo GetSiteUrl(); ?>/img/icon/pinterest.png) no-repeat; width: 25px; height: 25px; display: block;
    }

    .followus span.pt:hover{
        background: url(<?php echo GetSiteUrl(); ?>/img/icon/pinterest_selected.png) no-repeat;
    }

    .followus span.tw {
        background: url(<?php echo GetSiteUrl(); ?>/img/icon/twitter.png) no-repeat bottom center; width: 27px; height: 25px; display: block;
    }

    .followus span.tw:hover{
        background: url(<?php echo GetSiteUrl(); ?>/img/icon/twitter_selected.png) no-repeat bottom center;
    }

    .followus span.gp {
        background: url(<?php echo GetSiteUrl(); ?>/img/icon/google-plus.png) no-repeat; width: 25px; height: 25px; display: block;
    }

    .followus span.gp:hover{
        background: url(<?php echo GetSiteUrl(); ?>/img/icon/google-plus_selected.png) no-repeat;
    }

    .srp-widget-container .srp-widget-singlepost {
        border: none !important;
        width: 212px;
        padding: 0px 10px 10px 10px !important;
    }

    .srp-widget-container .srp-post-title {
        font-size: 13px;
        font-family: Arial;
    }

    .srp-post-title-link {
        font-weight: bold;
    }

    .bloglikeButton {
        margin-top: 10px;
    }

    .bloglikeButton .st_sharethis_custom {
        background: url("<?php echo GetSiteUrl(); ?>/img/social/btn-share.png") no-repeat scroll left top transparent;
        position: relative;
        display: block;
        width: 57px;
        height: 20px;
    }

    .bloglikeButton div {
        float: left;
        margin-right: 10px;
    }

    .clearfix:after {
        content: ".";
        display: block;
        height: 0;
        clear: both;
        visibility: hidden;
    }

    .clearfix {display: inline-block;}

    .wpcf7-submit {
        border: none;
        background: transparent;
        padding: 0;
        margin-left: 10px;
        color: #fefefe;
        font-size: 14px;
        cursor: pointer;
    }
    .wpcf7-not-valid-tip {
        color: red;
    }

    .blog {
        background: #6d6d70;
        width: 786px;
        margin-left: 11px;
        margin-top: 10px;
    }

    #primary {
        width: 549px;
        float: left;
    }

    .post {
        background: #ffffff;
        margin-top: 26px;
        position: relative;
        padding: 48px 25px 50px 25px;
    }

    .post .date strong {
        font-size: 19px;
    }
    .post .date {
        position: absolute;
        top: -26px;
        left: 26px;
        text-align: center;
        background: #6d6d70;
        color: #fff;
        border: 2px solid #c00021;
        padding: 6px 10px;
        font-size: 15px;
        line-height: 18px;
        text-transform: uppercase;
    }

    .post h3 {
        color: #c00021;
        font-size: 36px;
        line-height: 38px;
        margin-bottom: 10px;
        float: none;
    }

    .post h3 a {
        color: #c00021;
    }

    .post p{
        float: none;
        color: #000;
        font-size: 15px;
        line-height: 20px;
    }

    .post p img{
        max-width: 499px;
        height: auto;
    }

    .post a { color: #C00021;}

    .post .readmore {
        color: #c00021;
        position: absolute;
        bottom: 70px;
        right: 25px;
        font-size: 14px;
        text-transform: uppercase;
    }

    .post-spacer {
        height: 26px;
    }


    #secondary {
        width: 237px;
        float: right;
        margin-top: 26px;
    }

    aside {
        margin-bottom: 10px;
    }

    aside .assistive-text {
        display: none;
    }

    aside input[type="text"] {
        width: 200px;
        margin: 0px 10px 5px 10px;
        background: #3a3a3a;
        color: #fff;
        height: 30px;
        line-height: 30px;
        border: none;
        font-size: 11px;
        padding: 0px 6px;
    }

    #searchform input[type="submit"] {
        display: none;
    }

    aside h3 {
        font-size: 14px;
        text-transform: uppercase;
        height: 28px;
        line-height: 28px;
        padding-left: 5px;
        margin-bottom: 15px;
        background: #c00021; /* Old browsers */
        background: -moz-linear-gradient(top,  #c00021 0%, #4f000e 100%); /* FF3.6+ */
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#c00021), color-stop(100%,#4f000e)); /* Chrome,Safari4+ */
        background: -webkit-linear-gradient(top,  #c00021 0%,#4f000e 100%); /* Chrome10+,Safari5.1+ */
        background: -o-linear-gradient(top,  #c00021 0%,#4f000e 100%); /* Opera 11.10+ */
        background: -ms-linear-gradient(top,  #c00021 0%,#4f000e 100%); /* IE10+ */
        background: linear-gradient(to bottom,  #c00021 0%,#4f000e 100%); /* W3C */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#c00021', endColorstr='#4f000e',GradientType=0 ); /* IE6-9 */
    }

    aside ul {
        margin-left: 15px;
    }

    .imgth {float: left; margin-right: 10px; margin-bottom: 10px; width: 250px;}

    .contentPage.excerpt p {width: 420px !important;}

    #comments { clear: both; padding: 10px 0px; }
    #comments h2 { margin-bottom: 20px; color: #000;}
    #comments a { color: #C00021;}
    #comments .comments { border-bottom: 15px solid #red;}
    #comments .comments .comment-content { clear: both; }
    #comments .avatar { float: left; width: 58px; height: 58px; margin-right: 10px; margin-bottom: 10px; opacity: 0.69; filter: alpha(opacity=69); }
    #comments .comment .comment-author .fn { font-size: 11px; font-weight: bold; font-family: Arial,Helvetica,sans-serif; }
    #comments .comment-author .fn:after {  }
    #comments .comment-meta { font-size: 12px; font-family: Arial,Helvetica,sans-serif;  margin-top: 4px; }
    #comments .comment-meta .meta-sep { display: none; }
    #comments .comment-meta time { margin-left: 5px; font-size: 10px; }
    #comments .comment-content p { font-size: 13px; margin-bottom: 5px; }
    #comments .comment-reply-link .comment-reply-link { width: 39px; height: 17px; display: block;}
    #comments .form-submit #submit { width: 128px; height: 33px; display: block; }
    #comments #form-allowed-tags {display: none;}
    #comments #login {display: none;}
    #comments #comment-notes {display: none;}
    #comments .form-label { padding: 4px 0px;}

    #view-comments {display: none;}
    #view-comments-btn {float: right; color: #000 !important;}

    #comments #reply-title { display: none; }
    #comments .comment-notes { display: none; }
    #comments .form-textarea textarea { border: 1px solid #072c45; background: none;  width: 378px; padding: 4px 4px; }
    #comments #respond { margin-top: 15px;}
    #comments .comment {}
    #comments .comment .arrow-comment  { background: url(<?php echo GetSiteUrl(); ?>/img/icon/arrow-comment.png) no-repeat; height: 9px; width: 11px; position: absolute; top: -9px; left: 9px; }
    #comments .comment ul { margin-left: 50px; list-style: none; }
    #comments .comment .from {  width: 900px; padding: 5px 20px; font-family: Arial, Helvetica, sans-serif; font-size: 18px; }
    #comments span.name {  }
    #comments .comment .date {  width: 900px; padding: 0 20px; font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #000;}
    #comments .comment .comment-author {   font-size: 12px; color: #000;}
    #comments .comment .comment-content { position: relative; border: 1px solid #3a3a3a; padding: 10px 15px; margin: 8px 0px;}
    #comments .comment .comment-reply-link { float: right; color: #000 !important; margin-right: 10px;}
    #comments .comment .text {  width: 880px; padding: 20px 30px; font-family: Arial, Helvetica, sans-serif; font-size: 13px; }
    #comments .comment .bottombar {  width: 940px; height: 17px; background: #eaeaea;}
    #comments .wrapper { border-left: 1px solid #d6d6d6; border-right: 1px solid #d6d6d6; background: #fff; }

    #comments #respond label { display: none; }
    #comments #respond span.required, #comments #respond .form-allowed-tags { display: none; }
    #comments #respond input[type=text] { width: 300px; padding: 0px 5px; margin: 3px 0px; background: #3a3a3a; border: none; height: 30px; line-height: 30px; color: #fff; }
    #comments #respond input[type=submit] { border: none; background: none; text-align: left; cursor: pointer; text-transform: uppercase; }
    #comments #respond textarea { width: 400px; padding: 0px 5px; margin: 3px 0px; background: #3a3a3a; border: none; line-height: 20px; color: #fff; }

    .navigation {
        margin-bottom: 20px;
    }

    .navigation ul {
        list-style: none;
    }

    .navigation ul li {
        float: left;
        background: #333333;
        color: #999999;
        padding: 10px 14px;
        margin-right: 2px;
        margin-top: 2px;
    }

    .navigation ul li a {
        background: #333333;
        color: #999999;
        display: block;
    }

    .navigation ul li.current{
        float: left;
        background: #111111;
        color: #cccccc;
        font-weight: bold;
    }

    .boxgallery {
        border-bottom: 1px solid #3a3a3a;
        padding-bottom: 10px;
        margin-bottom: 10px;
    }

    h4 {
        font-size: 11px;
        color: #c00021;
        margin-bottom: 5px;
    }

    .boxrelatedposts {
        border-bottom: 1px solid #3a3a3a;
        padding-bottom: 5px;
        margin-bottom: 10px;
    }

    .boxrelatedposts img {
        float: left; 
        margin-right: 8px;
        margin-bottom: 5px;
    }

    .boxrelatedposts h3, .boxrelatedposts h3 a {
        font-size: 12px;
        color: #000;
        line-height: 15px;
        font-weight: bold;
    }

    /*
    ColorBox Core Style:
    The following CSS is consistent between example themes and should not be altered.
    */
    #colorbox, #cboxOverlay, #cboxWrapper{position:absolute; top:0; left:0; z-index:9999; overflow:hidden; background: transparent;}
    #cboxOverlay{position:fixed; width:100%; height:100%;}
    #cboxMiddleLeft, #cboxBottomLeft{clear:left;}
    #cboxContent{position:relative;}
    #cboxLoadedContent{overflow:auto;}
    #cboxTitle{margin:0;}
    #cboxLoadingOverlay, #cboxLoadingGraphic{position:absolute; top:0; left:0; width:100%; height:100%;}
    #cboxPrevious, #cboxNext, #cboxClose, #cboxSlideshow{cursor:pointer;}
    .cboxPhoto{float:left; margin:auto; border:0; display:block; max-width: none;}
    .cboxIframe{width:100%; height:100%; display:block; border:0;}
    #colorbox, #cboxContent, #cboxLoadedContent{box-sizing:content-box;}

    /* 
        User Style:
        Change the following styles to modify the appearance of ColorBox.  They are
        ordered & tabbed in a way that represents the nesting of the generated HTML.
    */
    #cboxOverlay{background:#000;}
    #colorbox{}
    #cboxContent{margin-top:20px;}
    .cboxIframe{background:#fff;}
    #cboxError{padding:50px; border:1px solid #ccc;}
    #cboxLoadedContent{border:5px solid #000; background:#000;}
    #cboxTitle{position:absolute; top:-20px; left:0; color:#ccc;}
    #cboxCurrent{position:absolute; top:-20px; right:0px; color:#ccc;}
    #cboxSlideshow{position:absolute; top:-20px; right:90px; color:#fff;}
    #cboxPrevious{position:absolute; top:50%; left:5px; margin-top:-23px; background:url(<?php echo GetSiteUrl(); ?>/img/icon/goLeftColor.png) no-repeat; width:34px; height:47px; text-indent:-9999px;}
    #cboxPrevious:hover{}
    #cboxNext{position:absolute; top:50%; right:5px; margin-top:-23px; background:url(<?php echo GetSiteUrl(); ?>/img/icon/goRightColor.png) no-repea; width:34px; height:47px; text-indent:-9999px;}
    #cboxNext:hover{background-position:bottom right;}
    #cboxLoadingOverlay{background:#000;}
    #cboxLoadingGraphic{}
    #cboxClose{position:absolute; top:5px; right:5px; display:block; background:url(<?php echo GetSiteUrl(); ?>/img/icon/closeColor.png) no-repeat; width:43px; height:43px; text-indent:-9999px;}
    #cboxClose:hover{background-position:bottom center;}

</style>