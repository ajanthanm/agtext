<?php 
include('template/header.php');

$colors = getData('color');
$designs = getData('users','order by name asc');

$printno = getSqlData("select max(voucherid) as vocuherid from transactions;");
$prtno = $printno[0]["vocuherid"]+1;


if($_POST && isset($_POST['amount'])){
	$data["userid"] = $_POST['userid'];
	$data["amount"] = $_POST['amount'];
	$data["voucherid"] = $prtno;
	$data["date"] = time();
	insertData("transactions", $data);
	$userid = $_POST['userid'];
	echo "Amount added successfully";
}else if($_POST && $_POST['userid']){
	$userid = $_POST['userid'];
} else {
	$userid = '';
}
?>
<html>
<body>
<center>



<form  action="transaction.php" method="post" >

<table>
<tr><td>User</td><td><select name="userid">
<option value="">--select--</option>
<?php

	foreach($designs as $key=>$val){
		if($val['id'] == $userid){
			$sel = 'selected';
		} else {
			$sel = '';
		}
		echo "<option ".$sel." value=".$val['id'].">".$val['name']."</option>";
	}
?>
</select></td></tr>


<tr><td></td><td>
<input type="submit" id="submit" value="Submit" class="btn btn-primary"></td></tr>
</table>
</form>
</center>
<div>
<strong>User Name : <?php echo getDataByName('users', $userid, 'name'); ?></strong>
</div>
<table id="example" border="0">
<thead>
<tr>
<th>S.No</th>
<th>User name</th>
<th>Voucher Amount</th>
<th>Voucher No</th>
<th>Cooli</th>
<th>Paavu No</th>
<th>Paavu detailid</th>
<th>Date </th>

</tr>
</thead>
<tbody>
<?php
$select=mysql_query("SELECT * FROM `transactions` where userid = '".$userid."' order by id desc");
$sno = 1;
$total = 0;
$paavuamnount = 0;

while($fetch = mysql_fetch_assoc($select)) {
if($fetch["paavuid"] == 0){
	$paavuid = getSingleData("returnpavudetails", $fetch["paavudetailid"]);
	$paavuid = empty($paavuid)?0:$paavuid[0]['paavuid'];
} else {
	$paavuid = $fetch["paavuid"];
}

$paavus = getSingleData('paavus',$paavuid);
if(!empty($paavus)){
	$paavuno = $paavus[0]['paavuno'].'-'.getDataByName('designs', $paavus[0]['name'], 'name');
}else{
	$paavuno = '';
}
echo "<tr><td>{$sno}</td><td>".getDataByName('users', $fetch["userid"], 'name')."</td><td>".$fetch["amount"]."</td><td>".$fetch["voucherid"]."</td><td>".$fetch["paavu_amount"]."</td><td>".$paavuno."</td><td>".$fetch["paavudetailid"]."</td><td>".date('d-m-Y',$fetch["date"])."</td></tr>";
$total += $fetch["amount"];
$paavuamnount += $fetch["paavu_amount"];
$sno++;
}
?>
</tbody>
</table>
<br/>
<br/>
<strong>
Voucher Amount :<?php echo $total; ?><br/>
Cooli Amount :<?php echo $paavuamnount; ?><br/>
------------------------------<br/>
Balance Amount : <?php echo  (float)$paavuamnount - (float)$total; ?>
</strong>
</body>
</html>