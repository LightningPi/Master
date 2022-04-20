<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>搜尋結果回饋</title>

<?php

include_once("timezone.php");
include_once("sql.php");
include_once("function.php");

?>

</head>

<body>

<?php

	//撈取搜尋結果資料表，當天尚未回饋資料，並依當天文章權重高到低排序，供使用者回饋文章相關或不相關

	$Db = "personalsearch";
	$Column = "search_result.sr_id,search_result.sr_title,search_result.sr_context";
	$Table = "search_result LEFT JOIN result_relevance ON search_result.sr_id = result_relevance.sr_id INNER JOIN result_order ON search_result.sr_id = result_order.sr_id";
	$Where = "search_result.u_id = ".$_SESSION['id']." AND search_result.day = '".$_SESSION['today']."' AND result_relevance.sr_id IS NULL";
	$Order = "result_order.ro_weight desc,search_result.sr_id asc";


	$result = Sql_fetchWOrder($Db,$Column,$Table,$Where,$Order);

	$row = mysql_fetch_object($result); 

	if($row != null){  

	//if判斷如果有撈取到資料，則顯示使用者回饋文章相關或不相關功能
 
?>		
		<center>
		<table border="1" width="65%">
        
        	<tr>
            	<td><div align="center">
                	<input type="button" id="back" value="回日期選單" onClick="location.href='feedback_day.php'">
					<input type="button" id="logout" value="登出" onClick="location.href='logout.php'">
					</div>
                </td>
            </tr>
        
			<tr>
            	<td>
                	<div align="left">
                	<input type="button" id="yes" value="相關" onClick="location.href='feedback_w.php?ty=1&sr_id=<?php echo $row->sr_id;?>'">
                	</div>
                    <div align="right">
                    <input type="button" id="no" value="不相關" onClick="location.href='feedback_w.php?ty=2&sr_id=<?php echo $row->sr_id;?>'">
                	</div>
                </td>
            </tr>
            
            <tr>				
                <th><?php echo $row->sr_title; ?></th>
			</tr>
            
        	<tr>    
                <td><?php echo $row->sr_context; ?></td>
            </tr>
	
    	</table>
 		</center>

<?php

}else{

	//if判斷如果沒有撈到資料，則顯示本日回饋已完成

	//五秒後自動換頁到，back/rate_count.php，計算當天的關鍵字，在相關、不相文章出現比率

	//接著rate_count.php執行完成後，會自動換頁到，back/weight.php，根據當天關鍵字在相關、不相文章出現比率，計算當天的關鍵字權重

	//接著weight.php執行完成後，會自動換頁到，order.php，根據過去三天關鍵字權重，計算明天尚未回饋搜尋結果，的排序權重
 

	echo "<center><h1>本日回饋已完成</h1></center>";
	echo "<meta http-equiv='refresh' content='5;url=back/rate_count.php'/>";

	}

?>
</body>
</html>