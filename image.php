<?php
	$width = 	$_GET['w'];
	$height = 	$_GET['h'];
	$background =	'#'.$_GET['bkg'];
	$foreground =	'#'.$_GET['frg'];
	$tr = 		$_GET['tr'];
	$theight = 	$_GET['th'];
	$left_tx = 	$_GET['ltx'];
	$top_tx = 	$_GET['ttx'];
	$nomefont = $_GET['nf'];
	$testo = 	$_GET['text'];
	
	$fontpath="fonts/";
	$i=0;

	while ($i < 2){
		if ($i == 0){ $hexcolor = $background; } 
		else { $hexcolor = $foreground; }
		if(preg_match('/^[#]([a-f0-9]{3})$/',$hexcolor)){
			$hexcolor = $hexcolor.substr($hexcolor,1,3);
		}
		if(!preg_match('/^[#]([a-f0-9]{2})([a-f0-9]{2})([a-f0-9]{2})$/',$hexcolor)){
			$result = "Codice non valido";
		}else{		
			if ($i == 0){
				$br = hexdec(substr($hexcolor, 1,2));
				$bg = hexdec(substr($hexcolor, 3,2));
				$bb = hexdec(substr($hexcolor, 5,2));
			} else {
				$fr = hexdec(substr($hexcolor, 1,2));
				$fg = hexdec(substr($hexcolor, 3,2));
				$fb = hexdec(substr($hexcolor, 5,2));
			}
		}
		$i++;
	}	
	header("Content-type: image/png");
	$im = imagecreatetruecolor($width,$height);	
	$tx = imagecolorallocate($im,$fr,$fg,$fb);
	$transparent_color = imagecolorallocate($im,$br,$bg,$bb);
	if ($tr == "1"){ imagecolortransparent($im, $transparent_color);}	
	ImageFilledRectangle($im,0,0,$width,$height,$transparent_color);	
	ImageTTFText ($im, $theight, 0,$left_tx,$top_tx, $tx, $fontpath.$nomefont ,$testo);
	imagepng($im);
	imagedestroy($im);
?>
