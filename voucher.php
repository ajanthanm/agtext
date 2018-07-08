<?php 
include('template/header.php');

$colors = getData('color');
$designs = getData('users','order by name asc');

$printno = getSqlData("select max(voucherid) as vocuherid from transactions;");
$prtno = $printno[0]["vocuherid"]+1;


if($_POST && $_POST['amount']){
	$data["userid"] = $_POST['userid'];
	$data["amount"] = $_POST['amount'];
	$data["type"] = $_POST['type'];
	$data["amountdetail"] = $_POST['amountdetail'];
	$data["voucherid"] = $prtno;
	$data["date"] = time();
	insertData("transactions", $data);
	$userid = $_POST['userid'];
	echo "Amount added successfully";
	$lastid = mysql_insert_id();
	$url = 'printTransaction.php?id='.$lastid;
	echo("<script>location.href = '".$url."';</script>");
}else if($_POST && $_POST['userid']){
	$userid = $_POST['userid'];
} else if($_GET && $_GET['userid']){
	$userid = $_GET['userid'];
} else {
	$userid = '';
}
?>
<html>
<body>
<center>



<form  action="voucher.php" method="post" id="formID">

<table>
<tr><td>User</td><td><select name="userid" class="validate[required]">
<option value="">--select--</option>
<option value="all">All</option>
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

<tr><td>Given amount</td><td><input type="text" name="amount" class="validate[custom[number]]"></td></tr>
<tr><td>Amount type</td><td><select name="type" >
<option value="">--select--</option>
<option value="Cash">Cash</option>
<option value="Cheque">Cheque</option>
<option value="RTGS/NEFT">RTGS/NEFT</option>
</select> <input type="text" name="amountdetail" >
</td><td></tr>
<tr><td></td><td>
<input type="submit" id="submit" value="Submit & print" class="btn btn-primary"></td></tr>
</table>
</form>
</center>
<div>
<strong>User Name : <?php 
if($userid == 'all') {
	echo "All";
} else {
	echo getDataByName('users', $userid, 'name');
}
 ?></strong>
</div>
<table id="example" border="0">
<thead>
<tr>
<th>S.No</th>
<th>Date</th>
<th>User name</th>
<th>Amount</th>
<th>Voucher No</th>
<th>Print</th>
</tr>
</thead>
<tbody>
<?php
if($userid == 'all') {
	$usercond = "";
} else {
	$usercond = "userid = '".$userid."' and";
	
}
$select=mysql_query("SELECT * FROM `transactions` where ".$usercond." amount != 0 order by id");
$sno = 1;
$total = 0;
$paavuamnount = 0;

while($fetch = mysql_fetch_assoc($select)) {
	if($fetch["amount"] != 0 && $userid != 'all'){
		$printData = "<a href='printTransaction.php?id=".$fetch["id"]."' class='btn btn-info cbtn'>Print</a>  <a class='btn btn-info cbtn' href='editvoucher.php?id=".$fetch["id"]."'>Edit</a>";
	} else {
		$printData = "";
	}
echo "<tr><td>{$sno}</td><td>".date('d-m-Y',$fetch["date"])."</td><td>".getDataByName('users', $fetch["userid"], 'name')."</td><td>".$fetch["amount"]."</td><td>".$fetch["voucherid"]."</td><td>".$printData."</td></tr>";
$total += $fetch["amount"];
$paavuamnount += $fetch["paavu_amount"];
$sno++;
}
?>
</tbody>
</table>
<br/>
<br/>

</body>
</html>