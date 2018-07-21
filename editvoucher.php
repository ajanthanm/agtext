<?php 
include('template/header.php');

$colors = getData('color');
$designs = getData('users');

$printno = getSqlData("select max(voucherid) as vocuherid from transactions;");
$prtno = $printno[0]["vocuherid"]+1;


if(isset($_POST['id'])){
	$data["userid"] = $_POST['userid'];
	$data["amount"] = $_POST['amount'];
	$data["type"] = $_POST['type'];
	$updateData["id"] = $_POST["id"];
	updateData("transactions",$data,$updateData);

	//echo "Amount added successfully";
	$url = 'voucher.php?userid='.$_POST['userid'];
	echo("<script>location.href = '".$url."';</script>");
}
if(isset($_GET['id'])){
	$id = $_GET['id'];
	$edit = true;
	$transaction = getSingleData('transactions',$id);
	$userid = $transaction[0]['userid'];
} else {
	$id = 0;	
	$edit = false;
	$transaction = [];
}
?>
<html>
<body>
<center>



<form  action="" method="post" id="formID">
<?php
echo "<input type='hidden' name='id' value='".$transaction[0]['id']."'>";
?>
<table>
<tr><td>User</td><td><select name="userid" class="validate[required]">
<option value="">--select--</option>
<?php

	foreach($designs as $key=>$val){
		if($val['id'] == $userid ){
			$sel = 'selected';
		} else {
			$sel = '';
		}
		echo "<option ".$sel." value=".$val['id'].">".$val['name']."</option>";
	}
?>
</select></td></tr>

<tr><td>Given amount</td><td><input type="text" name="amount" class="validate[custom[number]]" value="<?php echo ($edit)?$transaction[0]['amount']:''; ?>" ></td></tr>
<tr><td>Type</td><td><select name="type" class="validate[required]">
<option value="">--select--</option>
<?php
$type = ["Cash", "Cheque", "RTGS/NEFT"];
	foreach($type as $key=>$val){
		if($val == $transaction[0]['type'] ){
			$sel = 'selected';
		} else {
			$sel = '';
		}
		echo "<option ".$sel." value=".$val.">".$val."</option>";
	}
?>
</select></td></tr>
<tr><td>
<input type="submit" id="submit" value="Submit" class="btn btn-primary"></td><td>
<a href="voucher.php?userid=<?php echo $userid; ?>"><input type="button" id="submit" value="Cancel" class="btn btn-primary"></a></td></tr>
</table>
</form>
</center>


<br/>
<br/>

</body>
</html>