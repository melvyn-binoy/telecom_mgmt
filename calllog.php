<?php
  session_start()
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Call Log</title>
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
      margin-left: 200px;
      border-width: 2px;
      text-align: center;
    }
    th {
      background-color: #4CAF50;
      color: white;
      text-align: center;
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

  //$result = mysqli_query($db, "select phone_no, plan.name, plan.call_rate from customer, plan where customer.plan_id = plan.plan_id and uname = '$username'");

  //$resultrow = mysqli_fetch_array($result);

  $resultfrom = mysqli_query($db, "select phone_no from customer where uname = '$username'");
  $resultfromrow = mysqli_fetch_array($resultfrom);
  $phonefrom = $resultfromrow['phone_no'];
?>

  <div class="container-fluid">
    <div id="panel1format" class="panel panel-default col-lg-12">
      <div class="panel-heading">Dialled Calls</div>
      <div class="panel-body">
        <?php 

          $result = mysqli_query($db, "select * from calldetails where fromnumber = '$phonefrom'");

          echo '<table id="dialtable" class="table table-bordered table-hover">';
          echo "<tr><th>Dialled to</th> <th>Phone No.</th> <th>Month</th> <th>Date</th> <th>Year</th> <th>Time</th> <th>Duration(min)</th> <th>Charge(Rs)</th></tr>";

          while($resultrow = mysqli_fetch_array($result)){
            $phoneNo = $resultrow['tonumber'];
            $year = $resultrow['year'];
            $month = $resultrow['month'];
            $date = $resultrow['day'];
            $time = $resultrow['time'];
            $duration = $resultrow['duration'];
            $costofcall = $resultrow['costofcall'];
            //$charge = $duration * $callrate;

                //$sql = "update calldetails set costofcall = '$charge' where fromnumber='$phonefrom' and tonumber='$phoneNo' and month='$month' and day='$date' and year='$year' and time='$time'";
               // $resultupdate = mysqli_query($db, $sql);
                //if ($resultupdate) {
                  //echo "rows affected : ". mysqli_affected_rows($db);;
                //}
               //  else {
                   // echo "Error updating record: " . $db->error;
              //  }

                

            $resultother = mysqli_query($db, "select name from customer where phone_no = '$phoneNo'");
            $resultotherrow = mysqli_fetch_array($resultother);
            $oname = $resultotherrow['name'];

            echo "<tr><td>$oname</td> <td>$phoneNo</td> <td>$month</td> <td>$date</td> <td>$year</td> <td>$time</td> <td>$duration</td> <td>$costofcall</td></tr>";
          }

          echo "</table>";
        ?>
      </div>
    </div>

    <div id="panel2format" class="panel panel-default col-lg-8">
      <div class="panel-heading">Received Calls</div>
      <div class="panel-body">
        <?php 

          $result = mysqli_query($db, "select * from calldetails where tonumber = '$phonefrom'");

          echo '<table id="receivetable" class="table table-bordered table-hover">';
          echo "<tr><th>Received from</th> <th>Phone No.</th> <th>Month</th> <th>Date</th> <th>Year</th> <th>Time</th> <th>Duration(min)</th></tr>";

          while($resultrow = mysqli_fetch_array($result)){
            $phoneNo = $resultrow['fromnumber'];
            $month = $resultrow['month'];
		        $year = $resultrow['year'];
            $date = $resultrow['day'];
            $time = $resultrow['time'];
            $duration = $resultrow['duration'];

//$sql = "update calldetails set costofcall = '$charge' where fromnumber='$phoneNo' and tonumber='$phonefrom' and month='$month' and day='$date' and year='$year' and time='$time'";
                //$resultupdate = mysqli_query($db, $sql);


            $resultother = mysqli_query($db, "select name from customer where phone_no = '$phoneNo'");
            $resultotherrow = mysqli_fetch_array($resultother);
            $oname = $resultotherrow['name'];

            echo "<tr><td>$oname</td> <td>$phoneNo</td> <td>$month</td> <td>$date</td> <td>$year</td> <td>$time</td> <td>$duration</td></tr>";
          }

          echo "</table>";
        ?>
      </div>
    </div>


  </div>	

</body>




