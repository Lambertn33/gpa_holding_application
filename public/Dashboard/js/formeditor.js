$(function(e) {
	//WYSIWYG Editor
	$('.content').richText();
	
	//Summernote
	$('#summernote').summernote({
		placeholder: 'Hello bootstrap 4',
		tabsize: 3,
		height: 300
	});
});