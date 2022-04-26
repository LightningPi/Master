<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<title>將資料庫的會員搜尋結果，另存成文字文件的小工具，使用者可以從下拉式選單，指定要另存哪一天的搜尋結果</title>

</head>

<body>

<?php
//echo $_SESSION['date_start'];

?>

<form action="save_txt.php" method="post">
	<select name="save_day">

<?php 
		for($i = 0;$i < 30;$i++){		//0~29 = 30

    			$j = $i+1;	//顯示第幾天用
	
			$save_change = explode("-",$_SESSION['date_start']);		
	
			//接收開始日期，SESSION date_start，(會員登入後，系統自動設定會員開始實驗日期，的SESSION變數，date_start變數內容是日期格式，比如2015-03-04)

			//使用explode()，分割SESSION date_start的年、月、日字串，並以陣列方式存進 $save_change變數

			//$save_change[0] = 年
	
			//$save_change[1] = 月

			//$save_change[2] = 日


				//下方mktime()，固定格式是mktime(hour,minute,second,month,day,year)

				//由於我們只要年月日，所以mktime(0,0,0,$save_change[1],$save_change[2]+$i,$save_change[0])

				//由於我們只要年月日(Y-m-d)，所以date("Y-m-d",mktime(0,0,0,$save_change[1],$save_change[2]+$i,$save_change[0]))

				//下方date()，設定從開始實驗日期起算，30天日期(包含開始日)

			$va = date("Y-m-d",mktime(0,0,0,$save_change[1],$save_change[2]+$i,$save_change[0]));	

				echo "<option value='$va'>$j</option>";
	
	
	}
?>

	</select>
    <input type="submit" value="送出">
</form>
</body>
</html>