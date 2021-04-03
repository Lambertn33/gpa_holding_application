(function($) {
    // "use strict";

    // ______________Loader
    $("#loading").fadeOut("slow");


    // ______________Cover Image
    $(".cover-image").each(function() {
        var attr = $(this).attr('data-image-src');
        if (typeof attr !== typeof undefined && attr !== false) {
            $(this).css('background', 'url(' + attr + ') center center');
        }
    });

    // ______________ Modal
    $("#myModal").modal('show');

    // ______________Horizontal-menu Active Class
    $(document).ready(function() {
        $(".horizontalMenu-list li a").each(function() {
            var pageUrl = window.location.href.split(/[?#]/)[0];
            if (this.href == pageUrl) {
                $(this).addClass("active");
                $(this).parent().addClass("active"); // add active to li of the current link
                $(this).parent().parent().prev().addClass("active"); // add active class to an anchor
                $(this).parent().parent().prev().click(); // click the item to make it drop
            }
        });
        $(".horizontal-megamenu li a").each(function() {
            var pageUrl = window.location.href.split(/[?#]/)[0];
            if (this.href == pageUrl) {
                $(this).addClass("active");
                $(this).parent().addClass("active");
                $(this).parent().parent().parent().parent().parent().parent().parent().prev().addClass("active");
                $(this).parent().parent().prev().click(); // click the item to make it drop
            }
        });
        $(".horizontalMenu-list .sub-menu .sub-menu li a").each(function() {
            var pageUrl = window.location.href.split(/[?#]/)[0];
            if (this.href == pageUrl) {
                $(this).addClass("active");
                $(this).parent().addClass("active"); // add active to li of the current link
                $(this).parent().parent().parent().parent().prev().addClass("active"); // add active class to an anchor
                $(this).parent().parent().prev().click(); // click the item to make it drop
            }
        });
    });

    // ______________ GLOBAL SEARCH
    $(document).on("click", "[data-toggle='search']", function(e) {
        var body = $("body");

        if (body.hasClass('search-gone')) {
            body.addClass('search-gone');
            body.removeClass('search-show');
        } else {
            body.removeClass('search-gone');
            body.addClass('search-show');
        }
    });


    // ______________ Back to Top
    $(window).on("scroll", function(e) {
        if ($(this).scrollTop() > 0) {
            $('#back-to-top').fadeIn('slow');
        } else {
            $('#back-to-top').fadeOut('slow');
        }
    });
    $("#back-to-top").on("click", function(e) {
        $("html, body").animate({
            scrollTop: 0
        }, 600);
        return false;
    });


    // ______________Quantity-right-plus
    var quantitiy = 0;
    $('.quantity-right-plus').on('click', function(e) {
        e.preventDefault();
        var quantity = parseInt($('#quantity').val());
        $('#quantity').val(quantity + 1);
    });
    $('.quantity-left-minus').on('click', function(e) {
        e.preventDefault();
        var quantity = parseInt($('#quantity').val());
        if (quantity > 0) {
            $('#quantity').val(quantity - 1);
        }
    });

    // ______________Full screen
    $("#fullscreen-button").on("click", function toggleFullScreen() {
        $('html').addClass('fullscreen-button');
        if ((document.fullScreenElement !== undefined && document.fullScreenElement === null) || (document.msFullscreenElement !== undefined && document.msFullscreenElement === null) || (document.mozFullScreen !== undefined && !document.mozFullScreen) || (document.webkitIsFullScreen !== undefined && !document.webkitIsFullScreen)) {
            if (document.documentElement.requestFullScreen) {
                document.documentElement.requestFullScreen();
            } else if (document.documentElement.mozRequestFullScreen) {
                document.documentElement.mozRequestFullScreen();
            } else if (document.documentElement.webkitRequestFullScreen) {
                document.documentElement.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);
            } else if (document.documentElement.msRequestFullscreen) {
                document.documentElement.msRequestFullscreen();
            }
        } else {
            $('html').removeClass('fullscreen-button');
            if (document.cancelFullScreen) {
                document.cancelFullScreen();
            } else if (document.mozCancelFullScreen) {
                document.mozCancelFullScreen();
            } else if (document.webkitCancelFullScreen) {
                document.webkitCancelFullScreen();
            } else if (document.msExitFullscreen) {
                document.msExitFullscreen();
            }
        }
    })


    // ______________Chart-circle
    if ($('.chart-circle').length) {
        $('.chart-circle').each(function() {
            let $this = $(this);
            $this.circleProgress({
                fill: {
                    color: $this.attr('data-color')
                },
                size: $this.height(),
                startAngle: -Math.PI / 4 * 2,
                emptyFill: '#ebebf1',
                lineCap: ''
            });
        });
    }
    const DIV_CARD = 'div.card';
    // ______________Tooltip
    $('[data-toggle="tooltip"]').tooltip();

    // ______________Popover
    $('[data-toggle="popover"]').popover({
        html: true
    });

    // ______________Card Remove
    $('[data-toggle="card-remove"]').on('click', function(e) {
        let $card = $(this).closest(DIV_CARD);
        $card.remove();
        e.preventDefault();
        return false;
    });

    // ______________Card Collapse
    $('[data-toggle="card-collapse"]').on('click', function(e) {
        let $card = $(this).closest(DIV_CARD);
        $card.toggleClass('card-collapsed');
        e.preventDefault();
        return false;
    });

    // ______________Card Full Screen
    $('[data-toggle="card-fullscreen"]').on('click', function(e) {
        let $card = $(this).closest(DIV_CARD);
        $card.toggleClass('card-fullscreen').removeClass('card-collapsed');
        e.preventDefault();
        return false;
    });


    // ______________Increment
    var quantitiy = 0;
    $('.quantity-right-plus').on('click', function(e) {
        e.preventDefault();
        var quantity = parseInt($('#quantity').val());
        $('#quantity').val(quantity + 1);

    });
    $('.quantity-left-minus').on('click', function(e) {
        e.preventDefault();
        var quantity = parseInt($('#quantity').val());
        if (quantity > 0) {
            $('#quantity').val(quantity - 1);
        }
    });

    // ______________Jquery.Buttonloadingindicator
    $.fn.startLoading = function() {
        return this.each(function() {
            $(this).attr("disabled", true).addClass("disabled");
        });
    }
    $.fn.stopLoading = function() {
        return this.each(function() {
            $(this).removeAttr("disabled").removeClass("disabled");
        });
    }
    $("a.customspin").on("click", function(ev) {
        ev.preventDefault();
        $(this).startLoading();
        setTimeout(function() { $("a.customspin").stopLoading(); }, 3000);
    });


    // ______________Switcher-Toogle

    /*Theme-Layouts
    // $('body').addClass('light-mode');
    // $('body').addClass('dark-mode');

    /*Header Style*/
    // $('body').addClass('light-header');
    // $('body').addClass('color-header');
    // $('body').addClass('dark-header');
    // $('body').addClass('gradient-header');

    /*Leftmenu Background-image Styles*/
    // $('body').addClass('leftmenu-bgimage');

    /*Leftmenu Style*/
    // $('body').addClass('light-menu');
    // $('body').addClass('color-menu');
    $('body').addClass('dark-menu');
    // $('body').addClass('gradient-menu');

    /*Horizontal Style*/
    // $('body').addClass('light-hormenu');
    // $('body').addClass('color-hormenu');
    $('body').addClass('dark-hormenu');
    // $('body').addClass('gradient-hormenu');


})(jQuery);