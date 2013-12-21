(function($) {
	$.fn.countdown = function(options, callback) {
		var $self = $(this);

		var settings = {
			'date' : null,
		}

		if(options) {
			$.extend(settings, options);
		}

		function countdownProcessor() {
			var eventDate = Date.parse(settings.date) / 1000;
			var currentDate = Math.floor($.now() / 1000);

			if (eventDate <= currentDate) {
				callback.call(this);
				clearInterval(interval);
			}

			var secondsBetween = eventDate - currentDate;

			var days = Math.floor(secondsBetween / (60 * 60 * 24));
			secondsBetween -= days * 60 * 60 * 24;

			var hours = Math.floor(secondsBetween / (60 * 60));
			secondsBetween -= hours * 60 * 60;

			var minutes = Math.floor(secondsBetween / 60); 
			secondsBetween -= minutes * 60;

			var seconds = secondsBetween;	

			//update the HTML
			$self.find('.days').text(days);
			$self.find('.hours').text(hours);
			$self.find('.minutes').text(minutes);
			$self.find('.seconds').text(seconds);

			days == 1 ? $self.find('.refDays').text('Day') : $self.find('.refDays').text('Days');
			hours == 1 ? $self.find('.refHours').text('Hour') : $self.find('.refHours').text('Hours');
			minutes == 1 ? $self.find('.refMinutes').text('Minute') : $self.find('.refMinutes').text('Minutes');
			seconds == 1 ? $self.find('.refSeconds').text('Second') : $self.find('.refSeconds').text('Seconds');

		}

		countdownProcessor();
		interval = setInterval(countdownProcessor, 1000);
	}
	
})(jQuery);