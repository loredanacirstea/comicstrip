<?php


include('lib\neotek\cstrip\neo_frame.php');

function display_frame($id,$initial)
{
	$frame = new neo_frame();
	$frame->get_neo_frame($id);
	
	header("Content-type: image/jpeg");
	$im = imagecreatefromjpeg($frame->URL);
	
	if($initial != "true")
	{
		$frame->searchBalloons();
		foreach($frame->balloonsArr as $value)
			$value->display_balloon($value->id, $im);
	}
	
	imagejpeg($im);
	imagedestroy($im);	
}		


display_frame($_GET["id"],$_GET["initial"]);




?>