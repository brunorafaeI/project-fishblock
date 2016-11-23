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
/*
var connection = new WebSocket('ws://localhost:3553', ['soap', 'xmpp']);

// When the connection is open, send some data to the server
connection.onopen = function () {
    connection.send('Ping'); // Send the message 'Ping' to the server
};

// Log errors
connection.onerror = function (error) {
    console.log('WebSocket Error ' + error);
};

// Log messages from the server
connection.onmessage = function (e) {
    console.log('Server: ' + e.data);
};


// Sending String
connection.send('your message');

// Sending canvas ImageData as ArrayBuffer
var img = canvas_context.getImageData(0, 0, 400, 320);
var binary = new Uint8Array(img.data.length);
for (var i = 0; i < img.data.length; i++) {
    binary[i] = img.data[i];
}
connection.send(binary.buffer);

// Sending file as Blob
var file = document.querySelector('input[type="file"]').files[0];
connection.send(file);

// Setting binaryType to accept received binary as either 'blob' or 'arraybuffer'
connection.binaryType = 'arraybuffer';
connection.onmessage = function(e) {
    console.log(e.data.byteLength); // ArrayBuffer object if binary
};

// Determining accepted extensions
console.log(connection.extensions);*/
