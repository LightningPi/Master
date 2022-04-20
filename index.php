<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<?php

include_once("timezone.php");

?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<title>網路雷達站</title>


<!-- 使用Javascript，驗證帳號密碼有無輸入 -->

<script language="javascript">

function checknull(){
	var msg = "";
	
	if(login.account.value == ""){
		
		if(msg == ""){
			msg = "帳號";
		}else{
			msg = msg + "、帳號";
			}
		}
		
	if(login.pwd.value == ""){
		
		if(msg == ""){
			msg = "密碼";
		}else{
			msg = msg + "、密碼";
			}
		}
		
	if(msg != ""){
		alert("未輸入" + msg);
			
		}
	else{
		login.submit();
		}
}

</script>


</head>

<body>

<center>

<p>
	<h1>網路雷達站</h1>
</p>

<p>
	<h2>請先登入</h2>
</p>

<form name="login" action="login.php" method="post">
	
    帳號：<input type="text" name="account" /> <br />
    密碼：<input type="password" name="pwd" /> <br /><br />
    
    <input type="button" name="check" value="登入" onClick="checknull()">
    <input type="button" value="註冊" onclick="location.href='account.html'">

</form>



</center>



</body>
</html>