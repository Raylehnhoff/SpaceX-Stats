$(document).ready(function(){
	var activePage = 1;
	var lastAnimation = 0;
	var animLength = 1000;
	var rest = 200;
	var slideCount = $('div.main').children('section').length;

	// All three methods of changing slides
	$(window).on('mousewheel DOMMouseScroll', function(event){
		event.preventDefault();			
		if ((event.originalEvent.wheelDelta < 0) || (event.originalEvent.detail > 0) ) {
			scroll('down');
		} else {		
			scroll('up');			
		}					
	});

	$(window).on('keydown', function(event) {
		event.preventDefault();
		if (event.which == 40) {
			scroll('down');
		}
		if (event.which == 38) {
			scroll('up');
		}
	});

	$('li').on('click','a',function(event) {
		event.preventDefault();
		activePage = $(this).data("index");
		move(activePage);
	});

	$('#homelink').on('click',function(event) {
		event.preventDefault();
		activePage = 1;
		move(activePage);
	});

	$('div#bottomchevron').on('click',function(event) {
		scroll('down');
	});

	// Function to scroll pages
	function scroll(direction) {
		currentAnimation = new Date().getTime();

		// Prevent scrolling during a scroll
		if (currentAnimation > lastAnimation + animLength + rest) {
			if (direction == 'down') {
				// Slide back to top if reaching the end
				if (activePage >= slideCount) {
					activePage = 1;
				} else {
					activePage++;
				}
			}
			if (direction == 'up') {
				// Slide to bottom if at the top
				if (activePage <= 1) {
					activePage = slideCount;
				} else {
					activePage--;
				}						
			}
			
			move(activePage);
			lastAnimation = currentAnimation;
		}				
	}

	function move(moveToPage) {
		var offset = -100 * (moveToPage - 1);
		// Use translate3d to enable hardware acceleration on webkit browsers
		// Use translateY with -o-transform because Opera doesn't support 3D
		$('div.main').css({
			'transform' : 'translate3d(0, '+offset+'%, 0)', 
			'transition' : 'all '+animLength+'ms ease 0s',

			'-webkit-transform' : 'translate3d(0, '+offset+'%, 0)',  
			'-webkit-transition' : 'all '+animLength+'ms ease 0s',

			'-ms-transform' : 'translateY('+offset+'%)',  
			'-ms-transition' : 'all '+animLength+'ms ease 0s',

			'-moz-transform' : 'translate3d(0, '+offset+'%, 0)',  
			'-moz-transition' : 'all '+animLength+'ms ease 0s',

			'-o-transform' : 'translateY('+offset+'%)',  
			'-o-transition' : 'all '+animLength+'ms ease 0s'
		});
		setActivePage(moveToPage);
	}

	function setActivePage(activePage) {
		$('a, section').removeClass('active');
		$('a[data-index="'+activePage+'"], section[data-index="'+activePage+'"]').addClass('active').trigger('classChange');
	}


});