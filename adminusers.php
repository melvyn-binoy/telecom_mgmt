<?php
  session_start()
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>User Requests</title>
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

?>

  <div class="container-fluid">
    <div id="panel1format" class="panel panel-default col-lg-12">
      <div class="panel-heading">User Requests</div>
      <div class="panel-body">
        <?php 

          $result = mysqli_query($db, "select * from admin_users");

          echo '<table id="requesttable" class="table table-bordered table-hover">';
          echo "<tr><th>Client Name</th> <th>Leave Request</th> <th>Change Plan Request</th> </tr>";

          while($resultrow = mysqli_fetch_array($result)){
            $clientname = $resultrow['username'];
            $delete_status = $resultrow['delete_flag'];
            $changeplan_status = $resultrow['changeplan_flag'];

            $result1 = mysqli_query($db, "select name from customer where uname = '$clientname'");
            $resultrow1 = mysqli_fetch_array($result1);
            $name = $resultrow1['name'];

            ?>
            <tr><td>
                          <form action="clientdetails.php" method="POST">
                              <input type="hidden" name="cliname" value="<?php echo "$clientname";?>" />
                              <button class="button button-block"><?php echo "$name";?></button>
                          </form>
                </td> <?php 
              if($delete_status == "True" && $changeplan_status == "True")
              {
                ?><td>
                          
                          <form action="deleteuser.php" method="POST">
                              <input type="hidden" name="var" value="<?php echo "$clientname";?>" />
                              <button class="button button-block">Approve</button>
                          </form>

                            </td>
                  <td>
                          
                          <form action="admin_changeplan.php" method="POST">
                              <input type="hidden" name="var" value="<?php echo "$clientname";?>" />
                              <button class="button button-block">Approve</button>
                          </form>

                            </td></tr><?php
              }
    else if($delete_status == "True")
    {
                ?><td>
                          
                          <form action="deleteuser.php" method="POST">
                              <input type="hidden" name="var" value="<?php echo "$clientname";?>" />
                              <button class="button button-block">Approve</button>
                          </form>

                            </td><?php
                echo "<td>_</td></tr>";     
    }
              else if($changeplan_status == "True")
              {
                echo "<td>_</td>";
                ?><td>
                          
                          <form action="admin_changeplan.php" method="POST">
                              <input type="hidden" name="var" value="<?php echo "$clientname";?>" />
                              <button class="button button-block">Approve</button>
                          </form>

                            </td></tr><?php
              }
              else
                echo "<td>_</td><td>_</td></tr>";
          }
             echo "</table>";
        ?>
      </div>
    </div>

  </div>	

</body>




