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
  <link rel="stylesheet" href="css/endcall_button.css">
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
    h3{
      color: grey;
    }
    input{
      margin-top: 230px;
    }
    #container {
    margin: 0px auto;
    width: 400px;
    height: 300px;
    border: 10px #333 solid;
    }
    #videoElement {
    width: 380px;
    height: 280px;
    background-color: #666;
    }
  </style>

</head>

<body>
  <?php
    $username = $_SESSION['login_user'];

    if($_SERVER["REQUEST_METHOD"] == "POST"){
    
      $result = $_POST['contact'];
      $result_explode = explode('|', $result);

      $to_number = $result_explode[0];
      $mycontact = $result_explode[1];

      date_default_timezone_set("Asia/Kolkata");
      $mytime = date('H:i:s');
      $myday = date("d"); 
      $mymonth = date("F"); 
      $myyear = date("Y");

      $sql = "select phone_no from customer where uname = '$username'";
      $result = mysqli_query($db, $sql);
      $row = mysqli_fetch_array($result);
      $from_number = $row['phone_no'];

      $sql2 = "select id from bill where phone_no = '$from_number' and month = '$mymonth' and year = '$myyear'";
      $result2 = mysqli_query($db, $sql2);
      $row2 = mysqli_fetch_array($result2);
      $myid = $row2['id'];

        $resultfrom = mysqli_query($db, "select plan.call_rate from customer, plan where uname = '$username' and customer.plan_id = plan.plan_id");
        $resultfromrow = mysqli_fetch_array($resultfrom);
        $callrate = $resultfromrow['call_rate'];

    if(mysqli_affected_rows($db) > 0){
     // $_SESSION['login_user'] = $myusername;
     // header("location: planselect.php");
    }
    else{
     // echo "Invalid entry";
    }
  
  ?>
  <center><h1><?php echo "$mycontact"; }?></h1></center>
  <center><h3>calling...</h3></center>
<div id="container">
    <video autoplay="true" id="videoElement">
     
    </video>
</div>
<center>
  <form action="insert_calldetails.php" method="POST">
    <input type="hidden" name="info" value="<?php echo "$from_number";?>|<?php echo "$to_number";?>|<?php echo "$myid";?>|<?php echo "$myyear";?>|<?php echo "$mymonth";?>|<?php echo "$myday";?>|<?php echo "$mytime";?>|<?php echo "$callrate";?>" />
    <button>End Call</button>
  </form></center>

</body>
<script>
  
  var video = document.querySelector("#videoElement");
 
navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia || navigator.oGetUserMedia;
 
if (navigator.getUserMedia) {       
    navigator.getUserMedia({video: true}, handleVideo, videoError);
}
 
function handleVideo(stream) {
    video.src = window.URL.createObjectURL(stream);
}
 
function videoError(e) {
    // do something
}

</script>
