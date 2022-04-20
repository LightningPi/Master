<?php 

include_once("timezone.php");
include_once("function.php");
include_once("sql.php"); 


?>

<html>

<head>

	<title>註冊結果</title>

</head>

<body>

<?php 

	//註冊會員，php接收頁，接收POST傳送值

	$account = $_POST['account'];
		//echo $account."<br/>";

	$password = $_POST['password'];
		//echo $password."<br/>";

	$u_name = $_POST['u_name'];
		//echo $u_name."<br/>";

	$u_sex = $_POST['u_sex'];
		//echo $u_sex."<br/>";
	
	$date_start = $_POST['date_start'];
		//echo $date_start."<br/>";



	//註冊會員，寫入會員資料表user_feature

	$u_column = "user_feature(account,password,u_name,u_sex,date_start)";

	$u_values = "('".$account."','".$password."','".$u_name."',".$u_sex.",'".$date_start."')";

	
	$account_result = Insert($u_column,$u_values,"會員");

	echo "<center><h1>".$account_result."</h1></center><br/>";


?>

	<center>

	<input type="button" name="back_index" value="回首頁" onclick="location.href='index.php'">	

	</center>










</body>

</html>