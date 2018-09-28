<?php 
include('template/header.php');
$userid=$_REQUEST["userid"];
$paavuid=$_REQUEST["paavuid"];
if(isset($_GET['action'])&& isset($_GET['id']) && $_GET['action'] == 'delete' ){
	if($_GET['type'] == 'add'){
		deleteData("paavudetails", $_GET['id']);
	} else if($_GET['type'] == 'return') {
		deleteData("returnpavudetails", 'id', $_GET['id']);
		deleteData("transactions", 'paavudetailid', $_GET['id']);
	}
	header('Location:paavudetails.php?userid='.$userid.'&paavuid='.$paavuid);
}
$paavus = getSingleData('paavus',$paavuid);
$users = getSingleData('users',$userid);
$prevpaavu = getSqlData("select * from paavus where id < {$paavuid} and userid = {$userid} and status = 0 order by id desc limit 1");
$nextpaavu = getSqlData("select * from paavus where id > {$paavuid} and userid = {$userid} and status = 0 order by id asc limit 1");

$desings = getSingleData('designs',$paavus[0]['name']);
?>
<div id="print">
<center><h3 style="color:blue;"><?php echo $users[0]['name']; ?></h3></center>
<div class="back"><a href="paavu.php?userid=<?php echo $userid; ?>"><input type="button" value="Back" class="btn btn-info"></a>&nbsp;&nbsp;<a href="javascript:void(0);" onclick="printTrigger();"><input type="button" value="Print" class="btn btn-info"></a></div>
<div align="right" class="row">
<?php if(!empty($prevpaavu)){ ?>
<a href="paavudetails.php?userid=<?php echo $userid; ?>&paavuid=<?php echo $prevpaavu[0]['id']; ?>"><input type="button" value="Prev" class="btn btn-info"></a>
<?php } ?>
<?php if(!empty($nextpaavu)){ ?>
<a href="paavudetails.php?userid=<?php echo $userid; ?>&paavuid=<?php echo $nextpaavu[0]['id']; ?>"><input type="button" value="Next" class="btn btn-info"></a>
<?php 
}
if($paavus[0]['status'] == 0) { ?>
<a href="statusupdate.php?userid=<?php echo $userid; ?>&paavuid=<?php echo $paavuid; ?>"><input type="button" value="Status closure" class="btn btn-primary"></a>
<a href="add_paavudetails.php?userid=<?php echo $userid; ?>&paavuid=<?php echo $paavuid; ?>"><input type="submit" value="Add Yarn details" class="btn btn-primary"></a>
<?php } ?>

</div>

<?php

if($_POST && $_POST['type'] == 'add') {
	//exit;
	$data['paavuid']=$_POST["paavuid"];
	$data['kg'] = $_POST["kg"];
	$data['color'] = $_POST["color"];
	if(isset($_POST["id"])) {
		$updateData["id"] = $_POST["id"];
		updateData("paavudetails",$data,$updateData);
	} else {
		$data['date']=time();
		insertData('paavudetails', $data);
	}
}	

$select=mysql_query("SELECT * FROM paavudetails where paavuid = {$paavuid} order by id desc");
if (mysql_num_rows($select) > 0) {
    // output data of each row
    
  }
//$fetch=mysql_fetch_array($select);

?>

<h4>P.no : <?php echo $paavus[0]['paavuno']; ?>, Design Name : <?php echo getDataByName('designs', $paavus[0]['name'], 'name');  ?>, Color : <?php echo $paavus[0]['color']  ?></h4>
<div class="row container-fluid">
<div class="col-sm-12">
<table id="example" border="0">
<thead>
<tr>
<th>S.No</th>
<th>Kg</th>
<th>Date</th>
<th>Color/size</th>
<th>Carry forward</th>
<th>Action</th>
</tr>
</thead>
<tbody>
<?php
//print_r($fetch);
$sno = 1;
$addKg = 0;
$returnKg = 0;
while($fetch = mysql_fetch_assoc($select)) {
	$addKg = $addKg + $fetch["kg"];
	if($fetch["carry_paavuid"] != 0){
		$carry_paavus = getSingleData('paavus',$fetch["carry_paavuid"]);
		if(!empty($carry_paavus)) {
		$carryfor = "carry forward from: ".$carry_paavus[0]['paavuno']."-".getDataByName('designs', $carry_paavus[0]['name'], 'name');
		} else {
			$carryfor = '';
		}
	} else {
		$carryfor = '';
	}
echo "<tr><td>{$sno}</td><td>".$fetch["kg"]."</td><td>".date('d-m-Y',$fetch["date"])."</td><td>".getDataByName('color', $fetch["color"], 'name')."</td><td>".$carryfor."</td><td>"."<button class='btn btn-info cbtn' onclick=\"redirect('add_paavudetails.php?id=".$fetch["id"]."&paavuid=".$paavuid."&userid=".$userid."')\">Edit</button></td></tr>";
$sno++;
}
?>
</tbody>
</table>
</div>
</div>
</br>
<?php if($paavus[0]['status'] == 0) { ?>
<div class="row" align="right"><a href="return_Paavudetails.php?userid=<?php echo $userid; ?>&paavuid=<?php echo $paavuid; ?>"><input type="submit" value="Received Rolls" class="btn btn-primary"></a></div>
<?php } ?>
</br>

<?php 
if($_POST && $_POST['type'] == 'return') {
	$data["design"]=$_POST["design"];
	$data["roles"]=$_POST["roles"];
	$data["weight"]=$_POST["weight"];
	$data["meter"]=$_POST["meter"];
	$data["amount"]=$_POST["amount"];
	$data['date']= strtotime($_POST["date"]);
	$data['paavuid']=$_POST["paavuid"];
	if(isset($_POST["id"])){
		$updateData["id"] = $_POST["id"];
		updateData("returnpavudetails",$data,$updateData);
	}else{
		insertData("returnpavudetails", $data);
	}
	
	$transaction["userid"] = $userid;
	$transaction["paavu_amount"] = $_POST['amount'] * $_POST['meter'];
	$transaction["date"] = time();
	if(isset($_POST["id"])){
		$updateData["paavudetailid"] = $_POST["id"];
		updateData("transactions",$transaction,$updateData);
	}else{
		$transaction["paavudetailid"] = mysql_insert_id();
		insertData("transactions", $transaction);
	}
	
	}
	
$select=mysql_query("SELECT * FROM `returnpavudetails` where paavuid = {$paavuid} order by id desc");
if (mysql_num_rows($select) > 0) {
    // output data of each row
    
  }
//$fetch=mysql_fetch_array($select);
?>
<table class="example" border="0">
<thead>
<tr>
<th>S.No</th>
<th>Design</th>
<th>Rolls</th>
<th>Weight</th>
<th>Meter</th>
<th>Price/meter</th>
<th>Total amount</th>
<th>Weight/meter</th>
<th>Carry forward</th>
<th>Date</th>
<th>Action</th>
</tr>
</thead>
<tbody>
<?php
//print_r($fetch);
$i = 1;
$totalroles = 0;
$totalmeter = 0;
$totalamount = 0;

while($fetch = mysql_fetch_assoc($select)) {
$returnKg = $returnKg+$fetch["weight"];
if($fetch["carry_paavuid"] != 0){
		$carry_paavus = getSingleData('paavus',$fetch["carry_paavuid"]);
		if(empty($carry_paavus)) {
			$carryfor = 'carry forward from paavu';
		} else {
			$carryfor = "carry forward from: ".$carry_paavus[0]['paavuno']."-".getDataByName('designs', $carry_paavus[0]['name'], 'name');
		}
	} else {
		$carryfor = '';
	}
if(($fetch["meter"]+$fetch["roles"]) == 0){
	$meter = '';
}else{
	$meter = round($fetch["weight"]/($fetch["meter"]+$fetch["roles"]),3);
}
$meterstyle = "";
if($desings[0]['fromvalue'] > 0 && $desings[0]['tovalue'] > 0){
	if($desings[0]['fromvalue'] && $desings[0]['fromvalue'] <= $meter && $desings[0]['tovalue'] >= $meter) {
		$meterstyle = "";

	} else {
		$meterstyle = "style='background:red;'";
	}	
}
$totalroles = $totalroles + $fetch["roles"];
$totalmeter = $totalmeter + $fetch["meter"];
$totalamount = $totalamount + ($fetch["amount"]*$fetch["meter"]);
echo "<tr><td>".$i++."</td><td>".getDataByName('designs', $fetch["design"], 'name')."</td><td>".$fetch["roles"]."</td><td>".$fetch["weight"]."</td><td>".$fetch["meter"]."</td><td>".$fetch["amount"]."</td><td>".($fetch["amount"]*$fetch["meter"])."</td><td ".$meterstyle.">".$meter."</td><td>".$carryfor."</td><td>".date('d-m-Y',$fetch["date"])."</td><td><button class='btn btn-info cbtn' onclick=\"redirect('return_paavudetails.php?id=".$fetch["id"]."&paavuid=".$paavuid."&userid=".$userid."')\">Edit</button></td></tr>";
}
?>
</tbody>
</table>
<br/>
<div class="row">
<h4>Totals -  Rolls:<?php echo $totalroles; ?>,  Meter : <?php echo $totalmeter; ?>,  Amount : <?php echo $totalamount; ?> </h4></div>
<div class="row" style="font-size:20px;padding-top:30px;font-weight:bold;">
Given Kg : <?php echo $addKg; ?><br/>
Received Kg : <?php echo $returnKg; ?><br/>
-------------------------<br/>
Balance Kg : <?php echo $returnKg-$addKg; ?>
</div>
<div class="row" align="center" style="font-size:20px;padding-top:30px;font-weight:bold;">
<?php
if($paavus[0]["status"] == 1 && $paavus[0]["statusupdate"] == 'close'){
	echo "Paavu closure : '".($returnKg-$addKg)."Kg' amount for ".$paavus[0]["closeamount"];
} else if($paavus[0]["status"] == 1) {
	$carry_paavus = getSingleData('paavus',$paavus[0]["carry_paavuid"]);
	
	$name = $carry_paavus[0]['paavuno']."-".getDataByName('designs', $carry_paavus[0]['name'], 'name');
	echo "Paavu carry forwarded : '".($returnKg-$addKg)."Kg' to {$name}";
}

?>
<div>
</div>
</body>
</html>
