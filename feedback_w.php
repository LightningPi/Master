<?php session_start();
date_default_timezone_set("Asia/Taipei");

include_once("timezone.php");
include_once("sql.php");
include_once("function.php");

	//使用者回饋結果，寫入資料表功能，接收GET傳送值，使用Fback()寫入資料表，顯示回饋成功

	$re_type = $_GET['ty'];
	$sr_id = $_GET['sr_id'];

	Fback($re_type,$sr_id);
	
	echo "<center><h1>回饋成功!!</h1></center>";
	
	
			echo "<meta http-equiv='refresh' content='1.5;url=feedback_next.php'/>";
	
	

?>
