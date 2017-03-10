//Animation time
var aniTime = 1600;
var mastHeight = $('#masthead').height();
var bHead = $('#bootleaf header').outerHeight();
var navClasses = 'active slideInLeft';
var navOut = 'slideOutLeft';

//Toggle active on anything assigned to data-act attribute
function setWin() {
    //Whats the window width?
    winW = $(window).width();
    winH = $(window).height();
    fillHeight = winH - mastHeight;//get the height minus the masthead height
    mapHeight = fillHeight - bHead;
}

$(function() {
    setWin();

    $(".tweets .close").on("click", function(e) {
        e.preventDefault();
        $(".tweets").removeClass('revealOnScroll fadeInLeft animated').fadeOut('medium');
    });

    $(".ntrig").on("click", function(e) {
        e.preventDefault();
        //console.log('works');
        if ($(this).hasClass('active')) {
            $(this).removeClass('active');
            $('#navi').removeClass(navClasses).addClass(navOut );
        } else {
            $(this).addClass('active');
            $('#navi').removeClass(navOut).addClass(navClasses);
        }

    });


    var $window = $(window),
            win_height_padded = $window.height() * 1.1,
            isTouch = Modernizr.touch;

    if (isTouch) {
        $('.revealOnScroll').addClass('animated');
    }

    $window.on('scroll', revealOnScroll);

    function revealOnScroll() {
        var scrolled = $window.scrollTop(),
                win_height_padded = $window.height() * 1.1;

        // Showed...
        $(".revealOnScroll:not(.animated)").each(function() {
            var $this = $(this),
                    offsetTop = $this.offset().top;

            if (scrolled + win_height_padded > offsetTop) {
                if ($this.data('timeout')) {
                    window.setTimeout(function() {
                        $this.addClass('animated ' + $this.data('animation'));
                    }, parseInt($this.data('timeout'), 10));
                } else {
                    $this.addClass('animated ' + $this.data('animation'));
                }
            }
        });
        // Hidden...
        $(".revealOnScroll.animated").each(function(index) {
            var $this = $(this),
                    offsetTop = $this.offset().top;
            if (scrolled + win_height_padded < offsetTop) {
                $(this).removeClass('animated fadeInUp flipInX lightSpeedIn')
            }
        });
    }

    revealOnScroll();

});