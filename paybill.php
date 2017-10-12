<?php
  session_start()
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bills</title>
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
      margin-left: 210px;
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
  <a href="menu.php" class="w3-right w3-button w3-black">Back</a>
</header>

<?php

  include("config.php");
  $result = mysqli_query($db, "select * from bill where phone_no in (select phone_no from customer where uname = '$username')");

?>

  <div class="container-fluid">
    <div id="panelformat" class="panel panel-default col-lg-8">
      <div class="panel-heading">Bill Payments</div>
      <div class="panel-body">
        <?php 
          echo '<table id="paytable" class="table table-bordered table-hover">';
          echo "<tr><th>Bill-id</th> <th>Plan</th> <th>Month</th> <th>Year</th> <th>Amount</th> <th>Status</th></tr>";

          while($resultrow = mysqli_fetch_array($result)){
            $billid = $resultrow['id'];
            $plan = $resultrow['plan'];
            $month = $resultrow['month'];
            $year = $resultrow['year'];
            //$amount = $resultrow['charge'];
            $status = $resultrow['status'];

            $r1 = mysqli_query($db, "select name from plan where plan_id = '$plan'");
            $r1row = mysqli_fetch_array($r1);
            $planname = $r1row['name'];
            
            $sql = "select sum(costofcall) as sumcost from calldetails where billid = '$billid'";
            $r2 = mysqli_query($db, $sql);
            $r2row = mysqli_fetch_array($r2);
            $amount = $r2row['sumcost'];

              $sql = "update bill set charge = '$amount' where id = '$billid'";
                $resultupdate = mysqli_query($db, $sql);
                if ($resultupdate) {
                  //echo "rows affected : ". mysqli_affected_rows($db);;
                }
                 else {
                   // echo "Error updating record: " . $db->error;
                }

            $r3 = mysqli_query($db, "select charge from bill where id = '$billid'");
            $r3row = mysqli_fetch_array($r3);
            $amount = $r3row['charge'];
            
            echo "<tr><td>$billid</td> <td>$planname</td> <td>$month</td> <td>$year</td> <td>$amount</td>";
              if($status == "Paid"){
                echo "<td>PAID</td></tr>";
              }
			
		else if($amount == 0.00)
                echo "<td>_</td></tr>";			

              else if(date('d') == 01){
                ?> <td>
                          
                          <form action="billtransaction.php" method="POST">
                              <input type="hidden" name="var" value="<?php echo "$billid";?>" />
                              <button class="button button-block">Pay</button>
                          </form>

                            </td></tr><?php
                    
              }
              else
                echo "<td>Bill Cycle not Over</td></tr>";
          }
             echo "</table>";
        ?>
      </div>
    <?php
            $sql = "select sum(charge) as sumcharge from bill where phone_no in (select phone_no from customer where uname = '$username') and status = 'NotPaid'";
            $r = mysqli_query($db, $sql);
            $row = mysqli_fetch_array($r);
            $grandtot = $row['sumcharge'];
    ?>   
    <?php  
      $result = mysqli_query($db, "select * from bill where phone_no in (select phone_no from customer where uname = '$username')");
      $flag = 0;
    while($resultcheck = mysqli_fetch_array($result))
    {
      if($resultcheck['status'] == 'NotPaid')
      {
        $flag = 1;
        break;
      }
    }
    if ($flag == 1 && date('d') == 01) {
      echo "<b>Grand Total : $grandtot</b>";
    ?> <br><br>
      <form action="billtransaction.php" method="POST">
          <input type="hidden" name="var" value='payall' />
          <button class="button button-block">Pay All</button><br><br>
      </form>
      <?php  }  ?>
    </div>
  </div>	

</body>



<!-- <a href="billtransaction.php"><button type="button" class="btn btn-sm btn-primary btn-block">Pay</button></a></td></tr> <?php 

                /*?> <div id="paybill">
                      <?php
                          $sql = "update bill set status = 'Paid' where id = '$billid'";
                          $resultbillupdate = mysqli_query($db, $sql);
                      ?>
                    </div>
                <?php*/




 /* <form action="signup.php" method="POST">
                      <button class="button button-block">Pay</button>
                    </form>

                    </td></tr>*/


  //<button type="button" class="btn btn-sm btn-primary btn-block">Pay</button></td></tr> <?php


  /*<?php $billid = 56; ?>
                          <form action="billtransaction.php" method="POST">
                              <input type="hidden" name="var" value="<?php echo '$billid';?>" />
                              <button class="button button-block">Pay</button>
                          </form>

                            </td></tr><?php */
