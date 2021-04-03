$(function(e){
	
	//Default Calendar
	$('.calendar').pignoseCalendar();
	 
	//Input Calendar
	$('input.calendar').pignoseCalendar({
		format: 'YYYY-MM-DD' // date format string. (2017-02-02)
	});
	
	//Modal Calendar
	$('a.modal-calendar').pignoseCalendar({
		format: 'YYYY-MM-DD' // date format string. (2017-02-02)
	});
	
	//Dark-theme Calendar
	$('.calendar-dark').pignoseCalendar({
		theme: 'dark' // light, dark, blue
	});
	
	//Blue-theme Calendar
	$('.calendar-blue').pignoseCalendar({
		theme: 'blue' // light, dark, blue
	});
});