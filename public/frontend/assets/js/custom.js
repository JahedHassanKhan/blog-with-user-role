(function ($) {

	"use strict";

	//Global Variables

	var $window = $(window),
		win_height_padded = $window.height() * 1.1;

	// navbar fixed scrolling
	$window.on("scroll", function () {

		var bodyScroll = $window.scrollTop(),
			navbar = $(".fixed_header"),
			//get top nav logo image
			logo = $(".fixed_header .logo_head img");

		if (bodyScroll > 0) {

			navbar.addClass("fixed");
			//logo change when scroll nav bar
			//logo.attr('src', 'assets/images/logoscroll.png');

		} else {

			navbar.removeClass("fixed");
			//logo back when nav bar top
			//logo.attr('src','logo.png');
		}
	});

	// Mobile toogle menu
	$('.open_mobile_menu').on('click', function () {
		$(this).addClass('showm');
		$($(this).data('target')).stop().fadeIn().addClass('show_mobile_nav');
	});
	$('.close_mobile_menu, .cover_mobile_menu').on('click', function () {
		$('.open_mobile_menu').removeClass('showm');
		$($(this).data('target')).removeClass('show_mobile_nav').stop().fadeOut();
	});
	$('.mobile_nav .menu-item-has-children').append('<div class="sub_menu_btn"><span class="butline"></span><span class="butline"></span><span class="butline"></span></div>');
	$('.sub_menu_btn').on('click', function () {
		$(this).toggleClass('close_sub_menu');
		$(this).siblings('.sub-menu').stop().slideToggle();
	});

	//Seearch Window Navigation
	$('.search_show').on('click', function () {
		$($(this).data('target')).addClass('show');
		return false;
	});
	$('.close_search_window').on('click', function () {
		$($(this).data('target')).removeClass('show').fadeOut();
		return false;
	});

	//FloatSidebar Navigation
	$('.floatsidebar_show').on('click', function () {
		$($(this).data('target')).fadeIn(300).addClass('show');
		return false;
	});
	$('.close_float_sidebar, .cover_float_sidebar').on('click', function () {
		$($(this).data('target')).removeClass('show').fadeOut(300);
		return false;
	});

	//start carousels
	if ($().owlCarousel) {
		$('.latestposts_slider').owlCarousel({
			loop: true,
			margin: 0,
			autoplay: true,
			autoplayHoverPause: true,
			autoplayTimeout: 5000,
			smartSpeed: 1200,
			//pause:6000,
			nav: true,
			dots: false,
			navText: ['<span class="icon-svarrow-prev"></span>', '<span class="icon-svarrow-next"></span>'],
			responsive: {
				0: {
					items: 1
				},
				600: {
					items: 1
				},
				1000: {
					items: 1
				}
			}
		});
		$('.categories_slides').owlCarousel({
			loop: true,
			margin: 0,
			autoplay: true,
			autoplayHoverPause: true,
			autoplayTimeout: 4000,
			smartSpeed: 1000,
			//pause:6000,
			nav: true,
			dots: false,
			navText: ['<span class="icon-svarrow-prev"></span>', '<span class="icon-svarrow-next"></span>'],
			responsive: {
				0: {
					items: 2
				},
				600: {
					items: 2
				},
				1000: {
					items: 2
				}
			}
		});

	}

	//magnificPopup start
	if ($().magnificPopup) {
		//images popup gallery list
		$('.popupimg_gall').magnificPopup({
			type: 'image',
			fixedContentPos: false,
			fixedBgPos: true,

			overflowY: 'auto',
			removalDelay: 500, //delay removal by X to allow out-animation
			callbacks: {
				beforeOpen: function () {
					// just a hack that adds mfp-anim class to markup 
					this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
					this.st.mainClass = 'mfp-zoom-in';
				}
			},
			closeBtnInside: true,
			preloader: false,

			midClick: true,
			gallery: {
				enabled: true,
				navigateByImgClick: true,
				preload: [0, 1]
			},
		});
		//single image popup
		$('.popupimg').magnificPopup({
			type: 'image',
			removalDelay: 500, //delay removal by X to allow out-animation
			callbacks: {
				beforeOpen: function () {
					// just a hack that adds mfp-anim class to markup 
					this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
					this.st.mainClass = 'mfp-zoom-in';
				}
			},
			closeOnContentClick: true,
			midClick: true,
		});
		//video popup
		$('.popup_video').magnificPopup({
			disableOn: 700,
			type: 'iframe',

			mainClass: 'mfp-fade',
			removalDelay: 160,
			preloader: false,

			fixedContentPos: false
		});
	}


	//Scroll Up
	$(window).on('scroll', function () {
		if ($(this).scrollTop() > 0) {
			$('.scroll_up').fadeIn();
		} else {
			$('.scroll_up').fadeOut();
		}
	});
	$('.scroll_up').on('click', function () {
		$('body,html').animate({
			scrollTop: 0
		}, 400);
		return false;
	});


	//Scroll Animation
	$window.on('scroll', scrollanimation);

	function scrollanimation() {
		var scrolled = $window.scrollTop();
		$(".scrollanimation:not(.animated)").each(function () {
			var $this = $(this),
				offsetTop = $this.offset().top;

			if (scrolled + win_height_padded > offsetTop) {
				if ($this.data('timeout')) {
					window.setTimeout(function () {
						$this.addClass('animated ' + $this.data('animation'));
					}, parseInt($this.data('timeout'), 10));
				} else {
					$this.addClass('animated ' + $this.data('animation'));
				}
			}
		});
	}


	//Shuffle Filter Photos
	var Shuffle = window.Shuffle;
	var element = document.querySelector('.shuffle_photos');

	if (element) {

		var shuffleInstance = new Shuffle(element, {
			itemSelector: '.shuffle_photos_item',
			buffer: 1,
			easing: 'cubic-bezier(.42,.01,.57,1)',
			speed: 400,
			useTransforms: true,
		});

		//Shuffle Filter Nav
		$('.filter_image_btns button').on('click', function () {

			$('.filter_image_btns button').removeClass('active');
			$(this).addClass('active');

			if ($(this).data('group') != 'all') {
				shuffleInstance.filter([$(this).data('group')]);
			} else {
				shuffleInstance.filter(Shuffle.ALL_ITEMS);
			}
		});

	}// END Shuffle Filter

})(jQuery); //jQuery


