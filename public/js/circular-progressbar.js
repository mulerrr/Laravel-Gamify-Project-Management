;
(function ($) {
	$.fn.loading = function () {
		var DEFAULTS = {
			backgroundColor: 'red',
			progressColor: '#4b86db',
			percent: 75,
			label: 'productivity',
			duration: 2000
		};	
		
		$(this).each(function () {
			var $target  = $(this);

			var opts = {
			backgroundColor: $target.data('color') ? $target.data('color').split(',')[0] : DEFAULTS.backgroundColor,
			progressColor: $target.data('color') ? $target.data('color').split(',')[1] : DEFAULTS.progressColor,
			percent: $target.data('percent') ? $target.data('percent') : DEFAULTS.percent,
			label: $target.data('label') ? $target.data('label') : DEFAULTS.label,
			duration: $target.data('duration') ? $target.data('duration') : DEFAULTS.duration
			};
			// console.log(opts);
	
			$target.append('<div class="latar"></div><div class="putar"></div><div class="kiri"></div><div class="kanan"></div><div class="points-label"><span>' + opts.percent + '%</span><label>' + opts.label + '</label></div>');
	
			$target.find('.latar').css('background-color', opts.backgroundColor);
			$target.find('.kiri').css('background-color', opts.backgroundColor);
			$target.find('.putar').css('background-color', opts.progressColor);
			$target.find('.kanan').css('background-color', opts.progressColor);
	
			var $rotate = $target.find('.putar');
			setTimeout(function () {	
				$rotate.css({
					'transition': 'transform ' + opts.duration + 'ms linear',
					'transform': 'rotate(' + opts.percent * 3.6 + 'deg)'
				});
			},1);		

			if (opts.percent > 50) {
				var animationRight = 'toggle ' + (opts.duration / opts.percent * 50) + 'ms step-end';
				var animationLeft = 'toggle ' + (opts.duration / opts.percent * 50) + 'ms step-start';  
				$target.find('.kanan').css({
					animation: animationRight,
					opacity: 1
				});
				$target.find('.kiri').css({
					animation: animationLeft,
					opacity: 0
				});
			} 
		});
	}
})(jQuery);