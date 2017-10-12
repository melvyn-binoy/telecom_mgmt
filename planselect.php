<?php
  session_start()
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Plan Selection</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <style type="text/css">
    @import url('https://fonts.googleapis.com/css?family=Ubuntu:500');
    body{
      font-family: 'Ubuntu', sans-serif;
    }
    #panelformat{
      margin-top: 50px;
      margin-left: 370px;
      border-width: 2px;
      text-align: center;
    }
    #plantable{
    }
    th {
      background-color: #4CAF50;
      color: white;
    }
  </style>

</head>

<body>

<?php

  include("config.php");

  $result = mysqli_query($db, "select * from plan");
?>

    <div id="panelformat" class="panel panel-default col-lg-6">
      <div class="panel-heading">Choose Your Plan</div>
      <div class="panel-body">
        <?php 
          echo '<table id="plantable" class="table table-bordered table-hover">';
          echo "<tr><th>Plan ID</th> <th>Plan</th> <th>Call Rate(Rs/min)</th></tr>";

          while($resultrow = mysqli_fetch_array($result)){
            $plan_id = $resultrow['plan_id'];
            $plan = $resultrow['name'];
            $chargepm = $resultrow['call_rate'];

            echo "<tr><td>$plan_id</td> <td>$plan</td> <td>$chargepm</td></tr>";
          }

          echo "</table>";
        ?>

          <form action="plansubmit.php" method="POST">
            <div class="field-wrap">
              <label>Plan ID<span class="req">*</span></label>
		   <select name="planid">

              <?php
    $result2 = mysqli_query($db, "select * from plan");  
    while($result2row = mysqli_fetch_array($result2)){
        $plan = $result2row['name'];
        $plan_id = $result2row['plan_id'];
  ?>
  <option value=<?php echo "$plan_id"?>><?php echo "$plan_id - $plan"; ?></option>
  <?php } ?>
</select><br><br>
            </div>

            <button class="button button-block">Submit</button>

          </form>

      </div>
    </div>

</body>



