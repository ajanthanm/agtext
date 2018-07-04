<?php 
include('template/header.php');

$colors = getData('color');
$yarns = getData('yarns');
$designs = getData('designs');
$thread = [];
$edit = false;
$userid =$_REQUEST["userid"];
$paavuid =$_REQUEST["paavuid"];
$kg =$_REQUEST["kg"];
$yarnkg =$_REQUEST["yarnkg"];
$color = $_REQUEST["color"];
$editid = $_REQUEST["edit"];

if($_REQUEST['edit'] != 0){
	$data1 = getSingleData('paavudetails', $_REQUEST['edit']);
	$edit = true;
	$thread = $data1[0];
}

if(isset($_POST['yarn'])){
	$data["kg"]=$yarnkg;
	$data["color"]=$_POST["color"];
	$data["yarn"]=$_POST["yarn"];
	$data["date"]=time();
	insertData("threads", $data);
	$threadid = mysql_insert_id();
	
	$paavudata['paavuid']=$paavuid;
	$paavudata['kg'] = $_POST["kg"];
	$paavudata['color'] = $_POST["color"];
	$paavudata['threadid'] = $threadid;
	
	$paavudata['date'] = time();
	if($_POST["editid"] == 0){
		insertData('paavudetails', $paavudata);
	} else {
		$updateData['id']=$_POST["editid"];
		updateData("paavudetails", $paavudata, $updateData);
		
	}
	$url = 'paavudetails.php?userid='.$userid."&paavuid=".$paavuid;
	echo("<script>location.href = '".$url."';</script>");
	
} else if($yarnkg < 0){
	$data["kg"]=$yarnkg;
	$data["color"]=$color;
	$data["yarn"]=0;
	$data["date"]=time();
		
	
	$paavudata['paavuid']=$paavuid;
	$paavudata['kg'] = $_REQUEST["kg"];
	$paavudata['color'] = $color;
	$paavudata['date'] = time();
	
	if($editid == 0){
		insertData("threads", $data);
		$threadid = mysql_insert_id();
		$paavudata['threadid'] = $threadid;
		insertData('paavudetails', $paavudata);
	} else {
		$threadData = getSingleData('threads', $thread['threadid']);
		$updateDataId['id'] = $threadData[0]['id'];
		$data["kg"] = $yarnkg + $threadData[0]['kg'];
		//print_r($data);
		updateData("threads", $data, $updateDataId);
		$updateData['id'] = $editid;
		updateData("paavudetails", $paavudata, $updateData);
		
	}
	
	$url = 'paavudetails.php?userid='.$userid."&paavuid=".$paavuid;
	echo("<script>location.href = '".$url."';</script>");
	
}
?>
<div class="container">
<center>
<form  action="" method="post" id="formID">
<input type="hidden" name="kg"  value="<?php echo $kg; ?>">
<input type="hidden" name="color"  value="<?php echo $color; ?>">
<input type="hidden" name="editid"  value="<?php echo $editid; ?>">

<div class="hr"></div>
<h3 style="margin:0px">Thread details</h3>
<div class="hr"></div>
<table>
<tr><td>Yarn shop</td><td><select name="yarn" class='validate[required]'>
<option value="">--select--</option>
<?php
	foreach($yarns as $key=>$val){
		if($val['id'] == $thread['yarn']) {
			echo "<option selected ='selected' value=".$val['id'].">".$val['name']."</option>";
		} else {
			echo "<option value=".$val['id'].">".$val['name']."</option>";
		}
	}
?>
</select></td></tr>
<tr><td style="color:none">Kg</td><td><?php echo $yarnkg; ?></td></tr>

<tr><td>Color/size</td><td><?php echo getDataByName('color', $color, 'name'); ?></td></tr>

</table>
<input type="submit" id="submit" value="Submit" class="btn btn-primary">




</form>
</center>
</div>
</div>
</body>
</html>
