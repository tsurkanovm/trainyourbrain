
window.onload = function(){
    var answer;
    var total_exp = 3;
    var current_exp = 1;
    var currentTimeVal = 1;
    var set_interval_id = null;


    var board = $("#board");
    var clock = $("#clock");

    var test = $("#test_tool");
    test.tooltip('show');

    console.log(12343);

    var result = {
        user_id: board.data("user"),
        test_id: board.data("test"),
        result: 0
    };
    //console.log(document.location.origin + "/frontend/web/dashboard");
    start();

    function clockGoesOn(){
        if ( clock.length ) {
            clock.text( currentTimeVal );
            currentTimeVal++;
        }
    }

    function start( ){

        set_interval_id = setInterval(clockGoesOn, 1000);
        addNewExpression();
    }

    function pause(){
        if( set_interval_id )
            clearInterval(set_interval_id)
        var answer_input = $("#answer_input");
        if (answer_input) {
            answer_input.disabled = true
        }
    }

    function addNewExpression(){

        var title = "Решено - " + (current_exp - 1) + " из " + total_exp;
        var title_tag = $("<h4></h4>");

        title_tag.text( title );
        var expression = $("#exp");

        if ( expression.length ) {
            // already exist, so refresh it
            expression.text("");
        }else{
            expression = $("<div></div>");
            expression.attr("id" , "exp");
        }
        var answer_input = $("<input>");
        answer_input.attr("id", "answer_input");
        // options for tooltip, for popup window if given answer was wrong
        answer_input.attr("data-placement", "right");
        answer_input.attr("data-delay", "100");
        answer_input.attr("data-title", "Ответ неверный!!");
        answer_input.attr("data-trigger", "manual");
        // ===
        answer_input.keypress( checkAnswer );

        expression.append( title_tag, createExpression(), answer_input).appendTo( board );

    }

    function checkAnswer ( event ){
        if ( event.keyCode == 13 ) {
            var answer_input = $("#answer_input");
            if ( answer == document.activeElement.value ) {

                current_exp++;
                if ( current_exp - 1 < total_exp ) {
                    addNewExpression();

                    if (answer_input) {
                        answer_input.focus();
                    }
                }else{
                    finishTest();
                }

            } else {
                //console.log( answer_input.data() );
                //answer_input.tooltip(answer_input.data());
                answer_input.tooltip('show');
            }
        }
    }

    function finishTest(){
        pause();
        var expression = document.getElementById("exp");
        if (expression) {
            // already exist, so refresh it
            expression.innerHTML = "";
        }
        result.result = currentTimeVal;
        var title = "Поздравляем " + total_exp  + " примеров решены за " + currentTimeVal + " секунд!";
        var title_tag = document.createElement("h4");
        title_tag.innerHTML = title;
        board.append(title_tag);

        $.post( document.location.origin + "/frontend/web/dashboard/set-result", result, function(){
            document.location.replace( document.location.origin + "/frontend/web/dashboard" );
        },'JSON' );


    }

    function getRandomInt(min, max) {
        return Math.floor(Math.random() * (max - min)) + min;
    }

    function getSign() {
        var sign_index = getRandomInt(0,2);
        switch (sign_index) {
            case 0:
                return "+";
            case 1:
                return "-";
            default :
                return "*";
        }
    }

    function createExpression(){
        var sign = getSign();
        if (sign == "-") {
            var first = getRandomInt(9,19);
            var second = getRandomInt(0,9);
            answer = first - second;

        }else if( sign == "+" ) {
            var first = getRandomInt(0,9);
            var second = getRandomInt(0,9);
            answer = first + second;
        }
        else if( sign == "*" ) {
            var first = getRandomInt(0,9);
            var second = getRandomInt(0,9);
            answer = first * second;
        }

        return first + " " + sign + " " + second + " = ";
    }
}

