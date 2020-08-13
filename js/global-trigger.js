// JavaScript Document


jQuery(document).ready(function($) {
	$.mediaquery({
	  minWidth     : [ 320, 576, 768, 992, 1200 ],
	  maxWidth     : [ 1200, 992, 768, 576, 320 ],
	  minHeight    : [ 400, 800 ],
	  maxHeight    : [ 800, 400 ]
	});
	
	$("input[type='number']").number();
	
	
  	$('[data-toggle="tooltip"]').tooltip()

	// set endpoint and your access key
	
	$(window).on("mqchange.mediaquery", function(e, state) {
		if(state.minWidth < 768 ){
		   console.log('media query minWidth è inferiore a 768 | ' + state.minWidth, state.maxWidth);
		   }else{
			 console.log('media query minWidth è superiore a 768 | ' + state.minWidth, state.maxWidth);   
		   }
	  
	});
	

});

/**
 *  Backdrop for the menu.
 *
 * @require: Jquery
 * @works: in every page ( not mobile )
 */

jQuery(document).ready(function() {
	console.log('Backdrop for the menu');	
	jQuery(function($) {
		$('li.mega-menu-item').on('open_panel', function() {
			//console.log('Sub menu opened');
			$('#staticBackdrop').addClass("show").addClass('backdrop');
		});
	});	

	jQuery(function($) {
		$('li.mega-menu-item').on('close_panel', function() {
			//console.log('Sub menu closed');
			$('#staticBackdrop').removeClass("show").removeClass('backdrop');
		});
	});
});


/**
 *  Backdrop for the menu.
 *
 * @require: Jquery, bootstrap, cockie.js
 * @works: in home page only
 */

jQuery(document).ready(function() {


    console.log('log-in popup');

    var my_selector = 'body.home:not(.logged-in) #user-nav .mega-xoo-el-login-tgr';
    var redirect_link = "<a class=\"btn btn-warning btn-gradient\" href='https://www.vitamunda.it/my-account/'>Accedi</a>";
    var cookie = Cookies.get('popup-login');
	

    if (cookie != 5) {
        setTimeout(function() {
			
			jQuery(window).on("mqchange.mediaquery", function(e, state) {
				if(state.minWidth > 768 ){
					//mostra solo su desktop
					jQuery(my_selector).popover({
						placement: 'bottom',
						trigger: 'focus',
						container: 'body',
						html: true,
						content: redirect_link
					}).popover('show');

					Cookies.set('popup-login', '1');
				   }

			});
			
            

        }, 5000);
    } 

    jQuery(my_selector).on('shown.bs.popover', function() {

        setTimeout(function() {
            jQuery(my_selector).popover('hide');
        }, 10000);
    })
	jQuery(window).on("mqchange.mediaquery", function(e, state) {
		if(state.minWidth < 768 ){
			jQuery(my_selector).popover('hide');
		}
	}
    jQuery(window).scroll(function() {

        jQuery(my_selector).popover('hide');

    });
});



/**
 *  menu
 *
 * @require: Jquery, cockie.js
 * @works: in all pages
 */



//https://wicky.nillia.ms/headroom.js/playroom/

jQuery(document).ready(function($) {
	
	console.log('headroom');
	
	$("#product-nav").headroom();
	
	
	$("#wrapper-navbar").headroom({
		"offset": 205,
		"tolerance": 5,
		"classes": {
			"initial": "animated",
			"pinned": "slideDown",
			"unpinned": "slideUp"
		},
		onUnpin: function() {
			var navbar_height = parseInt($('#main-nav').outerHeight())+ 
								parseInt($('#product-nav').outerHeight());
			$("#product-tab").sticky("destroy");
			$("#product-tab").sticky({
				offset: navbar_height
			});
		},
		onPin: function() {
			$("#product-tab").sticky("destroy");
			
			var navbar_height = parseInt($('#main-nav').outerHeight()) + 
								parseInt($('#user-nav').outerHeight()) + 
								parseInt($('#product-nav').outerHeight());
			
			$("#product-tab").sticky({
				offset: navbar_height
			});
		},
	});
});	
	

/**
 *  product scroll
 *
 * @require: Jquery
 * @works: in product pages
 */


jQuery(document).ready(function($) {	
	console.log('scroll');
	// Select all links with hashes
$('a[href*="#"]')
  // Remove links that don't actually link to anything
  .not('[href="#"]')
  .not('[href="#0"]')
  .click(function(event) {
    // On-page links
    if (
      location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') 
      && 
      location.hostname == this.hostname
    ) {
      // Figure out element to scroll to
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
      // Does a scroll target exist?
      if (target.length) {
        // Only prevent default if animation is actually gonna happen
        event.preventDefault();
        $('html, body').animate({
          scrollTop: target.offset().top
        }, 1000, function() {
          // Callback after animation
          // Must change focus!
          var $target = $(target);
          $target.focus();
          if ($target.is(":focus")) { // Checking if the target was focused
            return false;
          } else {
            $target.attr('tabindex','-1'); // Adding tabindex for elements not focusable
            $target.focus(); // Set focus again
          };
        });
      }
    }
  });
});




jQuery(document).ready(function($) {	

	var maxHeight = 0;
	var productTarget = $(".woocommerce-loop-product__title");

	productTarget.each(function(){
	   if ($(this).height() > maxHeight) { maxHeight = $(this).height(); }
	});

	productTarget.height(maxHeight);

	$( window ).resize(function() {

		productTarget.each(function(){
	   if ($(this).height() > maxHeight) { maxHeight = $(this).height(); }
	});

	productTarget.height(maxHeight);

	});	
	
	
});


