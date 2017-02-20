<?php
//Variables
$path_pics = 'pictures/'; //Directory with pictures
$path_sounds = 'sounds/'; //Directory with sounds
$speed = 1000; //Change speed
$timeout = 3700; //Delay
$width = 960; //Maximum width of picture
//Database
$localhosta = array('localhost','mysql.hostinger.com.ua','mysql.hostinger.com.ua');
$logina = array('root','u919049167_xxl','u711284620_xxl');
$passworda = array('','19871987','19871987');
$namedba = array('photo','u919049167_photo','u711284620_photo');
$selector = 0; //choose 0 or 1
$localhost = $localhosta[$selector];
$login = $logina[$selector];
$password = $passworda[$selector];
$namedb = $namedba[$selector];
require_once "model.php";
$database = new Model($localhost, $login, $password, $namedb);
$database->connect();

//content
$select_content=$database->select("SELECT * FROM content");
	$header = $select_content['header'];
	$content = $select_content['content'];
	$footer = $select_content['footer'];
//number of presentations
$x=$database->select("SELECT * FROM current"); 
	$id_presentation=$x['current']; 
$con=$database->select("SELECT * FROM presentations WHERE id='$id_presentation'");
	$id_text = $con['id_text'];
	$id_pic = $con['id_pic'];
	$id_style = $con['id_style'];
	$id_trans = $con['id_trans'];
	$show_net = $con['show_net'];
	$url = $con['url'];
	$cat = $con['cat'];
	$max = $con['num'];
	$path_pics = $path_pics.$cat."/"; 
	$path_sounds = $path_sounds.$cat."/";
//texts
$con1=$database->select("SELECT * FROM texts WHERE id='$id_text'");
	$text = $con1['style'];
//pictures/slideshow
$con2=$database->select("SELECT * FROM pictures WHERE id='$id_pic'");
	$slideshow = $con2['slideshow'];
	$photos = $con2['photos'];
//mini
$con3=$database->select("SELECT * FROM styles WHERE id='$id_style'");
	$slider_back = $con3['slider_back'];
	$sliderix = $con3['sliderix'];
//effects
$con4=$database->select("SELECT * FROM effects WHERE id='$id_trans'");
	$fx = $con4['effect'];
//descriptions
$query=$database->query("SELECT id FROM descriptions");
$num=mysql_num_rows($query);
$descriptions = array();
for($i=1;$i<$num+1;$i++){
	$con5=$database->select("SELECT * FROM descriptions WHERE id=$i");
	$descriptions[$i]=$con5['description']; $title[$i]=$con5['title']; 
	$descriptions[$i]=str_replace("'","\'",$descriptions[$i]); //исправление бага с кавычками
	$descriptions[$i]=str_replace('"','\"',$descriptions[$i]);
}
$database->close();
?>