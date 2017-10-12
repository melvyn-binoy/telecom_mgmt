<?php
  session_start()
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>MENU</title>
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
  	.well{
  		margin-top: 150px;
  		margin-left: 350px;
  		border-color: #00CED1;
  		border-width: 2px;
  		font-weight: bold;
  		text-align: center;
	  }
    #welcome{
      margin-top: 20px;
      margin-left: 130px;
      font-size: 23px;
      color: blue;
    }
    img{
      margin-left: 200px;
    }
  </style>

</head>

<body>

  <?php
    $username = $_SESSION['login_user'];
  ?>
<header class="w3-container w3-top w3-white w3-xlarge w3-padding-16">
  <span class="w3-left w3-padding"><marquee><?php echo "Hello $username" ?></marquee></span>
  <img src="logo.png" alt="Megaval Logo" style="width:190px;height:98px;">
  <a href="login.html" class="w3-right w3-button w3-black">Logout</a>
</header>
	<div class="conatiner-fluid">
		<div class="well col-lg-6">
			<h2>MENU <br><br></h2>
      <a href="statistics.php"><button type="button" class="btn btn-lg btn-primary btn-block">Statistics</button></a><br>
			<a href="adminusers.php"><button type="button" class="btn btn-lg btn-primary btn-block">Users</button></a><br>
			<a href="adminplans.php"><button type="button" class="btn btn-lg btn-primary btn-block">Plans</button></a><br>
		</div>
	</div>

</body>

