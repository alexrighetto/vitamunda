// JavaScript Document

//Footer scripts

//function traced by a plugin (//sp-faq/faq.php)
jQuery(document).ready(function() {
		// check if the plugin is loaded https://stackoverflow.com/questions/400916/how-can-i-check-if-a-jquery-plugin-is-loaded
		if(jQuery().accordionfaq) {
			jQuery('.faq-accordion [data-accordion]').accordionfaq({
			 singleOpen: true,
			 transitionEasing: 'ease',
			  transitionSpeed: 300
			}); 
		}else{
			console.log("ERRORE: jQuery().accordionfaq non caricato.")
		}
});
