<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
<?php
include "inc/connect.php";
$link=mysql_connect($DBHOST,$DBUSER,$DBPWD);
$db=mysql_select_db($DBNAME,$link);
$id=$_GET["id"];

if($id)
 {
	  $sql="DELETE FROM book WHERE bnumber=".$id;
	  $result=mysql_query($sql,$link);
	  if($result)
	  {
		  echo "删除成功";
	  }
	  else{
	      echo "删除失败";
	  }
	  echo '<br><a href="b_del.php">返回上一层</a>';
 }
   
?>

</body>
</html>