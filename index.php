<?php require "script.php"; require "counter.php";?>
<!DOCTYPE html>
<html>
<head>
<title>Фотограф Днепропетровск-Днепродзержинск</title>
<meta http-equiv="Content-Type" content="text/html" charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=0.8, maximum-scale=2.0">
<script type="text/javascript" src="lib/js/jquery.min.js"></script>
<script type="text/javascript" src="lib/js/jquery.cycle.all.min.js"></script>
<link rel="stylesheet" type="text/css" href="styles.css" />
</head>
<body>
<!--Overlay-->
<div id="overlay"></div>
<!--Header-->
<div id=top>
	<div class="wrapper">
		<div id="logo" align="left"><img src="logo2.png" alt="logo" height="120px"/></div>	
		<div class="right">
			<p>Фотограф Сергей Дрон</p>
			<p class="text2">vk.com/foto_sergeidron<br>dron-sergei@mail.ru<br>067-628-10-18</p>
		</div>
	</div>
</div>
<!--/Header-->
<!--Middle-->
<div id=middle>
<!--Slider-->
<div class=wrapper>
<div id="slideshow" style="border-radius:10px;overflow:hidden;width:960px;position:relative;left:0px;top:0px;margin:0px auto;">
<!--Slideshow-->
	<div  id="photos" style="cursor:pointer;border-radius:20px;height:640px;" onClick="$('#photos').cycle('next')"></div>
	<script type=text/javascript>
		//Large images
		var max=<?php echo $max;?>; 
		var title=new Array(); <?php foreach($title as $key=>$value){echo "title[$key]='".$value."';";} ?> 
		for(i=1;i<max+1;i++){ 
		document.getElementById("photos").innerHTML+='<img src="<?php echo $path_pics;?>'+i+'.jpg" alt="'+title[i]+'" />';
		} 
	</script>
<!--/Slideshow-->
<!--Mini slider-->
	<div id="slider_back" style="<?php echo $slider_back;?>"> 
		<div id="sliderix" style="<?php echo $sliderix;?>">
		<script type=text/javascript>
			//Small images
			var max=<?php echo $max;?>;
			for(i=1;i<max+1;i++){
			document.getElementById("sliderix").innerHTML+='<img id="m'+i+'" src="<?php echo $path_pics;?>'+i+'.jpg" alt="'+title[i]+'" onclick="photo('+i+')"  />';
			} 
		</script>		
		</div>
	</div>
<!--/Mini slider-->	
	<div id="panel2" style="background-color:none;border-radius:5px;text-color:#fff;opacity:0.9;overflow:hidden;position:absolute;left:10px;bottom:10px;height:100px;width:50px;z-index:99">
		<img id="sound_button" src="lib/images/sound2.png" onclick="soundOff(this)">
		<img id="show_button" src="lib/images/auto.png" onclick="showOff(this)">
	</div>
</div>

<script type="text/javascript"> 
 
jQuery(window).load(function(){

$("#text").hide();
//Animation of control panel
$("#panel").mouseenter(function(){
	$("#panel").stop();
	$("#panel").animate({'opacity':'1'}, 200); 
});
$("#panel").mouseleave(function(){
	$("#panel").animate({'opacity':'0.7'}, 200);
});
$("#panel2").mouseenter(function(){
	$("#panel2").stop();
	$("#panel2").animate({'opacity':'1'}, 200); 
});
$("#panel2").mouseleave(function(){
	$("#panel2").animate({'opacity':'0.7'}, 200);
}); 

//Slider animation up-down
$("#sliderix").mouseover(function(e){
	var position=$("#sliderix").position();
	var position_ss=$("#slideshow").position();
	var sl=$("#sliderix").height(); 
	var ss=$("#slideshow").height();
	//Height difference between slider and its container
	var dh=sl-ss; 
	//If there are many images
	if(dh>0){	
		if( (e.pageY-position_ss.top)<ss/4){

			if( position.top<0 ){ 
				$("#sliderix").stop();
				$("#sliderix").animate({top:'2px'}, 200);
			}
		} 
		if( (e.pageY-position_ss.top)>ss/2 ){
		
			if( position.top>=-50 ){
				$("#sliderix").stop();
				$("#sliderix").animate({top:-dh}, 200);
			}
		}
	//If there are few images
	} else { $("#sliderix").animate({top:-dh/2}, 200); }	
});

photo(1); //Start from the first slide

$("#slider_back").hide();
$("#panel").hide();
$("#panel2").hide();
$("#left").hide();
$("#right").hide();
$("#slideshow").mouseenter(function(){
	var fadein=95; //Fadein
	$("#slider_back").fadeIn(fadein);
	$("#panel").show();
	$("#panel2").show();
	$("#left").show();
	$("#right").show();
});
$("#slideshow").mouseleave(function(){
	var fadeout=99; //Fadeout
	$("#slider_back").fadeOut(fadeout);
	$("#panel").hide();
	$("#panel2").hide();
	$("#left").hide();
	$("#right").hide();
});

$("#loading").hide(); //Hide layout after downloading

});//end of load

function photo(number){
	//Slodeshow uses jQuery Cycle Plugin
	sounds=number; //Important!
	stop_all_sounds();

	$("#photos").cycle({
	fx: '<?php echo $fx;?>', //Choose effect from the list: fade,blindY,blindZ,scrollLeft,scrollRight,scrollHorz,scrollVert,
	speed: <?php echo $speed;?>, //Скорость перехода
	timeout: <?php echo $timeout;?>, //Задержка
	startingSlide: number-1, //Номер первого слайда показа
	fit: true, //Растянуть картинку на ширину контейнера
	width: <?php echo $width;?>, //Ширина контейнера 
	after:onAfter,
	before:onBefore,
	});

	if(show==false) { 
	$("#photos").cycle('pause'); 
	}
} //end of photo
//Cleaning
function stop_all_sounds(){	
	for(i=1; i<max+1; i++){
		try{audio[i].pause();} catch(e){}
	}
}
function clear_all_minis(){	
	for(i=1; i<max+1; i++){
		try{
		var str="m"+i;
		document.getElementById(str).style.cssText="border:;opacity:0.5";
		} catch(e){}
	}
}
function onBefore(a,b,opt,d){
	clear_all_minis(); 
}
function onAfter(a,b,opt,d) {
	var dh=$("#sliderix").height()-$("#slideshow").height(); 
	currslide=opt.nextSlide; 
	if( currslide==0 ){ currslide=max; }
	var str="m"+(currslide);
	if(dh>0){
		if( currslide==1 ){ $("#sliderix").css({top:'2px'}); }else{ $("#sliderix").offset({top:$("#sliderix").offset().top-(dh/max)-1}); }
	} else {}
	try{  document.getElementById(str).style.cssText="border:1px solid red;opacity:1"; } catch(e){}
}

var play=false; //sound
if(play==false){$("#sound_button").fadeTo(0, 0.5);}

var show=true; //slide change

//Sounds in automatic mode
var sounds=1;
var prev=0;
var audio = new Audio();
audio.src='sounds/1.ogg';

function soundOff(obj){
	if(play==true){
	play=false; obj.style.opacity=0.5;
	try{ audio.volume=0;  } catch(e){}
	} else { play=true; obj.style.opacity=1; try{audio.play();} catch(e){} try{ audio.volume=1; } catch(e){} }
}
function textOff(obj){
	if(text==true){
	text=false; obj.style.opacity=0.5;
	$("#text").hide();
	} else {text=true; obj.style.opacity=1; $("#text").show();}
}
function showOff(obj){
	if(show==true){
	show=false; obj.style.opacity=0.5;
	$('#photos').cycle('pause'); 
	} else {show=true;  obj.style.opacity=1;
	$('#photos').cycle('resume');
	}
}
//Popup window
function popup(){
	error = false;
	data = $("#order").serialize();
	$("#order").find('input, textarea').each( function(){ 
		if ($(this).val() == '') { 
			alert('Заполните поле "'+$(this).attr('name')+'"!'); 
			error = true;
		}
	});
	if(error!=true){ $.post( 'order_form.php', data , Success(data) ); }
}
function Success(data){
	$("#popup").animate({opacity:0.9},500);
	setTimeout(function(){ $("#popup").animate({opacity:0},500); },5000);
}
//Additional functions
jQuery(window).load(function(){
	//Width of wrapper
	var width = $(window).width();
	if(width > 960){
		var ratio = 960*100/width + "%";
		$(".wrapper").css("width",ratio);
	}
	//Overlay of downloading
	$("#overlay").slideUp(500);
});
jQuery(window).resize(function(){
	var width = $(window).width();
	if(width > 960){
		var ratio = 960*100/width + "%";
		$(".wrapper").css("width",ratio);
	}
});
</script>
</div>
<!--/Slider-->
<!--Content-->
<div class="wrapper" style="margin:10px auto;">
	<p>Меня зовут Сергей Дрон. Я фотограф и занимаюсь съёмкой самых важных моментов в жизни людей. Если вам нужен фотограф в Днепропетровске или Днепродзержинске - вы всегда можете обратиться ко мне.</p>
	<p>
	Основные виды съёмки:
	<ul>
	<li>Свадебная фотосъемка</li>
	<li>Фотосъемка Love-story</li>
	<li>Детская и семейная съемка</li>
	<li>Фотосъемка будущих мам</li>
	<li>Фотосессии на природе</li>
	<li>Студийная съемка</li>
	<li>Съемка юбилеев, банкетов</li>
	<li>Съемка крестин</li>
	</ul>
	</p>
</div>
<!--/Content-->
<!--Testimonials-->
<div id="testimonials">
	<div class="wrapper">
		<p class="center"><span style="font: italic 900 25px Century Gothic;">Отзывы</span></p>
		<hr style="width:50px;">
		
		<div class="testimonial clear">
			<img class="round" src="pictures/otzivi/elena2.jpg" alt="photo">
			Сергей, Вы шикарный фотограф, добрый человек, а теперь и друг нашей семьи. Спасибо Вам огромное!!!! Приятно и легко работать с профессионалом!!!!
			<p class="names">Елена</p>
		</div>
		
		<div class="testimonial clear">
			<img class="round" src="pictures/otzivi/marina.jpg" alt="photo">
			Спасибо Вам большое за такие прекрасные фотографии, все в восторге от них)))))а так же спасибо за терпение и понимание))
			<p class="names">Марина</p>
		</div>
		
		<div class="testimonial clear">
			<img class="round" src="pictures/otzivi/inna.jpg" alt="photo">
			Моя первая фотосессия прошла в отличных условиях))) и с настоящим профи)<br>
			Спасибо большое за такие фотки! Они просто обалденные!
			<p class="names">Инна</p>
		</div>
		
		<div class="testimonial clear">
			<img class="round" src="pictures/otzivi/ekaterina.jpg" alt="photo">
			Сережа, огронное спасибо за волшебную фотосессию! Фотки супер! Ты замечательный фотограф, и такой же замечательный человек.  Веселый, открытый, энергия просто валит)
			<p class="names">Екатерина</p>
		</div>
		
		<div class="testimonial clear">
			<img class="round" src="pictures/otzivi/elena.jpg" alt="photo">
			Спасибо большое) Мы в восторге от результатов, и от самого процесса с Вами))<br>
			Очень понравился Ваш подход и профессионализм!!!
			<p class="names">Елена</p>
		</div>

		<div class="testimonial clear">
			<img class="round" src="pictures/otzivi/11.jpg" alt="photo">
			Хотела сказать ещё раз тебе от нашей семьи - большое спасибо за проделанную работу)) Я, конечно, не сомневалась, что получатся красивые фотографии,
			но я даже не представляла что нам понравится на столько!!! Очень круто))спасибо!
			<p class="names">Виктория</p>
		</div>
		
		<div class="testimonial clear">
			<img class="round" src="pictures/otzivi/22.jpg" alt="photo">
			Каждая твоя фотография, как произведение искусства! А работать с профессионалом одно удовольствие, легко и комфортно. 
			В итоге получились замечательные кадры, нежные, романтичные, наполненные чувствами. От фотографий невозможно отвезти глаз.
			<p class="names">Лиза</p>
		</div>
		
	</div>
</div>
<!--/Testimonials-->
</div>
<!--/Middle-->
<!--Popup-->
<div id="popup">
	Спасибо! Ждите звонка.
</div>
<!--/Popup-->
<!--Form-->
<div id="bottom">
<div class="wrapper">
<form id="order">
<table>
<tr>
<td colspan="2">Оставьте свои контактные данные для того, чтобы я связался с вами</td>
</tr>
<tr>
<td>Имя</td><td><input type="text" name="username" placeholder=""></td>
</tr>
<tr>
<td>Телефон</td><td><input type="text" name="phone" placeholder=""></td>
</tr>
<tr>
<td></td><td><input class="pulse-button" onclick="popup()" value="Заказать съемку"></td>
</tr>
</table>
</form>
</div>
</div>
<!--/Form-->
<!--Footer-->
<div id=footer>
<div class="wrapper"><p>Украина, г. Днепродзержинск</p><p>Тел.: (067) 628-10-18</p><p>Copyright 2014 © Designed by VStudio</p></div>
</div>
<!--/Footer-->
</body>
</html>