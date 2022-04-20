<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php
include_once("../timezone.php");
include_once("../sql.php");
include_once("../function.php");
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>新增搜尋結果</title>

</head>

<body>

<?php

	//後台，新增會員搜尋結果功能，php接收頁，接收POST傳送資料，並寫入搜尋結果資料表search_result

$sr_title = $_POST['sr_title'];
$sr_context = $_POST['sr_context'];
$sr_url = $_POST['sr_url'];
$day = $_POST['day'];
$u_id = $_POST['u_id'];

$Column = "search_result(sr_title,sr_context,sr_url,day,u_id)";
$Values = "('$sr_title','$sr_context','$sr_url','$day','$u_id')";
$Success = "搜尋結果";

$result = Insert($Column,$Values,$Success);

echo $result;
echo "<meta http-equiv='refresh' content='1.5;url=sr_add.php'/>";



?>



</body>
</html>
