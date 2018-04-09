<?php
//Database
$localhost_array = array('localhost','mysql.hostinger.com.ua','mysql.hostinger.com.ua');
$login_array = array('root','u919049167_xxl','u711284620_xxl');
$password_array = array('','19871987','19871987');
$dbname_array = array('photo','u919049167_photo','u711284620_photo');
//Database counter
$localhost_counter_array = array('localhost','mysql.hostinger.com.ua','mysql.hostinger.com.ua');
$login_counter_array = array('root','u919049167_root','u711284620_root');
$password_counter_array = array('','19871987','19871987');
$dbname_counter_array = array('photo_counter','u919049167_count','u711284620_count');
$selector = 0; //choose 0,1...

define('DB_HOST',$localhost_array[$selector]);
define('DB_LOGIN',$login_array[$selector]);
define('DB_PASSWORD',$password_array[$selector]);
define('DB_DATABASE',$dbname_array[$selector]);
define('DB_COUNTER_HOST',$localhost_counter_array[$selector]);
define('DB_COUNTER_LOGIN',$login_counter_array[$selector]);
define('DB_COUNTER_PASSWORD',$password_counter_array[$selector]);
define('DB_COUNTER_DATABASE',$dbname_counter_array[$selector]);

//Slideshow
$path_pics = 'pictures/'; //Directory with pictures
$path_sounds = 'sounds/'; //Directory with sounds