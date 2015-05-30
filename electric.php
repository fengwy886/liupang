<?php
require("check_login.php");
?>
<html>
<head>
<title>什么地线</title>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<link rel="stylesheet" type="text/css" href="css/layout.css" />
<script type="text/javascript" src="scripts\jquery.js"></script>
<script>
	$(document).ready(function(){
	$("#line").change(function(){
		var value1=$("#line").val();
		$("#section").empty();
		$.get('check.php',{v1:value1},what,"json");
	});
	function what(data1){
	data=eval(data1);
	alert(data[0]);
	$("#section").append("<option value =全部>全部</option>");
	$.each(data, function(i,val){      
		$("#section").append("<option value ="+val+">"+val+"</option>");
	});   
	}		
});
	function exam(){ 
		document.form1.action="exam_electric.php";
		document.form1.submit();
	}
</script>
</head>
<body>
<div id="container">
	<div id="header">
		<img src="image/1.jpg" width="240px" height="70px">
		<div id="guide">
			<ul>
			<li><a href="electric.php">停送电检测</a></li>
			<li><a href="line.php">地线使用记录</a></li>
			<li><a href="message.php">短信信息</a></li>
			<li><a href="query.php">信息查询</a></li>
			<li><a href="logout.php">退出</a></li>
			</ul>
		</div>
	</div>
	<div class="nav"></div>
	<div id="main">
	
	
<form name="form1" id="query"  method="get">
	
	线路名：<select name="line" id="line">

<?PHP
$conn = new COM("ADODB.Connection") or die ("ADO连接失败!");

$connstr = "DRIVER={Microsoft Access Driver (*.mdb)}; DBQ=" . realpath("C:/Users/feng/Desktop/na/Info.mdb");
$conn->Open($connstr);
$rs=$conn->OpenSchema(20);
echo "<option value =全部>全部</option>";
#echo $rs->Fields["name"]->Value;
while(! $rs->eof) { 
	if($rs['table_type']=='TABLE'){
	$v1 = iconv('gbk', 'utf-8', $rs['table_name']);
	echo "<option value =$v1>$v1</option>";
}
$rs->MoveNext(); 
} 

$rs->close(); 
?>

	</select>
	区间名：<select name="section" id="section">
		<option value =全部>全部</option>
	</select>
<input type="button" name="btn1" value="停送电检测" onclick="exam();">
</form>
<?php
include "footer.html";
 ?>