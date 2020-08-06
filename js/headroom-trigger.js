//https://wicky.nillia.ms/headroom.js/playroom/

jQuery( document ).ready(function($) {
$("#wrapper-navbar").headroom({
  "offset": 205,
  "tolerance": 5,
  "classes": {
    "initial": "animated",
    "pinned": "slideDown",
    "unpinned": "slideUp"
  },
	onUnpin : function() {
		

		
		var navbar_height = parseInt($('#main-nav').outerHeight());

		
	
		$("#product-tab").sticky("destroy");
		$("#product-tab").sticky({ offset: navbar_height });
		
	},
	onPin : function() {
		$("#product-tab").sticky("destroy");
		
		var navbar_height = parseInt($('#main-nav').outerHeight()) + parseInt($('#user-nav').outerHeight());
		
		$("#product-tab").sticky({ offset: navbar_height });
		
		
	},
});
	
	
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

;(function ($, window) {

var intervals = {};
var removeListener = function(selector) {

	if (intervals[selector]) {
		
		window.clearInterval(intervals[selector]);
		intervals[selector] = null;
	}
};
var found = 'waitUntilExists.found';

/**
 * @function
 * @property {object} jQuery plugin which runs handler function once specified
 *           element is inserted into the DOM
 * @param {function|string} handler 
 *            A function to execute at the time when the element is inserted or 
 *            string "remove" to remove the listener from the given selector
 * @param {bool} shouldRunHandlerOnce 
 *            Optional: if true, handler is unbound after its first invocation
 * @example jQuery(selector).waitUntilExists(function);
 */
 
$.fn.waitUntilExists = function(handler, shouldRunHandlerOnce, isChild) {

	var selector = this.selector;
	var $this = $(selector);
	var $elements = $this.not(function() { return $(this).data(found); });
	
	if (handler === 'remove') {
		
		// Hijack and remove interval immediately if the code requests
		removeListener(selector);
	}
	else {

		// Run the handler on all found elements and mark as found
		$elements.each(handler).data(found, true);
		
		if (shouldRunHandlerOnce && $this.length) {
			
			// Element was found, implying the handler already ran for all 
			// matched elements
			removeListener(selector);
		}
		else if (!isChild) {
			
			// If this is a recurring search or if the target has not yet been 
			// found, create an interval to continue searching for the target
			intervals[selector] = window.setInterval(function () {
				
				$this.waitUntilExists(handler, shouldRunHandlerOnce, true);
			}, 500);
		}
	}
	
	return $this;
};
 
}(jQuery, window));


jQuery( document ).ready(function($) {
	
$('#woof_html_buffer').waitUntilExists(function(){
	window.alert('hurra');
});
	
});
	