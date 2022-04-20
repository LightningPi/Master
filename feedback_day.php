<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>回饋日期</title>

<?php

include_once("timezone.php");
include_once("sql.php");
include_once("function.php");

?>

</head>

<body>

<?php

	$Db = "personalsearch";
	$Column = "date_start";
	$Table = "user_feature";
	$Where = "u_id = ".$_SESSION['id'];

	$result = Sql_fetchW($Db,$Column,$Table,$Where);
	$row = mysql_fetch_object($result); 

	$_SESSION['date_start'] = $row->date_start;
	$_SESSION['now'] = null;

?>

<center>

	    <!-- 使用者選擇回饋日期功能 -->

	<p>
    	Hi~<?php echo $_SESSION['name'];?>，請選擇回饋日期&nbsp;&nbsp; 
		<input type="button" id="logout" value="登出" onClick="location.href='logout.php'">
	</p>
    

		<table border="1">
        <!-- 第一列-->
        	<tr>
            	<td>
					<input type="button" id="Day1" value="Day1" onClick="location.href='feedback.php?add=0'"><br />
                    /
                </td>
                
                <td>
					<input type="button" id="Day2" value="Day2" onClick="location.href='feedback.php?add=1'"><br />
                    /
                </td>
                
                <td>
					<input type="button" id="Day3" value="Day3" onClick="location.href='feedback.php?add=2'"><br />
                    /
                </td>
                
                <td>
					<input type="button" id="Day4" value="Day4" onClick="location.href='feedback.php?add=3'"><br />
                    /
                </td>
                
                <td>
					<input type="button" id="Day5" value="Day5" onClick="location.href='feedback.php?add=4'"><br />
                    /
                </td>
                
                <td>
					<input type="button" id="Day6" value="Day6" onClick="location.href='feedback.php?add=5'"><br />
                    /
                </td>
            </tr>
         <!-- 第二列-->   
            <tr>
            	<td>
					<input type="button" id="Day7" value="Day7" onClick="location.href='feedback.php?add=6'"><br />
                    /
                </td>
                
                <td>
					<input type="button" id="Day8" value="Day8" onClick="location.href='feedback.php?add=7'"><br />
                    /
                </td>
                
                <td>
					<input type="button" id="Day9" value="Day9" onClick="location.href='feedback.php?add=8'"><br />
                    /
                </td>
                
                <td>
					<input type="button" id="Day10" value="Day10" onClick="location.href='feedback.php?add=9'"><br />
                    /
                </td>
                
                <td>
					<input type="button" id="Day11" value="Day11" onClick="location.href='feedback.php?add=10'"><br />
                    /
                </td>
                
                <td>
					<input type="button" id="Day12" value="Day12" onClick="location.href='feedback.php?add=11'"><br />
                    /
                </td>
            </tr>
        <!-- 第三列-->    
            <tr>
            	<td>
					<input type="button" id="Day13" value="Day13" onClick="location.href='feedback.php?add=12'"><br />
                    /
                </td>
                
                <td>
					<input type="button" id="Day14" value="Day14" onClick="location.href='feedback.php?add=13'"><br />
                    /
                </td>
                
                <td>
					<input type="button" id="Day15" value="Day15" onClick="location.href='feedback.php?add=14'"><br />
                    /
                </td>
                
                <td>
					<input type="button" id="Day16" value="Day16" onClick="location.href='feedback.php?add=15'"><br />
                    /
                </td>
                
                <td>
					<input type="button" id="Day17" value="Day17" onClick="location.href='feedback.php?add=16'"><br />
                    /
                </td>
                
                <td>
					<input type="button" id="Day18" value="Day18" onClick="location.href='feedback.php?add=17'"><br />
                    /
                </td>
            </tr>
         <!-- 第四列-->   
            <tr>
            	<td>
					<input type="button" id="Day19" value="Day19" onClick="location.href='feedback.php?add=18'"><br />
                    /
                </td>
                
                <td>
					<input type="button" id="Day20" value="Day20" onClick="location.href='feedback.php?add=19'"><br />
                    /
                </td>
                
                <td>
					<input type="button" id="Day21" value="Day21" onClick="location.href='feedback.php?add=20'"><br />
                    /
                </td>
                
                <td>
					<input type="button" id="Day22" value="Day22" onClick="location.href='feedback.php?add=21'"><br />
                    /
                </td>
                
                <td>
					<input type="button" id="Day23" value="Day23" onClick="location.href='feedback.php?add=22'"><br />
                    /
                </td>
                
                <td>
					<input type="button" id="Day24" value="Day24" onClick="location.href='feedback.php?add=23'"><br />
                    /
                </td>
            </tr>
         <!-- 第五列-->   
            <tr>
            	<td>
					<input type="button" id="Day25" value="Day25" onClick="location.href='feedback.php?add=24'"><br />
                    /
                </td>
                
                <td>
					<input type="button" id="Day26" value="Day26" onClick="location.href='feedback.php?add=25'"><br />
                    /
                </td>
                
                <td>
					<input type="button" id="Day27" value="Day27" onClick="location.href='feedback.php?add=26'"><br />
                    /
                </td>
                
                <td>
					<input type="button" id="Day28" value="Day28" onClick="location.href='feedback.php?add=27'"><br />
                    /
                </td>
                
                <td>
					<input type="button" id="Day29" value="Day29" onClick="location.href='feedback.php?add=28'"><br />
                    /
                </td>
                
                <td>
					<input type="button" id="Day30" value="Day30" onClick="location.href='feedback.php?add=29'"><br />
                    /
                </td>
            </tr>
            
		</table>

</center>




</body>
</html>