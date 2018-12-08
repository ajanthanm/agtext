<?php
mysql_connect("localhost","root","");
mysql_select_db("agtext_1819_1022");
$currentYear = strtotime("01-04-2018");
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

function getData($tablename, $order=''){
	$sql = "select * from {$tablename} {$order}";
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
	$data = [];
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
	$data = [];
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

function avgwait($id, $stdate, $endate){
	$sql = "select sum(roles) as roles, sum(weight) as weight, sum(meter) as meter, sum(amount) as amount from returnpavudetails where design = {$id} and date > '{$stdate}' and date < '{$endate}' and meter != 0 and amount != 0";
	$select=mysql_query($sql);
	$i=0;
	$data = [];
	while($fetch = mysql_fetch_assoc($select)) {
		if($fetch['weight'] != ''){
			$data["avgwait"] = $fetch['weight']/($fetch['roles']+$fetch['meter']);
			$data["couliamount"] = (($fetch['amount']*$fetch['meter'])/$fetch['meter']);
		} else {
			$data = 0;
		}
	}
	return $data;
}

function coulirate($id, $stdate, $endate){
	$sql = "select (meter * amount) as totalamount, meter from returnpavudetails where design = {$id} and date > '{$stdate}' and date < '{$endate}' and meter != 0 and amount != 0";
	$select=mysql_query($sql);
	$i=0;
	$data = 0;
	$totalamount = 0;
	$totalmeter = 0;
	while($fetch = mysql_fetch_assoc($select)) {
		$totalamount = $totalamount + $fetch['totalamount'];
		$totalmeter = $totalmeter + $fetch['meter'];
	}
	
    $data = ($totalamount/$totalmeter);
	return $data;
}

function yarnrate($stdate, $endate){
	$sql = "SELECT sum(a.price*a.kg) as price, sum(kg) as kg from color c, coloramount a where c.name like '10%' and c.id = a.color and a.date > '{$stdate}' and a.date < '{$endate}'";
	$select=mysql_query($sql);
	$i=0;
	$data = 0;
	while($fetch = mysql_fetch_assoc($select)) {
		if($fetch['price'] != ''){
			$data = ($fetch['price']/$fetch['kg']);
		}
	}
	return $data;
}

function yarnrateByName($stdate, $endate, $name){
	$sql = "SELECT sum(a.price*a.kg) as price, sum(kg) as kg from color c, coloramount a where c.name like '{$name}%' and c.id = a.color and a.date > '{$stdate}' and a.date < '{$endate}'";
	$select=mysql_query($sql);
	$i=0;
	$data = 0;
	while($fetch = mysql_fetch_assoc($select)) {
		if($fetch['price'] != ''){
			$data = ($fetch['price'])/($fetch['kg']);
		}
	}
	return $data;
}

function yarnrateByPolyName($stdate, $endate, $name){
	$data = 0;
	$kg = 0;
	foreach($name as $k=>$val){
		$sql = "SELECT a.* from color c, coloramount a where c.name like '{$val}%' and c.id = a.color and a.date > '{$stdate}' and a.date < '{$endate}' order by a.id desc limit 1";
		$select=mysql_query($sql);
		$i=0;
		
		while($fetch = mysql_fetch_assoc($select)) {
			if($fetch['price'] != ''){
				$data = $data + ($fetch['price']*$fetch['kg']);
			}
			$kg = $kg + $fetch['kg'];
		}
	}
	if($data > 0){
		$data = $data/$kg;
	} 
	return $data;
}




function pr($val){
	//print_r($val);
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

?>
<!DOCTYPE HTML>
<html>
<head>

<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css">  
<title>Ag Text</title>

<script type="text/javascript" language="javascript" src="js/jquery-1.12.3.min.js"></script>
<script src="js/jquery-1.8.2.min.js" type="text/javascript"></script>
<script type="text/javascript" language="javascript" src="js/jquery.dataTables.js"></script>
<script src="js/bootstrap.min.js"></script>
<link rel="stylesheet" media="all" type="text/css" href="css/jquery-ui-1.8.16.custom.css" />
  <link rel="stylesheet" media="all" type="text/css" href="css/validationEngine.jquery.css" />
  <script type="text/javascript" src="js/jquery-ui-1.8.16.custom.min.js"></script>
  <script type="text/javascript" src="js/jquery.validationEngine.js"></script>
  <script type="text/javascript" src="js/jquery.validationEngine-en.js"></script>
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
		$( "#datepicker, .datepicker" ).datepicker({
      showOn: "button",
      buttonImage: "img/calendar.gif",
      buttonImageOnly: true,
      buttonText: "Select date",
	  dateFormat: "dd-mm-yy"
	  });
	});
	function printTrigger(){
		var divContents = $("#print").html();
		var printWindow = window.open('', '', 'height=400,width=800');
		printWindow.document.write('<html><head><title></title>');
		printWindow.document.write('</head><body >');
		printWindow.document.write(divContents);
		printWindow.document.write('</body></html>');
		printWindow.document.close();
		printWindow.print();
	}
	function ajaxValidationCallback(status, form, json, options){
			if (window.console) 
			console.log(status);
                
			if (status === true) {
				alert("the form is valid!");
				// uncomment these lines to submit the form to form.action
				// form.validationEngine('detach');
				// form.submit();
				// or you may use AJAX again to submit the data
			} else {
				alert('no');
			}
		}
	 jQuery(document).ready(function(){
			jQuery("#formID").validationEngine('attach', {
  onValidationComplete: function(form, status){
    //alert("The form status is: " +status+", it will never submit");
	$("#submit").attr('disabled','disabled');
	if(status){
		
	form.validationEngine('detach');
	form.submit();
	} else {
		$("#submit").removeAttr('disabled','disabled');
	}	
  }  
});
			
		$('form').attr('autocomplete', 'off');	
			//$("#formID").bind("jqv.field.result", function(event, field, errorFound, prompText){ console.log(errorFound) })
		}); 

function redirect(url){
	window.location.href=url;
}		
</script>
</head>
<body class="container" style="width:85%;">
<div class="container-fluid" >
	<div class="row">
		<div class="page-banner" style="font-size: 58px;font-weight: bold;text-align: center;padding: 16px;color: #2424a9;margin:15px;">Agathiar Textiles </div>
	</div>
	<div>
		<nav style="min-height:36px;" class="navbar navbar-default">
			<div class="buttoncls">
				<ul class="nav navbar-nav">
				  <li class="active">
					<div class="dropdown">
					  <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Yarn
					  <span class="caret"></span></button>
					  <ul class="dropdown-menu">
						<li><a href="addoutsidethread.php">Yarn purchase</a></li>
						<li><a href="thread.php">Yarn stock</a></li>
						<li><a href="threadstock.php">Yarn cotton stocks </a></li>
						<li><a href="threadpolystock.php">Yarn poly stocks </a></li>
						<li><a href="color.php">Add Color</a></li>
						<li><a href="yarn.php">Add yarn shop</a></li>
						
						
					  </ul>
					</div>
				  </li>
				  <li><div class="dropdown">
					  <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Loom Customer
					  <span class="caret"></span></button>
					  <ul class="dropdown-menu">
						<li><a href="users.php">View Customer</a></li>
						<li><a href="designs.php">Add design</a></li>
						<li><a href="addusers.php">Add Customer</a></li>
						<li><a href="printAllDetails.php">Print Details</a></li>
						<li><a href="paavulist.php">Paavu List</a></li>
					  </ul>
					</div>
				  </li>
				  <li><div class="dropdown">
					  <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Billing details
					  <span class="caret"></span></button>
					  <ul class="dropdown-menu">
						<li><a href="yarnbilling.php">Yarn billing</a></li>
						<li><a href="yarnbillingdetails.php">Yarn billing details</a></li>
						<li><a href="viewreports.php">View reports</a></li>
						<li><a href="lalbagreports.php">Lalbag reports</a></li>
						<li><a href="kamalreports.php">Kamal reports</a></li>
					  </ul>
					</div>
				  </li>
				  <li><a href="transaction.php" style="color:#FFF;padding:0;"><button class="btn btn-primary dropdown-toggle " type="button" > Transaction</button></a></li>
				  <li><a href="voucher.php" style="color:#FFF;padding:0;"><button class="btn btn-primary dropdown-toggle " type="button" > Voucher</button></a></li>
					<li><a href="users.php" style="color:#FFF;padding:0;"><button class="btn btn-primary dropdown-toggle " type="button" > View customer</button></a></li>
				 
				</ul>
			</div>
		</nav>
	</div>
</div>