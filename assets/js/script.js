;(function ($, window, document, undefined) {
  'use strict';

  $(window).on('load', function () {
    if ($('.spinner-preloader-wrap').length) {
      $('.spinner-preloader-wrap').fadeOut(500);
    }
    if ($('.preloader-modern').length) {
      $('.preloader-modern').fadeOut(500);
    }
  });

  $('body').fitVids({ignore: '.vimeo-video, .youtube-simple-wrap iframe, .iframe-video.for-btn iframe, .post-media.video-container iframe'});

  /*=================================*/
  /* 01 - VARIABLES */
  /*=================================*/
  var swipers = [],
    winW, winH, winScr, _isresponsive, smPoint = 768,
    mdPoint = 992,
    lgPoint = 1200,
    addPoint = 1600,
    _ismobile = navigator.userAgent.match(/Android/i) || navigator.userAgent.match(/webOS/i) || navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPad/i) || navigator.userAgent.match(/iPod/i),
    pageCalculateHeight;

  /*=================================*/
  /* 02 - PAGE CALCULATIONS */
  /*=================================*/
  /**
   *
   * PageCalculations function
   * @since 1.0.0
   * @version 1.0.1
   * @var winW
   * @var winH
   * @var winS
   * @var pageCalculations
   * @var onEvent
   **/
  if (typeof pageCalculations !== 'function') {

    var winW, winH, winS, pageCalculations, onEvent = window.addEventListener;

    pageCalculations = function (func) {

      winW = window.innerWidth;
      winH = window.innerHeight;
      winS = document.body.scrollTop;

      if (!func) return;

      onEvent('load', func, true); // window onload
      onEvent('resize', func, true); // window resize
      onEvent("orientationchange", func, false); // window orientationchange

    }// end pageCalculations

    pageCalculations(function () {
      pageCalculations();
    });
  }

  /*Full height banner*/
  function topBannerHeight() {
    var headerH = $('.header_top_bg').not('.header_trans-fixed, .fixed-header').outerHeight() || 0;
    var windowH = $(window).height();
    var offsetTop;
    var adminbarH;
    if ($('#wpadminbar').length) {
      offsetTop = headerH + $('#wpadminbar').outerHeight();
    } else {
      offsetTop = headerH;
    }

    if ($('#wpadminbar').length && $('.header_trans-fixed').length) {
      adminbarH = $('#wpadminbar').outerHeight();
    } else {
      adminbarH = 0;
    }

    $('.full-height-window').css('min-height', (windowH - offsetTop) + adminbarH + 'px');
    $('.full-height-window-hard').css('height', (windowH - offsetTop) + adminbarH + 'px');
    $('.middle-height-window-hard').css('height', (windowH - offsetTop) * 0.8 + adminbarH + 'px');

    $('body, .main-wrapper').css('min-height', $(window).height());

    if($('body.error404 .unit').length){
      var footer = $('#footer').length ? $('#footer').height() : 0;
      $('.full-height-window').css('min-height', (windowH - offsetTop - footer - headerH) + adminbarH + 'px');
    }
  }

  /* IF TOUCH DEVICE */
  function isTouchDevice() {
    return 'ontouchstart' in document.documentElement;
  }

  /*=================================*/
  /* SWIPER SLIDER */
  /*=================================*/
  function initSwiper() {
    var initIterator = 0;
    $('.swiper-container').each(function () {
      var $t = $(this);

      var index = 'swiper-unique-id-' + initIterator;
      $t.addClass('swiper-' + index + ' initialized').attr('id', index);
      $t.parent().find('.swiper-pagination').addClass('swiper-pagination-' + index);
      $t.parent().find('.swiper-button-next').addClass('swiper-button-next-' + index);
      $t.parent().find('.swiper-button-prev').addClass('swiper-button-prev-' + index);

      var setThumb = function (activeIndex, slidesNum) {
        var url_thumb,
          leftClick = $t.find('.slider-click.left'),
          rightClick = $t.find('.slider-click.right'),
          slidesNum = slidesNum,
          activeIndexLeft, activeIndexRight;
        if (loopVar === 1) {
          if (activeIndex < 1) {
            leftClick.removeClass('disabled').find('.left').text(slidesNum);
            leftClick.find('.right').text(slidesNum);
          }
          else {
            leftClick.removeClass('disabled').find('.left').text(activeIndex);
            leftClick.find('.right').text(slidesNum);
          }
          if (activeIndex == slidesNum - 1) {
            rightClick.removeClass('disabled').find('.left').text('1');
            rightClick.find('.right').text(slidesNum);
          }
          else {
            rightClick.removeClass('disabled').find('.left').text(activeIndex + 2);
            rightClick.find('.right').text(slidesNum);
          }
        } else {
          if (activeIndex < 1) {
            leftClick.addClass('disabled');
          }
          else {
            leftClick.removeClass('disabled').find('.left').text(activeIndex);
            leftClick.find('.right').text(slidesNum);
          }
          if (activeIndex == slidesNum - 1) {
            rightClick.addClass('disabled');
          }
          else {
            rightClick.removeClass('disabled').find('.left').text(activeIndex + 2);
            rightClick.find('.right').text(slidesNum);
          }
        }
      };

      if (isTouchDevice() && $t.data('mode') == 'vertical') {
        $t.attr('data-noswiping', 1);
        $(this).find('.swiper-slide').addClass('swiper-no-swiping');
      }

      var autoPlayVar = parseInt($t.attr('data-autoplay'), 10);
      var mode = $t.attr('data-mode');
      var effect = $t.attr('data-effect') ? $t.attr('data-effect') : 'slide';
      var paginationType = $t.attr('data-pagination-type');
      var loopVar = parseInt($t.attr('data-loop'), 10);
      var noSwipingVar = parseInt($t.attr('data-noSwiping'), 10);
      var mouse = parseInt($t.attr('data-mouse'), 10);
      var speedVar = parseInt($t.attr('data-speed'), 10);
      var centerVar = parseInt($t.attr('data-center'), 10);
      var spaceBetweenVar = parseInt($t.attr('data-space'), 10);
      var slidesPerView = parseInt($t.attr('data-slidesPerView'), 10) ? parseInt($t.attr('data-slidesPerView'), 10) : 'auto';
      var breakpoints = {};
      var responsive = $t.attr('data-responsive');
      if ($('.album_swiper').length && $(window).width() < 768) {
        loopVar = 1;
      } else {
        loopVar = parseInt($t.attr('data-loop'), 10);
      }
      if (responsive == 'responsive') {
        slidesPerView = $t.attr('data-add-slides');
        var lg = $t.attr('data-lg-slides') ? $t.attr('data-lg-slides') : $t.attr('data-add-slides');
        var md = $t.attr('data-md-slides') ? $t.attr('data-md-slides') : $t.attr('data-add-slides');
        var sm = $t.attr('data-sm-slides') ? $t.attr('data-sm-slides') : $t.attr('data-add-slides');
        var xs = $t.attr('data-xs-slides') ? $t.attr('data-xs-slides') : $t.attr('data-add-slides');

        breakpoints = {
          768: {
            slidesPerView: xs
          },
          992: {
            slidesPerView: sm
          },
          1200: {
            slidesPerView: md
          },
          1600: {
            slidesPerView: lg
          }
        };

      }

      var titles = [];
      $t.find('.swiper-slide').each(function () {
        titles.push($(this).data('title'));
      });

      if ($t.hasClass('swiper-album')) {
        breakpoints = {
          480: {
            slidesPerView: 1
          },
          767: {
            slidesPerView: 3,
            centeredSlides: false
          },
          991: {
            slidesPerView: 4
          },
          1600: {
            slidesPerView: 5
          }
        };
      }

      swipers['swiper-' + index] = new Swiper('.swiper-' + index, {
        pagination: '.swiper-pagination-' + index,
        paginationType: paginationType,
        paginationBulletRender: function (swiper, index, className) {
          if ($t.parent('.banner-slider-wrap.vertical_custom_elements').length || $t.parent('.banner-slider-wrap.vertical').length || $t.parent('.banner-slider-wrap.vertical-2').length || $t.parent('.product-slider-wrapper').length) {
            var title = titles[index];

            if (index < 9) return '<span class="' + className + '"><i class="pagination-title">' + title + '</i><i>' + ('0' + (index + 1)) + '</i></span>';

            return '<span class="' + className + '"><i class="pagination-title">' + title + '</i><i>' + (index + 1) + '</i></span>';
          } else {
            return '<span class="' + className + '"></span>';
          }
        },
        direction: mode || 'horizontal',
        slidesPerView: slidesPerView,
        breakpoints: breakpoints,
        centeredSlides: centerVar,
        noSwiping: noSwipingVar,
        noSwipingClass: 'swiper-no-swiping',
        paginationClickable: true,
        spaceBetween: spaceBetweenVar,
        containerModifierClass: 'swiper-container-', // NEW
        slideClass: 'swiper-slide',
        slideActiveClass: 'swiper-slide-active',
        slideDuplicateActiveClass: 'swiper-slide-duplicate-active',
        slideVisibleClass: 'swiper-slide-visible',
        slideDuplicateClass: 'swiper-slide-duplicate',
        slideNextClass: 'swiper-slide-next',
        slideDuplicateNextClass: 'swiper-slide-duplicate-next',
        slidePrevClass: 'swiper-slide-prev',
        slideDuplicatePrevClass: 'swiper-slide-duplicate-prev',
        wrapperClass: 'swiper-wrapper',
        bulletClass: 'swiper-pagination-bullet',
        bulletActiveClass: 'swiper-pagination-bullet-active',
        buttonDisabledClass: 'swiper-button-disabled',
        paginationCurrentClass: 'swiper-pagination-current',
        paginationTotalClass: 'swiper-pagination-total',
        paginationHiddenClass: 'swiper-pagination-hidden',
        paginationProgressbarClass: 'swiper-pagination-progressbar',
        paginationClickableClass: 'swiper-pagination-clickable', // NEW
        paginationModifierClass: 'swiper-pagination-', // NEW
        lazyLoadingClass: 'swiper-lazy',
        lazyStatusLoadingClass: 'swiper-lazy-loading',
        lazyStatusLoadedClass: 'swiper-lazy-loaded',
        lazyPreloaderClass: 'swiper-lazy-preloader',
        notificationClass: 'swiper-notification',
        preloaderClass: 'preloader',
        zoomContainerClass: 'swiper-zoom-container',
        loop: loopVar,
        speed: speedVar,
        autoplay: autoPlayVar,
        effect: effect,
        mousewheelControl: mouse,
        nextButton: '.swiper-button-next-' + index,
        prevButton: '.swiper-button-prev-' + index,
        iOSEdgeSwipeDetection: true,
        onInit: function (swiper) {
          if ($t.closest('.product-slider-wrapper') && $(window).width() < 1024) {
            $t.find('.swiper-slide').addClass('swiper-no-swiping');
          } else {
            $t.find('.swiper-slide').removeClass('swiper-no-swiping');
          }

          if (winW > 1024 && $t.find(".slider-click").length) {
            $t.find(".slider-click").each(function () {
              var arrow = $(this);
              $(document).on("mousemove", function (event) {
                var arrow_parent = arrow.parent(),
                  parent_offset = arrow_parent.offset(),
                  pos_left = Math.min(event.pageX - parent_offset.left, arrow_parent.width()),
                  pos_top = event.pageY - parent_offset.top;

                arrow.css({
                  'left': pos_left,
                  'top': pos_top
                });
              });
            });
          }

          var totalSlides = $('.swiper-slide:not(.swiper-slide-duplicate)').length;
          if ($('.full_screen_slider').length) {
            setThumb(swiper.realIndex, totalSlides);
          }

          if ($t.hasClass('js-change-color')) {
            var activeSlide = $t.find('.swiper-slide-active');
            if (activeSlide.data('content-color') == 'light') {
              $t.closest('.product-slider-wrapper').addClass('product-slider-wrapper--light');
              $t.closest('.banner-slider-wrap').addClass('content-light');
            } else {
              $t.closest('.product-slider-wrapper').removeClass('product-slider-wrapper--light');
              $t.closest('.banner-slider-wrap').removeClass('content-light');
            }
          }

          if ($t.hasClass('js-check-pagination')) {
            var countSlide = $t.find('.swiper-pagination-bullet').length;

            if (countSlide > 5) {
              $t.addClass('js-calc-pagination');
            }
          }

          if ($t.hasClass('js-calc-pagination')) {
            var slide = $t.find('.swiper-pagination-bullet');
            slide.removeClass('visible');
            var countSlide = slide.length;
            var index = $t.find('.swiper-pagination-bullet-active').index();

            slide.eq(index).addClass('visible');
            slide.eq(0).addClass('visible');
            slide.eq(countSlide - 1).addClass('visible');

            if (index > 1 && index < countSlide - 2) {
              $t.find('.swiper-pagination').removeClass('start end').addClass('center');
              slide.eq(index - 1).addClass('visible');
              slide.eq(index + 1).addClass('visible');
            } else if (index <= 1) {
              $t.find('.swiper-pagination').removeClass('center end').addClass('start');
              slide.eq(0).addClass('visible');
              slide.eq(1).addClass('visible');
              slide.eq(2).addClass('visible');
            } else if (countSlide >= index - 2) {
              $t.find('.swiper-pagination').removeClass('center start').addClass('end');
              slide.eq(countSlide - 2).addClass('visible');
              slide.eq(countSlide - 3).addClass('visible');
            }
          }
        },
        onSlideChangeEnd: function (swiper) {
          if ($t.hasClass('js-change-color')) {
            $t.closest('.banner-slider-wrap').removeClass('content-transition');
            $t.closest('.product-slider-wrapper').removeClass('content-transition');
            var activeSlide = $t.find('.swiper-slide-active');
            if (activeSlide.data('content-color') == 'light') {
              $t.closest('.product-slider-wrapper').addClass('product-slider-wrapper--light');
              $t.closest('.banner-slider-wrap').addClass('content-light');
            } else {
              $t.closest('.product-slider-wrapper').removeClass('product-slider-wrapper--light');
              $t.closest('.banner-slider-wrap').removeClass('content-light');
            }
          }

          if ($t.hasClass('js-calc-pagination')) {
            var slide = $t.find('.swiper-pagination-bullet');
            slide.removeClass('visible');
            var countSlide = slide.length;
            var index = $t.find('.swiper-pagination-bullet-active').index();

            slide.eq(index).addClass('visible');
            slide.eq(0).addClass('visible');
            slide.eq(countSlide - 1).addClass('visible');

            if (index > 1 && index < countSlide - 2) {
              $t.find('.swiper-pagination').removeClass('start end').addClass('center');
              slide.eq(index - 1).addClass('visible');
              slide.eq(index + 1).addClass('visible');
            } else if (index <= 1) {
              $t.find('.swiper-pagination').removeClass('center end').addClass('start');
              slide.eq(0).addClass('visible');
              slide.eq(1).addClass('visible');
              slide.eq(2).addClass('visible');
            } else if (countSlide >= index - 2) {
              $t.find('.swiper-pagination').removeClass('center start').addClass('end');
              slide.eq(countSlide - 2).addClass('visible');
              slide.eq(countSlide - 3).addClass('visible');
            }
          }
        },
        onSlideChangeStart: function (swiper) {

          var activeIndex = (loopVar == 1) ? swiper.realIndex : swiper.activeIndex;

          if ($t.parent().find('.swiper-pagination-bullet').length) {
            $t.parent().find('.swiper-pagination-bullet').removeClass('swiper-pagination-bullet-active').eq(activeIndex).addClass('swiper-pagination-bullet-active');
          }

          if ($t.hasClass('js-change-color')) {
            $t.closest('.banner-slider-wrap').addClass('content-transition');
            $t.closest('.product-slider-wrapper').addClass('content-transition');
          }
        }
      });

      (function verticalResponsive() {
        if ($t.hasClass('swiper-container-vertical')) {
          var breakpoints = [1600, 1200, 992, 768],
            maxHeight = Math.max.apply(null, $t.find('.swiper-slide').map(function () {
              return $(this).height();
            }).get()),
            swiperWrapper = $t.find('.swiper-wrapper');

          if ($(window).width() < breakpoints[3]) {
            $t.css({'height': maxHeight * $t.data('xs-slides')});
          } else if ($(window).width() < breakpoints[2]) {
            $t.css({'height': maxHeight * $t.data('sm-slides')});
          } else if ($(window).width() < breakpoints[1]) {
            $t.css({'height': maxHeight * $t.data('md-slides')});
          } else {
            $t.css({'height': maxHeight * $t.data('lg-slides')});
          }
        }
      })();

      if ($t.hasClass('swiper-container-horizontal') && $t.closest('.px-slider')) {
        $t.closest('.vc_row[data-vc-full-width]').css({'overflow': 'visible'});
      }

      initIterator++;
    });
  }


  $('.slider-click.left').on('click', function () {
    swipers['swiper-' + $(this).parent().parent().parent().find('.full_screen_slider').attr('id')].slidePrev();
    swipers['swiper-' + $(this).parent().parent().parent().find('.full_screen_slider').attr('id')].startAutoplay();
  });
  $('.slider-click.right').on('click', function () {
    swipers['swiper-' + $(this).parent().parent().parent().find('.full_screen_slider').attr('id')].slideNext();
    swipers['swiper-' + $(this).parent().parent().parent().find('.full_screen_slider').attr('id')].startAutoplay();
  });

  /*=================================*/
  /* MAIN WRAPPER */
  /*=================================*/

  function calcPaddingMainWrapper() {
    var footer = $('#footer');
    var paddValue = footer.outerHeight();
    footer.bind('heightChange', function () {
      if (!$("#footer.fix-bottom").length && $("#footer.footer-parallax").length) {
        $('.main-wrapper').css('margin-bottom', paddValue);
      } else if (!$("#footer.fix-bottom").length) {
        $('.main-wrapper').css('padding-bottom', paddValue);
      }
    });

    footer.trigger('heightChange');
  }

  function calcPaddingBlog() {
    if($('.post-paper.center').length && $('body.blog .header_trans-fixed').length) {
      var headerHeight = $('.header_trans-fixed').outerHeight() + $('#wpadminbar').outerHeight();
      $('.post-paper.center').css('padding-top', headerHeight + 'px');
    }
  }

  if ($(".animsition").length) {
    $(".animsition").animsition({
      inClass: 'fade-in',
      outClass: 'fade-out',
      inDuration: 2000,
      outDuration: 800,
      loading: true,
      loadingParentElement: 'body', //animsition wrapper element
      loadingClass: 'animsition-loading',
      unSupportCss: ['animation-duration',
        '-webkit-animation-duration',
        '-o-animation-duration'
      ],
      overlay: false,
      overlayClass: 'animsition-overlay-slide',
      overlayParentElement: 'body'
    });
  }

  /*=================================*/
  /* FOOTER WIDGETS HEIGHT */
  /*=================================*/

  function footerWidgetsHeight() {
    if ($('#footer .sidebar-item').length) {
      $('#footer .widg').each(function () {
        var layoutM = 'masonry';
        $(this).isotope({
          itemSelector: '.sidebar-item',
          layoutMode: layoutM,
          masonry: {
            columnWidth: '.sidebar-item'
          }
        });
      });
    }
  }

  /*=================================*/
  /* ADD IMAGE ON BACKGROUND */
  /*=================================*/

  function wpc_add_img_bg(img_sel, parent_sel) {
    if (!img_sel) {

      return false;
    }
    var $parent, $imgDataHidden, _this;
    $(img_sel).each(function () {
      _this = $(this);
      $imgDataHidden = _this.data('s-hidden');
      $parent = _this.closest(parent_sel);
      $parent = $parent.length ? $parent : _this.parent();
      $parent.css('background-image', 'url(' + this.src + ')').addClass('s-back-switch');
      if ($imgDataHidden) {
        _this.css('visibility', 'hidden');
        _this.show();
      }
      else {
        _this.hide();
      }
    });
  }

  // SEARCH POPUP
  $('.open-search').on('click', function () {
    $('body').css('overflow', 'hidden');
    $('.site-search').addClass('open');
  });
  $('.close-search').on('click', function () {
    $('body').css('overflow', '');
    $('.site-search').removeClass('open');
  });

  /*=================================*/
  /* MOBILE MENU */
  /*=================================*/
  var prevState;
  $('.mob-nav').on('click', function (e) {
    e.preventDefault();
    $('html').addClass('no-scroll').height(window.innerHeight + 'px');
    if ($(this).hasClass('mob-but-full')) {
      $(this).toggleClass('active');
      if ($('#topmenu-full').hasClass('open')) {
        $('html').removeClass('no-scroll').height('auto');
        $('#topmenu-full').find('.sub-menu').slideUp();
        $('#topmenu-full').toggleClass('open');
        setTimeout(function () {
          $('#topmenu-full').animate({'width': 'toggle'}, 500);
        }, 800);
      } else {
        $('#topmenu-full').animate({'width': 'toggle'}, 500).css('padding-top', ($('.header_top_bg').outerHeight() + $('#wpadminbar').outerHeight()) + 'px');
        setTimeout(function () {
          $('#topmenu-full').toggleClass('open');
        }, 400);
      }
    } else {
      $('html').addClass('no-scroll sidebar-open').height(window.innerHeight + 'px');
      if ($('#wpadminbar').length) {
        $('.sidebar-open #topmenu').css('top', '46px');
      } else {
        $('.sidebar-open #topmenu').css('top', '0');
      }
    }
  });

  $('.mob-nav-close').on('click', function (e) {
    e.preventDefault();
    $('html').removeClass('no-scroll sidebar-open').height('auto');
  });

  $('#topmenu-full .menu-item-has-children > a').on('click', function (e) {
    e.preventDefault();
    $(this).parent().siblings().find('.sub-menu').slideUp();
    $(this).next().slideToggle();
  });


  function fixedMobileMenu() {
    var headerHeight = $('.header_top_bg').not('.header_trans-fixed').outerHeight();
    var offsetTop;
    var dataTop = $('.main-wrapper').data('top');
    var adminbarHeight = $('#wpadminbar').outerHeight();
    if ($('#wpadminbar').length) {
      offsetTop = adminbarHeight + headerHeight;
      $('.header_top_bg').css('margin-top', adminbarHeight);
    } else {
      offsetTop = headerHeight;
    }
    if ($(window).width() < dataTop) {
      $('.main-wrapper').css('padding-top', offsetTop + 'px');
    } else {
      $('.main-wrapper').css('padding-top', '0');
    }
    if ($('#wpadminbar').length && $(window).width() < 768) {
      $('#wpadminbar').css({
        'position': 'fixed',
        'top': '0'
      })
    }
  }

  function menuArrows() {
    var mobW = $('.main-wrapper').attr('data-top');
    if (($(window).width() < mobW)) {
      if (!$('.menu-item-has-children i').length) {
        $('header .menu-item-has-children').append('<i class="ion-ios-arrow-down"></i>');
        $('header .menu-item-has-children i').addClass('hide-drop');
      }
      $('header .menu-item i').on('click', function () {
        if ($(this).parent().hasClass('menu-item-has-children') && !$(this).hasClass('animation')) {
          $(this).addClass('animation');
          if ($(this).hasClass('hide-drop')) {
            if ($(this).closest('.sub-menu').length) {
              $(this).removeClass('hide-drop').prev('.sub-menu').slideToggle(400);
            } else {
              $('.menu-item-has-children i').addClass('hide-drop').next('.sub-menu').hide(100);
              $(this).removeClass('hide-drop').prev('.sub-menu').slideToggle(400);
            }
          } else {
            $(this).addClass('hide-drop').prev('.sub-menu').hide(100).find('.menu-item-has-children a').addClass('hide-drop').prev('.sub-menu').hide(100);
          }
        }
        setTimeout(removeClass, 400);

        function removeClass() {
          $('header .menu-item i').removeClass('animation');
        }
      });
    } else {
      $('header .menu-item-has-children i').remove();
    }
  }

  /*=================================*/
  /* ANIMATION */
  /*=================================*/

  $.fn.isInViewport = function (offsetB) {

    var elementTop = $(this).offset().top;
    var elementBottom = elementTop + $(this).outerHeight();

    var viewportTop = $(window).scrollTop();
    var viewportBottom = viewportTop + $(window).height() - offsetB;

    return elementBottom > viewportTop && elementTop < viewportBottom;
  };

  function addAnimation() {
    if ($('.js-animation').length) {
      var headings = $('.js-animation');
      headings.each(function () {
        var animationClass = 'animation';
        var elements = $(this).find('.js-animation-item');
        var headingOffsetB;
        if ($(window).width() > 1024) {
          headingOffsetB = 50;
        } else {
          headingOffsetB = 0;
        }
        if ($(this).isInViewport(headingOffsetB)) {
          elements.addClass(animationClass);
        } else {
          elements.removeClass(animationClass);
        }
      });
    }

    if ($('.wpb_animate_when_almost_visible').length) {
      var targets = $('.wpb_animate_when_almost_visible');
        targets.each(function () {
          var animationClass = 'wpb_start_animation animated';
          var headingOffsetB;
          if ($(window).width() > 1024) {
            headingOffsetB = 50;
          } else {
            headingOffsetB = 0;
          }
          if ($(this).isInViewport(headingOffsetB)) {
            $(this).addClass(animationClass);
          } else {
            $(this).removeClass(animationClass);
          }
      });
    }

    if ($('.portfolio-grid').length || $('.portfolio-masonry').length) {
      $('.portfolio-grid, .portfolio-masonry').each(function () {
        if ($(window).scrollTop() >= $(this).offset().top - $(window).height() * .8) {
          $(this).addClass('animation');
        }
      });
    }
  }

  function addTransition() {
    if ($('.js-animation').length) {
      var headings = $('.js-animation');
      headings.each(function () {
        var elements = $(this).find('.js-animation-item');
        for (var i = 0; i < $(this).find('.js-animation-item').length; i++) {
          elements.eq(i).addClass('transition-' + i);
        }
      });
    }
  }

  /*=================================*/
  /* HEADER SCROLL */
  /*=================================*/

  $(window).on('scroll', function () {
    if ($(this).scrollTop() >= $('.header_top_bg.header_trans-fixed').outerHeight()) {
      if ($('.header_top_bg.header_trans-fixed').length) {
        $('.header_top_bg.header_trans-fixed').not('.fixed-dark').addClass('bg-fixed-color');
        $('.fixed-dark').addClass('bg-fixed-dark');
        $('.logo-hover').show();
        $('.main-logo').hide();
      }
    } else {
      if ($('.header_top_bg.header_trans-fixed').length) {
        $('.header_top_bg.header_trans-fixed').not('.fixed-dark').removeClass('bg-fixed-color');
        $('.fixed-dark').removeClass('bg-fixed-dark');
        $('.logo-hover').hide();
        $('.main-logo').show();
      }
    }
  });

  /*=================================*/
  /* ABOUT SECTION */
  /*=================================*/

  $('.about-hamburger').on('click', function () {
    $('.about-mob-section-wrap').toggleClass('open');
    $('body').toggleClass('overflow-full');
    $(window).resize();
  });

  /*=================================*/
  /* BLOG */
  /*=================================*/

  /* MAGNIFIC POPUP VIDEO */
  function popupVideo() {
    if ($('.blog .video-content-blog').length || $('.single-post .video-content-blog').length) {
      $('.play').each(function () {
        $(this).magnificPopup({
          disableOn: 700,
          type: 'iframe',
          mainClass: 'mfp-fade',
          removalDelay: 160,
          preloader: false,
          fixedContentPos: true,
          fixedBgPos: true
        });
      });
    }
  }

  // image slider
  // ---------------------------------
  function blogImageSlider() {
    if ($('.img-slider').length) {
      $('.img-slider .slides').not('.slick-initialized').each(function () {
        $(this).slick({
          fade: true,
          autoplay: true,
          speed: 500,
          dots: false,
          prevArrow: "<div class='flex-prev'><i class='ion-ios-arrow-thin-left'></i></div>",
          nextArrow: "<div class='flex-next'><i class='ion-ios-arrow-thin-right'></i></div>"
        });
      })
    }
  }

  // Equal height for protected page
  function protectHeight() {
    if ($('.protected-page').length) {
      var protectHeight = $(window).outerHeight() - ($('.header_top_bg').outerHeight() + $('#wpadminbar').outerHeight() + $('#footer').outerHeight());
      var headerHeight = $('.header_trans-fixed').outerHeight() + $('#wpadminbar').outerHeight();
      $('.protected-page').css('min-height', protectHeight + 'px').css('margin-top', headerHeight + 'px');
    }
  }

  // Equal height for protected page
  function postHeight() {
    if ($('.unit .single-post').length) {
      var postHeight = $(window).outerHeight() - ($('.header_top_bg').outerHeight() + $('#wpadminbar').outerHeight() + $('#footer').outerHeight());
      $('.unit .single-post').css('min-height', postHeight + 'px');
    }
  }

  // Load more for blog
  function load_more_blog_posts() {
    // Load More Portfolio
    if (window.load_more_blog_posts) {

      var pageNum = parseInt(window.load_more_blog_posts.startPage) + 1;

      // The maximum number of pages the current query can return.
      var max = parseInt(window.load_more_blog_posts.maxPage);

      // The link of the next page of posts.
      var nextLink = window.load_more_blog_posts.nextLink;

      // wrapper selector
      var wrap_selector = '.blog.metro';

      //button click
      $('.js-load-more').on('click', function (e) {

        var $btn = $(this),
          $btnText = $btn.html();
          $btn.html('loading...');

        if (pageNum <= max) {

          var $container = $(wrap_selector);
          $.ajax({
            url: nextLink,
            type: "get",
            success: function (data) {
              var newElements = $(data).find('.blog.metro .post');
              var elems = [];

              newElements.each(function (i) {
                elems.push(this);
              });

              $container.append(elems);
              $container.find('img[data-lazy-src]').foxlazy();

              wpc_add_img_bg('.s-img-switch');
              popupVideo();
              blogImageSlider();

              pageNum++;
              nextLink = nextLink.replace(/\/page\/[0-9]?/, '/page/' + pageNum);

              $btn.html($btnText);

              if (pageNum == max + 1) {
                $btn.hide('fast');
              }
            }
          });
        }
        return false;
      });
    }
  }

// Likes for blog
  function toggleLikeFromCookies($element, postId) {
    if (document.cookie.search(postId) === -1) {
      $element.removeClass('post__likes--liked');
    } else {
      $element.addClass('post__likes--liked');
    }
  }

  var $likes = $('.post__likes');

  for (var i = 0; i < $likes.length; i++) {
    toggleLikeFromCookies($likes.eq(i), $likes.eq(i).attr('data-id'));
  }

  $likes.on('click', function (e) {
    var $this = $(this),
      post_id = $this.attr('data-id');
    $this.toggleClass('post__likes--liked');
    $this.addClass('post__likes--disable');

    $.ajax({
      type: "POST",
      url: get.ajaxurl,
      data: ({
        action: 'pixxy_like_post',
        post_id: post_id
      }),
      success: function (msg) {
        $this.closest('.likes-wrap').find('.count').text(msg);
        toggleLikeFromCookies($this, post_id);
        $this.removeClass('post__likes--disable');
      }
    });
    return false;
  });

  // isotope
  function initBlogIsotope() {
    if ($('.izotope-blog').length) {
      var self = $('.izotope-blog');
      var layoutM = 'masonry';
      self.isotope({
        itemSelector: '.post',
        layoutMode: layoutM,
        masonry: {
          columnWidth: '.post'
        }
      });
    }
  }

  // back to top
  $('#back-to-top').on('click', function (e) {
    e.preventDefault();
    $('html,body').animate({
      scrollTop: 0
    }, 700);
  });

  /*=================================*/
  /* PORTFOLIO DETAIL */
  /*=================================*/
  if ($('.light-gallery').length) {
    $('.light-gallery').each(function () {
      var thumb = (typeof $(this).attr('data-thumb') !== undefined) && (typeof $(this).attr('data-thumb') !== false) ? $(this).attr('data-thumb') : true;
      thumb = thumb === 'false' ? false : true;

      var selector = $(this).closest('.metro_3, .metro_4').length ? '.gallery-item-wrap' : '.gallery-item:not(.popup-details)';

      $(this).lightGallery({
        selector: selector,
        mode: 'lg-slide',
        closable: true,
        iframeMaxWidth: '80%',
        download: false,
        thumbnail: true,
        showThumbByDefault: thumb
      });
    });
  }

  function initIsotope() {
    if ($('.portfolio-izotope-container').length) {
      $('.portfolio-izotope-container').each(function () {
        var self = $(this);
        var layoutM = self.attr('data-layout') || 'masonry';
        self.isotope({
          itemSelector: '.gallery-item',
          layoutMode: layoutM,
          masonry: {
            columnWidth: '.gallery-item, .grid-sizer',
            gutterWidth: 30
          }
        });
      });
    }

    if ($('.events-wrapper').length) {
      $('.events-wrapper').each(function () {
        var self = $(this);
        var layoutM = self.attr('data-layout') || 'masonry';
        self.isotope({
          itemSelector: '.event-post-box',
          layoutMode: layoutM,
          masonry: {
            columnWidth: '.event-post-box',
            gutterWidth: 30
          }
        });
      });
    }

    if ($('.masonry .light-gallery').length) {
      $('.masonry .light-gallery').each(function () {
        var self = $(this);
        var layoutM = self.attr('data-layout') || 'masonry';
        self.isotope({
          itemSelector: '.gallery-item',
          layoutMode: layoutM,
          masonry: {
            columnWidth: '.gallery-item',
            'gutter': 30
          }
        });
      });
    }

    if ($('.grid .light-gallery').length) {
      $('.grid .light-gallery').each(function () {
        var self = $(this);
        var layoutM = self.attr('data-layout') || 'masonry';
        self.isotope({
          itemSelector: '.gallery-item-wrap',
          layoutMode: layoutM,
          masonry: {
            columnWidth: '.gallery-item-wrap',
            'gutter': 30
          }
        });
      });
    }

    if ($('.metro_2 .light-gallery, .metro_4 .light-gallery').length) {
      var gutter = $(window).width() < 1199 ? 12 : 30;
      $('.metro_2 .light-gallery, .metro_4 .light-gallery').each(function () {
        var self = $(this);
        var layoutM = self.attr('data-layout') || 'masonry';
        self.isotope({
          itemSelector: '.gallery-item-wrap',
          layoutMode: layoutM,
          masonry: {
            columnWidth: '.gallery-item-wrap',
            'gutter': gutter
          }
        });
      });
    }
  }

  function leftGalleryImages() {
    if ($('.portfolio-content-pixxy.left_gallery .gallery-item').length) {
      $("img[data-lazy-src]").foxlazy();
      $('.portfolio-content-pixxy.left_gallery .gallery-item').each(function () {
        var height = $(this).height();
        var width = $(this).width();
        if (height > width) {
          $(this).addClass('vertical');
        } else {
          $(this).addClass('horizontal');
        }
      });
    }
  }

  pageCalculations(function () {
    if (!window.enable_foxlazy) {
      wpc_add_img_bg('.s-img-switch');
    }

    /* fix for splited slider */
    wpc_add_img_bg('.ms-section .s-img-switch');
    wpc_add_img_bg('.woocommerce .s-img-switch');
  });

  function popup_image() {
    if ($('.popup-image').length) {
      $('.popup-image').each(function () {
        $(this).lightGallery({
          selector: 'this',
          mode: 'lg-slide',
          closable: true,
          iframeMaxWidth: '80%',
          download: false,
          thumbnail: true
        });
      });
    }
  }

  popup_image();

  $('.product button[type="submit"]').on('click', function () {
    $("img[data-lazy-src]").foxlazy();
  });

  /*product slider*/
  if ($('.pixxy_images').length) {
    $('.product-gallery-wrap').each(function () {
      $(this).slick({
        dots: false,
        arrows: false,
        infinite: true,
        speed: 300,
        slidesToShow: 1,
        asNavFor: '.product-gallery-thumbnail-wrap',
        fade: true,
        draggable: false
      })
    });
    $('.product-gallery-thumbnail-wrap').each(function () {
      $(this).slick({
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        dots: false,
        arrows: false,
        asNavFor: '.product-gallery-wrap',
        vertical: false,
        focusOnSelect: true,
        responsive: [
          {
            breakpoint: 770,
            settings: {
              slidesToShow: 3,
              vertical: false
            }
          }
        ]
      })
    })
  }

  /**********************************/
  /* VIDEO CONTROLS */
  /**********************************/
  function onYouTubeIframeAPIReady() {
    if (_ismobile) {
      $('.iframe-video').removeClass('play').find('.play-button').removeClass('start');
    }

    var player = [],
      $iframe_parent = [],
      $this;

    // each all iframe
    $('.iframe-video.youtube iframe').each(function (i) {
      // get parent element
      $this = $(this);
      $iframe_parent[i] = $this.closest('.iframe-video.youtube');
      // init video player

      player[i] = new YT.Player(this, {
        // callbacks
        events: {
          'onReady': function (event) {
          },
          'onStateChange': function (event) {
            switch (event.data) {
              case 1:
                // start play
                if (($iframe_parent[i].data('mute')) && ($iframe_parent[i].find('.mute-button').hasClass('mute1'))) {
                  player[i].mute();
                } else {
                  player[i].unMute();
                }
                break;
              case 2:
                // pause
                $iframe_parent[i].removeClass('play').find('.play-button').removeClass('start');
                break;
              case 3:
                // buffering
                break;
              case 0:
                // end video
                $iframe_parent[i].removeClass('play').find('.play-button').removeClass('start');
                break;
              default:
                '-1'
              // not play
            }
          }
        }
      });

      var muteButton = $iframe_parent[i].find('.mute-button');
      // mute video
      if (muteButton.length) {
        muteButton.on('click', function () {
          if (muteButton.hasClass('mute1')) {
            player[i].unMute();
            muteButton.removeClass('mute1');
          } else {
            player[i].mute();
            muteButton.addClass('mute1');
          }
        });
      }

      // click play/pause video
      $iframe_parent[i].find('.play-button').on('click', function (event) {
        event.preventDefault();
        var $parent = $iframe_parent[i];
        if ($parent.hasClass('play')) {
          player[i].pauseVideo();
          $parent.removeClass('play').find('.play-button').removeClass('start');
        } else {
          player[i].playVideo();
          $parent.addClass('play').find('.play-button').addClass('start');
        }
      });

      // stop video
      $iframe_parent[i].find('.video-close-button').on('click', function () {
        player[i].stopVideo();
        $iframe_parent[i].removeClass('play').find('.play-button').removeClass('start');
      });
    });
  };

  var gridWrapper = $('.tg-grid-wrapper');
  if (gridWrapper.length) {
    window.addEventListener('load', function () {
      window.dispatchEvent(new Event('resize'));
    });
  }

  /* ------------------------------------------- */
  /* URBAN SLIDER */
  /* ------------------------------------------- */
  function initUrbanSlider() {
    var winWidth = window.innerWidth,
      slideWidth;
    if (winWidth > 768) {
      slideWidth = winWidth * 0.65;
    } else {
      slideWidth = winWidth;
    }
    if ($('.portfolio-content-pixxy.urban_slider').length) {
      $('.gallery-top-slide').width(slideWidth);
    }

    if ($('.portfolio-content-pixxy.urban_slider').length) {

      $('.gallery-top').each(function () {
        var autoplaySpeed = $(this).data('autoplayspeed'),
          autoplay = $(this).data('autoplay'),
          speed = $(this).data('speed'),
          id = '#' + $(this).data('id');

        $(this).slick({
          slidesToShow: 1,
          autoplay: autoplay,
          slidesToScroll: 1,
          arrows: true,
          speed: speed,
          autoplaySpeed: autoplaySpeed,
          infinite: true,
          asNavFor: id,
          centerMode: true,
          centerPadding: '30px',
          variableWidth: true,
          prevArrow: '<button type="button" class="slick-prev"></button>',
          nextArrow: '<button type="button" class="slick-next"></button>',
          cssEase: 'ease'
        });
      });

      $('.gallery-thumb').each(function () {
        var autoplaySpeed = $(this).data('autoplayspeed'),
          autoplay = $(this).data('autoplay'),
          id = '#' + $(this).data('id'),
          speed = $(this).data('speed');

        $(this).slick({
          slidesToShow: 3,
          autoplay: autoplay,
          slidesToScroll: 1,
          infinite: true,
          speed: speed,
          arrows: false,
          autoplaySpeed: autoplaySpeed,
          asNavFor: id,
          centerMode: true,
          centerPadding: '30px',
          focusOnSelect: true,
          cssEase: 'ease',
          responsive: [
            {
              breakpoint: 991,
              settings: {
                slidesToShow: 1
              }
            }
          ]
        });

      });
    }
  }

  /* Copyright */
  if ($('.pixxy_copyright_overlay').length) {
    $(document).on('contextmenu', function (event) {
      if ($('.pixxy_copyright_overlay').hasClass('copy')) {
        event.preventDefault();
      } else if (event.target.tagName != 'A') {
        event.preventDefault();
      }
      $('.pixxy_copyright_overlay').addClass('active');
    }).on('click', function () {
      $('.pixxy_copyright_overlay').removeClass('active').removeAttr('style');
    });
  }

  function calcZindex() {
    var row_count_after = $('.row-angle-after, .row-angle-before').length;
    if (row_count_after) {
      $('.row-angle-after, .row-angle-before').each(function (index) {
        $(this).css('z-index', row_count_after - index);
      });
    }
  }

  /* SHARE POPUP */
  $('[data-share]').on('click',function () {
    var w = window,
      url = this.getAttribute('data-share'),
      title = '',
      w_pop = 600,
      h_pop = 600,
      scren_left = w.screenLeft ? w.screenLeft : screen.left,
      scren_top = w.screenTop ? w.screenTop : screen.top,
      width = w.innerWidth,
      height = w.innerHeight,
      left = ((width / 2) - (w_pop / 2)) + scren_left,
      top = ((height / 2) - (h_pop / 2)) + scren_top,
      newWindow = w.open(url, title, 'scrollbars=yes, width=' + w_pop + ', height=' + h_pop + ', top=' + top + ', left=' + left);
    if (w.focus) {
      newWindow.focus();
    }
    return false;
  });

  function products_load() {
    if (window.products_load) {

      // wrapper selector
      var wrap_selector = '.product-tabs-wrapper .swiper-wrapper-tab';

      //button click
      $('.product-tabs-wrapper .filters ul li').on('click', function (e) {

        $('.product-tabs-wrapper .filters ul li').removeClass('active');
        $(this).addClass('active');

        var cats = $(this).attr('data-filter'),
          order = $(this).closest('.filters').attr('data-order'),
          orderby = $(this).closest('.filters').attr('data-orderby'),
          count = $(this).closest('.filters').attr('data-count'),
          autoplay = $(this).closest('.product-tabs-wrapper').find('.pixxy-product-filter').attr('data-autoplay'),
          speed = $(this).closest('.product-tabs-wrapper').find('.pixxy-product-filter').attr('data-speed'),
          addslides = $(this).closest('.product-tabs-wrapper').find('.swiper-wrapper-tab').attr('data-add-slides'),
          mdslides = $(this).closest('.product-tabs-wrapper').find('.swiper-wrapper-tab').attr('data-md-slides'),
          smslides = $(this).closest('.product-tabs-wrapper').find('.swiper-wrapper-tab').attr('data-sm-slides'),
          xsslides = $(this).closest('.product-tabs-wrapper').find('.swiper-wrapper-tab').attr('data-xs-slides'),
          loop = $(this).closest('.product-tabs-wrapper').find('.pixxy-product-filter').attr('data-loop');

        var $container = $(wrap_selector);
        $.ajax({
          url: get.ajaxurl,
          type: "post",
          data: ({
            action: 'pixxy_products_slider_load',
            cats: cats,
            order: order,
            orderby: orderby,
            count: count,
            addslides: addslides,
            mdslides: mdslides,
            smslides: smslides,
            xsslides: xsslides,
            speed: speed,
            loop: loop,
            autoplay: autoplay
          }),
          success: function (data) {

            $container.html(data);
            $('img[data-lazy-src]').foxlazy();
            $container.find('img[data-lazy-src]').foxlazy();
            wpc_add_img_bg('.s-img-switch');

            initSwiper();
          }
        });
        return false;
      });
    }
  }

  function removeBracketsFromFilter() {
    if ($('.tg-filter-name').length) {
      $('.tg-filter-name').each(function () {
        var text = $(this).text().replace(/[0-9]|\(|\)/g, '');
        var number = $(this).find('.tg-filter-count').text();
        $(this).text(text).append('<span class="tg-filter-count">' + number + '</span>');
      });
    }
  }

  // over ride click link in menu
  $('.menu a[href*="#"]:not([href="#"])').on('click', function(event) {
    event.preventDefault();
    var target = $(this).attr('href');
    var number = target.indexOf("#");
    var id = target.slice(number);

    if ($(id).length) {
      var pos = $(id).offset().top - ($('.header_trans-fixed').outerHeight() + $('#wpadminbar').outerHeight());
      $('body, html').animate({scrollTop: pos}, 1500);
    } else {
      window.location.href = target;
    }
  });

  window.hashName = window.location.hash;
  $(window).ready(function () {
    var $target = $(hashName);
    if (hashName.length != 0 && $target) {
      var pos = $target.offset().top - ($('.header_trans-fixed').outerHeight() + $('#wpadminbar').outerHeight());
      $('body, html').animate({scrollTop: pos}, 1500);
    }
  });

  $(window).on('scroll', function() {
    if($('footer').length && ($(window).scrollTop() > $('footer').offset().top - 600) && $('.single-pagination.left_gallery').length ) {
      $('.single-pagination.left_gallery').addClass('change-color');
    } else if( $('.single-pagination.left_gallery').length) {
      $('.single-pagination.left_gallery').removeClass('change-color');
    }
  });

  $(window).on('load', function () {
    wpc_add_img_bg('.s-img-switch');
    calcZindex();
    addTransition();
    products_load();
    removeBracketsFromFilter();
    $("img[data-lazy-src]").foxlazy();
    setTimeout(function () {
      initIsotope();
    }, 300);
    popupVideo();
    load_more_blog_posts();
    onYouTubeIframeAPIReady();
    blogImageSlider();
    setTimeout(function () {
      $(window).trigger('resize');
    }, 500);
  });

  $(window).on('load resize', function () {
    initIsotope();
    calcPaddingBlog();
  });

  $(window).on('load resize', function () {
    setTimeout(initSwiper, 100);
    footerWidgetsHeight();
    calcPaddingMainWrapper();
    topBannerHeight();
    fixedMobileMenu();
    menuArrows();
    protectHeight();
    postHeight();
    initBlogIsotope();
    leftGalleryImages();
  });

  window.addEventListener("orientationchange", function () {
    initSwiper();
    footerWidgetsHeight();
    calcPaddingMainWrapper();
    topBannerHeight();
    fixedMobileMenu();
    menuArrows();
    protectHeight();
    postHeight();
    initIsotope();
    $("img[data-lazy-src]").foxlazy('', function () {
      setTimeout(initIsotope, 500);
      initBlogIsotope();
    });
  });

  $(window).on('load scroll resize', function () {
    addAnimation();
    if($("img[data-lazy-src]").length){
      $("img[data-lazy-src]").foxlazy('', function () {
          setTimeout(initIsotope, 500);
          initBlogIsotope();
      });
    }
  });
})(jQuery, window, document);