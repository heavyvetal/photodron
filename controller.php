<?php
$database = new Sqli(DB_HOST, DB_LOGIN, DB_PASSWORD, DB_DATABASE);
$database->connect();

//content
$select_content = $database->select("SELECT * FROM content");
$header = $select_content['header'];
$content = $select_content['content'];
$footer = $select_content['footer'];
	
//number of presentations
$x = $database->select("SELECT * FROM current");
$id_presentation = $x['current'];
$con = $database->select("SELECT * FROM presentations WHERE id='$id_presentation'");
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
$con1 = $database->select("SELECT * FROM texts WHERE id='$id_text'");
$text = $con1['style'];
	
//pictures/slideshow
$con2 = $database->select("SELECT * FROM pictures WHERE id='$id_pic'");
$slideshow = $con2['slideshow'];
$photos = $con2['photos'];
	
//mini
$con3 = $database->select("SELECT * FROM styles WHERE id='$id_style'");
$slider_back = $con3['slider_back'];
$sliderix = $con3['sliderix'];
	
//effects
$con4=$database->select("SELECT * FROM effects WHERE id='$id_trans'");
$fx = $con4['effect'];
	
//descriptions
$result = $database->query("SELECT id FROM descriptions");
while($con5 = mysqli_fetch_array($result)){
	$i = $con5['id'];
	$descriptions[$i] = $con5['description'];
	$title[$i] = $con5['title'];
    //correction bug with quotes
	$descriptions[$i] = str_replace("'","\'",$descriptions[$i]);
	$descriptions[$i] = str_replace('"','\"',$descriptions[$i]);
}

$database->close();

?>