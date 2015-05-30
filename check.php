<?php
$v1=$_GET["v1"];
#$v1="包西线";
$conn = new COM("ADODB.Connection") or die ("ADO连接失败!");
$name=array();
$path = "C:/Users/feng/Desktop/na/Info.mdb";
#$path = iconv('utf-8','gb2312',$path);
$connstr = "DRIVER={Microsoft Access Driver (*.mdb)}; DBQ=" . realpath($path);
$conn->Open($connstr);
$rs = @new COM("ADODB.RecordSet");
$sql ="select * from "."{$v1}";
$sql= iconv('utf-8','gb2312',$sql);
$rs->Open($sql,$conn,1,1);
while(! $rs->eof) { 
$value1 = iconv('gbk', 'utf-8', $rs->Fields(1)->value);
array_push($name,$value1);
$rs->MoveNext(); 
} 

echo json_encode($name);
?>

