
jQuery(window).load(function(){

    $("#text").hide();

    //Animation of control panel
    $("#panel, #panel2").mouseenter(function(){
        $(this).stop().animate({'opacity':'1'}, 200);
    }).mouseleave(function(){
        $(this).animate({'opacity':'0.7'}, 200);
    });

    //Slider animation up-down
    $("#sliderix").mouseover(function(e){
        var position = $("#sliderix").position();
        var position_ss = $("#slideshow").position();
        var sl = $("#sliderix").height();
        var ss = $("#slideshow").height();
        //Height difference between slider and its container
        var dh = sl - ss;
        //If there are many images
        if (dh>0) {
            if ((e.pageY-position_ss.top) < ss/4) {
                if ( position.top < 0 ) $("#sliderix").stop().animate({top:'2px'}, 200);
            }
            if ((e.pageY-position_ss.top) > ss/2 ) {
                if (position.top >= -50) $("#sliderix").stop().animate({top:-dh}, 200);
            }
            //If there are few images
        } else {
            $("#sliderix").animate({top:-dh/2}, 200);
        }
    });

    photo(1); //Start from the first slide

    $("#slider_back, #panel, #panel2, #left, #right").hide();

    $("#slideshow").mouseenter(function(){
        $("#slider_back").fadeIn(95);
        $("#panel, #panel2, #left, #right").show();
    }).mouseleave(function(){
        $("#slider_back").fadeOut(99);
        $("#panel, #panel2, #left, #right").hide();
    });

});//end of load

function photo(number) {
    //Slodeshow uses jQuery Cycle Plugin
    sounds = number; //Important!
    stop_all_sounds();

    $("#photos").cycle({
        fx: 'scrollLeft', //Choose effect from the list: fade,blindY,blindZ,scrollLeft,scrollRight,scrollHorz,scrollVert,
        speed: 1000, //Скорость перехода
        timeout: 3700, //Задержка
        startingSlide: number-1, //Номер первого слайда показа
        fit: true, //Растянуть картинку на ширину контейнера
        width: 960, //Ширина контейнера
        after: onAfter,
        before: onBefore
    });

    if(show == false) {
        $("#photos").cycle('pause');
    }
}

//Cleaning
function stop_all_sounds() {
    for (i=1; i<max+1; i++) {
        try {
            audio[i].pause();
        } catch(e){}
    }
}

function clear_all_minis() {
    for (i=1; i<max+1; i++) {
        try {
            var str="m" + i;
            document.getElementById(str).style.cssText="border:;opacity:0.5";
        } catch(e) {}
    }
}

function onBefore(a,b,opt,d){
    clear_all_minis();
}

function onAfter(a,b,opt,d) {
    var dh = $("#sliderix").height() - $("#slideshow").height();
    currslide = opt.nextSlide;
    if (currslide == 0) currslide = max;
    var str = "m" + (currslide);
    if (dh > 0){
        if (currslide == 1) {
            $("#sliderix").css({top:'2px'});
        } else {
            $("#sliderix").offset({top:$("#sliderix").offset().top - (dh/max) - 1});
        }
    }
    try {
        document.getElementById(str).style.cssText="border:1px solid red;opacity:1";
    } catch(e) {

    }
}

//Sound
var play = false;
if (play == false) $("#sound_button").fadeTo(0, 0.5);

var show=true; //slide change

//Sounds in automatic mode
var sounds = 1;
var prev = 0;
var audio = new Audio();
audio.src = 'sounds/1.ogg';

function soundOff(obj) {
    if (play == true) {
        play = false; obj.style.opacity = 0.5;
        try {
            audio.volume = 0;
        } catch(e) {}
    } else {
        play=true; obj.style.opacity = 1;
        try {
            audio.play();
            audio.volume = 1;
        } catch(e) {}
    }
}

function textOff(obj) {
    if (text == true) {
        text = false;
        obj.style.opacity = 0.5;
        $("#text").hide();
    } else {
        text=true;
        obj.style.opacity = 1;
        $("#text").show();
    }
}

function showOff(obj) {
    if(show == true){
        show = false; obj.style.opacity = 0.5;
        $('#photos').cycle('pause');
    } else {
        show = true;
        obj.style.opacity = 1;
        $('#photos').cycle('resume');
    }
}
//Popup window
function popup(){
    error = false;
    data = $("#order").serialize();
    $("#order").find('input, textarea').each( function(){
        if ($(this).val() == '') {
            alert('Заполните поле "' + $(this).attr('name') + '"!');
            error = true;
        }
    });
    if (error != true) $.post('order_form.php', data , Success(data));
}
function Success(data){
    $("#popup").animate({opacity:0.9},500);
    setTimeout(function(){$("#popup").animate({opacity:0},500); },5000);
}

//Additional functions
jQuery(window).load(function(){
    //Width of wrapper
    var width = $(window).width();
    if (width > 960) {
        var ratio = 960*100/width + "%";
        $(".wrapper").css("width",ratio);
    }
    //Overlay of downloading
    $("#loading").hide(); //Hide layout after downloading
    $("#overlay").slideUp(500);
});

jQuery(window).resize(function(){
    var width = $(window).width();
    if (width > 960) {
        var ratio = 960*100/width + "%";
        $(".wrapper").css("width",ratio);
    }
});