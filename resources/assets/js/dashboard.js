$(document).ready(function() {

	// Checking depends on window.width show or not show .sidebar-nav
	if ( $(window).width() < 750) {
		var wrapper = $('#wrapper');
		var span = $('.sidebar-nav li span');
	   	if (wrapper.hasClass('menu-displayed')) {
	   		wrapper.removeClass('menu-displayed').addClass('menu-not-displayed');
	   		span.addClass('hide-span');
	   	} else if (wrapper.hasClass('menu-not-displayed')) {
	   		wrapper.removeClass('menu-not-displayed').addClass('menu-displayed');
	   		span.removeClass('hide-span');
		}
	}

	// Show/Hide sidebar
	$('#menu-toggle').on('click', function(e) {
		e.preventDefault();
		$('#wrapper').toggleClass('menu-not-displayed').toggleClass('menu-displayed');
		$('#menu-toggle i').toggleClass('fa fa-chevron-right').toggleClass('fa fa-chevron-left');

	    var span = $('.sidebar-nav li span');
		if (span.hasClass('hide-span')) {
			span.animate({
				opacity: 1,
			}, 200, function() {
				$(this).removeClass('hide-span');
			});
		} else {
			span.animate({
				opacity: 0,
			}, 200, function() {
				$(this).addClass('hide-span');
			});
		}

	});

	// // Noty function initialisation
	// function callNoty(text, type, layout, timeout, href) {
	// 	noty({
 //            text        : text,
 //            type        : type,
 //            animation: {
	// 	        open: 'animated zoomIn', // Animate.css class names
	// 	        close: 'animated zoomOut', // Animate.css class names
	// 	    },
 //            dismissQueue: true,
 //            layout      : layout,
 //            timeout 	: timeout,
 //            modal 		: true,
 //            theme       : 'redesign',
 //            buttons     :  (href) ?
 //            [
 //                {addClass: 'btn btn-default', text: 'Ok', onClick: function ($noty) {
 //                    $noty.close();
 //                    if(href) {
 //                    	window.location.replace(href);
 //                    }

 //                }
 //                },
 //                {addClass: 'btn btn-default', text: 'Cancel', onClick: function ($noty) {
 //                    $noty.close();
 //                }
 //                }
 //            ] : false
 //        });
	// }

	// Noty call before delete
	$('.delete').on('click', function(e) {
		e.preventDefault();
		var href = $(this).attr('href');
		// callNoty('Are you sure?', 'confirm', 'center', false, href);
		noty({
			type: 'confirm',
			theme: 'redesign',
			modal: true,
			animation: {
		        open: 'animated zoomIn', // Animate.css class names
		        close: 'animated zoomOut', // Animate.css class names
		    },
			layout: 'center', 
			text: 'Are you sure?', 
			buttons     : 
            [
                {addClass: 'btn btn-default', text: 'Ok', onClick: function ($noty) {
                    $noty.close();
                    if(href) {
                    	window.location.replace(href);
                    }

                }
                },
                {addClass: 'btn btn-default', text: 'Cancel', onClick: function ($noty) {
                    $noty.close();
                }
                }
            ]
		});
		
	});

	// Custom checkbox
	$("[name='published']").bootstrapSwitch({
		size: 'mini',
		onText: 'on',
		offText: 'off',
		onColor: 'success',
		offColor: 'default',
		labelWidth: 0
	});

	// Adding images to project through AJAX
	$('#add-image').on('click', function(e) {

		e.preventDefault();

		var form = $('#form-image');
		var CSRF_TOKEN = $('input[name=_token]').val();
		var action = $('#form-image').attr('action');
		var imagesDiv = $('#project-images .row');
		var imgFile = $('#img-file');
		var altVal = form.find('#alt').val();
		var alt = form.find('#alt');

		var formData = new FormData();
		formData.append('imgFile', imgFile[0].files[0]);
		formData.append('alt', altVal);

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
				switch(data.img) {
					case 'projectImage' : 
						imagesDiv.append('<div class="col-xs-6 col-sm-4 col-md-3"><div class="thumbnail"><img src="' + data.name + '"><span><button class="remove-image btn btn-danger btn-sm glyphicon glyphicon-trash"></button></span></div></div>'); break;
					case 'illustration' :
						imagesDiv.append('<div class="col-xs-6 col-sm-3 col-md-2"><div class="thumbnail"><img src="' + data.name + '"><span><button class="remove-illustration btn btn-danger btn-sm glyphicon glyphicon-trash"></button></span></div></div>'); break;
					default : 
						noty({type: 'error', theme: 'redesign', layout: 'top', text: 'You need to attach image before upload / alt text is required', timeout: 3000});
				}
			},
			error: function(xhr) {
				imagesDiv.append('<li>' + xhr.responseText + '</li>');
			}
		});

		// clearing fields for a new input
		imgFile.replaceWith(imgFile.val('').clone(true));
		alt.val('');
	});

	// Removing images from project through AJAX
	$('#project-images').on('click', '.remove-image', function(e) {
		e.preventDefault();

		var url = window.location.href;
		var index = url.indexOf('/edit')
		url = url.substring(0, index);
		var thumbnail = $(this).parent().parent().parent();
		var src = $(this).parent().parent().find('img').attr('src');
		var imageName = src.split('/').reverse()[0];

		$.ajax({
			type: 'POST',
			url: url + '/remove-image',
			data: ({'imageName' : imageName}),
			headers: {
            	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        	},
			success: function(response) {
				if(response == 'ok')
					thumbnail.remove();
				else {
					console.log(response);
				}
			},
			error: function(xhr) {
				$('body').replaceWith('<body>' + xhr.responseText + '</body>');
			}
		});
	});

	// Removing illustrations/logos through AJAX
	$('#project-images').on('click', '.remove-illustration', function(e) {
		e.preventDefault();

		var url = window.location.href;
		var thumbnail = $(this).parent().parent().parent();
		var src = $(this).parent().parent().find('img').attr('src');
		var imageName = src.split('/').reverse()[0];

		$.ajax({
			type: 'POST',
			url: url + '/remove',
			data: ({'imageName' : imageName}),
			headers: {
            	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        	},
			success: function(response) {
				if(response == 'ok')
					thumbnail.remove();
				else {
					console.log(response);
				}
			},
			error: function(xhr) {
				$('body').replaceWith('<body>' + xhr.responseText + '</body>');
			}
		});
	});

}); // document ready