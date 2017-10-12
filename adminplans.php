<?php
  session_start()
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Admin Plans</title>
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
    #panel1format{
      margin-top: 150px;
      border-width: 2px;
      text-align: center;
    }
    #panel2format{
      margin-top: 50px;
      margin-left: 370px;
      border-width: 2px;
      text-align: center;
    }
    th {
      background-color: #4CAF50;
      color: white;
      text-align: center;
    }   
    button {
    color: black;
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
  <a href="adminmenu.php" class="w3-right w3-button w3-black">Back</a>
</header>

<?php

  include("config.php");
  $result = mysqli_query($db, "select * from plan");

?>

  <div class="container-fluid">
    <div id="panel1format" class="panel panel-default col-lg-12">
      <div class="panel-heading">Plans</div>
      <div class="panel-body">
       
	 <?php 
          echo '<table id="otherplantable" class="table table-bordered table-hover">';
          echo "<tr><th>Plan ID</th> <th>Plan</th> <th>Call Rate(Rs/min)</th></tr>";

          while($resultrow = mysqli_fetch_array($result)){
            $planid=$resultrow['plan_id'];
		 $plan = $resultrow['name'];
            $chargepm = $resultrow['call_rate'];

            echo "<tr><td>$planid</td> <td>$plan</td> <td>$chargepm</td></tr>";
          }

          echo "</table>";
        ?>



      </div>
          <a href="adminaddplan.php"><button class="button button-block">Add Plan</button></a><br><br>
    </div>


  </div>	

</body>





