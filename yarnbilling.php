
<?php 
include('template/header.php');
$colors = getData('color');
$yarns = getData('yarns');
//$designs = getData('designs');
$thread = [];
$edit = false;
if(isset($_GET['id'])){
	$data = getSingleData('yarnbillings', $_GET['id']);
	$edit = true;
	$id = $_GET['id'];
	$thread = $data[0];
	$threadc = $data[0];
	
	$coloramount = getSingleDataByName("coloramount", $thread['id'], 'yarnid');
} else{
	$thread = [];
	$threadc = [];
}
if(!empty($_POST) && isset($_POST['id'])){
	$data['yarnshopid'] = $_POST['yarn']; 
	$data['billno'] = $_POST['billno'];
	$data['billdate'] = strtotime($_POST['billdate']);
	if($_POST['taxamount'] == 'amount'){
		$data['taxamount'] = $_POST['taxamount'];
	} 
	$data['taxpercentage'] = $_POST['taxpercentage'];
	$data['totalamount'] = $_POST['totalamount'];
	$updateData["id"] = $_POST["id"];
	updateData("yarnbillings",$data,$updateData);
	foreach($_POST['color'] as $k=>$v){
		$data = [];
		$data['color'] = $_POST['color'][$k];
		$data['kg'] = $_POST['kg'][$k];
		$data['price'] = $_POST['price'][$k];
		$data['yarnid'] = $_POST["id"];
		$data['date'] = strtotime($_POST['billdate']);
		if(isset($_POST['colorid'][$k])) {
			$updateData["id"] = $_POST['colorid'][$k];
			updateData("coloramount",$data,$updateData);
		} else {
			insertData("coloramount", $data);
		}
		
		
	}
	$url = 'yarnbillingdetails.php';
	echo("<script>location.href = '".$url."';</script>");
}else if(!empty($_POST)){	
	
	$data['yarnshopid'] = $_POST['yarn']; 
	$data['billno'] = $_POST['billno'];
	$data['billdate'] = strtotime($_POST['billdate']);
	if($_POST['taxamount'] == 'amount'){
		$data['taxamount'] = $_POST['taxamount'];
	} 
	$data['taxpercentage'] = $_POST['taxpercentage'];
	$data['totalamount'] = $_POST['totalamount'];
	insertData("yarnbillings", $data);
	$billid = mysql_insert_id();
	$threadyarn["yarn"]=$_POST["yarn"];
	$threadyarn["outsideyarn"] = 1;
	$threadyarn["date"]=strtotime('now');
	$printno = getSqlData("select max(yarnprintno) as yarnprintno from threads;");
	$threadyarn["yarnprintno"]=$printno[0]["yarnprintno"]+1;
	
	foreach($_POST['color'] as $k=>$v){
		$data = [];
		$data['color'] = $_POST['color'][$k];
		$data['kg'] = $_POST['kg'][$k];
		$data['price'] = $_POST['price'][$k];
		$data['yarnid'] = $billid;
		$data['date'] = strtotime($_POST['billdate']);
		insertData("coloramount", $data);
		$threadyarn['color'] = $_POST['color'][$k];
		$threadyarn['kg'] = $_POST['kg'][$k];
		if($_POST["submit"] == 'Submit & save yarn') {
			insertData("threads", $threadyarn);
		}
	}
	if($_POST["submit"] == 'Submit & save yarn') {
		$url = 'yarnprintoutside.php?yarn='.$threadyarn["yarn"]."&yarnprintno=".$threadyarn["yarnprintno"];
		echo("<script>location.href = '".$url."';</script>");
	} else {
		$url = 'yarnbillingdetails.php';
		echo("<script>location.href = '".$url."';</script>"); 
	}
}

?>
<style>
table tr td {
	padding-right:10px;
}
</style>
<div class="container">
<center>
<form  action="yarnbilling.php" method="post" id="formID">
<?php 
if($edit){
	echo "<input type='hidden' name='id' value='{$thread['id']}'>";
}
?>
<div class="hr"></div>
<h3 style="margin:0px">Yarn billing</h3>
<div class="hr"></div>
<div>
<table align="left">
<tr><td>Yarn shop</td><td><select name="yarn" class='validate[required]'>
<?php
	foreach($yarns as $key=>$val){
		if($val['id'] == $thread['yarnshopid']) {
			echo "<option selected ='selected' value=".$val['id'].">".$val['name']."</option>";
		} else {
			echo "<option value=".$val['id'].">".$val['name']."</option>";
		}
	}
?>
</select></td>
<td>Bill no </td><td><input type="text"  name="billno" size="25" style="width:159px;" value="<?php if(isset($thread['billno']))echo ($thread['billno']); ?>"></td>
<td>Bill date</td><td><input id="datepicker" class='validate[required] datepicker' style="width:150px;" type="text" name="billdate"  value="<?php if(isset($thread['billdate']))echo date('d-m-Y',$thread['billdate']); ?>"></td>
</tr>
</table>
<table align="left" >
<?php 
if($edit){
foreach($coloramount as $k=>$v){ 
$thread = $v;
$thread['amount'] = $thread['kg'] * $thread['price'];
echo "<input type='hidden' name='colorid[]' value='".$thread['id']."'>";
?>
<tr id="billfield"><td >Color/size</td><td><select name="color[]" class='validate[required]'>
<option value="">--select--</option>
<?php
	foreach($colors as $key=>$val){
		if($val['id'] == $thread['color']) {
			echo "<option selected ='selected' value=".$val['id'].">".$val['name']."</option>";
		} else {
			echo "<option value=".$val['id'].">".$val['name']."</option>";
		}
	}
?>
</select></td>
<td >Kg&nbsp;&nbsp;&nbsp;&nbsp;<input class='validate[required,custom[number]] kg' type="text" name="kg[]" size="5" style="width:50px;" value="<?php if(isset($thread['kg']))echo $thread['kg']; ?>" onblur="setamountkg(this);" >&nbsp;&nbsp;Price&nbsp;&nbsp; <input type="text" class='validate[required, custom[number]] price' name="price[]" size="5" style="width:63px;"  value="<?php if(isset($thread['price']))echo $thread['price']; ?>" onblur="setamount(this);" id="userprice" >
&nbsp;&nbsp;&nbsp;Amount&nbsp;&nbsp;<input class="amount" style="width:150px;" type="text" name="amount[]" size="5" value="<?php if(isset($thread['amount']))echo $thread['amount']; ?>" readonly ></td>
</tr>
<?php
}
 } else { ?>
<tr id="billfield"><td >Color/size</td><td><select name="color[]" class='validate[required]'>
<option value="">--select--</option>
<?php
	foreach($colors as $key=>$val){
		if($val['id'] == $thread['color']) {
			echo "<option selected ='selected' value=".$val['id'].">".$val['name']."</option>";
		} else {
			echo "<option value=".$val['id'].">".$val['name']."</option>";
		}
	}
?>
</select></td>
<td >Kg&nbsp;&nbsp;&nbsp;&nbsp;<input class='validate[required,custom[number]] kg' type="text" name="kg[]" size="5" style="width:50px;" value="<?php if(isset($thread['kg']))echo $thread['kg']; ?>">&nbsp;&nbsp;Price&nbsp;&nbsp; <input type="text" class='validate[required, custom[number]] price' name="price[]" size="5" style="width:63px;"  value="<?php if(isset($thread['price']))echo $thread['price']; ?>" onblur="setamount(this);" id="userprice" >
&nbsp;&nbsp;&nbsp;Amount&nbsp;&nbsp;<input class="amount" style="width:150px;" type="text" name="amount[]" size="5" value="<?php if(isset($thread['amount']))echo $thread['amount']; ?>" readonly ></td>
</tr>
<?php } ?>
</table>
<table align="left" id="billtable">

</table>
<table align="left">
<tr><td colspan="8" align="right"><a href="javascript:void(0);" onclick="addmore();">Add more</a></td></tr>
<tr ><td>Tax amount</td><td><select name="taxpercentage" class='validate[required] tax' onchange="selectTax(this.value)" style="width:150px">
<option value="">--select--</option>
<option value="5" <?php if($threadc && $threadc['taxpercentage'] == '5'){ echo "selected='selected'"; } ?>>5%</option>
<option value="18" <?php if($threadc && $threadc['taxpercentage'] == '18'){ echo "selected='selected'"; } ?>>18%</option>
<option value="amount" <?php if($threadc && $threadc['taxamount'] != 0){ echo "selected='selected'"; } ?> >amount</option>		
</select></td>
<td><span id="amntlbl" style="display:none;">amount</span></td><td><input class='' type="text" name="taxamount" size="5" style="width:150px;display:none;" value="<?php if(isset($threadc['taxamount']))echo $threadc['taxamount']; ?>"  id="taxamt" onblur="updateamnt()"></td>
<td>Total amount </td><td><input type="text" class='validate[required, custom[number]]' style="width:181px" name="totalamount" size="5" value="<?php if(isset($threadc['totalamount']))echo $threadc['totalamount']; ?>" readonly id="totalamount"></td>
</tr>
</table>
</div>
<div style="clear:both" class="col-sm-12">
<div align="right"></div>
<table style="">
<tr><td>
<input type="submit" id="submit" value="Submit" name="submit" class="btn btn-primary">
</td>
<?php if(!$edit){ ?>

<td>
<input type="submit" id="submityarn" value="Submit & save yarn" name="submit" onclick="return chkvalid();" class="btn btn-primary">
</td>
<?php } ?>
</tr>
</table>
</div>



</form>
</center>
</div>
</div>
<script>
function chkvalid(){
	var test = confirm("You want to save yarn and submit billing?");
	if(test){
		return true;
	} else {
		return false;
	}
}
function addmore(){
	$("#billfield").clone().find('input, select').val('').end().appendTo("#billtable");
}

function setamount(val){
	var amnt = parseFloat(val.value) * parseFloat($(val).prev('.kg').val());
	$(val).next('.amount').val(amnt.toFixed(2));
	var tax = $(".tax option:selected").val();
	if(tax != ''){
		selectTax(tax);
	}	
}

function setamountkg(val){
	var amnt = parseFloat(val.value) * parseFloat($(val).next('.price').val());
	$(val).next().next('.amount').val(amnt.toFixed(2));
	var tax = $(".tax option:selected").val();
	if(tax != ''){
		selectTax(tax);
	}	
}


function selectTax(taxval){
	var total = 0;
	$(".amount").each(function(){
        total = total + parseInt($(this).val());
    });
	if(taxval != 'amount') {
		if(total){
			var per = (total*parseInt(taxval))/100;
			$("#totalamount").val(Math.round(total+per));
		}
		$("#taxamt").hide();
		$("#amntlbl").hide();
	} else {
		$("#taxamt").show();
		$("#amntlbl").show();
	}
}

function updateamnt(){
	var total = 0;
	$(".amount").each(function(){
        total = total + parseInt($(this).val());
    });
	var per = parseFloat($("#taxamt").val());
	$("#totalamount").val(Math.round(total+per));
	
}
</script>
</body>
</html>
