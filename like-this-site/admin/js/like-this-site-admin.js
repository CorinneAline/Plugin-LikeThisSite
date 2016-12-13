(function( $ ) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */
   
$('td input:radio').prop('checked', false);   
$('#like_this_site_label').val("");

$('td #like_this_site_icone input:radio').click(function () {
  $('#like_this_site_resultat').html('<i class="fa fa-2x fa-'+(this.value)+'"></i>');
});

$('td #like_this_site_color input:radio').click(function () {
  var couleur = "#"+(this.value);
  $('#like_this_site_resultat i').css("color", couleur);
});

$('.like_this_site_colorOk').click(function (e) {
  e.preventDefault();
  var inputColor = $('#valueInput').val();
  var couleur = "#"+(inputColor);
  $('#like_this_site_resultat i').css("color", couleur);
});

$('#like_this_site_label_ok_btn').click(function(e) {
   e.preventDefault();
   var label = $('#like_this_site_label').val();
   var $newdiv1 = $( "<div id='newLabel'>"+label+"</div>" );
 
  $( "#like_this_site_resultat" ).prepend( $newdiv1 );
  $('input[name=like_this_site_position][value="top"]').prop('checked',true);
});

$('td #like_this_site_position input:radio').click(function () {
  var position = (this.value);
  var label = $('#like_this_site_label').val();
  $('#newLabel').remove();  
  
  if (this.value == "top"){
   var $newdiv2 = $( "<div id='object2'>"+label+"</div>" );
   $( "#like_this_site_resultat" ).prepend( $newdiv2 );   
   }

  if (this.value == "bottom"){
   var $newdiv2 = $( "<div id='object2'>"+label+"</div>" );
   $( "#like_this_site_resultat" ).append( $newdiv2 );   
   }   
}); 

$('#reset').click(function (e) {
  e.preventDefault(); 
  window.location.href = window.location.href;
});   
})( jQuery );
