<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
</head>

<body>
<?php
	include "inc/connect.php"; 	
	$link=mysql_connect($DBHOST,$DBUSER,$DBPWD);
  	$db=mysql_select_db($DBNAME,$link);

$name = $_POST['name'];
$num = $_POST['number'];

if(!( $name && $num ) ) 
{
	echo "添加的内容有空信息!"."<br>";
	echo "请点"."<a href='return.html' target='_self'>这里</a>"."重新添加！";
}
else
{
	if(! is_numeric($num))
	{
		echo "书本编号输入不合法<br>";
		echo "请点"."<a href='return.html' target='_self'>这里</a>"."重新添加！";
		die();
	}
	
  $sql1 = "SELECT * from borrow WHERE reader_name = '$name' AND book_num = '$num';";
  
  $result1 = mysql_query($sql1)
                or die(mysql_error());
                
  if($rs = mysql_fetch_array($result1 , MYSQL_ASSOC))
  {
  	$str = date("Y-m-d");
  	$str1 = explode("-",$rs['date_return']);
  	$str2 = explode("-",$str);
  	$date1 = mktime(0,0,0,$str1[1],$str1[2],$str1[0]);
  	$date2 = mktime(0,0,0,$str2[1],$str2[2],$str2[0]);
  	$time = round($date2-$date1)/3600/24;
  	
  	if( $time > 0 )
  	{
  		$money = $time/10.0;
  		echo "已超出应还日期，欠费".$money."<br>";
  		
  		$sql = "UPDATE reader SET money='$money' WHERE rname= '$name';";
  		
  		$result1 = mysql_query($sql)
                or die(mysql_error());
  		
  	}
  		$sql1 = "DELETE from borrow WHERE reader_name = '$name' AND book_num = '$num';";
  		
  		$result1 = mysql_query($sql1)
                or die(mysql_error());
      
      $sql = "UPDATE reader SET ramount = ramount-1 WHERE rname= '$name';";
      		
      $result1 = mysql_query($sql)
      		          or die(mysql_error());
      		          
      $sql = "UPDATE book SET bamount = bamount+1  WHERE bnumber= '$num';";
      $result1 = mysql_query($sql)
      		          or die(mysql_error());
               
      	echo "归还成功!<br>";
		echo '<br><a href="reader_operation.html">返回</a>';
   }
  	
  else
  {
  	echo "没有读者".$name."借阅书本".$num."的信息！<br>";
  	echo "请点"."<a href='return.html' target='_self'>这里</a>"."重新添加！";
  }
  mysql_close( $link );
}
?>
</body>
</html>