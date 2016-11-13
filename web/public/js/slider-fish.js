
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

