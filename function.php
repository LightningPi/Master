<?php

	ini_set("max_execution_time","7200");	//延長存取時間為10 min

function Keyword_add($keys,$id){
	
	$key_len = count($keys);	//keys長度
	
	$key_index = 7 - $key_len;	//二元八位數，Index最左位置
	
	$all = pow(2,$key_len) - 1;		//所有組合數 = 2的n次方 -1
	
	for($i = $all;$i >= 1;$i--){	//以迴圈做出所有二進位值

		$key_words = array();	//陣列型式
		$two = sprintf("%08d",decbin($i));	//$i十進位轉二進位
		print_r($two);
		for($j = 7;$j > $key_index;$j--){		//依二進位值代入所有關鍵字組合
			
			if($two[$j] == 1){
				
				$key_words[] = $keys[-$j+7];
				
				}	
			
			}
		$array_string = mysql_escape_string(serialize($key_words));	//序列化成可儲存格式
		
		$Column = "key_words(k_word,weight,k_type,u_id)";
		$Values = "('$array_string','0','0','$id')";
		$Success = 0;
		
		Insert($Column,$Values,$Success);
		
		unset($key_words);
		}
		
	return "執行完成!!";
	
	}



	//自定義的SQL function，撈取資料專用(無WHERE判斷)，回傳$result變數

function Sql_fetch($Db,$Column,$Table){
		
	$result = mysql_db_query($Db,"SELECT ".$Column." FROM ".$Table);
	//$row = mysql_fetch_object($result);	
	return $result;
		
	}



	//自定義的SQL function，撈取資料專用(有WHERE判斷)，回傳$result變數

function Sql_fetchW($Db,$Column,$Table,$Where){		
		
	$result = mysql_db_query("$Db","SELECT $Column FROM $Table WHERE $Where");
	//$row = mysql_fetch_object($result);	
	
	return $result;	
			
	}



	//自定義的SQL function，撈取資料專用(有WHERE判斷、GROUP BY)，回傳$result變數
	
function Sql_fetchWGroup($Db,$Column,$Table,$Where,$Group){		
		
	$result = mysql_db_query("$Db","SELECT $Column FROM $Table WHERE $Where GROUP BY $Group");
	//$row = mysql_fetch_object($result);	
	
	return $result;	
			
	}



	//自定義的SQL function，撈取資料專用(有WHERE判斷、ORDER BY)，回傳$result變數
	
function Sql_fetchWOrder($Db,$Column,$Table,$Where,$Order){		
		
	$result = mysql_db_query("$Db","SELECT $Column FROM $Table WHERE $Where ORDER BY $Order");
	//$row = mysql_fetch_object($result);	
	
	return $result;	
			
	}



	//自定義的SQL function，撈取資料專用(有WHERE判斷)，如果有撈到資料則回傳$user陣列
	
function Sql_fetchid($Db,$Column,$Table,$Where){		
		
	$result = mysql_db_query("$Db","SELECT $Column FROM $Table WHERE $Where");
	$row = mysql_fetch_object($result);	
	
	if($row != null){

	$user = array();
	$user[] = $row->u_id;
	$user[] = $row->u_name;

	return $user;	

		}
	}



	//自定義的SQL function，寫入資料到資料表，回傳$result變數
	
function Insert($Column,$Values,$Success){

	$sql = "INSERT INTO ".$Column." VALUES".$Values;
	mysql_query($sql);

	$result = $Success."新增成功!!";
	
	return $result;
			
	}



	//自定義的SQL function，修改資料表資料(有WHERE判斷)
		
function Update($Table,$Value,$Where){

	$sql = "UPDATE ".$Table." SET ".$Value." WHERE ".$Where;
	mysql_query($sql);
	
	}



	//自定義的SQL function，刪除資料表資料(有WHERE判斷)
		
function Delete($Table,$Where){

	$sql = "DELETE FROM ".$Table." WHERE ".$Where;
	mysql_query($sql);
	
	}



	//自定義的php function，空值驗證
		
function checknull($id,$value){

	if($id == $value){

		echo "還有未填寫欄位";

		}else{
	
		break;
			
			}
	
	} 



	//自定義的SQL function，寫入資料表，使用者回饋文章相關或不相關($re_type)
		
function Fback($re_type,$sr_id){

	$Column = "result_relevance(re_type,re_stage,sr_id)";
	$Values = "('$re_type','1','$sr_id')";
	$Success = "回饋";
		
		$result = Insert($Column,$Values,$Success);
				
	}

?>