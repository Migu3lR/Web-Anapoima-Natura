$(document).ready(function() {
	smoothScroll.init({
		selector: '[link]', // Selector for links (must be a valid CSS selector)
		speed: 1000, // Integer. How fast to complete the scroll in milliseconds
		easing: 'easeOutQuad', // Easing pattern to use
		offset: 64, // Integer. How far to offset the scrolling anchor location in pixels
		updateURL: true, // Boolean. If true, update the URL hash on scroll
	});
});

