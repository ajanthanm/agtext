<!DOCTYPE HTML>
<html>
<head>

<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css">  
<title>Ag Text</title>

<script type="text/javascript" language="javascript" src="js/jquery-1.12.3.min.js"></script>
<script type="text/javascript" language="javascript" src="js/jquery.dataTables.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript" >
	$(document).ready(function() {
		$('#example, .example').DataTable({
			"pagingType": "full_numbers"
		});
		$('#printMe').click(function(){
			var divContents = $("#print").html();
            var printWindow = window.open('', '', 'height=400,width=800');
            printWindow.document.write('<html><head><title></title>');
            printWindow.document.write('</head><body >');
            printWindow.document.write(divContents);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
		});
	});
	
</script>
<style>

.container-fluid{
	background-color:lavender; 
	padding:10px 10px;
	margin:0px;
}
.container{
padding:0px; 
margin:0px;
}
.hr{
	height:20px;
}
.tableprint tr td{
	border:1px solid #BBB;
}
.back{
	padding:5px 10px;
}
.dataTables_paginate{
	float:none !important;
}
.label{
	font-size:20px;
	color:#cc0a0a;
	font-weight:bold;
}
</style>
</head>
<body margin="10px" class="container">
 <div class="container-fluid" >
 <div class="row">
 <h1 style="margin:0px"><center>
  <div class="page-banner"> WELCOME TO AGATHIAR TEXTILES</div>

  </center>
</h1>
</div>
<div >
<div class="row">
<center>
<table width="1124">
  <tr color="black">
 

<div class="col-sm-3"><td width="307"><h2><a href="designs.php"> Add Designs</a></h2></td></div>
<div class="col-sm-3"><td width="349"><h2><a href="color.php">Add Color</a></h2></td></div>
<div class="col-sm-3"><td width="349"><h2><a href="yarn.php">Add Yarn Shop name</a></h2></td></div>
<div class="col-sm-3"><td width="452"><h2><a href="thread.php"> Yarn Stock</a></h2></td></div>
<div class="col-sm-3"><td width="307"><h2><a href="users.php"> Loom Users</a></h2></td></div>

<div class="col-sm-3"><td width="307"><h2><a href="transaction.php"> Transaction</a></h2></td></div>
<div class="col-sm-3"><td width="307"><h2><a href="voucher.php"> Voucher</a></h2></td></div>
 </tr></table>
</center>
</div>
</div>
</div>
<?php
mysql_connect("localhost","root","");
mysql_select_db("agtext");

function insertData($table, $data){
	$sql = "insert into {$table} ";
	$field = "";
	$fieldData = "";
	foreach($data as $key=>$val){
		$field .= $key.",";
		$fieldData .= "'".$val."',";
		
	}
	$field = rtrim($field, ",");
	$fieldData = rtrim($fieldData, ",");
	$sql .= "(".$field.") values (".$fieldData.")";
	mysql_query($sql);
}

function updateData($table, $data, $id){
	$sql = "UPDATE {$table} set ";
	$field = "";
	$fieldData = "";
	foreach($data as $key=>$val){
		$field .= $key." = '".$val."',";
	}
	$field = rtrim($field, ",");
	foreach($id as $key=>$val){
		$updateName = $key;
		$updateValue = $val;
	}
	$sql .= $field." where ".$updateName." = '".$updateValue."'";
	mysql_query($sql);
}

function getData($tablename){
	$sql = "select * from {$tablename}";
	$select=mysql_query($sql);
	$i=0;
	while($fetch = mysql_fetch_assoc($select)) {
		$data[$i] = $fetch;
		$i++;
	}
	return $data;
}

function getSingleData($tablename, $id){
	$sql = "select * from {$tablename} where id = {$id}";
	$select=mysql_query($sql);
	$i=0;
	while($fetch = mysql_fetch_assoc($select)) {
		$data[$i] = $fetch;
		$i++;
	}
	return $data;
}

function deleteData($tablename, $column ,$id){
	$sql = "delete from {$tablename} where {$column} = {$id}";
	mysql_query($sql);
	
}

function getSqlData($sql){
	//$sql = "select * from {$tablename} where id = {$id}";
	$select=mysql_query($sql);
	$i=0;
	$data = [];
	while($fetch = mysql_fetch_assoc($select)) {
		$data[$i] = $fetch;
		$i++;
	}
	return $data;
}

function getDataByName($tablename, $id, $fieldName){
	if($id){
	$sql = "select * from {$tablename} where id = {$id}";
	$select=mysql_query($sql);
	$i=0;
	while($fetch = mysql_fetch_assoc($select)) {
		$data[$i] = $fetch;
		$i++;
	}
	return $data[0][$fieldName];
	} else {
		return '';
	}
}

function getSingleDataByName($tablename, $val, $name){
	$sql = "select * from {$tablename} where {$name} = {$val}";
	$select=mysql_query($sql);
	$i=0;
	while($fetch = mysql_fetch_assoc($select)) {
		$data[$i] = $fetch;
		$i++;
	}
	return $data;
}

function checkData($value){
	if(isset($value)){
		return $value;
	} else {
		return '';
	}
}

function pr($val){
	print_r($val);
}
function convert_number_to_words($number) {

    $hyphen      = '-';
    $conjunction = ' and ';
    $separator   = ', ';
    $negative    = 'negative ';
    $decimal     = ' point ';
    $dictionary  = array(
        0                   => 'zero',
        1                   => 'one',
        2                   => 'two',
        3                   => 'three',
        4                   => 'four',
        5                   => 'five',
        6                   => 'six',
        7                   => 'seven',
        8                   => 'eight',
        9                   => 'nine',
        10                  => 'ten',
        11                  => 'eleven',
        12                  => 'twelve',
        13                  => 'thirteen',
        14                  => 'fourteen',
        15                  => 'fifteen',
        16                  => 'sixteen',
        17                  => 'seventeen',
        18                  => 'eighteen',
        19                  => 'nineteen',
        20                  => 'twenty',
        30                  => 'thirty',
        40                  => 'fourty',
        50                  => 'fifty',
        60                  => 'sixty',
        70                  => 'seventy',
        80                  => 'eighty',
        90                  => 'ninety',
        100                 => 'hundred',
        1000                => 'thousand',
        1000000             => 'million',
        1000000000          => 'billion',
        1000000000000       => 'trillion',
        1000000000000000    => 'quadrillion',
        1000000000000000000 => 'quintillion'
    );

    if (!is_numeric($number)) {
        return false;
    }

    if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
        // overflow
        trigger_error(
            'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
            E_USER_WARNING
        );
        return false;
    }

    if ($number < 0) {
        return $negative . convert_number_to_words(abs($number));
    }

    $string = $fraction = null;

    if (strpos($number, '.') !== false) {
        list($number, $fraction) = explode('.', $number);
    }

    switch (true) {
        case $number < 21:
            $string = $dictionary[$number];
            break;
        case $number < 100:
            $tens   = ((int) ($number / 10)) * 10;
            $units  = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $hyphen . $dictionary[$units];
            }
            break;
        case $number < 1000:
            $hundreds  = $number / 100;
            $remainder = $number % 100;
            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
            if ($remainder) {
                $string .= $conjunction . convert_number_to_words($remainder);
            }
            break;
        default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int) ($number / $baseUnit);
            $remainder = $number % $baseUnit;
            $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= convert_number_to_words($remainder);
            }
            break;
    }

    if (null !== $fraction && is_numeric($fraction)) {
        $string .= $decimal;
        $words = array();
        foreach (str_split((string) $fraction) as $number) {
            $words[] = $dictionary[$number];
        }
        $string .= implode(' ', $words);
    }

    return $string;
}

function editData($data, $val){
	if(isset($data[$val])){
		return $data[$val];
	}else {
		return '';
	}
}
$name = "hi suresh";
$dbname = "keyname asdfsadf asdf asdf fsdf asfd ";
$msg = $name.$dbname;
$msg = str_replace("keyname",$name,$dbname);

function mailsend($name, $to, $msg){


}
?>