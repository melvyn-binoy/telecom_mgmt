 <?php
  session_start();
  $adminusername = $_SESSION['login_user'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Client Details</title>
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
    h2{
    color: #4CAF50;    
    }
  </style>

</head>

<center><body>

<header class="w3-container w3-top w3-white w3-xlarge w3-padding-16">
  <span class="w3-left w3-padding"><marquee><?php echo "Hello $adminusername" ?></marquee></span>
  <a href="adminusers.php" class="w3-right w3-button w3-black">Back</a>
</header>

<?php

  include("config.php");
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = mysqli_real_escape_string($db, $_POST['cliname']);

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

    $query2 = "SELECT month, charge FROM bill WHERE phone_no = '$number' GROUP BY month";  
 $result2 = mysqli_query($db, $query2);
}
?>

  <div class="container-fluid">
    <div id="panelformat" class="panel panel-default col-lg-8">
      <div class="panel-heading">Client Details</div>
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
   <br><br>
   <h2>Monthly Bill</h2>
<div id="chart_div" style="width: 900px; height: 500px;"></div>
</body></center>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawVisualization);

      function drawVisualization() {
        // Some raw data (not necessarily accurate)
        var data = google.visualization.arrayToDataTable([
         ['Month', 'Bill Amount'],
<?php  
                          while($row2 = mysqli_fetch_array($result2))  
                          {  
                               echo "['".$row2["month"]."', ".$row2["charge"]."],";  
                          }  
                          ?> 
      ]);

    var options = {
      //title : 'Monthly Bill',
      vAxis: {title: 'Bill Amount'},
      hAxis: {title: 'Months'},
      seriesType: 'bars',
      series: {5: {type: 'line'}}
    };

    var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
    chart.draw(data, options);
  }
    </script>


