$(document).ready(function(){
	var sheetmenu = $('div.dropdown > ul');
	sheetmenu.hide();

	$('div.dropdown').hover(function(){
		$(sheetmenu).stop().slideToggle(500);
	});

	// Hide any inactive data sheets
	$('section [data-sheet]').not("li, [data-sheet='1']").hide();

	$('div.dropdown li').on('click', function() {
		var nextSheet = $(this).data('sheet');
		var nextSheetName = $(this).text();

		// Check if a data sheet has a unique background image
		if ($(this).data('image')) {
			var nextSheetBackground = $(this).data('image');
		}

		// Replace the data-sheet value and the name of the display span upon click
		$('section.active span').data('sheet', nextSheet);
		$('section.active span').text(nextSheetName);

		// Hide current [data-sheet] values
		$('section.active div[data-sheet]:visible').stop().fadeOut(500, false, function() {
			$('section.active div[data-sheet="'+nextSheet+'"]').stop().fadeIn(500, false);
		});

		if (nextSheetBackground) {
			$('section.active').css('background-image', 'url('+nextSheetBackground+')');
		}
		
	});
});