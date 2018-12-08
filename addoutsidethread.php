
<?php 
include('template/header.php');
$colors = getData('color');
$yarns = getData('yarns');
//$designs = getData('designs');
$thread = [];
$edit = false;
if(isset($_GET['id'])){
	$data = getSingleData('threads', $_GET['id']);
	$edit = true;
	$thread = $data[0];
} else{
	$thread = [];
}
if(isset($_POST['yarn'])){
	
	//$data["kg"]=$_POST["kg"];
	$data["price"]=0;
	//$data["color"]=$_POST["color"];
	$data["yarn"]=$_POST["yarn"];
	$data["outsideyarn"] = 1;
	$data["date"]=strtotime('now');
	$printno = getSqlData("select max(yarnprintno) as yarnprintno from threads;");
	$data["yarnprintno"]=$printno[0]["yarnprintno"]+1;
	foreach($_POST["kg"] as $k=>$v){
		if(!empty($_POST["kg"][$k]) && !empty($_POST["color"][$k])){
		$data["kg"] = $_POST["kg"][$k];
		$data["color"] = $_POST["color"][$k];
		insertData("threads", $data);
		}
	}
	$url = 'yarnprintoutside.php?yarn='.$data["yarn"]."&yarnprintno=".$data["yarnprintno"];
	echo("<script>location.href = '".$url."';</script>");
	
}
?>
<div class="container">
<center>
<form  action="addoutsidethread.php" method="post" id="formID">
<?php 
if($edit){
	echo "<input type='hidden' name='id' value='{$thread['id']}'>";
}
?>
<div class="hr"></div>
<h3 style="margin:0px">Yarn details</h3>
<div class="hr"></div>
<table id="addcontent">
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
<tr>
<td>Color/size</td>
<td>Kg</td>
</tr>


<tr id="addmore"><td><select name="color[]" class='validate[required]'>
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
</select></td><td><input class='validate[required,custom[number]]' type="text" name="kg[]" size="25" value="<?php if(isset($thread['kg']))echo $thread['kg']; ?>"></td></tr>






</table>
<table>
<tr><td style="color:none"></td><td><a href="javascript:void(0);" onclick="addmore();">Add more</a></td></tr>
</table>
<input type="submit" id="submit" value="Submit & Print" class="btn btn-primary">




</form>
</center>
</div>
</div>
<center><h3>Thread Delivery Slip</h3></center>





<?php
$time = strtotime('today');
$sql = "select * from threads group by yarnprintno";
$select=getSqlData($sql);

//$fetch=mysql_fetch_array($select);
?>

<table id="example" border="0">
<thead>
<tr>
<th>S.No</th>
<th>Print no</th>
<th>Date</th>
<th>Action</th>
</tr>
</thead>
<tbody>
<?php
//print_r($fetch);
$i=1;
foreach($select as $key=>$fetch) {
echo "<tr><td>{$i}</td><td>".$fetch["yarnprintno"]."</td><td>".date('d-m-Y',$fetch["date"])."</td>
	     <td><a href='yarnprintoutside.php?yarn=".$fetch["yarn"]."&yarnprintno=".$fetch["yarnprintno"]."'>Print details</a></td></tr>";
$i++;
}
?>
</tbody>
</table>
<script>
function addmore(){
	$("#addmore").clone().find("input").each(function() {
    $(this).attr({
       'value': ''               
    });
  }).end().appendTo('#addcontent');
}
</script>
</body>
</html>
