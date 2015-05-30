<?php

class Checkcode{
	private $width;
	private $height;
	private $codeNumber;
	private $image;
	private $pointNumber;
	private $text;
	
	function __construct($width=20,$height=10,$codeNumber=4){
		$this->width=$width;
		$this->height=$height;
		$this->codeNumber=$codeNumber;
		$pointNumber=floor($width*$height/10);
		$this->createText();
		if ($pointNumber>254){
			$this->pointNumber=254-$codeNumber-50;
			}
		else{
			$this->pointNumber=$pointNumber;
			}
	}
	
	function showImage(){
		$this->createImage();
		$this->addInterruption();
		$this->addText();
		$this->outputImage();
		imagedestroy($this->image);
	}
	
	function outputImage(){
		header('Content-type: image/png');
		imagepng($this->image);
	}
	
	function createImage(){
		$this->image = @imagecreatetruecolor($this->width, $this->height) or die("Cannot Initialize new GD image stream");
		$color=imagecolorallocate($this->image,rand(200,255),rand(200,255),rand(200,255));
		imagefill($this->image,0,0,$color);
		$background=imagecolorallocate($this->image,0,0,0);
		imagerectangle($this->image,0,0,$this->width-1,$this->height-1,$background);
	}

	function addInterruption(){
		for($i=0;$i<$this->pointNumber;$i++){
			$color=imagecolorallocate($this->image,rand(0,255),rand(0,255),rand(0,255));
			imagesetpixel($this->image,rand(1,$this->width-2),rand(1,$this->height-1),$color);
			}
		for($i=0;$i<10;$i++){
			$color=imagecolorallocate($this->image,rand(0,255),rand(0,255),rand(0,255));
			imagearc($this->image,rand(-10,$this->width),rand(-5,$this->height),rand(25,150),rand(15,100),rand(15,45),rand(45,90),$color);
			}
		
	}
	function createText(){
		$code="0123456789abcdefghijklmnpqrstuvwxyzABCDEFGHIGKLMNPQRSTUVWXYZ";
		$this->text="";
		for ($i=0;$i<$this->codeNumber;$i++){
			$char=$code[rand(0,strlen($code)-1)];
			$this->text.=$char;
		}
	}
	function addText(){
		for($i=0;$i<strlen($this->text);$i++){
			$color=imagecolorallocate($this->image,rand(0,50),rand(0,50),rand(0,50));
			$font=rand(3,5);
			$x=3+floor($this->width/$this->codeNumber)*$i;
			$y=rand(10,$this->height-15);
			imagechar($this->image,5,$x,$y,$this->text{$i},$color);
		}
	}
	function getText(){
		return $this->text;
	}
}


?>