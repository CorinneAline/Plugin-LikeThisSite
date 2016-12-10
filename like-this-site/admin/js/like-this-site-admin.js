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

$('td #icone input:radio').click(function () {
  alert(this.value);
  $('#resultat').html('<i class="fa fa-2x fa-'+(this.value)+'"></i>');
});

$('td #color input:radio').click(function () {
  var couleur = "#"+(this.value);
  $('#resultat i').css("color", couleur);
});

$('.colorOk').click(function (e) {
  e.preventDefault();
  var inputColor = $('#valueInput').val();
  var couleur = "#"+(inputColor);
  $('#resultat i').css("color", couleur);
});

$('#like_this_site_label').change(function() {
   var valeur = (this.value);
   alert(valeur);
   $('#resultat').append('<strong>'+(this.value)+'</div>');
});
   
})( jQuery );
