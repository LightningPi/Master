<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<title>從資料庫撈取使用者選擇日，的搜尋結果標題、內容，另存成文字文件的執行頁面</title>

<?php

	$save_day = $_POST['save_day'];
	$_SESSION['save_day'] = $save_day;

	include_once("../timezone.php");
	include_once("../sql.php");
	include_once("../function.php");

function clear($raw){
	
	$raw = trim($raw);	//去除字串前後空白

	$raw = preg_replace('/\s(?=)/', '', $raw);	//去除字串間空白

	return $raw;
}
?>


</head>

<body>
<?php
$Db = "personalsearch";			//撈取search_result存成txt
$Column = "sr_context,sr_id,sr_title";
$Table = "search_result";
$Where = "u_id = ".$_SESSION['id']." AND day = '".$save_day."'";

$result = Sql_fetchW($Db,$Column,$Table,$Where);

$dir = "D:\\xampp\\htdocs\\back\\cut_in\\"; //儲存路徑
	
while($row = mysql_fetch_object($result)){

	$save_text = clear("$row->sr_title")."。".clear("$row->sr_context"); 	//去除字串所有空白

		echo $save_text."<br/><br/><br/>";
	
	$fp = fopen("$dir$row->sr_id.txt","w");		//開啟txt檔
	
		fwrite($fp, "$save_text");		//寫入文字
	
		fclose($fp);	//關閉txt
	
}


?>

</body>
</html>