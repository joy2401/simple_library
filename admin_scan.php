<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>借閱信息查詢</title>
</head>

<body>
<?php
	include "inc/connect.php"; 
  	$link=mysql_connect($DBHOST,$DBUSER,$DBPWD);
  	$db=mysql_select_db($DBNAME,$link);

$falg =false;
$sql1 = "SELECT * from reader,book,borrow where borrow.reader_name = reader.rname and borrow.book_num=book.bnumber;";

$result1 = mysql_query($sql1)
                or die(mysql_error());
                
if($rs = mysql_fetch_array($result1 , MYSQL_ASSOC))
{
	echo "借阅信息如下：<br>";
	echo "<table border='1'>";
	echo "<tr> <th>读者姓名</th> <th>借读书籍名称</th> <th>借出日期</th>  <th>应还日期</th> <th>出版社</th></tr>";
	echo "<tr> <td>".$rs['rname']."</td>";
  echo " <td>".$rs['bname']."</td>";
  echo "<td>".$rs['date_borrow']."</td>";
  echo "<td>".$rs['date_return']."</td>";
//  echo "<td>".$rs['write']."</td>";
  echo "<td>".$rs['press']."</td>";
  echo " </tr>";
  
  $falg = true ;
}
else
{
	echo "数据库中没有可以浏览的信息<br>";
}
while($rs = mysql_fetch_array($result1 , MYSQL_ASSOC))
{
	echo "<table border='1'>";
	echo "<tr> <th>读者姓名</th> <th>借读书籍名称</th> <th>借出日期</th>  <th>应还日期</th>  <th>出版社</th></tr>";
	echo "<tr> <td>".$rs['rname']."</td>";
  echo " <td>".$rs['bname']."</td>";
  echo "<td>".$rs['date_borrow']."</td>";
  echo "<td>".$rs['date_return']."</td>";
 // echo "<td>".$rs['write']."</td>";
  echo "<td>".$rs['press']."</td>";
  echo " </tr>";
}
if($falg ) echo "</table>";
echo '<br><a href="admin_operation.html">返回</a>';
mysql_close( $link );
?>
</body>
</html>