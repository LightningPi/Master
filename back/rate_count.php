<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>關鍵字出現比率計算工具</title>

<?php

include_once("../timezone.php");
include_once("../sql.php");
include_once("../function.php");

?>


</head>

<body>
<?php

	//每天回饋完成後，計算當天的關鍵字，分別在相關、不相文章出現比率
			

//撈取當日「相關」所有字 type =1
$ck_plus_Db = "personalsearch";
$ck_plus_Column = "result_ck.rc_word,count(result_ck.rc_word) as total";		//count(欄位)：計算該欄位每字次數 命名為total
$ck_plus_Table = "search_result INNER JOIN result_relevance ON search_result.sr_id = result_relevance.sr_id INNER JOIN result_ck ON search_result.sr_id = result_ck.sr_id";
$ck_plus_Where = "search_result.u_id = ".$_SESSION['id']." AND search_result.day = '".$_SESSION['today']."' AND result_relevance.re_type = 1 AND result_relevance.re_stage = 1";		
$ck_plus_Group = "result_ck.rc_word";		//同字Group起來，僅顯示一次

	$ck_plus_rate = Sql_fetchWGroup($ck_plus_Db,$ck_plus_Column,$ck_plus_Table,$ck_plus_Where,$ck_plus_Group);	//撈取相關結果 for word rate

//撈取當日「相關」 re_id
$ck_plus_id_Db = "personalsearch";
$ck_plus_id_Column = "result_relevance.re_id";
$ck_plus_id_Table = "search_result INNER JOIN result_relevance ON search_result.sr_id = result_relevance.sr_id";
$ck_plus_id_Where = "search_result.u_id = ".$_SESSION['id']." AND search_result.day = '".$_SESSION['today']."' AND result_relevance.re_type = 1 AND result_relevance.re_stage = 1";		

	$ck_plus_id = Sql_fetchW($ck_plus_id_Db,$ck_plus_id_Column,$ck_plus_id_Table,$ck_plus_id_Where);	//撈取相關總結果 re_id

		
echo "<h2>Plus</h2>";

$plus_num = mysql_num_rows($ck_plus_id);	//「相關」總筆數 for rate
	echo "相關總數";
	echo $plus_num."<br/>";

$to = mysql_num_rows($ck_plus_rate);	//「相關」比率字總數
	echo "比率字總數";
	echo $to."<br/>";

	//echo "各字次數<br/>";
		
while($ck_plus_row = mysql_fetch_object($ck_plus_rate)){
	//echo $ck_plus_row->rc_word.$ck_plus_row->total;			//印出字、出現次數
	//echo "<br/>";	
	
	$rate = ($ck_plus_row->total / $plus_num);		//計算關鍵字在相關文件比率
		
		if($rate > 1){
			
			continue;
			
			}
		
		//將比率存入資料庫
		$ra_Column = "rate_count(ra_word,rate,ra_type,day,u_id)";		//type>1:相關 2:不相關
		$ra_Values = "('$ck_plus_row->rc_word','$rate','1','".$_SESSION['today']."','".$_SESSION['id']."')";		//									
		$ra_Success = "0";
		
		Insert($ra_Column,$ra_Values,$ra_Success);
		
	unset($rate);		//清空rate
	}
			//上方相關 ok	
		
	
//撈取當日「不相關」所有字 type =2
$ck_minus_Db = "personalsearch";
$ck_minus_Column = "result_ck.rc_word,count(result_ck.rc_word) as ntotal";
$ck_minus_Table = "search_result INNER JOIN result_relevance ON search_result.sr_id = result_relevance.sr_id INNER JOIN result_ck ON search_result.sr_id = result_ck.sr_id";
$ck_minus_Where = "search_result.u_id = ".$_SESSION['id']." AND search_result.day = '".$_SESSION['today']."' AND result_relevance.re_type = 2 AND result_relevance.re_stage = 1";			
$ck_minus_Group = "result_ck.rc_word";

	$ck_minus_rate = Sql_fetchWGroup($ck_minus_Db,$ck_minus_Column,$ck_minus_Table,$ck_minus_Where,$ck_minus_Group);	//撈取不相關結果for word rate

//撈取當日「不相關」 re_id
$ck_minus_id_Db = "personalsearch";
$ck_minus_id_Column = "result_relevance.re_id";
$ck_minus_id_Table = "search_result INNER JOIN result_relevance ON search_result.sr_id = result_relevance.sr_id";
$ck_minus_id_Where = "search_result.u_id = ".$_SESSION['id']." AND search_result.day = '".$_SESSION['today']."' AND result_relevance.re_type = 2 AND result_relevance.re_stage = 1";		

	$ck_minus_id = Sql_fetchW($ck_minus_id_Db,$ck_minus_id_Column,$ck_minus_id_Table,$ck_minus_id_Where);	//撈取不相關總結果 re_id


echo "<h2>Minus</h2>";

$minus_num = mysql_num_rows($ck_minus_id);	//「不相關」總筆數 for rate
	echo "不相關總數";
	echo $minus_num."<br/>";

$nto = mysql_num_rows($ck_minus_rate);	//「不相關」比率字總數
	echo "比率字總數";
	echo $nto."<br/>";


	//echo "各字次數<br/>";
		
while($ck_minus_row = mysql_fetch_object($ck_minus_rate)){
	//echo $ck_minus_row->rc_word.$ck_minus_row->ntotal;		//印出字、出現次數
	
	//echo "<br/>";	

	$nrate = ($ck_minus_row->ntotal / $minus_num);		//計算關鍵字在不相關文件比率

		if($nrate > 1){
			
			continue;
			
			}
		
		//將比率存入資料庫
		$nra_Column = "rate_count(ra_word,rate,ra_type,day,u_id)";		//type>1:相關 2:不相關
		$nra_Values = "('$ck_minus_row->rc_word','$nrate','2','".$_SESSION['today']."','".$_SESSION['id']."')";		//									
		$nra_Success = "0";
		
		Insert($nra_Column,$nra_Values,$nra_Success);
		
	unset($nrate);		//清空nrate

	
}	//while end
		
		echo "<center><h1>rate_count 已完成</h1></center>";			
		echo "<meta http-equiv='refresh' content='5;url=weight.php'/>";
	
		//完成後換頁至weight.php，根據當天關鍵字在相關、不相文章出現比率，計算當天的關鍵字權重

?>

</body>
</html>