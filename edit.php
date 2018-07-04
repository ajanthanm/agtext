<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>
<?php include 'index.php';
?>
<?php
//$username=$_POST["threadno"];
mysql_connect("localhost","root","");
mysql_select_db("agtext");
$id=$_GET["id"];
$sql="select * from threads where id=".$id."";
echo "$sql";

$res=mysql_query($sql);
$fecth=mysql_fetch_array($res);
//$s=mysql_fetch_row($res);
//print_r($s);
print_r($fecth);


?>
<form  action="thread.php" method="post">
<h3>thread details</h3>
<input type="hidden" name="id" value="<?php echo $fecth['id']; ?>">
<table border="4">
<tr><td width="150">THREADNO </td><td><input type="text" name="threadno" size="25" width="150" value="<?php echo $fecth['threadno']; ?>"></td></tr>

<tr><td>KG</td><td><input type="text" name="kg" size="25" value="<?php echo $fecth['kg']; ?>"></td></tr>
<tr><td>PRICE </td><td><input type="text" name="price" size="25" value="<?php echo $fecth['price']; ?>"></td></tr>
<tr><td>COLOR</td><td><input type="text" name="color" size="25" value="<?php echo $fecth['color']; ?>"></td></tr></table>
<input type="submit" value="submit">
<a href="addthread.php"><input type="button" value="ADDTHREAD"></a>

</form>
</body>
</html>
