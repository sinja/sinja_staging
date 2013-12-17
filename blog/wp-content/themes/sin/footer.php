<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?>
</div>  
</div>

</div>
<?php
global $FOOTER_ID;
global $FOOTER_TABLE;
global $ALBUM_URL;
?>
<?php include("../footer.php");  ?>

<?php wp_footer(); ?>

<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.cookie.js" ></script>
<script type="text/javascript">
	/*
	if($.cookie('togglecomments') == "close"){
		$('#view-comments-btn').html('view all');
		$('#view-comments').hide();
	} else {
		$('#view-comments-btn').html('close');
		$('#view-comments').show();
	}
	*/
	
	if($('#comments-title').html() == "COMMENTS (0)") {
		$('#view-comments').hide();
		$('#view-comments-btn').html('view all');
	} else {
		$('#view-comments').show();
		$('#view-comments-btn').html('close');
	}
	
	$('#view-comments-btn').click(function() {
        $('#view-comments').toggle('slow');
        if($('#view-comments-btn').html() == 'view all'){
            $('#view-comments-btn').html('close');
			//$.removeCookie('togglecomments', { path: '/' });
        } else {
            $('#view-comments-btn').html('view all');
			//$.cookie('togglecomments', 'close', { expires: 7, path: '/' });
        }
    });
	
    $('#author').attr('placeholder', 'Name');
    $('#email').attr('placeholder', 'Email');
    $('#url').attr('placeholder', 'Website');
    $('#comment').attr('placeholder', 'Comment');
    
    
</script>


<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.colorbox-min.js" ></script>
<script type="text/javascript">
	$(function()
	{
		$(window).bind('load', function()
		{	
			$('.bloglikeButton div').delay('1000').show('fast');
			$('.afb').click();
			$('.content-likesend').css('overflow','inherit');
		});
		
		$('.followus a').click(function(){
			$('.followus a.selected').css({ opacity: 1 });
            $('.followus a.selected').removeClass('selected');
            $(this).addClass('selected');
            $('.likesend').css('display', 'none');
            $('.likesend.box' + $(this).attr('data-type')).css('display', 'block');
        });
		
		$(".followus a").hover(
        function () {
			if(!$(this).hasClass('selected')){
				$('.followus a.selected').css({ opacity: 0.5 });
			}
        },
        function () {
            if(!$(this).hasClass('selected')){
				$('.followus a.selected').css({ opacity: 1 });
			}
        }
        );

		if($('.logged-in-as').html() != null) {
			$('#fbloginbutton').css('display', 'none');
			$('#fbconnect_commentslogin').css('float', 'none');
		}
		
		$("#newsletterLink").colorbox({iframe:true, width:600, innerWidth:600, innerHeight:500,bottom:0,scrolling:false,bottom:"10%",fixed:true,onComplete:function(){ $('#cboxWrapper').css('width', '595'); $('.cboxShare').remove(); }}); 

		$('#subscribenewsletter').click(function(){
			var snlname =  $('#snlname').val();
			var snlemail = $('#snlemail').val();
			var snlwdate = $('#snlwdate').val();
			
			if(snlname == ''){
				alert('Please enter your Name.');
				return false;
			}
			
			if(snlemail == ''){
				alert('Please enter your Email.');
				return false;
			}
			
			href = '<?php echo GetSiteUrl(); ?>/register_popup.php?snlname=' + snlname + '&snlemail='+ snlemail + '&snlwdate=' + snlwdate;
			$(this).attr('href', href);
			
		});
		
		$("#subscribenewsletter").colorbox({iframe:true, width:600, innerWidth:600, innerHeight:500,bottom:0,scrolling:false,bottom:"10%",fixed:true,onComplete:function(){ $('#cboxWrapper').css('width', '595'); $('.cboxShare').remove(); $('.cboxVia').remove(); }}); 

		
		$(".gallery").colorbox({rel:'gallery', height:"90%",
            onComplete:function(){
                var externalurl = $(this).attr('data-external-url');
                var url = $(this).attr('data-url');
                var img = $(this).attr('data-img');
                var desc = $(this).attr('data-desc');
                var html = '';
				
                $("#colorbox").addClass("gallery");
						
                $('.cboxShare').remove();
				$('.cboxVia').remove();
                        
                html = html + '<span class="cboxShare">';
                html = html + '<a target="_blank" href="http://pinterest.com/pin/create/button/?url='+url+'&media='+img+'&description='+desc+'" class="pin-it-button" count-layout="horizontal"><img border="0" src="//assets.pinterest.com/images/PinExt.png" title="Pin It" /></a>';
                html = html + '</span>';
				if(externalurl != ''){
					html = html + '<a target="_blank" class="cboxVia" href="http://' + externalurl + '" rel="nofollow">Via ' + externalurl + '</a>';
				}
                        
                $('#cboxContent').append(html);
            },
			onClosed:function(){
				$("#colorbox").removeClass("gallery");
			}
        });
        $("#cboxContent").hover(
        function () {
            $('.cboxShare').show();
        },
        function () {
            $('.cboxShare').hide();
        }
        );
	});
</script>
	
</body>
</html>