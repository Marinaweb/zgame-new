jQuery(document).ready(function() {

	// slick
    jQuery('.manufacturers').slick({ 
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: true,
        adaptiveHeight: true,
        speed: 700,
        autoplay: false,
        arrows: false,
        fade: false,
        cssEase: 'linear',
        touchMove: true
    }); 

    jQuery('.slider_banner').slick({ 
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: true,
        adaptiveHeight: true,
        speed: 700,
        autoplay: false,
        arrows: false,
        fade: false,
        cssEase: 'linear',
        touchMove: true
    }); 

    jQuery('.testimonials_slider').slick({ 
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        dots: false,
        adaptiveHeight: true,
        speed: 700,
        autoplay: false,
        arrows: true,
        fade: false,
        cssEase: 'linear',
        touchMove: true
    }); 

    setTimeout(function() { 
	    jQuery('.yrc-core').slick({ 
	        infinite: true,
	        slidesToShow: 3,
	        slidesToScroll: 1,
	        dots: false,
	        adaptiveHeight: true,
	        speed: 700,
	        autoplay: false,
	        arrows: true,
	        fade: false,
	        cssEase: 'linear',
	        touchMove: true
	    }); 
    }, 300);

	// To add poster to youtube video 
	  // poster frame click event
	jQuery(document).on('click','.js-videoPoster, .youtube_icon',function(ev) {
	  ev.preventDefault();
	  var jQueryposter = jQuery(this);
	  var jQuerywrapper = jQueryposter.closest('.js-videoWrapper');
	  videoPlay(jQuerywrapper);
	});

	// play the targeted video (and hide the poster frame)
	function videoPlay(jQuerywrapper) {
	  var jQueryiframe = jQuerywrapper.find('.js-videoIframe');
	  var src = jQueryiframe.data('src');
	  // hide poster
	  jQuerywrapper.addClass('videoWrapperActive');
	  // add iframe src in, starting the video
	  jQueryiframe.attr('src',src);
	}

	// stop the targeted/all videos (and re-instate the poster frames)
	function videoStop(jQuerywrapper) {
	  // if we're stopping all videos on page
	  if (!jQuerywrapper) {
	    var jQuerywrapper = jQuery('.js-videoWrapper');
	    var jQueryiframe = jQuery('.js-videoIframe');
	  // if we're stopping a particular video
	  } else {
	    var jQueryiframe = jQuerywrapper.find('.js-videoIframe');
	  }
	  // reveal poster
	  jQuerywrapper.removeClass('videoWrapperActive');
	  // remove youtube link, stopping the video from playing in the background
	  jQueryiframe.attr('src','');
	}


	// Fancybox
	jQuery(".modalbox").fancybox();


	// to open popular categories
    jQuery(".all_categories ").click(function() {
        jQuery(".product_categories").toggleClass("visible_menu");
    });

    // to close menu by clicking anywhere
    jQuery(function () {
        jQuery(document).on('click', function (e) {
          if (!jQuery(e.target).closest('.all_categories').length) {
              jQuery(".product_categories").removeClass("visible_menu");
          }
          e.stopPropagation();
      });
    })


});  // jQuery(document).ready(function() END