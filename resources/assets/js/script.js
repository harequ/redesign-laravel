$(function() {

	var fadeStart = 0,
		fadeUntil = 400,
		appearStart = 400,
		hero = $('.hero'),
		snow = $('.snow'),
		threeCircles = $('#intro dl'),
		nav = $('#nav'),
		pull = $('#pull'),
		heightOfIntro = $('header').height(),
		menu = $('#nav .navbar');

	if(nav.length) {
		var	navOffset = $('#nav').offset().top,
			navHeight = nav.outerHeight(),
			menuHeight = menu.height();
	}
	// Smooth scrolling
	$(".scroll").click(function(event) {
	    event.preventDefault();
	    $('html, body').animate({ scrollTop : $(this.hash).offset().top - navHeight + 1 } , 700);
    });

	// Scrolling events
	$(window).scroll(function() {
		var offset = $(this).scrollTop(),
			
	    	opacity = 0,
	    	opacity2 = 1;

	    // Parallax effect for snow
		if(offset <= heightOfIntro) {
			snow.css({ 'transform' : 'translate(0px, ' + offset * 1.2 +'px)' });
		}

		// Fade in and Fade out effect for herotext and threeCircles
	    if(offset <= fadeStart) {
	        opacity = 1;
	        opacity2 = 0;
	    } else if( offset <= fadeUntil ){
	        opacity = 1 - offset/fadeUntil;
	        opacity2 = offset/fadeUntil;
	    }

	    if($(window).width() > 1024) {
	    	hero.css('opacity', opacity);
	    }
	    threeCircles.css('opacity', opacity2);

	    // Highlighting active nav menu items
	    if(nav.length) {
		    var windowPos = offset + navHeight;

		    $('.navbar li a').removeClass('active');

		    if(windowPos > $('#work').offset().top) {
			    $('.navbar li a').removeClass('active');
			    $('a[href$="#work"]').addClass('active');
		    }

		    if(windowPos > $('#design').offset().top) {
			    $('.navbar li a').removeClass('active');
			    $('a[href$="#design"]').addClass('active');
		    }

		    if(windowPos > $('#skills').offset().top) {
			    $('.navbar li a').removeClass('active');
			    $('a[href$="#skills"]').addClass('active');
		    }

		    if(windowPos > $('footer').offset().top) {
			    $('.navbar li a').removeClass('active');
			    $('a[href$="#contact"]').addClass('active');
		    }
		}
	});

	// When clicking on Menu button, it toggles the menu
	$(pull).on('click', function(e) {
		e.preventDefault();
		menu.slideToggle();
	});

	// When menu is opened (in mobile version), slideup the menu when clicking anywhere outside
	$(document).on('click', function(event) {
		if (!$(event.target).closest(pull).length && pull.is(':visible') && menu.is(':visible')) {
			menu.slideUp();
		}
	});

    // Remove style attribute (display:block; or display:none;) when resize the window
	$(window).resize(function() {
		menu.removeAttr('style');	
	});

	/*
	=============================================
	=== Carousel
	=============================================
	*/

	$('.carousel').slick({
		dots: true,
		autoplay: true,
  		autoplaySpeed: 3000
	});

	/*
	=============================================
	=== Sticky nav 
	=============================================
	*/
	if(nav.length) {
		var sticky = new Waypoint.Sticky({
		  element: $(nav)
		});
	}

	/*
	=============================================
	=== IE Fix for "jumpy" fixed background
	=============================================
	*/
	if(navigator.userAgent.match(/Trident\/7\./)) {
        $('body').on("mousewheel", function () {

            event.preventDefault();
            var wheelDelta = event.wheelDelta;

            var currentScrollPosition = window.pageYOffset;
            window.scrollTo(0, currentScrollPosition - wheelDelta);
        });
	}

	/*
	=============================================
	=== Trigger for skills graph animation
	=============================================
	*/
	var html = $('#html'),
		css = $('#css'),
		javascript = $('#javascript'),
		php = $('#php'),
		wordpress = $('#wordpress'),
		mysql = $('#mysql');

	$('.skillz').waypoint(function(direction) {
		if(direction == 'down') {
			html.addClass('html');
			css.addClass('css');
			javascript.addClass('javascript');
			php.addClass('php');
			wordpress.addClass('wordpress');
		} else {
			html.removeClass('html');
			css.removeClass('css');
			javascript.removeClass('javascript');
			php.removeClass('php');
			wordpress.removeClass('wordpress');
		}
	}, {offset : '95%'});

	/*
	=============================================
	=== Modal overlay window (submit form) 
	=============================================
	*/
	$('.email').click(function() {
		$('.overlay').addClass('show-modal');
		return false;
	});

	$('.close-btn').click(function() {
		$('.overlay').removeClass('show-modal');
	});

	$('.overlay').click(function(event) {
		if(event.target == this) {
			$('.overlay').removeClass('show-modal');
		}
	});

	
	$('#get-in-touch').validate({
		rules: {
			email: {
				required: true,
				email: true
			},
			name: {
				required: true
			},
			message: {
				required: true
			}
		},
		submitHandler: function(form) {
			var form = $('#get-in-touch');
			var action = form.attr('action');
			var CSRF_TOKEN = form.find('input[name=_token]').val();
			var name = form.find('input[name=name]').val();
			var email = form.find('input[name=email]').val();
			var message = form.find('textarea[name=message]').val();

			var options = {
				type: 'POST',
				url: action,
				data: ({'name' : name, 'email' : email, 'message' : message}),
				headers: {
					'X-CSRF-TOKEN': CSRF_TOKEN 
				},
				success: function(data) {
					if(data == "success")
						form.replaceWith("<div class='success'><p>Your message has been sent.</p><p>Thank you!</p></div>");
					else 
						form.replaceWith("<div class='success'><p>Something went wrong.</p><p>Please try again later.</p></div>");
				}
			};

    		$(form).ajaxSubmit(options);
  		}
  	});

	/*
	=============================================
	=== Pulsing circle 
	=============================================
	*/
	var circle = $('#intro .circle');
	$('#intro h1').hover(function() {
		circle.toggleClass('open');
	});
	


});