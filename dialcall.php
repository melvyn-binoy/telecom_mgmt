<?php
  include("config.php");
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Dial Call</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="css/call_button.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <style type="text/css">
    @import url('https://fonts.googleapis.com/css?family=Ubuntu:500');
    body{
      font-family: 'Ubuntu', sans-serif;
    }
    h1{
      margin-top: 100px;
      font-size: 150px;
      color: #4CAF50;
    }
    h4{
      color: grey;
      margin-left: 660px;
    }
    button{
      margin-top: 200px; 
    }
  </style>

</head>

<body>

  <?php
    $username = $_SESSION['login_user'];
  ?>
  <header class="w3-container w3-top w3-white w3-xlarge w3-padding-16">
  <a href="menu.php" class="w3-right w3-button w3-black">Back</a>
</header>
  <center><h1><?php echo "$username" ?></h1></center>

<center>
  <form action="calling.php" method="POST">
  <br> <br>
   <select name="contact">
  <?php  
    $result = mysqli_query($db, "select name,phone_no from customer where uname != '$username' and status='Exist'");
    while($resultrow = mysqli_fetch_array($result)){
        $contactname = $resultrow['name'];
        $contactnumber = $resultrow['phone_no'];
  ?>
  <option value=<?php echo "$contactnumber";?>|<?php echo "$contactname";?>><?php echo "$contactname - $contactnumber"; ?></option>
  <?php } ?>
</select> <br>
  <button>Call</button>
</form></center>


</body>