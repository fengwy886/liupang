<?php
session_start();

if (isset($_SESSION["userid"])){
	//echo $_SESSION["userid"];
	echo "<script>location.href='mainpage.php';</script>"; 
	}
?>

<html>
<head>
<title>LOGIN</title>
</head>
<body>
<center>
<h2>LOGIN</h2>
<form action="login.php" method="post">
<table border="0">
			<tr>
				<td align="right">����:</td>
				<td><input type="text" name="username" ></td>
			</tr>
			<tr>
				<td align="right">����:</td>
				<td><input type="password" name="password" ></td>
			</tr>
			<tr>
				<td align="right">��֤��</td>
				<td><input type="text" name="checkcode"></td>
				<td><img src="checkcode.php" onclick="this.src='checkcode.php?'+Math.random()"><td>
			</tr>
            <tr>

				<td  colspan="2" align="center">
					<input type="submit" name="submit" value="login"></input>
				</td>

			<tr>
			<a href="register.php">û���˺ţ����ע��</a>
			
		</table>
<form>
</center>
</body>
</html>