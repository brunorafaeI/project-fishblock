/********* effect images **************/
        $("span.roll").css("opacity","0");

// ON MOUSE OVER
        $("span.roll").hover(function () {

// SET OPACITY TO 80%
                $(this).stop().animate({
                    opacity: .8
                }, "slow");
            },

// ON MOUSE OUT
            function () {

// SET OPACITY BACK TO 0%
                $(this).stop().animate({
                    opacity: 0
                }, "slow");
            });


/********* SlideShow **************/
$(function(){
    var image = $('ul.slide-fish li');
    var nav = $('ul.nav-slide-fish li');
    var link = $('ul.nav-slide-fish li a');
    var linkSelect = $('ul.nav-slide-fish li a.select').index();

    image.eq(2).show();
    link.eq(2).addClass('select');


    link.click(function(){
        reset();
        changeSlide($(this).parent().index());

    });

    function reset(){
        image.hide();
        link.removeClass('select');
    }

    function changeSlide(slide){
        image.eq(slide).fadeIn();
        link.eq(slide).addClass('select');
        linkSelect = slide;
    }


    setInterval(function(){

        linkSelect = (linkSelect == (image.length -1)) ? 0 : linkSelect +1;
        reset();
        changeSlide(linkSelect);

        /********* Alerts messages **************/
        $("div.alert-fish").addClass("animated fadeOutRight");
    }, 5000);


})

/********* SlideShow DEV **************/
/*$(function() {
    var currentTheme = '';
    $('#change-theme').on('click', 'a', function(e) {
        e.preventDefault();
        var theme = 'skitter-' +  $(this).data('theme')
        $('#change-theme a').removeClass('active');
        $(this).addClass('active');
        $('.skitter-large').removeClass(currentTheme).addClass(theme);
        currentTheme = theme;
    });

    $('#change-animation').on('click', 'a', function(e) {
        e.preventDefault();
        var animation = $(this).data('animation');
        $('#change-animation a').removeClass('active');
        $(this).addClass('active');
        $('.skitter-large').skitter('setAnimation', animation);
        $('.skitter-large').skitter('next');
    });

    var animations = $('.skitter-large').skitter('getAnimations');
    for (var i in animations) {
        var animation = animations[i];
        var item = '<li><a href="#" data-animation="' + animation + '">' + animation + '</a></li>';
        $('#change-animation ul').append(item);
    }
})*/



