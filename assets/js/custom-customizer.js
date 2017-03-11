/**
 * Theme Customizer scripts.
 *
 * @package Thunderbear
 */
(function($){
	$(document).ready(function() {
		$('.thunderbear-toggle-description').on('click',function(e){
			e.preventDefault();
			$(this).toggleClass('thunderbear-description-opened').parents('.customize-control-title').siblings('.thunderbear-control-description').slideToggle();
		});
	});
})(jQuery);