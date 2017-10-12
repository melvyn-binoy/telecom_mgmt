 <?php
  session_start()
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Personal Details</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <style type="text/css">
    @import url('https://fonts.googleapis.com/css?family=Ubuntu:500');
    body{
      font-family: 'Ubuntu', sans-serif;
    }
    #panelformat{
      margin-top: 150px;
      margin-left: 230px;
    }
    th {
      background-color: #4CAF50;
      color: white;
    }
    button:hover {
    color: #4CAF50;
    }
  </style>

</head>

<body>

  <?php
    $username = $_SESSION['login_user'];
  ?>
<header class="w3-container w3-top w3-white w3-xlarge w3-padding-16">
  <span class="w3-left w3-padding"><marquee><?php echo "Hello $username" ?></marquee></span>
  <a href="pdetails.php" class="w3-right w3-button w3-black">Back</a>
</header>

<?php

  include("config.php");
  $result = mysqli_query($db, "select * from customer where uname = '$username'");

  $resultrow = mysqli_fetch_array($result);

  $name = $resultrow['name'];
  $address = $resultrow['bill_address'];
  $number = $resultrow['phone_no'];
  $email = $resultrow['email'];
  $dob = $resultrow['dob'];
  //$gender = "Male";
  $city = $resultrow['city'];
  $state = $resultrow['state'];
  $country = $resultrow['country'];

?>

  <!--<div id="welcome">Hello <?php echo $username ?>!</div>-->
<form action="update.php" method="POST">
  <div class="container-fluid">
    <div id="panelformat" class="panel panel-default col-lg-8">
      <div class="panel-heading">Personal Details</div>
      <div class="panel-body">
        <?php 
          echo '<table id="mytable" class="table table-bordered table-hover">';
          echo "<tr><td><b>Name</b></td><td><input type='text' autocomplete='on' name='newname'value='$name'size='40'/></td></tr>";
          echo "<tr><td><b>Number</b></td><td><input type='text'value='$number'size='40'readonly/></td></tr>";
          echo "<tr><td><b>Email-id</b></td><td><input type='text' autocomplete='on' name='newemail'value='$email'size='40'/></td></tr>";
          echo "<tr><td><b>Address</b></td><td><input type='text' name='newaddress'value='$address'size='40'/></td></tr>";
          echo "<tr><td><b>Date of birth</b></td><td><input type='text' name='newdob'value='$dob'size='40'/> (YYYY-MM-DD)</td></tr>";
          /*echo "<tr><td>Gender</td><td><textarea rows=1 cols=68 readonly>".$gender."</textarea></td></tr>";*/
          echo "<tr><td><b>City</b></td><td><input type='text' autocomplete='on' name='newcity'value='$city'size='40'/></td></tr>";
          echo "<tr><td><b>State</b></td><td><input type='text' value='$state'size='40'readonly/></td></tr>";
          echo "<tr><td><b>Country</b></td><td><input type='text'value='$country'size='40'readonly/></td></tr>";
          echo "</table>";
        ?>
      </div>
    </div>
   </div>
	
	<center><button class="button button-block">Save Changes</button></center>
</form>
</body>




