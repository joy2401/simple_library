<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
</head>

<body>
<?php
	include "inc/connect.php"; 
	$name= $_POST['name'];
	
	$link=mysql_connect($DBHOST,$DBUSER,$DBPWD);
  	$db=mysql_select_db($DBNAME,$link);
	
	$sql= "SELECT * from borrow WHERE reader_name = '$name';";
	$result=mysql_query($sql,$link);
if($result)	
{	
	if($rs = mysql_fetch_array($result, MYSQL_ASSOC))
	{
		echo "已借图书图书信息如下：<br>";
		echo "<table border='1'>";
		echo "<tr> <th>图书编号</th> <th>借出时间</th><th>应还时间</th></tr>";
		echo "<tr> <td>".$rs['book_num']."</td>";
  		echo " <td>".$rs['date_borrow']."</td>";
  		echo "<td>".$rs['date_return']."</td>";
 		
  		echo " </tr>";
	}
	while($rs = mysql_fetch_array($result, MYSQL_ASSOC))
{
		//echo "已借图书图书信息如下：<br>";
		echo "<table border='1'>";
		echo "<tr> <th>图书编号</th> <th>借出时间</th><th>应还时间</th></tr>";
		echo "<tr> <td>".$rs['book_num']."</td>";
  		echo " <td>".$rs['date_borrow']."</td>";
  		echo "<td>".$rs['date_return']."</td>";
  		echo " </tr>"; 
}
		echo "</table>";
}
	else
	{
		echo "还没有借阅图书<br>";	}	
echo '<br><a href="reader_operation.html">返回</a>';
	mysql_close( $link );		

?>
</body>
</html>