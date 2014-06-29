(function( $ ) {
	$(document).ready(function(){

      $('.none-filter').click(function(){
      	$('form#advanced-filter-form').slideDown('slow');
      	$(this).removeClass('none-filter').addClass('yes-filter');
      });

	$(".show-box").click(function(){
        $(".cr-none").slideToggle("slow");
        $(this).toggleClass("active");
    });
	

	$('select#location_name,select#location_region').scombobox();
});

})( jQuery );