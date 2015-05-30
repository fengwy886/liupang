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
	$("#section").append("<option value =0>全部</option>");
	$.each(data, function(i,val){      
		$("#section").append("<option value ="+val+">"+val+"</option>");
	});   
	}
});
</script>
</head>
<body>
<div id="container">
	<div id="header">
		<div id="guide">
			<div id="choice"><a href="show.php?a=feng">首页</a></div>
			<div id="choice"><a href="dixian.php">地线使用记录</a></div>
			<div id="choice"><a href="message.php">短信信息</a></div>
			<div id="choice"><a href="query.php">信息查询</a></div>
			<div id="choice"><a href="logout.php">退出</a></div>
		</div>
	</div>
	<div class="nav"></div>
	<div id="main">
	
	
<form id="query" action="di.php" method="get">
	<select name="line" id="line">

<?PHP
$conn = new COM("ADODB.Connection") or die ("ADO连接失败!");

$connstr = "DRIVER={Microsoft Access Driver (*.mdb)}; DBQ=" . realpath("C:/Users/feng/Desktop/na/Info.mdb");
$conn->Open($connstr);
$rs=$conn->OpenSchema(20);

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
	<select name="section" id="section">
		<option value =0>全部</option>
	</select>
<input type="submit">
</form>
<?php
include "footer.html";
 ?>