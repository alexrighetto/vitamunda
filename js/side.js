jQuery(document).ready(function($){
	
	//Toggle Side Cart
	function toggle_sidecart(toggle_type){
		var toggle_element = $('.axl-side-modal , body, html'),
			toggle_class   = 'axl-side-active';

		if(toggle_type == 'show'){
			toggle_element.addClass(toggle_class);
		}
		else if(toggle_type == 'hide'){
			toggle_element.removeClass(toggle_class);
		}
		else{
			toggle_element.toggleClass('axl-side-active');
		}

		//unblock_cart();
	}

	
	$('body').on('click','.axl-side-basket,.axl-side-sc-cont', function(e){
		e.preventDefault();
		e.stopImmediatePropagation();
		toggle_sidecart();
	});
	
	//Set Cart content height
	function content_height(){
		var header = $('.axl-side-header').outerHeight(), 
			footer = $('.axl-side-footer').outerHeight(),
			screen = window.innerHeight,
			$cont  = $('.axl-side-container');

			console.log("header " + header);
		
			$cont.css({"top": "", "bottom": ""});
			var body_height = 'calc(100% - '+(header+footer)+'px)';
		
				
		
				$cont.css({"top": "0", "bottom": "0"});
			
		
			console.log("body_height " + body_height);

		$('.axl-side-body').css('height',body_height);

	};

	content_height();

	$(window).resize(function(){
		console.log("resizing");
    	content_height();
	});
	
	
	
	//Close Side Cart
	function close_sidecart(e){
		$.each(e.target.classList,function(key,value){
			
				$('.axl-side-modal , body, html').removeClass('axl-side-active');
			
		})
	}

	$('body').on('click','.axl-side-close , .axl-side-opac',function(e){
		console.log("click close");
		e.preventDefault();
		close_sidecart(e);
	});
	
	$(".axl-side-sc-cont").click(function(){
    var post_id = $(this).attr("rel"); //this is the post id
    $(".axl-side-body").html("content loading");
    $.ajax({
        url: woof_ajaxurl.ajax_url,
        type: 'post|get|put',
        data: {
            action: 'my_php_function_name',
            post_id: post_id
        },
        success: function(data) {
            // What I have to do...
        },
        fail: {
            // What I have to do...
        }
    });
    return false;
});
	
})