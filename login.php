<?php

if(!isset($_POST['submit'])){
	exit('非法登录!');
	}
session_start();
$username=$_POST["username"];
$password=md5($_POST["password"]);
//$checkcode=$_POST["checkcode"];
if (strtolower($_POST["checkcode"])!=strtolower($_SESSION["code"]))
{echo '<script>';
 echo 'alert("验证码错误");';
 echo "location.href='index.php';"; 
 echo '</script>';
 exit();
}
require("config.php");
$con=mysqli_connect(HOST,USER,PASSWORD,DBNAME);
if(!$con)
	{echo 'connecte failed';}
$result=mysqli_query($con,"select * from users where name='{$username}' and password='{$password}' limit 1");
if ($result->num_rows<1)
{echo '<script>';
 echo 'alert("用户名或密码错误");';
 echo "location.href='index.php';"; 
 echo '</script>';
 exit();
}

if($row=$result->fetch_array()){
$_SESSION["username"]=$row["name"];
$_SESSION["userid"]=$row["id"];
}


echo "<script>location.href='mainpage.php';</script>"; 

?>