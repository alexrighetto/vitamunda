// JavaScript Document
jQuery(function($) {
	
	var navbar_height = parseInt($('#main-nav').outerHeight()) + 20;
	
	$('#left-sidebar .sidebar__outer').stickySidebar({
		topSpacing: 0,
		bottomSpacing: 0
	});
	
	$('.tab-sidebar .sidebar__outer').stickySidebar({
		topSpacing: navbar_height,
		bottomSpacing: 0
	});


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