
<?php

  include("config.php");
  session_start();
$username = $_SESSION['login_user'];
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    $planid = mysqli_real_escape_string($db, $_POST['planid']);
    $planname = mysqli_real_escape_string($db, $_POST['planname']);
    $callrate = mysqli_real_escape_string($db, $_POST['callrate']);

$sql = "insert into plan values('$planid','$planname','$callrate')"; 

    $result = mysqli_query($db, $sql);

    if(mysqli_affected_rows($db) > 0){
      header("location: adminplans.php");
    }
    else{
      echo "Invalid entry";
    }
  }

?>




