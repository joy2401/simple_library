<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>借阅图书</title>
</head>

<body>
<?php
$name = $_POST['name'];
$num = $_POST['number'];
$borrow_date=date('Y-m-d'); //图书的借阅时间为系统当前时间
$return_date=date("Y-m-d",(time()+3600*24*15)); //归还图书日期为当前期日期+15 天期限
//$borrow_date = $_POST['borrow_date'];
//$return_date = $_POST['return_date'];

if(!( $name && $num && $borrow_date && $return_date ) ) 
{
	echo "添加的内容有空信息!"."<br>";
	echo "请点"."<a href='borrow.html' target='_self'>这里</a>"."重新添加！";
}
else
{
	if(! is_numeric($num))
	{
		echo "书本编号输入不合法<br>";
		echo "请点"."<a href='borrow.html' target='_self'>这里</a>"."重新添加！";
		die();
	}
	
	include "inc/connect.php"; 	
	$link=mysql_connect($DBHOST,$DBUSER,$DBPWD);
  	$db=mysql_select_db($DBNAME,$link);

    $sql1 = "SELECT * from reader WHERE rname = '$name';";
  
  $result1 = mysql_query($sql1)
                or die(mysql_error());
                
  if($rs = mysql_fetch_array($result1 , MYSQL_ASSOC))
  {
  	if(($rs['rnumber']-$rs['ramount']) <= 0 )
  	{
  		echo "读者".$rs['rname']."借阅图书已达上限，不能再借阅<br>";
  		die();
  	}
  	else if($rs['money']< 0)
  	{
  		echo "读者".$rs['rname']."已欠费，不能再借阅<br>";
  		echo "请点"."<a href='borrow.html' target='_self'>这里</a>"."重新添加！";
  		die();
  	}
  	else
  	{
  		$sql1 = "SELECT * from book WHERE bnumber = '$num';";
  		$result1 = mysql_query($sql1)
                or die(mysql_error());
                
      if($rs = mysql_fetch_array($result1 , MYSQL_ASSOC))
      {
      	if($rs['bamount'] <= 0 )
      	{
      		echo "书本".$rs['bname']."已全部借出！不能再外借<br>";
      	}
      	else
      	{
      		$sql = "INSERT INTO borrow VALUES('".$name."','".$num."','".$borrow_date."','".$return_date."');";
      		
      		$result1 = mysql_query($sql)
      		          or die(mysql_error());
      		
      		$sql = "SELECT amount from book where number = $num;";
      		          
      		$sql = "UPDATE book SET bamount = bamount-1  WHERE bnumber= '$num';";
      		
      		$result1 = mysql_query($sql)
      		          or die(mysql_error());
      		          
      		$sql = "UPDATE reader SET ramount = ramount+1 WHERE rname= '$name';";
      		
      		$result1 = mysql_query($sql)
      		          or die(mysql_error());
      		echo "借阅成功!<br>";
			 echo '<br><a href="reader_operation.html">返回</a>';
      	}
      }
      else
      {
      	echo "没有书本".$num."的库存<br>";
      }
  	}
  	
  }
  else
  {
  	echo "没有读者".$name."的信息！<br>";
  }
  mysql_close( $link );
}
?>
</body>
</html>