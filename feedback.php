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

<script type="text/javascript">

</script>

</head>

<body>

<?php

	$add = $_GET['add'];		//接收feedback_day 傳值
	$change = explode("-",$_SESSION['date_start']);		//接收開始日期
	$today = date("Y-m-d",mktime(0,0,0,$change[1],$change[2]+$add,$change[0]));		//加減fb_day 傳值 = 當日
	$_SESSION['today'] = $today;		//建立 session:today

if($add == 0){

	//檢查第一天排序權重，是否已初始化

	$day_one_check_Db = "personalsearch";
	$day_one_check_Column = "result_order.ro_id";
	$day_one_check_Table = "search_result INNER JOIN result_order ON search_result.sr_id = result_order.sr_id";
	$day_one_check_Where = "search_result.day = '".$_SESSION['today']."' AND search_result.u_id = ".$_SESSION['id'];
				
$day_one_check_result = Sql_fetchW($day_one_check_Db,$day_one_check_Column,$day_one_check_Table,$day_one_check_Where);


	if(mysql_num_rows($day_one_check_result) == 0){

	//初始化第一天day 1 排序權重result_order

	$day_one_Db = "personalsearch";
	$day_one_Column = "sr_id";
	$day_one_Table = "search_result";
	$day_one_Where = "day = '".$_SESSION['today']."' AND u_id = ".$_SESSION['id'];
				
	$day_one_result = Sql_fetchW($day_one_Db,$day_one_Column,$day_one_Table,$day_one_Where);

	while($day_one_row = mysql_fetch_object($day_one_result)){
		
		$ini_Column = "result_order(ro_weight,sr_id)";		//ini = 初始化，初始化day1 result_order
		$ini_Values = "('0','$day_one_row->sr_id')";		//									
		$ini_Success = "ini";
		
		Insert($ini_Column,$ini_Values,$ini_Success);
	
		}		//while end
	
	}		//if in end
	
	
}		//if out end



	//撈取搜尋結果資料表，尚未回饋資料，並依每天文章權重高到低排序，供使用者回饋文章相關或不相關

	$Db = "personalsearch";
	$Column = "search_result.sr_id,search_result.sr_title,search_result.sr_context";
	$Table = "search_result LEFT JOIN result_relevance ON search_result.sr_id = result_relevance.sr_id INNER JOIN result_order ON search_result.sr_id = result_order.sr_id";
	$Where = "search_result.u_id = ".$_SESSION['id']." AND search_result.day = '".$today."' AND result_relevance.sr_id IS NULL";
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

	//由於關鍵字權重分析、排序權重分析已完成，直接導引回選擇回饋日期
 
	echo "<center><h1>本日回饋已完成</h1></center>";
	echo "<meta http-equiv='refresh' content='3;url=feedback_day.php'/>";

	}

	?>

</body>
</html>