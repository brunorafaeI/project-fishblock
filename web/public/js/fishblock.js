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
    }, 4000);


})

/********* Websocket **************/

var websocket = WS.connect("ws://127.0.0.1:3553");

webSocket.on("socket/connect", function(session){

    //the callback function in "subscribe" is called everytime an event is published in that channel.
    session.subscribe("acme/channel", function(uri, payload){
        console.log("Received message", payload.msg);
    });

    session.publish("acme/channel", "This is a message!");
})

