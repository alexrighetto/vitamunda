// JavaScript Document
jQuery(function($) {
	
	
    $("#mega-menu-primary .mega-sub-menu .mega-menu-link").mouseover(function() { 
			//cerca nel primo gruppo 'immagine e registra l'url.
            var image_name = $(this).attr("href");
			
		//cerca nel secondo gruppo e individua l'immagine con lo stesso url.
		
			//alert( "attr href " +  image_name );
			
			var allListElements = $( "[alt='img1']" );
		
			var image_link = $( ".images-group [alt='"+image_name+"']" ).attr("src");
		
			//alert( "attr scr " +  image_link );
		
            $(".target").attr("src", image_link);
		
        });
        
});


