<?php 
include('template/header.php');
?>
<center><h3>Billing details</h3></center>



<?php

if($_POST) {
	$data["name"]=$_POST["name"];
	//$emailid=$_POST["emailid"];
	$data["mobileno"]=$_POST["mobileno"];
	$data["address"]=$_POST["address"];
	if(isset($_POST["id"])) {
		$updateData["id"] = $_POST["id"];
		updateData("users",$data,$updateData);
	}
	else {
		$data["date"]=time();
		
		insertData("users", $data);
	}
	/**
else {
	$sql="insert into users (name,mobileno,address)values('$name','$mobileno','$address')";
	$i=mysql_query($sql);

}
*/}
$select=mysql_query("SELECT * FROM `yarnbillings`");
if (mysql_num_rows($select) > 0) {
    // output data of each row
    
  }
//$fetch=mysql_fetch_array($select);
?>
<table id="example" border="0">
<thead>
<tr>
<th>S.No</th>
<th>Yarn name</th>
<th>Bill no</th>
<th>Total amount</th>
<th>Paid amount</th>
<th>Balance</th>
<th>Action</th>
</tr>
</thead>
<tbody>
<?php
//print_r($fetch);
$i=1;
while($fetch = mysql_fetch_assoc($select)) {
	$billamount = getSingleDataByName("yarnbillamount", $fetch["yarnshopid"],"yarnbillid");
	$amount = '';
	$totalamnt = 0;
	if($billamount){
		foreach($billamount as $k=>$v){
			$amount .= $v['amount'].",";
			$totalamnt = $totalamnt + $v['amount'];
		}
		$amount = rtrim($amount,",");
	}
echo "<tr><td>{$i}</td><td>".getDataByName('yarns', $fetch["yarnshopid"], 'name')."</td><td>".$fetch["billno"]."</td><td>".$fetch["totalamount"]."</td><td>".$amount."</td><td>".($fetch["totalamount"] - $totalamnt)."</td><td><a href='addbillamount.php?billid=".$fetch["id"]."&yarnid=".$fetch["yarnshopid"]."'>Add amount</a>/<a href='yarnbilling.php?id=".$fetch["id"]."'>Edit</a></td></tr>";
$i++;
}
?>
</tbody>
</table>
</body>
</html>