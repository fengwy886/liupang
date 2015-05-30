<?php 	
if(isset($_GET["pic"]))
{
	$pic="image/".$_GET["pic"].".jpg";
	$pic = iconv('utf-8', 'gbk', $pic);
}
#header('Content-type: image/jpg');
echo "<img src={$pic} width=\"320px\" height=\"240px\" alt={$pic}/>";

?>