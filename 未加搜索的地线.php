<?php
require("check_login.php");
?>
<?php 
include "in.html";
?>
<table border="1">
		<tr>
		    <th align="center">线路</th>
			<th align="center">地线编号</th>
			<th align="center">出库</th>	
			<th align="center">经办人</th>
			<th align="center">时间</th>
			<th align="center">备注</th>
		</tr>

<?PHP
$conn = new COM("ADODB.Connection") or die ("ADO连接失败!");
$path = "C:/Users/feng/Desktop/na/地线.mdb";
$path = iconv('utf-8','gb2312',$path);
$connstr = "DRIVER={Microsoft Access Driver (*.mdb)}; DBQ=" . realpath($path);
$conn->Open($connstr);
$rs = @new COM("ADODB.RecordSet");
$sql ="select * from 地线";
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
	echo "<td>{$v1}</td>";
	echo "<td>{$v2}</td>";
	echo "<td>{$v3}</td>";
	echo "<td>{$v4}</td>";
	echo "<td>{$v5}</td>";
	echo "<td>{$v6}</td>";
	echo "</tr>";
$rs->MoveNext(); 
} 
echo "</table>";
$rs->close();
include "footer.html"
?>
