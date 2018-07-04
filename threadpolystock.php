<?php 
include('template/header.php');

?>
<center><h3>Yarn stock details</h3></center>




<?php


$threads = [];
$givenkg = [];
$threadsMinus = [];
$select=mysql_query("SELECT sum(kg) as kg, color FROM `threads` where kg > 0 group by color");
if (mysql_num_rows($select) > 0) {
    while($fetch = mysql_fetch_assoc($select)){
		$threads[$fetch['color']] = $fetch['kg'];
	}
}
$select=mysql_query("SELECT sum(kg) as kg, color FROM `threads` where kg < 0 group by color");
if (mysql_num_rows($select) > 0) {
    while($fetch = mysql_fetch_assoc($select)){
		$threadsMinus[$fetch['color']] = $fetch['kg'];
	}
}
$select1=mysql_query("SELECT sum(kg) as kg, color FROM `paavudetails` group by color");
if (mysql_num_rows($select1) > 0) {
    while($fetch = mysql_fetch_assoc($select1)){
		$givenkg[$fetch['color']] = $fetch['kg'];
	}
}

?>
<table id="example" border="0">
<thead>
<tr>
<th>S.no</th>
<th>Color</th>
<th>Balance</th>

</tr>
</thead>
<tbody>
<?php

$sn = 1;
$totalbalnce = 0;
foreach($threads as $k=>$v) {
	$gkg = (isset($givenkg[$k]))?$givenkg[$k]:0;
	$minuskg = (isset($threadsMinus[$k]))?$threadsMinus[$k]:0;
	
	$balnce = $v - $gkg;
	$name = getDataByName('color', $k, 'name');
	$polychk = strpos(strtolower($name), 'poly');
	
	if($balnce && $polychk !== false){
             $totalbalnce = $totalbalnce + $balnce;
		echo "<tr><td>".$sn++."</td><td>".$name."</td><td>".round($balnce, 2)."</td></tr>";
	}
}
?>
</tbody>
</table>

<br>
<br>
<div>
<div class="row" style="font-size:20px;padding-top:30px;font-weight:bold;">
Total Balance :- <?php echo $totalbalnce; echo ' kg' ?><br>
</div>





</body>
</html>