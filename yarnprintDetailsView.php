<?php 
include('template/header.php');


?>

<center><h3>Thread Delivery Slip</h3></center>





<?php
$time = strtotime('today');
$sql = "select a.name, a.userid, b.date, b.color, b.kg, b.printno, b.id, c.yarn, c.yarnprintno from paavus a, paavudetails b, threads c where a.id = b.paavuid and b.threadid = c.id and c.date > {$currentYear} group by c.yarnprintno";
$select=getSqlData($sql);

//$fetch=mysql_fetch_array($select);
?>

<table id="example" border="0">
<thead>
<tr>
<th>S.No</th>
<th>Print no</th>
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
	     <td><a href='yarnprint.php?userid=".$fetch["userid"]."&yarn=".$fetch['yarn']."&yarnprintno=".$fetch['yarnprintno']."'>Print details</a></td></tr>";
$i++;
}
?>
</tbody>
</table>





</body>

</html>