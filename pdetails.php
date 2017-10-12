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
    button {
    color: black;
    } 
    button:hover {
    color: #4CAF50;
    }

    /* Popup container - can be anything you want */
    .popup {
        position: relative;
        display: inline-block;
        cursor: pointer;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    /* The actual popup */
    .popup .popuptext {
        visibility: hidden;
        width: 250px;
        background-color: #555;
        color: white;
        text-align: center;
        border-radius: 6px;
        padding: 8px 0;
        position: absolute;
        z-index: 1;
        bottom: 125%;
        left: 50%;
        margin-left: -80px;
    }

    /* Popup arrow */
    .popup .popuptext::after {
        content: "";
        position: absolute;
        top: 100%;
        left: 32%;
        margin-left: -5px;
        border-width: 5px;
        border-style: solid;
        border-color: #555 transparent transparent transparent;
    }

    /* Toggle this class - hide and show the popup */
    .popup .show {
        visibility: visible;
        -webkit-animation: fadeIn 1s;
        animation: fadeIn 1s;
    }

    /* Add animation (fade in the popup) */
    @-webkit-keyframes fadeIn {
        from {opacity: 0;} 
        to {opacity: 1;}
    }

    @keyframes fadeIn {
        from {opacity: 0;}
        to {opacity:1 ;}
    }
  </style>

</head>

<body>

  <?php
    $username = $_SESSION['login_user'];
  ?>
<header class="w3-container w3-top w3-white w3-xlarge w3-padding-16">
  <span class="w3-left w3-padding"><marquee><?php echo "Hello $username" ?></marquee></span>
  <a href="menu.php" class="w3-right w3-button w3-black">Back</a>
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

  <div class="container-fluid">
    <div id="panelformat" class="panel panel-default col-lg-8">
      <div class="panel-heading">Personal Details</div>
      <div class="panel-body">
        <?php 
          echo '<table id="mytable" class="table table-bordered table-hover">';
          echo "<tr><td><b>Name</b></td><td>".$name."</td></tr>";
          echo "<tr><td><b>Number</b></td><td>".$number."</td></tr>";
          echo "<tr><td><b>Email-id</b></td><td>".$email."</td></tr>";
          echo "<tr><td><b>Address</b></td><td>".$address."</td></tr>";
          echo "<tr><td><b>Date of birth</b></td><td>".$dob."</td></tr>";
          /*echo "<tr><td>Gender</td><td>".$gender."</td></tr>";*/
          echo "<tr><td><b>City</b></td><td>".$city."</td></tr>";
          echo "<tr><td><b>State</b></td><td>".$state."</td></tr>";
          echo "<tr><td><b>Country</b></td><td>".$country."</td></tr>";
          echo "</table>";
        ?>
      </div>
    </div>
   </div>
	<?php 

    $sql = "select sum(costofcall) as sumchar from calldetails where fromnumber=(select phone_no from customer where uname='$username')";
    $result = mysqli_query($db, $sql);
    $resultrow = mysqli_fetch_array($result);
    $amountdue = $resultrow['sumchar'];  

    $flag = 0;
    $sql = "select status,charge from bill where phone_no in (select phone_no from customer where uname = '$username')";
    $result = mysqli_query($db, $sql);
    while($resultrow = mysqli_fetch_array($result)){
      $status = $resultrow['status'];
      $charge = $resultrow['charge'];
      if ($status=='NotPaid'&&$charge!=0.00) 
        $flag = 1;
    }
  ?>
	<center><a href="pdetailsupdate.php"><button class="button button-block">Update Details</button></a>
    
&nbsp &nbsp &nbsp &nbsp &nbsp 
<?php  if($flag==1){ ?>
<div class="popup" onclick="myFunction()"><button class="button button-block">Delete User</button>
  <span class="popuptext" id="myPopup">You have <?php echo "$amountdue"; ?> amount due!<br><br>
    <a href="paydue.php">
      <button>Pay Now</button>
    </a>
  </span>
</div>
<?php }else{ ?>
  <div class="popup" onclick="myFunction()"><button class="button button-block">Delete User</button>
  <span class="popuptext" id="myPopup">Your request has been submitted!<br><br>
    <a href="requestadmin_delete.php">
      <button>Okay</button>
    </a>
  </span>
</div></center>
<?php } ?>
<script>
// When the user clicks on div, open the popup
function myFunction() {
    var popup = document.getElementById("myPopup");
    popup.classList.toggle("show");
}
</script>

</body>



