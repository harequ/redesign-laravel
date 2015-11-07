$(document).ready(function() {

	$.material.init();
	$('div.alert').delay(3000).slideUp(300);

	// $('#add-image').on('click', function(e) {
	// 	e.preventDefault();
	// 	var file = $('#projectImg').files[0];
	// 	console.log(file.name);
	// });
	// 

	// Adding images to project through AJAX
	$('#add-image').on('click', function(e) {

		e.preventDefault();

		var CSRF_TOKEN = $('input[name=_token]').val();
		var form = $('#form-image');
		var action = $('#form-image').attr('action');
		var imagesUl = $('#project-images');
		var imgFile = $('#img-file');

		var formData = new FormData();
		formData.append('imgFile', imgFile[0].files[0]);

		$.ajax({
			type: 'POST',
			url: action,
			processData: false,
  			contentType: false,
			data: formData,
			headers: {
				'X-CSRF-TOKEN': CSRF_TOKEN 
			},
			success: function(data) {
				imagesUl.append('<li><img src="' + data.name + '"></li>');
			},
			error: function() {
				imagesUl.append('<li>Something went wrong.</li>');
			}
		});

		imgFile.replaceWith(imgFile.val('').clone(true));
	});

}); // document ready