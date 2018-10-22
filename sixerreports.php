<?php 
include('template/header.php');
?>
<center><h3>View reports</h3></center>



<?php


$select=mysql_query("SELECT * FROM `designs` where name like '%60-Sixer Jacd%'");
if (mysql_num_rows($select) > 0) {
    // output data of each row
    
  }
//$fetch=mysql_fetch_array($select);
?>
<form action="sixerreports.php"  method="get" id="formID">
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
<th>Cotton Weight</th>
<th>White/Black rate</th>
<th>300 Poly rate</th>
<th>300 White</th>
<th>Couli amount</th>
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
$avgrate["60-Sixer Jacd"] = 0.140;
//$avgrate["63-Sixer Jacd"] = 0.106;
 

$avgrate150["60-Sixer Jacd"] = 0.070;
//$avgrate150["63-Sixer Jacd"] = 0.053;


$avgrate300["60-Sixer Jacd"] = 0.070;
//$avgrate300["63-Sixer Jacd"] = 0.053;


$yarnrate = yarnrate($stdate, $endate);
$poly300Data = ["300-Poly Maroon", "300-Poly R.Blue"];
$poly300rate = yarnrateByPolyName($stdate, $endate, $poly300Data);
//$poly300rate = yarnrateByPolyName($stdate, $endate, "150-Poly Maroon")+yarnrateByPolyName($stdate, $endate, "150-Poly Coppie")+yarnrateByPolyName($stdate, $endate, "150-Poly R Blue")+yarnrateByPolyName($stdate, $endate, "150-Poly Red");
$poly150rate = yarnrateByPolyName($stdate, $endate, ["300-Poly White"]);
$ratewhite6 = yarnrateByName($stdate, $endate, "6-White");
$rateblack6 = yarnrateByName($stdate, $endate, "6-Black");
while($fetch = mysql_fetch_assoc($select)) {
	$avgwait = avgwait($fetch["id"], $stdate, $endate);
	if($avgwait != 0){
		$cottonWeight = $avgwait['avgwait']-$avgrate[$fetch["name"]];
		$sixerDivide = round(($cottonWeight/2),3);
		$couliamnt = coulirate($fetch["id"], $stdate, $endate);
	  	$white6Rate = round(($sixerDivide*$ratewhite6),3);
		$black6Rate = round(($sixerDivide*$rateblack6),3);
		
		$poly300 = ($poly300rate + 6)*$avgrate300[$fetch["name"]];
		$poly150 = ($poly150rate + 6)*$avgrate150[$fetch["name"]];
		
		$totalamount = $white6Rate + $black6Rate + $poly300 + $poly150 +($couliamnt+1.25);
		
		echo "<tr><td>{$i}</td><td>".($fetch["name"])."</td><td>".round($avgwait['avgwait'],3)."</td><td>".round($cottonWeight,3)."</td><td>".$white6Rate."/".$black6Rate."</td><td>".round($poly300,3)."</td><td>".round($poly150,3)."</td><td>".round(($couliamnt+1.25),2)."</td><td>".round($totalamount,3)."</td></tr>";
		$i++;
	}
}
?>
</tbody>
</table>
</body>
</html>