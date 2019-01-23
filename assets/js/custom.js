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
        touchMove: true,
        responsive: [
        {
          breakpoint: 1000,
          settings: {
            slidesToShow: 2
          }
        },
        {
          breakpoint: 800,
          settings: {
            slidesToShow: 1
          }
        }
      ]
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
	        touchMove: true,
            responsive: [
            {
              breakpoint: 800,
              settings: {
                slidesToShow: 2
              }
            },
            {
              breakpoint: 600,
              settings: {
                slidesToShow: 1
              }
            }
          ]
	    }); 
    }, 500);

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

    jQuery(".products-per-page").before("<p class='quan_add'>Количество</p>");
    jQuery(".products-per-page, .quan_add").wrapAll("<div class='wrap_quan clearfix'></div>");
    jQuery(".woocommerce-ordering").before("<p class='ord_add'>Сортировать: </p>");
    jQuery(".woocommerce-ordering, .ord_add").wrapAll("<div class='wrap_ord clearfix'></div>");
    jQuery(".wrap_ord, .wrap_quan, .gridlist-toggle").wrapAll("<div class='top_woo clearfix'></div>");
    jQuery("li.product .attachment-woocommerce_thumbnail").wrap("<div class='game_img'></div>");
    jQuery(".woo_products .product-type-variable .price .amount").prepend("<p class='from'>от</p>");
    jQuery(".quantity.buttons_added").before("<p class='quan_add_product'>Выберите количество</p>");
    jQuery(".summary.entry-summary .compare.button").after('<p class="compare_title right">Добавить к сравнению</p>');
    jQuery(".single-product.woocommerce .summary.entry-summary .price").prepend("<p class='price_add'>Цена: </p>");
    jQuery(".woocommerce-ordering").after('<a class="comp_link" target="blank" href="/?action=yith-woocompare-view-table&iframe=yes">Сравнить</a>');
    // jQuery(".woo_products li.product .price, .woo_products li.product .instock_inner").wrapAll("<div class='price_stock'></div>");
    jQuery(".summary .compare, .summary .compare_title").wrapAll("<div class='compare_wrap'></div>");
    

    jQuery(".single-product.woocommerce .summary").each(function () {
        jQuery(this).siblings(".clickBuyButton").prependTo(jQuery(this)); 
    });

    jQuery(".summary .clickBuyButton, .summary .compare_wrap").wrapAll("<div class='buttons_top clearfix'></div>");
    jQuery(".summary .attr_product, .summary .woocommerce-product-rating, .download_file").wrapAll("<div class='right_block'></div>");
    jQuery(".summary .product_meta, .summary .variations_form cart, .summary .price, .summary .instock_inner, .summary .buttons_top").wrapAll("<div class='left_block'></div>");
    jQuery(".left_block .clickBuyButton").after('<p class="buy_title">Быстрый заказ</p>');
    jQuery(".buy_title, .left_block .clickBuyButton").wrapAll("<div class='buy_wrap'></div>");
    jQuery("body.single-product .quantity.buttons_added, body.single-product .quan_add_product").wrapAll("<div class='quan_wrap'></div>");
    jQuery(".woocommerce-review-link").append("<p class='review_after_see'>Написать отзыв</p>");

    jQuery(".upsells.products").appendTo(jQuery(".single-product.woocommerce .summary .right_block"));
     // jQuery(".single-product.woocommerce .summary").prepend(jQuery(".single-product.woocommerce .summary").parent(".product").find(".clickBuyButton")); 
     jQuery(".upsells.products").children("h2").text("Аксессуары, с эти товаром покупают:");
     jQuery(".summary.entry-summary").addClass("clearfix");


    jQuery(".select.wppp-select option:first-child").text("12");
    jQuery(".select.wppp-select option:nth-child(2)").text("24");
    jQuery(".select.wppp-select option:nth-child(3)").text("36");
    jQuery(".select.wppp-select option:nth-child(4)").text("48");
    jQuery(".select.wppp-select option:nth-child(5)").text("60");


    // sidebar: if is chosen li - to open ul
    jQuery(function () {
        jQuery(".sidebar_woo li ul").each(function () {
          if(jQuery(this).children().hasClass('chosen')) {
            jQuery(this).show();
            jQuery(this).parent("li").addClass("li_open");
        }
        });
    });


    // sidebar: to open ul by clicling on title
    // jQuery(function () {
    //     jQuery('.sidebar li h3' ).each(function() {
    //         jQuery(this).on('click', function(e) {
    //             jQuery(this).closest('li').toggleClass("li_active");
    //             jQuery(this).closest('li').find("ul").slideToggle();
    //         });
    //     });
    // });

        // sidebar: to open ul by clicling on title
    jQuery(function () {
        jQuery('.sidebar_woo li' ).after().each(function() {
            jQuery(this).on('click', function(e) {
                jQuery(this).closest('li').toggleClass("li_active");
                jQuery(this).closest('li').find("ul").slideToggle();
            });
        });
    });



    // to open sidebar
    jQuery(function () {
        jQuery(".filter_icon").click(function() {
            jQuery(".sidebar").addClass('visible_sidebar');
            jQuery("body").addClass('no-scroll');
            jQuery(".popup-bg").addClass('active');
            jQuery(".close").addClass('close_display');
        });
    });

    // to close sidebar
    jQuery(function () {
        jQuery(".close").click(function() {
            jQuery("body").removeClass('no-scroll');
            jQuery(".close").removeClass('close_display');
            jQuery(".sidebar").removeClass('visible_sidebar');
            jQuery(".popup-bg").removeClass('active');
        });
    });

    // to open mobile menu
    jQuery(function () {
        jQuery(".mobile_menu_icon").click(function() {
            jQuery(".menu-header_menu_mobile-container").addClass('visible_menu');
            jQuery("body").addClass('no-scroll');
            jQuery(".popup-bg").addClass('active');
            jQuery(".close").addClass('close_display');
        });
    });

    // to close mobile menu
    jQuery(function () {
        jQuery(".close").click(function() {
            jQuery("body").removeClass('no-scroll');
            jQuery(".close").removeClass('close_display');
            jQuery(".menu-header_menu_mobile-container").removeClass('visible_menu');
            jQuery(".popup-bg").removeClass('active');
        });
    });


        // to open mobile search
    jQuery(function () {
        jQuery(".search_icon").click(function() {
            jQuery(".dgwt-wcas-search-wrapp").addClass('visible_search');
            jQuery("body").addClass('no-scroll');
            jQuery(".popup-bg").addClass('active');
            jQuery(".close").addClass('close_display');
        });
    });

    // to close mobile search
    jQuery(function () {
        jQuery(".close").click(function() {
            jQuery("body").removeClass('no-scroll');
            jQuery(".close").removeClass('close_display');
            jQuery(".popup-bg").removeClass('active');
            jQuery(".dgwt-wcas-search-wrapp").removeClass('visible_search');
        });
    });


    // to open mobile tel
    jQuery(function () {
        jQuery(".tel_mob_icon").click(function() {
            jQuery(".tel_mob_all").addClass('visible_tel');
            jQuery("body").addClass('no-scroll');
            jQuery(".popup-bg").addClass('active');
            jQuery(".close").addClass('close_display');
        });
    });

    // to close mobile tel
    jQuery(function () {
        jQuery(".close").click(function() {
            jQuery("body").removeClass('no-scroll');
            jQuery(".close").removeClass('close_display');
            jQuery(".popup-bg").removeClass('active');
            jQuery(".tel_mob_all").removeClass('visible_tel');
        });
    });

  //Close background
  jQuery(function () {
    jQuery(".popup-bg").click(function() {
        jQuery(".popup-bg").removeClass('active');
        if (jQuery('body').hasClass('no-scroll')) {
            jQuery("body").removeClass('no-scroll');
            jQuery(".sidebar").removeClass('visible_sidebar');
            jQuery(".close").removeClass('close_display');
            jQuery(".menu-header_menu_mobile-container").removeClass('visible_menu');
            jQuery(".dgwt-wcas-search-wrapp").removeClass('visible_search');
            jQuery(".tel_mob_all").removeClass('visible_tel');
        }
    });
  });



// Открыть категории по наведении на пункт меню
 jQuery(".all_categories").prepend(jQuery(".product_categories")); 
    jQuery('.all_categories').hover(function(){
        jQuery('.product_categories').addClass("visible_menu");
    },
    function(){
        jQuery('.product_categories').removeClass("visible_menu");
    });


// // Зафиксированная корзина
jQuery(document).ready(function() {
    jQuery(window).scroll(function() {
        if(jQuery(this).scrollTop() > 200) {
            jQuery('.basket_h').addClass('fixed_basket');
        } else {
            jQuery('.basket_h').removeClass('fixed_basket');
        }
    });
});


});  // jQuery(document).ready(function() END


