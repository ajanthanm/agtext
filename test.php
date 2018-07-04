<!DOCTYPE html>
<html lang="en">
<?php
$URL = "http://localhost/agtext/";
?>
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->
  
  <link rel="stylesheet" type="text/css" src="<?php echo $URL; ?>css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script type="text/javascript" src="<?php echo $URL; ?>js/bootstrap.min.js"></script>
</head>
<body>
  
<div class="container-fluid">
  <h1>My First Bootstrap Page</h1>      
  <p>This part is inside a .container-fluid class.</p> 
  <p>The .container-fluid class provides a full width container, spanning the entire width of the viewport.</p>  
<div class="dropdown">
  <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Dropdown Example
  <span class="caret"></span></button>
  <ul class="dropdown-menu">
    <li><a href="#">HTML</a></li>
    <li><a href="#">CSS</a></li>
    <li><a href="#">JavaScript</a></li>
  </ul>
</div>  
</div>

</body>
</html>
