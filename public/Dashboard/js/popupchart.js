$(function(e) {
	
	// Chatpopup
	$(document).on("click", "#chat-popup", function(event) {
		event.preventDefault();
		$('.chat-message-popup').toggleClass('active');
		$('#chat-popup').removeClass('chat-popup-active');
	});		
	
	// Chat Minimize
	$(document).on("click", ".popup-minimize-fullscreen", function(event) {
		event.preventDefault();
		$('.chat-message-popup').removeClass('card-fullscreen');		
		$('#chat-popup').addClass('chat-popup-active');
		setTimeout(function() {
			$('.chat-message-popup').removeClass('active');
		}, 500);
	});
	
	$(document).on("click", ".popup-minimize", function(event) {
		event.preventDefault();
		$('.chat-message-popup').removeClass('active');
		$('.chat-message-popup').removeClass('card-fullscreen');		
		$('#chat-popup').addClass('chat-popup-active');		
	});
	
	
});