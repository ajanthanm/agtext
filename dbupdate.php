<?php 
include('template/header.php');
// paavu update
deleteData("paavus", "status", 1);
$userdata = getData("users");
foreach($userdata as $k=>$v){
	$userpaavu = getSingleDataByName("paavus","userid", $v['id']);
	if(!empty($userpaavu)){
		$paavuno = 1;
		foreach($userpaavu as $key=>$val){
			$data["paavuno"] = $paavuno;
			$id["id"]=$val['id'];
			updateData("paavus", $data, $id);
			//echo $val['id']."||".$paavuno."</br>";
			$paavuno++;
		}
	}
	// Transaction update
	$select=mysql_query("SELECT * FROM `transactions` where userid = '".$v['id']."'");
	$total = 0;
	$paavuamnount = 0;
	while($fetch = mysql_fetch_assoc($select)) {
		$total += $fetch["amount"];
		$paavuamnount += $fetch["paavu_amount"];
	}
	$voucherAmnt = $paavuamnount - $total;
	if($voucherAmnt) {
		$userTransaction[$v['id']] = $voucherAmnt;
	}
}
$sql = "TRUNCATE TABLE transactions";
mysql_query($sql);
//echo "<pre>";
//print_r($userTransaction);
foreach($userTransaction as $key=>$val) {
	$data = [];
	$data["userid"] = $key;
	$data["paavu_amount"] = $val;
	$data["date"] = time();
	print_r($data);
	insertData("transactions", $data);
}



?>