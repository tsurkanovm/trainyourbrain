

window.onload = function () {

   // i = 1;
   // expression_quantity = 5; // переделать - брать из настроек
   // var e1 = document.getElementById("element_answer");

   // e1.addEventListener("keypress", checkTheAnswer, false);

   // findTIME();

    alert('It is working');
}

function checkTheAnswer(event) {
    var res = event.keyCode;
    var right_answer = document.getElementById("element_right_answer").value;
    var my_answer = document.activeElement.value;
    if ( res == 13 ) { // нажат ентер
        if( right_answer == my_answer ){
            if( i < expression_quantity ) {
                // предоставлен правильный ответ
                // запускаем AJAX
                // Создание объекта для HTTP запроса.
                xhr = new XMLHttpRequest();
                // Настройка объекта для отправки асинхронного GET запроса
                xhr.open("GET", "http://localhost/brain_v1/Exercise", true);

                xhr.onreadystatechange = serverResponse;
                // Отправка запроса, так как запрос асинхронный сценарий продолжит свое выполнение. Когда с сервера придет ответ сработает событие onreadystatechange
                xhr.send();

            } else {
                // достигли обработки последнего примера
                // отправляем в кабинет с результатами
                var time_result = document.clockform.clock.value;
                window.location.href = "http://localhost/brain_v1/Account/writeResult?time="+time_result;
            }

        }


    }
    else{
        // ответ неправильный. можно покрасить поле в красный
        // ....


    }

}



function serverResponse(){
    if (xhr.readyState == 4) { // если получен ответ
        if (xhr.status == 200) { // и если статус код ответа 200

            // responseText - текст ответа полученного с сервера.
            document.getElementById("ExerciseBlocks").innerHTML = xhr.responseText;
            var current_element = document.getElementById("element_answer");

            current_element.addEventListener("keypress", checkTheAnswer, false);
            current_element.focus();
            i++;
            if( i == expression_quantity ){
                // это был последний пример, закрываем соединение
                xhr.close();
                return;
            }

        }
    }
}



// CLOCK
var base = 60;
var clocktimer,dateObj,dh,dm,ds,ms;
var readout='';
var h=1;
var m=1;
var tm=1;
var s=0;
var ts=0;
var ms=0;
var show=true;
var init=0;
var ii=0;

function clearALL() {
    clearTimeout(clocktimer);
    h=1;m=1;tm=1;s=0;ts=0;ms=0;
    init=0;show=true;
    readout='00:00:00.00';
    document.clockform.clock.value=readout;
    var CF = document.clockform;
    ii = 0;	}

function startTIME() {
    var cdateObj = new Date();
    var t = (cdateObj.getTime() - dateObj.getTime())-(s*1000);

    if (t>999) { s++; }

    if (s>=(m*base)) { ts=0;
        m++; } else {
        ts=parseInt((ms/100)+s);
        if(ts>=base) { ts=ts-((m-1)*base); } }

    if (m>(h*base)) { tm=1;
        h++; } else {
        tm=parseInt((ms/100)+m);
        if(tm>=base) { tm=tm-((h-1)*base); } }

    ms = Math.round(t/10);
    if (ms>99) {ms=0;}
    if (ms==0) {ms='00';}
    if (ms>0&&ms<=9) { ms = '0'+ms; }

    if (ts>0) { ds = ts; if (ts<10) { ds = '0'+ts; }} else { ds = '00'; }
    dm=tm-1;
    if (dm>0) { if (dm<10) { dm = '0'+dm; }} else { dm = '00'; }
    dh=h-1;
    if (dh>0) { if (dh<10) { dh = '0'+dh; }} else { dh = '00'; }

    readout = dh + ':' + dm + ':' + ds + '.' + ms;
    if (show==true) { document.clockform.clock.value = readout; }

    clocktimer = setTimeout("startTIME()",1); }

function findTIME() {
    if (init==0) {	dateObj = new Date();
        startTIME();
        init=1;
    } else { if(show==true) {
        show=false;
    } else { show=true;	} } }
/**
 * Created by Mihail on 28.08.2015.
 */
