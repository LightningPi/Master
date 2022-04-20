<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<title>讀取CKIP斷詞結果、分割字與詞性，將字存至資料庫</title>

<?php

include_once("../timezone.php");
include_once("../sql.php");
include_once("../function.php");

?>


</head>

<body>
<?php			//select sql sr_id to read already ckip txt  
$Db = "personalsearch";
$Column = "sr_id";
$Table = "search_result";
$Where = "u_id = ".$_SESSION['id']." AND day = '".$_SESSION['save_day']."'";

$result = Sql_fetchW($Db,$Column,$Table,$Where);

$dir = "C:\\xampp\\htdocs\\back\\cut_out\\"; //CKIP斷詞結果，儲存路徑
	
while($row = mysql_fetch_object($result)){
	
	$fp = fopen("$dir$row->sr_id.txt","r");		//開啟txt檔
	
	$read_text = "";	//設定接收變數
	
		while(!feof($fp)){		//判斷指標是否在最後面，若否繼續讀取
			$read_text .= fgets($fp); 
		}
	
		echo "read_text：".$read_text."<br/><br/><br/>";		//印出接收變數
	
	fclose($fp);		//關閉txt
		
	$cut_array = explode("　",$read_text);		//以tab切割轉存陣列
	
		echo "以tab切割後陣列：<br/>";	//印出切割後陣列
		print_r($cut_array);
		
		echo "<br/><br/><br/>";
	
	unset($read_text);		//清空接收變數
	
		echo "切割字、詞，保留字";
	foreach($cut_array as $value){
		$tem = explode("(",$value);		//分割字與詞性，保留字
		$cut_word[] = $tem[0];		//tem[0]：字 tem[1]：詞性  將字存至陣列
		//echo $tem[0]."<br/>";		
	
	}
	print_r($cut_word);
	echo "<br/><br/>";
	
	$word_fre = array_count_values($cut_word);		//計算陣列字詞出現次數
	
		echo "單詞出現次數：<br/>";
		print_r($word_fre);
		echo "<br/><br/>";
	
	$raw_words = array_keys($word_fre);		//所有字存進陣列
		echo "所有字<br/>";
		print_r($raw_words);
		echo "<br/><br/>";
	
	foreach($raw_words as $val){
			
		//分割後的字存進資料表result_ck
		$ck_Column = "result_ck(rc_word,sr_id)";		
		$ck_Values = "('$val','$row->sr_id')";
		$ck_Success = "字";
		
		Insert($ck_Column,$ck_Values,$ck_Success);
		
		}
	
	
	unset($cut_word);
	
}


?>

</body>
</html>