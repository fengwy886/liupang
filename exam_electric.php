<?php
require("check_login.php");
require("config.php");
?>
<?php 
include "in.html";
?>
<?PHP
$conn = new COM("ADODB.Connection") or die ("ADO连接失败!");
$path=ACCESS_DIR."短信信息.mdb";
#$path = "C:/Users/feng/Desktop/na/短信信息.mdb";
$path = iconv('utf-8','gb2312',$path);
$connstr = "DRIVER={Microsoft Access Driver (*.mdb)}; DBQ=" . realpath($path);
$conn->Open($connstr);
$rs = @new COM("ADODB.RecordSet");
$sql1 ="select COUNT(*) as success from  短信信息 where m_state='挂接成功'";
$sql2 ="select COUNT(*) as success from  短信信息 where m_state='成功摘下'";
if(is_array($_GET)&&count($_GET)>0)
{ 
	if(isset($_GET["line"])&&($_GET["line"]!="全部")){ 
		$line=$_GET["line"];
		$sql1=$sql1." and m_strGstName='{$line}'";
		$sql2=$sql2." and m_strGstName='{$line}'";
	}
	if(isset($_GET["section"])&&($_GET["section"]!="全部")){
		$section=$_GET["section"];
		$sql1=$sql1." and m_station='{$section}'";
		$sql2=$sql2." and m_station='{$section}'";
	}
} 
$sql1= iconv('utf-8','gb2312',$sql1);
$rs->Open($sql1,$conn,1,1);
#echo $rs->Fields["name"]->Value;
while(! $rs->eof) { 
	$v1 = iconv('gbk', 'utf-8', $rs->Fields(0)->value);
	$rs->MoveNext(); 
}
$sql2= iconv('utf-8','gb2312',$sql2);
$rs_new = @new COM("ADODB.RecordSet");
$rs_new->Open($sql2,$conn,1,1);
while(! $rs_new->eof) { 
	$v2 = iconv('gbk', 'utf-8', $rs_new->Fields(0)->value);
	$rs_new->MoveNext(); 
}
echo " 线路：{$line}&nbsp&nbsp&nbsp&nbsp区间：{$section}"."&nbsp&nbsp&nbsp&nbsp挂接成功个数：{$v1}&nbsp&nbsp&nbsp&nbsp成功摘下个数：{$v2}";
echo "<br></br>"; 
if($v1==$v2){
	echo "本段符合停送电安全要求";
}
elseif($v1>$v2){
	echo "本段仍有地线未摘下，不符合停送电安全要求，请检查！";
}
else{
	echo "挂接信息有误";
}
$rs->close();
include "footer.html";
?>
