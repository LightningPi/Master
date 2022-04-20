<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<?php
include_once("../timezone.php");
include_once("../sql.php");
include_once("../function.php");
?>

	<!--引用日曆套件-->

    <link rel="stylesheet" href="../datefile/jquery-ui.css">
	<script src="../datefile/jquery-1.10.2.js"></script>
	<script src="../datefile/jquery-ui.js"></script>
	   
	<script>
		
	$(function() {
    	$( "#day" ).datepicker({
      		dateFormat: "yy-mm-dd",
			yearRange: "1900:2015",
			changeMonth: true,
      		changeYear: true
    				});
  				});
	
    </script>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>新增搜尋結果</title>
</head>

<body>

<center>

<h2>新增搜尋結果</h2>

<form name="sr_add" action="sr_add_w.php" method="post">

<table>

	<tr>
    	<td>標題：<input type="text" name="sr_title" title="請輸入標題"></td>
    </tr>
    
    <tr>
    	<td>內文：<textarea rows="5" cols="50" name="sr_context" title="請輸入內文"></textarea></td>
    </tr>

	<tr>
    	<td>網址：<input type="text" name="sr_url" title="請輸入網址"></td>
    </tr>

	<tr>
    	<td>日期：<input type="text" name="day" id="day" title="請選擇日期"></td>
    </tr>
    
    <tr>
    	<td>所屬會員：<input type="text" name="u_id" title="請選擇所屬會員"></td>
    </tr>

</table>

<input type="submit" name="submit" value="送出"><input type="reset" name="reset" value="清除重填">

</form>

</center>

</body>
</html>