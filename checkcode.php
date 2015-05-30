<?php
session_start();
include "CheckCode.class.php";

$image=new Checkcode(100,40,4);
$image->showImage();
$_SESSION["code"]=$image->getText();
?>