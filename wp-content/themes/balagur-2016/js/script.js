/**
 * Theme script file.
 */

( function( $ ) {
    var container, menu;

    function formChangeStates(form, elementWrapper) {
        function checkState(formElement) {
            formElement.each(function(){
                if ($(this).val().length) {
                    $(this).parents(elementWrapper).addClass('isDirty');
                }
            })
        }
        checkState($('input[type="text"]'));
        checkState($('input[type="email"]'));
        checkState($('textarea'));

        $('input[type="text"], input[type="email"], textarea')
            .on('focus', function() {
                $(this).parents(elementWrapper).addClass('isFocused');
            })
            .on('blur', function() {
                $(this).parents(elementWrapper).removeClass('isFocused');
            })
            .on('change', function() {
                if ( $(this).val().length ) {
                    $(this).parents(elementWrapper).addClass('isDirty');
                } else {
                    $(this).parents(elementWrapper).removeClass('isDirty');
                }
            })
    };
    function formValidation(form) {
        function disableButton(button) {
            button.attr("disabled", "disabled").parent().addClass('js-disabled');
        }
        function enableButton(button) {
            button.removeAttr("disabled", "disabled").parent().removeClass('js-disabled');
        }
        function validateEmail(email) {
            var re = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            return re.test(email);
        }
        function validateField (element) {
            var emptyFieldText = '<span role="alert" class="vb-not-valid-tip">Поле обязательно.</span>',
                invalidEmailText = '<span role="alert" class="vb-not-valid-tip">Введённый электронный адрес неверен.</span>';

            element.parent().find('span[role="alert"]').remove();

            if (element.val().length == 0) {
                element.parent().append(emptyFieldText);
            } else if (element.attr('name') == 'email' && !validateEmail(element.val())) {
                element.parent().append(invalidEmailText);
            } else {
            }
        }

        var submitButton = $(form).find('input[type="submit"]');

        disableButton(submitButton);

        $(form).on('change blur', '[required]', function() {
            validateField ($(this));
            if ($('.vb-not-valid-tip').length == 0) {
                enableButton(submitButton);
            } else {
                disableButton(submitButton);
            }
        });
    };
    function toggleMenu() {
        var menuButton = $('#menu-toggle'),
            menu = $('#site-navigation'),
            siteContent = $('.vb-site-inner'),
            site = $('.vb-site'),
            isOpened = false;

        menuButton.on('click', function() {
            menu.addClass('menu-visible');
            site.addClass('menu-opened');
            $('.menu-overlay').fadeIn(300);
        });
        $('.menu-overlay').on('click', function() {
            menu.removeClass('menu-visible');
            site.removeClass('menu-opened');
            $('.menu-overlay').fadeOut(300);
        });
    };

   /* function lazyPicture(self) {
        if (self.find($('.vb-picture-lazy'))) {
            self.find($('source')).each(function () {
                $(this).animate({ opacity: 0 }, 100, function() {
                    $(this).attr('srcset', $(this).attr('data-lazy-srcset'));

                    $(this).animate({ opacity: 1 }, 200, function() {
                        $(this).removeAttr('data-lazy-srcset');
                    });
                });
            });
            self.find($('img')).each(function () {
                $(this).animate({ opacity: 0 }, 100, function() {
                    $(this).attr('src', $(this).attr('data-lazy-src'));

                    $(this).animate({ opacity: 1 }, 200, function() {
                        $(this).removeAttr('data-lazy-src');
                    });
                });
            })
        }
    }*/

    $.fn.scrollToLinks = function() {
        var targetIdName = "",
            targetOffsetTop = 0;

        this.on('click', function(e) {
            targetIdName = $(this).attr("href");

            if ( $(targetIdName).length ) {
                targetOffsetTop = $(targetIdName).offset().top;
                e.preventDefault();

                $("html, body").animate({
                    scrollTop: targetOffsetTop
                }, 600);
                return false;
            }
        })
    };

    $.fn.scrollToTop = function() {
        var _ = this;

        _.on('click', function() {
            $("html, body").animate({ scrollTop: 0 }, 600);
        });

        $(window).on('scroll.balagur2016', function() {
            if ($(document).scrollTop() > 550) {
                _.addClass('isShown');
            } else {
                _.removeClass('isShown');
            }
        });
    };

    $.fn.lazyLoadCache = function() {
        this.each(function() {
            if ($(this).is('[data-lazy-src]')) {
                if ($(this).is('img')) {
                    $(this).attr('src', $(this).attr('data-lazy-src')).fadeIn();
                } else {
                    var url = 'url(' + $(this).attr('data-lazy-src') + ')';
                    $(this).css('background-image', url);
                }
            }
        });
    };

    $.fn.expandAjaxLoader = function() {
        this.prepend('<span class="bar1"></span><span class="bar2"></span><span class="bar3"></span><span class="bar4"></span>');
    };

    $(document).ready(function() {
        $('.js-slickBanners').slick({
            infinite: true,
            lazyLoad: 'ondemand',
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 5000,
            arrows: false
        });
        $('.js-slickCorporates').slick({
            infinite: true,
            lazyLoad: 'ondemand',
            slidesToShow: 8,
            slidesToScroll: 8,
            autoplay: true,
            autoplaySpeed: 5000,
            prevArrow: '<button type="button" data-role="none" class="slick-prev" aria-label="Previous" tabindex="0" role="button"><span></span></button>',
            nextArrow: '<button type="button" data-role="none" class="slick-next" aria-label="Next" tabindex="0" role="button"><span></span></button>',
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 6,
                        slidesToScroll: 6,
                        infinite: true
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 5,
                        slidesToScroll: 5
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3
                    }
                }
            ]
        });
        $('.js-slickReviews').slick({
            infinite: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 10000,
            arrows: false
        });

        formChangeStates('.vb-form-wrapper', '.vb-form-common-group');
        formValidation('.vb-form-wrapper.comment-form');
        toggleMenu();

        $('a[href^="#"]').scrollToLinks();
        $('.js-scrollTop').scrollToTop();
        $('.vb-img-lazy').lazyLoadCache();
        $('.ajax-loader').expandAjaxLoader();
    });
})( jQuery );