<?php 
include('template/header.php');
?>
<center><h3>View reports</h3></center>



<?php


$select=mysql_query("SELECT * FROM `designs` where name like '%checked%'");
if (mysql_num_rows($select) > 0) {
    // output data of each row
    
  }
//$fetch=mysql_fetch_array($select);
?>
<form action="viewreports.php"  method="get" id="formID">
<table align="left">
<tr>
<td>Start Date </td><td><input type="text"  class='validate[required] datepicker' style="width:150px;" type="text" name="stdate"  ></td>
<td>End Date</td><td><input id="datepicker" class='validate[required] datepicker' style="width:150px;" type="text" name="endate" ></td>
<td></td><td><input type="submit" value="Submit" class="btn btn-primary"></td>
</tr>
</table>
</form>
<table id="example" border="0">
<thead>
<tr>
<th>S.No</th>
<th>Design name</th>
<th>Avg weight</th>
<th>Yarn rate</th>
<th>Couli rate</th>
<th>Total amount</th>

</tr>
</thead>
<tbody>
<?php
//print_r($fetch);
$i=1;
if($_GET && $_GET['stdate']){
$stdate = strtotime($_GET['stdate']);
$endate = strtotime($_GET['endate']);
} else {
	$stdate = strtotime("-90 day", time());
	$endate = time();
}
$yarnrate = yarnrate($stdate, $endate);
while($fetch = mysql_fetch_assoc($select)) {
	$avgwait = avgwait($fetch["id"], $stdate, $endate);
	if($avgwait != 0){
		
		$couliamnt = coulirate($fetch["id"], $stdate, $endate);
	  	$totalamount = ($avgwait['avgwait'] * $yarnrate) + ($couliamnt);
echo "<tr><td>{$i}</td><td>".($fetch["name"])."</td><td>".round($avgwait['avgwait'],3)."</td><td>".round($yarnrate,2)."</td><td>".round($couliamnt,2)."</td><td>".round($totalamount,2)."</td></tr>";
$i++;
	}
}
?>
</tbody>
</table>
</body>
</html>