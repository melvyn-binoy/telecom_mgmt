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
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
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
    <form action="requestadmin_changeplan.php" method="POST">
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
<!--
  <div class="popup" onclick="myFunction()"><button class="button button-block">Submit</button>
  <span class="popuptext" id="myPopup">Your request has been submitted!<br><br>

        <input type="text"required autocomplete="on" name="planid"/>-->
        <button>Submit</button>
    </form>
  </span>
</div>

      </div>
    </div>

<script>
// When the user clicks on div, open the popup
function myFunction() {
    var popup = document.getElementById("myPopup");
    popup.classList.toggle("show");
}
</script>

</body>



