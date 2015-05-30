<!doctype html>
<html>
<head>
<title>注册账号</title>
	<style>
		span.one{color:blue}
		span.two{color:red}
		span.three{color:green}
	</style>
	<script type="text/javascript" src="scripts\jquery.js"></script>
	<script>
	function test(obj,msg,func,click)
	{		var nextspan=obj.next();
			obj.focus(function(){
				nextspan.removeClass().addClass("three");
				nextspan.text(msg);
			});
			
			obj.blur(function(){
				var value=$(this).val();
				if (func(value))
				{
					nextspan.removeClass().addClass("three");
					nextspan.text("输入正确");
					
				}
				else{
					nextspan.removeClass().addClass("two");
				}
			
			});
			if (click=='click')
				obj.blur();
	
	};
	
	function what(click){ 
	return all(click);
	};
	
	function all(click){
		var cli=click
		var flag=true;
		var name=$("[name='name']");
		var password=$("[name='password']");
		var password_=$("[name='password_']");
	    test(name,"用户名必须长于5位",function(val){
			if (val.length<5)
				{flag=false;
				return false;}
			else
				return true;
		}
		,cli);
		test(password,"密码必须长于6位",function(val){
			if (val.length<6)
				{flag=false;
				return false;}
			else
				return true;
		}
		,cli);
		test(password_,"必须与上面密码相同",function(val){
			if (val.length>5 &&val==password.val())
				return true;
			else{
				flag=false;
				return false;}
		}
		,cli);
		return flag;
	};
	
	
	$(document).ready(function(){
		//test("用户名必须长于5位");
		//exam();
		all('no');
  });

	
	
	
	
		//$(function(){
			//$("span").click(function(){
	   		//$(this).removeClass().addClass("three");;
//});
//}); 
	</script>

	<meta charset="UTF-8">
	<title>表单练习</title>
</head>
<body>
<center>
	<h1>注册账号</h1>
	<form action="check_register.php" method="post" onsubmit="return what('click')">
	<br>输入用户名<input type="text" name="name"/><span class="one">请输入用户名</span></br>
	<br>输入密码<input type="password" name="password"/><span class="one">请输入密码</span></br>
	<br>再次输入密码<input type="password" name="password_"/><span class="one">请再次输入密码</span></br>	
	<br>输入其他<input type="text" name="other"/><span class="three">可以不填</span></br>
	<input type="submit" name="submit" value="注册" />
	</form>
</body>
</center>
</html>