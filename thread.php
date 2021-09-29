<?php 
include('template/header.php');
$colors = getData('color');

if(isset($_GET['color'])){
	$color = $_GET['color'];
	if($_GET['color'] == 'all'){
		$colorcond = "";
		$colorReturn = "where a.color != 0";
		$color = '';
	} else {
		$colorcond = "where color = {$color}";
		$colorReturn = "where a.color = {$color}";
	}

} else {
	$colorcond = "where color = 0";
	$colorReturn = "where a.color = null";
	$color = '';
}

?>
<center><h3>Yarn stock details</h3></center>



<div class="container-fluid">
<form action="" method="get">
<div class="row">
<table><tr><td>
	<div class="col-md-2 col-sm-2">Color/size</div></td>
	<td><div class="col-md-4 col-sm-4">
		<select name="color" id="color">
<option value="">--Select--</option>
<option value="all" <?php if(isset($_GET['color']) && 'all' == $_GET['color']){ echo 'selected'; }?>>--All--</option>
<?php
	foreach($colors as $key=>$val){
		if(isset($_GET['color']) && $val['id'] == $_GET['color']){
			echo "<option value=".$val['id']." selected>".$val['name']."</option>";
		} else {
			echo "<option value=".$val['id'].">".$val['name']."</option>";
		}
	}
?>
</select>
<input type="submit" id="submit" value="Submit" class="btn btn-primary">
	</div></td>
	<td><div class="col-md-6 col-sm-6">
		<a href="addthread.php"><input type="button" value="Yarn purchase" class="btn btn-primary"></a>
	</div></td>
</table>	

</div>
</form>
</div>





<?php

if($_POST) {
	$data["threadno"]=$_POST["threadno"];
	
	$data["kg"]=$_POST["kg"];
	$data["price"]=$_POST["price"];
	$data["color"]=$_POST["color"];
	$data["yarn"]=$_POST["yarn"];
	$data["date"]=strtotime($_POST["date"]);
	if(isset($_POST["id"])) {
		$updateData["id"] = $_POST["id"];
		updateData("threads", $data, $updateData);
		
	} else {
		
		
		insertData("threads", $data);
	}
	
	
}
echo "SELECT * FROM `threads` {$colorcond} ORDER BY date desc";
$select=mysql_query("SELECT * FROM `threads` {$colorcond} ORDER BY date desc");
if (mysql_num_rows($select) > 0) {
    // output data of each row
    
  }
//$fetch=mysql_fetch_array($select);
?>
<table id="example" border="0">
<thead>
<tr>
<th>Bill no</th>
<th>Date</th>
<th>Kg</th>
<th>Price</th>
<th>Color</th>
<th>yarn</th>
<th>Action</th>
</tr>
</thead>
<tbody>
<?php
$minusKg = 0;
$threadColor = 0;
while($fetch = mysql_fetch_assoc($select)) {
	
	if($fetch["kg"] < 0) {
		$kg = $fetch["kg"];
		$minusKg = $minusKg + $kg;
	} else {
		$kg = $fetch["kg"];
	}
	
echo "<tr><td>".$fetch["threadno"]."</td><td>".date('d-m-Y',$fetch["date"])."</td><td>".$kg."</td><td>".$fetch["price"]."</td><td>".getDataByName('color', $fetch["color"], 'name')."</td><td>".getDataByName('yarns', $fetch["yarn"], 'name')."</td><td>"."<a href='addthread.php?id=".$fetch["id"]."'>edit</a></td></tr>";
$threadColor = $threadColor + abs($kg);
}
echo $threadColor;
?>
</tbody>
</table>
<br/>
<?php
//$select=getSqlData("SELECT a.kg as kg, c.name as name, a.color as color, a.date as date FROM paavudetails a, paavus b, users c WHERE a.paavuid = b.id and b.userid = c.id and a.date > '".strtotime('2018-04-01')."' {$colorReturn} ORDER BY a.date desc");
echo "SELECT * FROM paavudetails a {$colorReturn} ORDER BY a.date desc";
$select=getSqlData("SELECT * FROM paavudetails a {$colorReturn} ORDER BY a.date desc");
//echo "SELECT a.kg as kg, a.color as color, a.date as date FROM paavudetails a {$colorReturn} ORDER BY a.date desc";
//$fetch=mysql_fetch_array($select);
?>
<table id="example" border="0">
<thead>
<tr>
<th>S.No</th>
<th>Date</th>
<th>Kg</th>
<th>Color</th>
<th>User</th>
</tr>
</thead>
<tbody>
<?php
$sn =1;
$givenKg = 0;
foreach($select as $k=>$fetch) {
	$paavus = getSingleData('paavus', $fetch["paavuid"]);
	if(!empty($paavus)) {
		$users = getSingleData("users", $paavus[0]['userid']);
		$username = $users[0]['name'];
	} else {
		$username = '';
	}
	$givenKg = $givenKg + $fetch["kg"];
echo "<tr><td>".$sn++."</td><td>".date('d-m-Y',$fetch["date"])."</td><td>".$fetch["kg"]."</td><td>".getDataByName('color', $fetch["color"], 'name')."</td><td>".$username."</td></tr>";
}
?>
</tbody>
</table>
<br/>
<div class="container-fluid">
<div class="row" style="font-size:20px;padding-top:30px;font-weight:bold;">
Total Kg : <?php echo $threadColor+$minusKg; ?><br/>
Given Kg : <?php echo $givenKg; ?><br/>
-------------------------<br/>
Balance : <?php echo round($threadColor+$minusKg, 2)-round($givenKg, 2); ?>
</div>
</div>

</body>
</html>