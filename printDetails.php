<?php 
include('template/header.php');
if(isset($_REQUEST['userid']) && !isset($_REQUEST['printno'])) {
	$userid = $_REQUEST['userid'];
	$users = getSingleData('users',$userid);
	$time = strtotime('today');
	$condition = "a.userid = ".$userid." and a.id = b.paavuid and b.color != 0 and b.printno = 0 and b.date > {$time}";
	$updateCon = true;
} else if(isset($_REQUEST['printno'])) {
	$userid = $_REQUEST['userid'];
	$users = getSingleData('users',$userid);
	$printnodet = $_REQUEST['printno'];
	$condition = "a.id = b.paavuid and b.color != 0 and b.printno = {$printnodet}";
	$updateCon = false;
}
$printno = getSqlData("select max(printno) as printno from paavudetails;");
$prtno = $printno[0]["printno"];

if($updateCon) {
	$displayNo = $prtno+1;
} else {
	$displayNo = $_REQUEST['printno'];
}

?>

<center><h3>Thread Delivery Slip</h3></center>


<div class="back"><a href="paavu.php?userid=<?php echo $userid; ?>"><input type="button" value="Back" class="btn btn-info"></a></div>
<div align="right"><button><a href='printDetailsCustomize.php?userid=<?php echo $userid; ?>'>Print details</a></button></div>

<?php

$select=getSqlData("select a.name, b.date, b.color, b.kg, b.printno, b.id from  paavus a, paavudetails b where {$condition}");

//$fetch=mysql_fetch_array($select);
?>

<?php 
if(!$select){
	echo "No data to print";
}else{
?>

<div id="print" >
<div style="margin-left:10px;">
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

<div style="width:700px;" >
<!--
<div class="row"><div style="float:left;width:130px;">Off 04324-232467</div><div style="float:left;width:150px;padding-left:20px;font-weight:bold;text-decoration:underline;" >Yarn Delivery slip</div><div style="float:right;" >cell:94437 32465</div></div>
<div class="row"><div align="center" class="textcolor">Agathiar textiles</div></div>
<div class="row" align="center" style="font-size:18px;">65, Kamarajapuram, Sengunthapuram post, karur - 2</div>
<div class="row" style="padding:10px 0;"><div style="float:left;width:100px;">No. <?php echo $displayNo; ?> </div><div style="float:right;">Date : <?php echo date('d-m-Y');?></div></div><br/>
<div class="row"  ><strong>Mr. <?php echo $users[0]['name'].", ".$users[0]['address']; ?></strong></div>-->



<table style="width:700px;">
<tr>
<td align="center"><div >Delivery challan(For job work)</div></td>
</tr>
</table>
<table style="width:700px;">
<tr>
<td ><div ><strong>GST NO:</strong>33AAAFA9848E1ZL</div></td>
<td align="right"><div ><strong>PH:</strong> 94437 32465</div></td>
</tr>
</table>
<table style="width:700px;">
<tr>
<td>
<div class="row"><div align="center" class="textcolor">Agathiar textiles</div></div>
<div class="row" align="center" style="font-size:15px;">65, Kamarajapuram west, Sengunthapuram post, karur - 2</div>
<div style="padding:10px 0;"><div style="float:left;width:100px;">DC No. <?php echo $displayNo; ?> </div><div style="float:right;">Date : <?php echo date('d-m-Y');?></div></div>
</td>
</tr>
</table>
<!--<table>
<tr>
<td width="300px">
<div>Agathiar textiles</div>
<div>65, Kamarajapuram, Sengunthapuram post, karur - 2</div>

</td>
<td>
<div><strong>DC No:</strong> <?php echo $displayNo; ?></div>
<div><strong>Date: </strong><?php echo date('d-m-Y');?></div>
</td>
</tr>
</table>-->
<table style="width:700px;">
<tr>
<td width="480px">
<div>CONSIGNEE : <strong><?php echo $users[0]['name']; ?></strong></div>
<!--<div style="font-size:18px;"><strong><?php echo $users[0]['name']; ?></strong></div>-->
<div><?php echo $users[0]['address']; ?></div>
</td>
<td >
<div align="right">GST NO: UNREGD</div>
<div align="right"><strong>PH:</strong> <?php echo $users[0]['mobileno']; ?></div>
</td>
</tr>
</table>
</div>
<table class="tableprint" style="width:700px;font-size:18px;">
	<thead>
		<tr >
			<td>S.No</td>
			<td width="200px">Description of Goods</td>
			<td>HSN Code/ Chapter #</td>
			<td>Weight (Kg)</td>
			<td>No.Bag</td>
			
		</tr>
	</thead>
	<tbody>
	
	<?php
	$j = 1;	
	$prtno = $prtno+1;
    $totalbags = 0;    
        
	foreach($select as $k=>$fetch) {
		if($updateCon){
			$update["id"] = $fetch["id"];
			$printupdate["printno"] = $prtno;	
			updateData('paavudetails',$printupdate,$update);
		}
	?>
		<tr >
			<td><?php echo $j++; ?></td>
			<td><?php echo $name = getDataByName('color', $fetch["color"], 'name'); ?></td>
			<td><?php 
					if(strpos(strtolower($name), 'poly') !== false){
						echo "5402";
					} else {
						echo '5205';
					}

			?></td>
			<td><?php echo $fetch["kg"]; ?></td>
			<td><?php
                                        if(strpos(strtolower($name), 'poly') !== false){
                                             echo '-';                                             
						
				               } else {
												$totalbags = $totalbags + ($fetch["kg"]/60);
                                              echo round($fetch["kg"]/60,2);
                                             					
					} 
                                  
                         ?></td>
			
		</tr>
	<?php } ?>	
	</tbody>
	
</table>


<div style="width:700px;padding-top:5px;" >
<div align="left" style="float:left;width:220px" >Party signature</div>
<div align="left" style="float:left;width:220px;font-size:16px;" ><b>Total bags - <?php echo round($totalbags,2); ?> </b></div>
<div align="right" style="float:right;">For Agathiar textiles <br/><img style="width:135px;height:50px;" src="img/signimg.jpg" /></div>
</div>
</div>
</div>
<div style="width:700px;padding-top:73px;" >
<div class="row"><div align="center" ><input type="button" value="Print" id="printMe"  /></div></div>
</div>
</div>

<?php
}
?>


</body>

</html>