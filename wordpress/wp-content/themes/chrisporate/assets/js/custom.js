jQuery(document).ready(function($) {

    /*------------------------------------------------
                DECLARATIONS
    ------------------------------------------------*/

    var loader = $('#loader');
    var loader_container = $('#loader-container');
    var display_none = $('.display-none');
    var scrollup = $('.backtotop');

    /*------------------------------------------------
                PRELOADER
    ------------------------------------------------*/

    loader.fadeOut();
    loader_container.fadeOut();
    display_none.css({'display' : 'block'});

    /*------------------------------------------------
                BACK TO TOP
    ------------------------------------------------*/

    $(window).scroll(function() {
        if ($(this).scrollTop() > 1) {
            scrollup.css({bottom:"25px"});
        } 
        else {
            scrollup.css({bottom:"-100px"});
        }
    });

    scrollup.click(function() {
        $('html, body').animate({scrollTop: '0px'}, 800);
        return false;
    });

    /*------------------------------------------------
                    MENU ACTIVE AND STICKY
    ------------------------------------------------*/

    $('.main-navigation ul li').click(function() {
        $('.main-navigation ul li').removeClass('current-menu-item');
        $(this).addClass('current-menu-item');
    });

    $('.main-navigation ul li a.search').click(function() {
        $('.main-navigation #search').fadeToggle();
        $('.main-navigation .search-field').focus();
    });

    $(window).scroll(function() {    
        var scroll = $(window).scrollTop();  
        if (scroll > 1) {
            $(".site-header.is-sticky").addClass("nav-shrink");
        }
        else {
             $(".site-header.is-sticky").removeClass("nav-shrink");
        }
    });

    $("#masthead .menu-toggle").click(function() {    
        $("#masthead .menu-toggle").toggleClass("active");
        $("#masthead").toggleClass("menu-active");
        $('.main-navigation').toggleClass('toggled');
        $(".main-navigation").fadeToggle();
    });

    $('.main-navigation .menu-item-has-children > a').after('<button class="dropdown-toggle"><i class="fa fa-angle-down"></button>');

    /*------------------------------------------------
                  SEARCH
    ------------------------------------------------*/

    $('.main-navigation ul li a.search').click(function() {
        $(this).toggleClass('search-open');
        $('.main-navigation #search').Toggle();
        $('.main-navigation .search-field').focus();
    });

    /*------------------------------------------------
                  DROP-DOWN-MENU
    ------------------------------------------------*/

    $('.main-navigation .dropdown-toggle').click(function() {
        $(this).toggleClass('active');
        $(this).parent().find('.sub-menu').first().slideToggle();
    });
        
    /*------------------------------------------------
                   SECTION-SCROLL
    ------------------------------------------------*/

    $('.scroll-link').on('click', function(event) {
      event.preventDefault();
      var section = $(this).attr("href");

        $('html,body').animate({
            scrollTop: $(section).offset().top},
        '800');
    });

    /*------------------------------------------------
                   ICONS-MENU
    ------------------------------------------------*/

    var sectionPosition = $("#content").offset().top;
    $(window).scroll(function() {
        var scroll = $(window).scrollTop();
        if (scroll >= sectionPosition ) {
            $('.icons-menu').fadeIn();
        } 
        else {
            $('.icons-menu').fadeOut();

        }
    });

    $('.scroll-link').on('click', function(event) {
      event.preventDefault();
      var section = $(this).attr("href");

        $('html,body').animate({
            scrollTop: $(section).offset().top},
        '800');

        $('.icons-menu li .scroll-link').parent().removeClass('active');
        $(this).parent().addClass('active');
    });

    function onScroll(){
        var scrollPosition = $(document).scrollTop();
        $('.icons-menu li .scroll-link').removeClass('active');
        $('.icons-menu .scroll-link').each(function () {
            var currentLink = $(this);
            var refElement = $(currentLink.attr("href"));
            if (refElement.position().top -10 <= scrollPosition && refElement.position().top -10 ) {
                $('.icons-menu .scroll-link').parent().removeClass("active");
                currentLink.parent().addClass("active");
            }
            else{
                currentLink.parent().removeClass("active");
            }
        });
    }

    $(window).scroll(function() {
        onScroll();
    });

    /*------------------------------------------------
                   SLICK SLIDER
    ------------------------------------------------*/

    $('.testimonial-slider').slick();
    $('.author-slider').slick();
    $('#client .regular').slick({
        responsive: [
        {
          breakpoint: 992,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 1
          }
        },
        {
          breakpoint: 767,
          settings: {
            slidesToShow: 3,
          }
        },
        {
          breakpoint: 567,
          settings: {
            slidesToShow: 2,
          }
        },
        {
          breakpoint: 421,
          settings: {
            slidesToShow: 1,
          }
        }
      ]
    });

    $('#author .slick-prev').insertAfter('#author .entry-content');
    $('#author .slick-next').insertAfter('#author .entry-content');

    /*------------------------------------------------
                    TABS   
    ------------------------------------------------*/

    $("#services .nav-tabs li a").click(function(event) {
        event.preventDefault();
        $(this).parent().addClass("active");
        $(this).parent().siblings().removeClass("active");
        var tab = $(this).attr("href");
        $("#services .tab-pane").not(tab).css("display", "none");
        $(tab).fadeIn();

    });

    $("#team .nav-tabs li a").click(function(event) {
        event.preventDefault();
        $(this).parent().addClass("active");
        $(this).parent().siblings().removeClass("active");
        var tab = $(this).attr("href");
        $("#team .tab-pane").not(tab).css("display", "none");
        $(tab).fadeIn();

    });

    /*------------------------------------------------
                        COUNTER   
    ------------------------------------------------*/
    function count($this){
        var current = parseInt($this.html(), 10);
        current = current + 1; /* Where 50 is increment */
        $this.html(++current);
        if(current > $this.data('count')){
            $this.html($this.data('count'));
        } 
        else {    
            setTimeout(function(){count($this)}, 5);
        }
    }        
        
    $(".stat-count").each(function() {
        $(this).data('count', parseInt($(this).html(), 10));
        $(this).html('0');
        count($(this));
    });

    /*------------------------------------------------
                        SECTION DISABLED CSS   
    ------------------------------------------------*/

    if( $('#counter').hasClass('relative') ) {
        $('#services').css("border-bottom", "none");
    }

    if( $('#author').hasClass('relative') ) {
        $('#portfolio').css("border-bottom", "none");
    }

    if( $('#testimonial').hasClass('relative') ) {
        $('#latest-blog').css("border-bottom", "none");
    }

    if( $('#client').hasClass('relative') ) {
        $('#team').css("border-bottom", "none");
    }

    if( $('#contact-form').hasClass('relative') ) {
        $('#client').css("border-bottom", "none");
    }

    if( $('#map').hasClass('relative') ) {
        $('#subscribe').css("border-top", "none");
    }

    /*------------------------------------------------
                SNOWFALL   
    ------------------------------------------------*/

    if ( $.isFunction($.fn.letItSnow) ) {
       $('body').letItSnow();
    }
 
/*------------------------------------------------
                END JQUERY
------------------------------------------------*/
});

