<?php 
include('template/header.php');
$userid = $_REQUEST['userid'];
$users = getSingleData('users',$userid);
$yarn = $_REQUEST['yarn'];
$yarnprintno = $_REQUEST['yarnprintno'];
$printno = getSqlData("select max(yarnprintno) as yarnprintno from threads;");
$prtno = $printno[0]["yarnprintno"];

if(isset($_REQUEST['userid']) && $_REQUEST['yarnprintno'] == 0) {
	$updateCon = true;
	$displayNo = $prtno+1;
} else {
	$updateCon = false;
	$displayNo = $yarnprintno;
}

$time = strtotime('today');
$sql = "select a.name, b.date, b.color, b.kg, b.printno, c.id, c.yarn, c.kg as yarnkg from paavus a, paavudetails b, threads c where a.userid = {$userid} and a.id = b.paavuid and b.threadid = c.id and c.yarn = {$yarn} and c.yarnprintno = {$yarnprintno} and b.date > {$currentYear}";
$select=getSqlData($sql);

//$condition = "a.id = b.paavuid and b.color != 0 and b.printno = {$printnodet}";
?>

<center><h3>Yarn purchase Slip</h3></center>



<div align="right"><button><a href='yarnprintDetailsCustomize.php?userid=<?php echo $userid; ?>'>Print details</a></button></div>

<?php


//$fetch=mysql_fetch_array($select);
?>

<?php 
if(!$select){
	echo "No data to print";
}else{
?>

<div id="print" >
<div style="margin:0 17%;">
<style>
.tableprint tr td{
	border:1px solid #BBB;
}
.textcolor{
	color:#000;
	font-size:26px;
	font-weight:bold;
}
</style>

<div style="width:490px;" >
<div class="row"><div style="float:left;width:185px;"><div ><strong>GST NO:</strong>33AAAFA9848E1ZL</div></div><div style="float:left;width:150px;padding-left:20px;font-weight:bold;text-decoration:underline;" >Yarn purchase slip</div><div style="float:right;" >cell:94437 32465</div></div>
<div class="row"><div align="center" class="textcolor">Agathiar textiles</div></div>
<div class="row" align="center" style="font-size:18px;">65, Kamarajapuram west, Sengunthapuram post, karur - 2</div>
<div class="row" style="padding:10px 0;"><div style="float:left;width:100px;">No. <?php echo $displayNo; ?> </div><div style="float:right;">Date : <?php echo date('d-m-Y');?></div></div><br/>
<div class="row"  ><strong>Mr. <?php echo getDataByName('yarns', $select[0]["yarn"], 'name'); ?></strong></div>

</div>
<table class="tableprint" style="width:490px;font-size:20px;">
	<thead>
		<tr >
			<td>S.No</td>
			<td>Color</td>
			
			<td>Bag(s)</td>
			
		</tr>
	</thead>
	<tbody>
	
	<?php
	$j = 1;	
	
	foreach($select as $k=>$fetch) {
		
		if($updateCon){
			$update["id"] = $fetch["id"];
			$printupdate["yarnprintno"] = $displayNo;	
			updateData('threads',$printupdate,$update);
		}
	?>
		<tr >
			<td><?php echo $j++; ?></td>
			<td><?php echo getDataByName('color', $fetch["color"], 'name'); ?></td>
			<td><?php echo $fetch["yarnkg"]/60; ?></td>
		</tr>
	<?php } ?>	
	</tbody>
	
</table>
<br/>
<div style="font-size:18px;">Kindly provide the above yarns to particular person.</div>
<div style="width:440px;padding-top:43px;" >
<div class="row"><div style="float:left;">Receiving</div><div style="float:right" >Regards</div></div>
</div>
</div>
</div>
<div style="width:440px;padding-top:43px;" >
<div class="row"><div align="right" ><input type="button" value="Print" id="printMe"  /></div></div>
</div>
</div>

<?php
}
?>


</body>

</html>