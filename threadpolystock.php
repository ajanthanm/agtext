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
$colors = getData('color');
$sn = 1;
$totalbalnce = 0;

foreach($colors as $k=>$v) {
	$gkg = (isset($givenkg[$v['id']]))?$givenkg[$v['id']]:0;
	$minuskg = (isset($threadsMinus[$v['id']]))?$threadsMinus[$v['id']]:0;
	$threadskg = (isset($threads[$v['id']]))?$threads[$v['id']]:0;
	$balnce = ($threadskg) - $gkg;
	$name = getDataByName('color', $v['id'], 'name');
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