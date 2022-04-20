<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>明日排序權重計算工具</title>

<?php

include_once("timezone.php");
include_once("sql.php");
include_once("function.php");

?>

</head>

<body>

<center><h1>明日排序權重計算工具</h1></center>

<?php

//根據過去三天關鍵字權重，分析明天尚未回饋的搜尋結果，的每篇文章排序權重

	$change = explode("-",$_SESSION['today']);

			//接收當天日期
	
	$day_one = $_SESSION['today'];	

			//今天日期 for 明日權重

	$day_two = date("Y-m-d",mktime(0,0,0,$change[1],$change[2]-1,$change[0]));

			//昨天前日期 for 明日權重

	$day_three = date("Y-m-d",mktime(0,0,0,$change[1],$change[2]-2,$change[0]));	

			//兩天前日期 for 明日權重

	$tomorrow = date("Y-m-d",mktime(0,0,0,$change[1],$change[2]+1,$change[0]));	

			//明日日期 
					
		echo "$day_one<br/>$day_two<br/>$day_three<br/>$tomorrow";

		//$_SESSION['today'] = $today;



	//撈明天sr_id，初始化result_order
		
	$tomorrow_Db = "personalsearch";
	$tomorrow_Column = "sr_id";
	$tomorrow_Table = "search_result";
	$tomorrow_Where = "u_id = ".$_SESSION['id']." AND day = '".$tomorrow."'";
				
	$tomorrow_result = Sql_fetchW($tomorrow_Db,$tomorrow_Column,$tomorrow_Table,$tomorrow_Where);

	while($tomorrow_row = mysql_fetch_object($tomorrow_result)){
		
		$ini_Column = "result_order(ro_weight,sr_id)";		//ini = 初始化，初始化隔日result_order
		$ini_Values = "('0','$tomorrow_row->sr_id')";		//									
		$ini_Success = "ini";
		
		Insert($ini_Column,$ini_Values,$ini_Success);
	
	}


			
		//撈前三天字 & 權重，for 計算明日每篇搜尋結果，的排序權重

	for($i = 1;$i < 4;$i++){
	
		switch($i){
			case 1:
				$one_Db = "personalsearch";
				$one_Column = "ra_word,rate";
				$one_Table = "rate_count";
				$one_Where = "u_id = ".$_SESSION['id']." AND day = '".$day_one."' AND ra_type = 3";
				
				$one_result = Sql_fetchW($one_Db,$one_Column,$one_Table,$one_Where);
							
				while($one_row = mysql_fetch_object($one_result)){
	
					$one_check_Db = "personalsearch";
					$one_check_Column = "result_order.ro_id,result_order.ro_weight";
					$one_check_Table = "search_result INNER JOIN result_ck ON search_result.sr_id = result_ck.sr_id INNER JOIN result_order ON search_result.sr_id = result_order.sr_id";
					$one_check_Where = "search_result.u_id = ".$_SESSION['id']." AND search_result.day = '".$tomorrow."' AND result_ck.rc_word = '$one_row->ra_word'";
				
					$one_check_result = Sql_fetchW($one_check_Db,$one_check_Column,$one_check_Table,$one_check_Where);

					//找到明日搜尋結果中，有day1字的結果
	
					
					//if(mysql_num_rows($one_check_result) > 0){
					
					while($one_check_row = mysql_fetch_object($one_check_result)){
					
						$one_weight_change = $one_check_row->ro_weight + $one_row->rate;
					
						$one_up_Table = "result_order";
						$one_up_Value = "ro_weight = '$one_weight_change'";
						$one_up_Where = "ro_id = $one_check_row->ro_id";
	
						Update($one_up_Table,$one_up_Value,$one_up_Where);
						
						unset($one_weight_change);
						}//in while end
					
					//}//if end
					
				}//out while end
				
				
				
				break;
			
			case 2:
				$two_Db = "personalsearch";
				$two_Column = "ra_word,rate";
				$two_Table = "rate_count";
				$two_Where = "u_id = ".$_SESSION['id']." AND day = '".$day_two."' AND ra_type = 3";
			
				$two_result = Sql_fetchW($two_Db,$two_Column,$two_Table,$two_Where);
				
				while($two_row = mysql_fetch_object($two_result)){
	
					$two_check_Db = "personalsearch";
					$two_check_Column = "result_order.ro_id,result_order.ro_weight";
					$two_check_Table = "search_result INNER JOIN result_ck ON search_result.sr_id = result_ck.sr_id INNER JOIN result_order ON search_result.sr_id = result_order.sr_id";
					$two_check_Where = "search_result.u_id = ".$_SESSION['id']." AND search_result.day = '".$tomorrow."' AND result_ck.rc_word = '$two_row->ra_word'";
				
					$two_check_result = Sql_fetchW($two_check_Db,$two_check_Column,$two_check_Table,$two_check_Where);	

					//找到明日搜尋結果中，有day2字的結果
	
					
					//if(mysql_num_rows($two_check_result) > 0){
					
					while($two_check_row = mysql_fetch_object($two_check_result)){
					
						$two_weight_change = $two_check_row->ro_weight + $two_row->rate;
					
						$two_up_Table = "result_order";
						$two_up_Value = "ro_weight = '$two_weight_change'";
						$two_up_Where = "ro_id = $two_check_row->ro_id";
	
						Update($two_up_Table,$two_up_Value,$two_up_Where);
						
						unset($two_weight_change);
						}//in while end
					
					//}//if end
					
				}//out while end
				
				break;
				
			case 3:
				$three_Db = "personalsearch";
				$three_Column = "ra_word,rate";
				$three_Table = "rate_count";
				$three_Where = "u_id = ".$_SESSION['id']." AND day = '".$day_three."' AND ra_type = 3";
				
				$three_result = Sql_fetchW($three_Db,$three_Column,$three_Table,$three_Where);
				
				while($three_row = mysql_fetch_object($three_result)){
	
					$three_check_Db = "personalsearch";
					$three_check_Column = "result_order.ro_id,result_order.ro_weight";
					$three_check_Table = "search_result INNER JOIN result_ck ON search_result.sr_id = result_ck.sr_id INNER JOIN result_order ON search_result.sr_id = result_order.sr_id";
					$three_check_Where = "search_result.u_id = ".$_SESSION['id']." AND search_result.day = '".$tomorrow."' AND result_ck.rc_word = '$three_row->ra_word'";
				
					$three_check_result = Sql_fetchW($three_check_Db,$three_check_Column,$three_check_Table,$three_check_Where);	

					//找到明日搜尋結果中，有day3字的結果
	
					
					
					
					while($three_check_row = mysql_fetch_object($three_check_result)){
					
						$three_weight_change = $three_check_row->ro_weight + $three_row->rate;
					
						$three_up_Table = "result_order";
						$three_up_Value = "ro_weight = '$three_weight_change'";
						$three_up_Where = "ro_id = $three_check_row->ro_id";
	
						Update($three_up_Table,$three_up_Value,$three_up_Where);
						
						unset($three_weight_change);
						}

						//in while end
					
					
					
				}

				//out while end
				
				
				break;
		
		
		}		//switch end
	
	
	}		//for end


		echo "<center><h1>order 已完成</h1></center>";	
	
			//完成後跳頁至feedback_day

		echo "<meta http-equiv='refresh' content='5;url=feedback_day.php'/>";


	
?>

</body>
</html>