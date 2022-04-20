<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>會員登入</title>

<?php

include_once("timezone.php");
include_once("sql.php");
include_once("function.php");

?>

</head>

<body>

<?php

	//會員登入功能，php接收頁，接收POST傳送值

	$account = $_POST['account'];
	$password = $_POST['pwd'];

	$Db = "personalsearch";
	$Column = "u_id,u_name";
	$Table = "user_feature";
	$Where = "account = '$account' && password = '$password'";
	
	$user = Sql_fetchid($Db,$Column,$Table,$Where);
	
	if($user == null){

		//if判斷如果帳號密碼，撈不到會員資料，則顯示帳號或密碼輸入錯誤

		echo "<center>帳號或密碼輸入錯誤，請重新登入</center>";
		echo "<meta http-equiv='refresh' content='2;url=index.php'/>";

		}else{

		//if判斷如果$user有撈到會員資料，則設定會員主鍵跟名稱session變數
		
		
		$_SESSION['id'] = $user[0];
		$_SESSION['name'] = $user[1];
		
		echo "<meta http-equiv='refresh' content='0.1;url=feedback_day.php'/>";
		}

?>

</body>
</html>