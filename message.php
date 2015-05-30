<?php
require("check_login.php");
require("config.php");
?>
<?php 
include "in.html";
?>
<table border="1">
		<tr>
		    <th align="center">线路</th>
			<th align="center">区间或站点</th>
			<th align="center">设备号</th>	
			<th align="center">支柱号</th>
			<th align="center">挂接状态</th>
			<th align="center">电话号码</th>
			<th align="center">接收时间</th>
			<th align="center">查看照片</th>
		</tr>

<?PHP
$conn = new COM("ADODB.Connection") or die ("ADO连接失败!");
$path=ACCESS_DIR."短信信息.mdb";
#$path = "C:/Users/feng/Desktop/na/短信信息.mdb";
$path = iconv('utf-8','gb2312',$path);
$connstr = "DRIVER={Microsoft Access Driver (*.mdb)}; DBQ=" . realpath($path);
$conn->Open($connstr);
$rs = @new COM("ADODB.RecordSet");
$sql ="select * from 短信信息";
if(is_array($_GET)&&count($_GET)>0)
{ 
	if(isset($_GET["line"])&&($_GET["line"]!="全部")){ 
		$line=$_GET["line"];
		$sql=$sql." where m_strGstName='{$line}'";
		if(isset($_GET["section"])&&($_GET["section"]!="全部")){
			$section=$_GET["section"];
			$sql=$sql." and m_station='{$section}'";
		}	
	if(isset($_GET["date"])&&(!empty($_GET['date']))){
		list($year,$month,$day)=explode('-', $_GET["date"]);
		$year = substr($year,-2);
		$sql=$sql." and (m_time like '%{$year}"."年"."{$month}"."月"."{$day}"."日%')";
	}	
	}
} 
var_dump($sql);
$sql= iconv('utf-8','gb2312',$sql);
$rs->Open($sql,$conn,1,1);
#echo $rs->Fields["name"]->Value;
while(! $rs->eof) { 
	echo "<tr>";
	$v1 = iconv('gbk', 'utf-8', $rs->Fields(1)->value);
	$v2 = iconv('gbk', 'utf-8', $rs->Fields(2)->value);
	$v3 = iconv('gbk', 'utf-8', $rs->Fields(3)->value);
	$v4 = iconv('gbk', 'utf-8', $rs->Fields(4)->value);
	$v5 = iconv('gbk', 'utf-8', $rs->Fields(5)->value);
	$v6 = iconv('gbk', 'utf-8', $rs->Fields(6)->value);
	$v7 = iconv('gbk', 'utf-8', $rs->Fields(7)->value);
	echo "<td>{$v1}</td>";
	echo "<td>{$v2}</td>";
	echo "<td>{$v3}</td>";
	echo "<td>{$v4}</td>";
	echo "<td>{$v5}</td>";
	echo "<td>{$v6}</td>";
	echo "<td>{$v7}</td>";
	echo "<td>
	<a href=\"picture.php?pic={$v7}\" target=\"_blank\">点击查看照片</a>
	</td>";
	echo "</tr>";
$rs->MoveNext(); 
} 
echo "</table>";
$rs->close();
include "footer.html";
?>
