<?php 
include('template/header.php');
if(isset($_REQUEST['id'])) {
	$id = $_REQUEST['id'];
	$printData = getSingleData('transactions',$id);
	$users = getSingleData('users',$printData[0]['userid']);
}

?>
<div class="back"><a href="voucher.php?userid=<?php echo $users[0]['id']; ?>"><input type="button" value="Back" class="btn btn-info"></a></div>
<center><h3>Cash Delivery Slip</h3></center>




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
.textcolor1{
	color:#000;
	font-size:20px;
	font-weight:bold;
}
.row{
	padding:5px 0;
}
.vouch{
	float: left;
    width: 136px;
    font-size: 21px;
    padding-left: 35px;
    font-weight: bold;
    text-decoration: underline;
	color:#000;
}
</style>

<div style="width:490px;" >
<div class="row"><div style="float:left;width:185px;"><div ><strong>GST NO:</strong>33AAAFA9848E1ZL</div></div><div class="vouch" >VOUCHER</div><div style="float:right;" ><div>cell:94437 32465</div><div>Off:04324 32467</div></div></div>
<div style="clear:both;"></div>
<div class="row"><div align="center" class="textcolor">Agathiar textiles</div></div>
<div class="row" align="center" style="font-size:18px;">65, Kamarajapuram west, Sengunthapuram post, karur - 2</div>

<div class="row" style="padding:10px 0;"><div style="float:left;width:100px;">No. <?php echo $printData[0]['voucherid']; ?> </div><div style="float:right;">Date : <?php echo date('d-m-Y');?></div></div><br/>
<div style="border:1px solid #bbb;"></div>
<div class="row"><div style="float:left;width:100px;">Name :</div><div style="float:left;font-size:16px;"><strong><?php echo $users[0]['name']; ?></strong></div></div>
<div style="clear:both;"></div>
<div class="row"><div style="float:left;width:100px;">Address : </div><div style="float:left;"><?php echo $users[0]['address']; ?></div></div>
<div style="clear:both;"></div>
<div class="row"><div style="float:left;width:100px;">Particulars : </div><div style="float:left;"><?php 
$amtdetails = ($printData[0]['amountdetail'] != '')?"- ".$printData[0]['amountdetail']:"";
echo $printData[0]['type']." ".$amtdetails;

 ?></div></div>
<div style="clear:both;"></div>
<div class="row"><div style="float:left;width:100px;">Rupees : </div><div style="float:left;"><?php echo convert_number_to_words($printData[0]['amount'])." only"; ?></div></div>
<div style="clear:both;"></div>
<div class="row"><div style="float:left;width:100px;">Rs. <?php echo $printData[0]['amount']; ?></div></div>
<div style="clear:both;"></div>

</div>
<div style="width:490px;padding-top:43px;" >
<div class="row"><div align="right" >Signature</div></div>
</div>
</div>
</div>
<div style="width:490px;padding-top:43px;" >
<div class="row"><div align="right" ><input type="button" value="Print" id="printMe"  /></div></div>
</div>




</body>
<script>
printTrigger();
</script>
</html>