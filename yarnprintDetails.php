<?php 
include('template/header.php');
$userid = $_REQUEST['userid'];
$users = getSingleData('users',$userid);
$printno = getSqlData("select max(printno) as printno from paavudetails;");
$prtno = $printno[0]["printno"];
?>

<center><h3>Yarn printdetails </h3></center>
<div align="right"><button><a href='yarnprintDetailsCustomize.php?userid=<?php echo $userid; ?>'>Print details</a></button></div>

<?php
$time = strtotime('today');
$sql = "select a.name, b.date, b.color, b.kg, b.printno, b.id, c.yarn, c.yarnprintno from paavus a, paavudetails b, threads c where a.userid = {$userid} and a.id = b.paavuid and b.date > {$time} and b.threadid = c.id and c.yarnprintno = 0 group by c.yarn";
$select=getSqlData($sql);

//$fetch=mysql_fetch_array($select);
?>

<table id="example" border="0">
<thead>
<tr>
<th>S.No</th>
<th>Yarn shop</th>
<th>Date</th>
<th>Action</th>
</tr>
</thead>
<tbody>
<?php
//print_r($fetch);
$i=1;
foreach($select as $key=>$fetch) {
echo "<tr><td>{$i}</td><td>".getDataByName('yarns', $fetch["yarn"], 'name')."</td><td>".date('d-m-Y',$fetch["date"])."</td>
	     <td><a href='yarnprint.php?userid=".$userid."&yarn=".$fetch['yarn']."&yarnprintno=".$fetch['yarnprintno']."'>Print details</a></td></tr>";
$i++;
}
?>
</tbody>
</table>





</body>

</html>