(function( $ ) {
	$(document).ready(function(){

      $('.none-filter').click(function(){
      	$('form#advanced-filter-form').slideDown('slow');
      	$(this).removeClass('none-filter').addClass('yes-filter');
      });

	});
	
	/*$('#publish').click(function() {
		alert('dddddddddd');
	});*/

})( jQuery );