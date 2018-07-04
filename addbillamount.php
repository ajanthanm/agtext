<?php 
include('template/header.php');
$edit = false;
if(isset($_GET['yarnid'])){
	$data = getSingleData('yarns', $_GET['yarnid']);
	//$edit = true;
	$yarndata = $data[0];
	$billid = $_GET['billid'];
}
$data = [];
if(!empty($_POST)){
	//print_r($_POST);
	$data['yarnbillid'] = $_POST['billid']; 
	$data['amount'] = $_POST['amount'];
	$data['date']= time();
	insertData("yarnbillamount", $data);
	
	$url = 'yarnbillingdetails.php';
	echo("<script>location.href = '".$url."';</script>");
	 
}
?>
<center>
<form  action="" method="post" id="formID">
<?php 
echo "<input type='hidden' name='billid' value='{$billid}'>";
if($edit){
	echo "<input type='hidden' name='id' value='{$thread['id']}'>";
}
?>
<table >
<tr><td>Yarn name</td>
<td><?php if(isset($yarndata['name']))echo ($yarndata['name']); ?></td></tr>
<tr><td>Amount</td>
<td><input type="text" name="amount" size="25" class='validate[required, custom[number]]' ></td></tr>
<tr><td></td><td><input type="submit" <?php echo (!$edit)?"id='submit'":''?> value="Submit" class="btn btn-primary"></td></tr>
</table>
</form>
</center>
</body>
</html>
