<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<title>關鍵字權重工具</title>

<?php

include_once("../timezone.php");
include_once("../sql.php");
include_once("../function.php");

?>


</head>

<body>

<?php
	//根據當天關鍵字在相關、不相文章出現比率，計算當天的每個關鍵字權重
	

	//撈rate_count相關
	$re_Db = "personalsearch";
	$re_Column = "ra_word as A,rate";	//ra_word as A
	$re_Table = "rate_count";
	$re_Where = "u_id = ".$_SESSION['id']." AND day = '".$_SESSION['today']."' AND ra_type = 1";			

	$re_result = Sql_fetchW($re_Db,$re_Column,$re_Table,$re_Where);
	
	//$AAA = mysql_num_rows($re_result);		//驗證相關寫入數量
	//echo $AAA;
			
	while($re_row = mysql_fetch_object($re_result)){
		
		$re_check_Db = "personalsearch";		//check 尋找不相關相同字
		$re_check_Column = "ra_word,rate";
		$re_check_Table = "rate_count";
		$re_check_Where = "ra_word = '$re_row->A' AND ra_type = 2 AND day = '".$_SESSION['today']."' AND u_id = ".$_SESSION['id'];			
		
		$re_check_result = Sql_fetchW($re_check_Db,$re_check_Column,$re_check_Table,$re_check_Where);
		
			if(mysql_num_rows($re_check_result) > 0){
					
					$re_two_Column = "rate_count(ra_word,rate,ra_type,day,u_id)";		
					$re_two_Success = "0";
					
					
					while($re_check_row = mysql_fetch_object($re_check_result)){
						
						$re_all = $re_row->rate - $re_check_row->rate;
						//echo $re_row->A.$re_check_row->ra_word."<br/>";		//檢查字是否相同
						//echo $re_row->rate.$re_check_row->rate.$re_all."<br/><br/>"; 	//檢查加減結果相同
							if($re_all >= 0.8 && $re_all <= 1){
						
								$re_two_Values = "('$re_row->A','5','3','".$_SESSION['today']."','".$_SESSION['id']."')";		//	0.8~1								
								Insert($re_two_Column,$re_two_Values,$re_two_Success);
												
							}
							
							if($re_all >= 0.6 && $re_all < 0.8){
						
								$re_two_Values = "('$re_row->A','4','3','".$_SESSION['today']."','".$_SESSION['id']."')";		//	0.6~0.8								
								Insert($re_two_Column,$re_two_Values,$re_two_Success);
												
							}
							
							if($re_all >= 0.4 && $re_all < 0.6){
						
								$re_two_Values = "('$re_row->A','3','3','".$_SESSION['today']."','".$_SESSION['id']."')";		//	0.4~0.6								
								Insert($re_two_Column,$re_two_Values,$re_two_Success);
												
							}
							
							if($re_all >= 0.2 && $re_all < 0.4){
						
								$re_two_Values = "('$re_row->A','2','3','".$_SESSION['today']."','".$_SESSION['id']."')";		//	0.2~0.4								
								Insert($re_two_Column,$re_two_Values,$re_two_Success);
												
							}
							
							if($re_all > 0 && $re_all < 0.2){
						
								$re_two_Values = "('$re_row->A','1','3','".$_SESSION['today']."','".$_SESSION['id']."')";		//	0~0.2								
								Insert($re_two_Column,$re_two_Values,$re_two_Success);
												
							}
							
							if($re_all == 0){
						
								$re_two_Values = "('$re_row->A','0','3','".$_SESSION['today']."','".$_SESSION['id']."')";		//	0								
								Insert($re_two_Column,$re_two_Values,$re_two_Success);
												
							}
							
							if($re_all < 0 && $re_all > -0.2){
						
								$re_two_Values = "('$re_row->A','-1','3','".$_SESSION['today']."','".$_SESSION['id']."')";		//	0~-0.2								
								Insert($re_two_Column,$re_two_Values,$re_two_Success);
												
							}
							
							if($re_all <= -0.2 && $re_all > -0.4){
						
								$re_two_Values = "('$re_row->A','-2','3','".$_SESSION['today']."','".$_SESSION['id']."')";		//	-0.2~-0.4								
								Insert($re_two_Column,$re_two_Values,$re_two_Success);
												
							}
							
							if($re_all <= -0.4 && $re_all > -0.6){
						
								$re_two_Values = "('$re_row->A','-3','3','".$_SESSION['today']."','".$_SESSION['id']."')";		//	-0.4~-0.6								
								Insert($re_two_Column,$re_two_Values,$re_two_Success);
												
							}
							
							if($re_all <= -0.6 && $re_all > -0.8){
						
								$re_two_Values = "('$re_row->A','-4','3','".$_SESSION['today']."','".$_SESSION['id']."')";		//	-0.6~-0.8								
								Insert($re_two_Column,$re_two_Values,$re_two_Success);
												
							}
							
							if($re_all <= -0.8 && $re_all >= -1){
						
								$re_two_Values = "('$re_row->A','-5','3','".$_SESSION['today']."','".$_SESSION['id']."')";		//	-0.8~-1								
								Insert($re_two_Column,$re_two_Values,$re_two_Success);
												
							}
								
						unset($re_all);
						}
					
				}else{
					
					$re_one_Column = "rate_count(ra_word,rate,ra_type,day,u_id)";		//type>1:相關 2:不相關
					$re_one_Success = "0";		
					
						if($re_row->rate >= 0.8 && $re_row->rate <= 1){
						
						$re_one_Values = "('$re_row->A','10','3','".$_SESSION['today']."','".$_SESSION['id']."')";		//	0.8~1.0								
						Insert($re_one_Column,$re_one_Values,$re_one_Success);
												
						}
						
						if($re_row->rate >= 0.6 && $re_row->rate < 0.8){
						
						$re_one_Values = "('$re_row->A','9','3','".$_SESSION['today']."','".$_SESSION['id']."')";		//		0.6~0.79							
						Insert($re_one_Column,$re_one_Values,$re_one_Success);
												
						}
						
						if($re_row->rate >= 0.4 && $re_row->rate < 0.6){
						
						$re_one_Values = "('$re_row->A','8','3','".$_SESSION['today']."','".$_SESSION['id']."')";		//		0.4~0.59							
						Insert($re_one_Column,$re_one_Values,$re_one_Success);
												
						}
						
						if($re_row->rate >= 0.2 && $re_row->rate < 0.4){
						
						$re_one_Values = "('$re_row->A','7','3','".$_SESSION['today']."','".$_SESSION['id']."')";		//		0.2~0.39							
						Insert($re_one_Column,$re_one_Values,$re_one_Success);
												
						}
						
						if($re_row->rate >= 0 && $re_row->rate < 0.2){
						
						$re_one_Values = "('$re_row->A','6','3','".$_SESSION['today']."','".$_SESSION['id']."')";		//		0~0.19							
						Insert($re_one_Column,$re_one_Values,$re_one_Success);
												
						}
									
				}	//else end
		
	unset($re_check_Db);
	unset($re_check_Column);
	unset($re_check_Table);
	unset($re_check_Where);
	unset($re_check_result);
	unset($re_check_row);
			
	}	//re end
			
	
	//撈 rate_count 不相關
	$nre_Db = "personalsearch";
	$nre_Column = "ra_word as B,rate";	//ra_word as B
	$nre_Table = "rate_count";
	$nre_Where = "u_id = ".$_SESSION['id']." AND day = '".$_SESSION['today']."' AND ra_type = 2";			

	$nre_result = Sql_fetchW($nre_Db,$nre_Column,$nre_Table,$nre_Where);
	// $BBB = mysql_num_rows($nre_result);		//驗證不相關寫入數量
	//echo $BBB;
			
	while($nre_row = mysql_fetch_object($nre_result)){
		
		$nre_check_Db = "personalsearch";		//check 字在 sql 是否已存  type = 3
		$nre_check_Column = "ra_word";
		$nre_check_Table = "rate_count";
		$nre_check_Where = "ra_word = '$nre_row->B' AND ra_type = 3 AND day = '".$_SESSION['today']."' AND u_id = ".$_SESSION['id'];		//日期、人未動態
		
		$nre_check_result = Sql_fetchW($nre_check_Db,$nre_check_Column,$nre_check_Table,$nre_check_Where);
		
			if(mysql_num_rows($nre_check_result) > 0){		//確認是否已存 sql 相同字  
					
					/*
					while($nre_check_row = mysql_fetch_object($nre_check_result)){
						
						echo $nre_check_row->ra_word."<br/>";	//確認是否印出所有已存在相同字
				
					}
					*/
					
					continue;
			
			}else{		//if end
					$nre_one_Column = "rate_count(ra_word,rate,ra_type,day,u_id)";		
					$nre_one_Success = "0";		
					
						if($nre_row->rate >= 0 && $nre_row->rate < 0.2){
						
						$nre_one_Values = "('$nre_row->B','-6','3','".$_SESSION['today']."','".$_SESSION['id']."')";		//		0~0.19							
						Insert($nre_one_Column,$nre_one_Values,$nre_one_Success);
												
						}
						
						if($nre_row->rate >= 0.2 && $nre_row->rate < 0.4){
						
						$nre_one_Values = "('$nre_row->B','-7','3','".$_SESSION['today']."','".$_SESSION['id']."')";		//		0.2~0.39							
						Insert($nre_one_Column,$nre_one_Values,$nre_one_Success);
												
						}
						
						if($nre_row->rate >= 0.4 && $nre_row->rate < 0.6){
						
						$nre_one_Values = "('$nre_row->B','-8','3','".$_SESSION['today']."','".$_SESSION['id']."')";		//		0.4~0.59							
						Insert($nre_one_Column,$nre_one_Values,$nre_one_Success);
												
						}
						
						if($nre_row->rate >= 0.6 && $nre_row->rate < 0.8){
						
						$nre_one_Values = "('$nre_row->B','-9','3','".$_SESSION['today']."','".$_SESSION['id']."')";		//		0.6~0.79							
						Insert($nre_one_Column,$nre_one_Values,$nre_one_Success);
												
						}
						
						if($nre_row->rate >= 0.8 && $nre_row->rate <= 1){
						
						$nre_one_Values = "('$nre_row->B','-10','3','".$_SESSION['today']."','".$_SESSION['id']."')";		//		0.8~1.0							
						Insert($nre_one_Column,$nre_one_Values,$nre_one_Success);
												
						}
	
	
			}
	}	//nre_row while end
	
	
		echo "<center><h1>weight 已完成</h1></center>";			
		echo "<meta http-equiv='refresh' content='5;url=../order.php'/>";
	
		//完成後換頁至../order.php，根據過去三天關鍵字權重，計算明天尚未回饋搜尋結果，的排序權重
		
?>

</body>
</html>