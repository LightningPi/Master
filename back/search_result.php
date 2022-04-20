<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<?php
include_once("../timezone.php");
include_once("../sql.php");
include_once("../function.php");
?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>搜尋結果列表</title>
</head>

<body>

<input type="button" value="回首頁" onClick="location.href='index.php'">

<?php
$Db = "personalsearch";
$Column = "*";
$Table = "search_result";

//Sql_fetch($Db,$Column,$Table);
$result = Sql_fetch($Db,$Column,$Table);
//$result = mysql_db_query($Db,"SELECT ".$Column." FROM ".$Table);
while($row = mysql_fetch_object($result)){
	echo "<table name='catch' width='50%' border='2'>";

	echo "<br><br><br>";	
	echo "<tr>
		<td>標題：</td>
		<td>內文：</td>
		<td>網址：</td>
	 </tr>"	;
	echo "<tr>
		<td>".$row->sr_title."</td>
		<td>".$row->sr_context."</td>
		<td>".$row->sr_url."</td>
	  </tr>";

	echo "</table>";	
	}


?>


</body>
</html>